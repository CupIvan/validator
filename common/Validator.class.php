<?php
require_once 'OsmFunctions.class.php';
require_once 'Geocoder.class.php';

mb_internal_encoding('utf-8');

class Validator extends OsmFunctions
{
	protected $domain  = '';
	static    $urls    = array();
	protected $fields  = array();
	protected $region  = '';
	protected $objects = array();
	protected $filter  = array();
	protected $context = null; // для download
	public    $useCacheHtml = false; // страницы только из кеша
	public    $updateHtml   = false; // перезакачать html страницы

	/** конструктор - проверка возможности работы с заданным регионом */
	public function __construct($region)
	{
		if (!isset(static::$urls[$region])) throw new Exception('Unknow region!');
		$this->region = $region;
		$this->context = stream_context_create(array(
			'http' => array('method' => 'GET', 'timeout' => 5, 'header' => "User-agent: OSM validator http://osm.cupivan.ru\r\n")
		));
	}
	/** список областей */
	static function getRegions()
	{
		return array_keys(static::$urls); // COMMENT: позднее статическое связывание
	}
	/** доступна ли область для валидации */
	static function isRegion($x)
	{
		return isset(static::$urls[$x]);
	}
	/** реальные объекты */
	public function getObjects()
	{
		return $this->objects;
	}
	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data');
		$urls = static::$urls[$this->region];
		if (is_string($urls)) $urls = array('' => $urls);
		foreach ($urls as $id => $url)
		{
			$url = str_replace('$1', $id, $url);
			$page = $this->download($this->domain.$url);
			$this->code = $id;
			$this->url  = $url;
			$this->parse($page);
		}
	}
	/** сохранение страницы */
	protected function savePage($url, $content)
	{
		$fname = $this->pageFileName($url);
		file_put_contents($fname, $content);
		return $content;
	}
	/** загрузка страницы */
	protected function loadPage($url)
	{
		$fname = $this->pageFileName($url);
		$reload = 0;
		if (!file_exists($fname)) $reload = 1;
		else
		if ($this->useCacheHtml) $reload = 0;
		else
		if (time() - filemtime($fname) < 3600*24) $reload = 0; // обновляли только что, поэтому больше не надо
		else if ($this->updateHtml || mt_rand(0,9) == 0)
			$reload = 1; // старые файлы обновляем с вероятностью 1/10
		return $reload ? false : file_get_contents($fname);
	}
	/** имя файла для сохранения страницы */
	protected function pageFileName($url)
	{
		$md5 = md5($url);
		$fname = '../_/_html/'.get_called_class().'/'.$this->region.'/'.substr($md5, 0, 2);
		if (!file_exists($fname)) mkdir($fname, 0777, 1);
		$fname .= "/$md5.html";
		return $fname;
	}
	/** скачивание страницы из интернета, force - не использовать кеш */
	protected function download($url, $force = 0)
	{
		$page = $force ? '' : $this->loadPage($url);
		if (!$page)
		{
			$this->log("Download: ".urldecode($url));
			$page = @file_get_contents($url, false, $this->context);
			if (!$page)
			{
				$this->log("Error download: $url\n");
				return '';
			}
			$this->response = $http_response_header; // заголовки ответа
			if (stripos($page.implode('', $this->response), 'windows-1251'))
				$page = iconv('cp1251', 'utf-8', $page);

			if (!$force)
				$page = $this->savePage($url, $page);
		}
		return $page;
	}
	/** функция валидации объектов */
	public function validate()
	{
		$this->log("Validate not supported yet!\n");
	}
	/** функция сравнения объектов */
	protected function compare($osm, $real)
	{
		$res = array('result' => 'ok');
		foreach ($real as $k => $v)
		if (!isset($osm[$k]))
		{
			$res[$k] = array('result' => 'empty', 'right' => $real[$k]);
			if ($res['result'] != 'error') $res['result'] = 'empty';
		}
		else
		if ($v != $osm[$k])
		{
			$res[$k] = array('result' => 'error', 'value' => $v, 'right' => $real[$k]);
			$res['result'] = 'error';
		}
		return $res;
	}
	/** универсальная функция преобразования времени в стандартный формат */
	protected function time($st)
	{
		// передали массив - формируем строку
		if (is_array($st))
		{
			// формируем хэш: время => день
			$a = array();
			foreach ($st as $k => $v)
			{
				if (!isset($a[$v])) $a[$v] = array();
				array_push($a[$v], $k);
			}
			// перемещаем off в конец
			if (isset($a['off']))
			{
				$off = $a['off'];
				unset($a['off']);
				$a['off'] = $off;
			}
			// склеиваем в строку учитывая одинаковое время работы
			$res = '';
			foreach ($a as $time => $days)
				$res .= ($res?'; ':'').implode(',', $days).' '.$time;
			// перечисляем нерабочие дни
			$edays = array('Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su');
			// склеиваем соседние дни
			for ($i = 1; $i < count($edays); $i++)
				$res = str_replace($edays[$i-1].','.$edays[$i], $edays[$i-1].'-'.$edays[$i], $res);
			$res = preg_replace('/-[-\w]+-/', '-',    $res);
			$res = str_replace('Mo-Su ',      '',     $res);
			$res = str_replace('00:00-24:00', '24/7', $res);
			return $res;
		}

		// FIXME: отрефакторить - сделать один return

		$st = ' '.strip_tags(mb_strtolower($st, 'utf-8')).' ';
		if (mb_stripos($st, 'круглос')) $st = '24/7';
		$st = str_replace(
			array('выходной', 'будни', 'выходные', 'ежедневно', 'круглосуточно', ' ', 'c', ' и ', ' в ',
				' до ', ' по ', ',', '.', '&ndash;', '&mdash;', '&nbsp;', '–', '—', '00:00'),
			array('off',      'Mo-Fr', 'Sa-Su',    'Mo-Su',     'Mo-Su',         ' ', 'с', ', ',  ' ',
				'-',    '-',    ';', '', '-', '-', ' ', '-', '-', '24:00'), $st);
		$st = preg_replace('#(\D)(\d{1,2})\s*-\s*(\d{1,2})\s#', '$1$2:00-$3:00', $st);
		$st = preg_replace(
			array('/\s(\d{1,2})\s*-/','/-\s*(\d{1,2})\s/','/-\s*(\d{1,2});/',
				'/[ \s]*—[ \s]*/u', '/пн\.?/iu','/вт\.?/iu','/ср\.?/iu','/чт\.?/iu',
				'/пт\.?/iu','/сб\.?/iu','/вск?\.?/iu', '/([a-z])(\d)/',
				'/\s+/', '/(\d)\s*([A-Z])/', '/([a-z])[^\da-z]+(\d)/', '/ [дп]о /u', '/(^|\D)(\d:)/',
				'/[  ]?-[  ]?/', '/[^\d\s]00/', '/\s*;/', '/;(\S)/', '/;[; ]+/', '/;\s*$/', '/([a-z]); ([A-Z])/',
				'/(\d{2})(\d{2})/','/(\d{1})(\d{2})/', '/-off/',
				),
			array(' $1:00-', '-$1:00 ', '-$1:00;',
				'-', 'Mo','Tu','We','Th',
				'Fr','Sa','Su', '$1 $2',
				' ', '$1; $2', '$1 $2', '-',
				'${1}0$2', '-', ':00', ';', '; $1', '; ', '', '$1-$2',
				'$1:$2','0$1:$2', ' off'
				), $st);
		$st = str_replace(
			array('-Tu-', '-We-', '-Th-', '-Fr-', '-Sa-'),
			array('-',    '-',    '-',    '-',    '-'),
			$st
		);
		$st = str_replace('с ',          '',     $st);
		$st = str_replace('Mo-Su ',      '',     $st);
		$st = str_replace('00:00-24:00', '24/7', $st);

		$st = trim($st);

		// валидация запрещенных символов
		if ($st != '24/7' && preg_match('/[^\d:-a-z -]/i', $st)) return '';
		return $st;
	}
	/** универсальная функция преобразования телефона в стандартный формат */
	protected function phone($st)
	{
		$st = preg_split('/[,;\/]/', $st); $st = $st[0]; // возможно несколько телефонов, берем первый
		$st = preg_replace('/[^\d()]/', '', $st); // оставляяем цифры и скобки
		$st = preg_replace('/^7/', '8',     $st); // заменяем первую 7 на 8 (+7 которая)
		$st = preg_replace('/^8?\((.+?)\)(.+)/', '+7-$1-$2', $st, -1, $n); // приводим к стандарту RFC
		$st = preg_replace('/\(.+/', '', $st); // удаляем оставшиеся скобки, от второго телефона
		$st = preg_replace('/^8?(\d{3})(\d+)/',   '+7-$1-$2', $st); // выделяем код города - первые 3 цифры
		$len = strlen($st);
		if ($len <= 12 || $len > 14) $st = ''; // что-то пошло не так: получился короткий номер +7-000-12345
		$st = str_replace('-', ' ', $st); // формат E.123, DIN 5008
		return $st;
	}
	/** преобразование нескольких телефонов */
	protected function phones($st)
	{
		$res = '';
		$list = explode(';', $st);
		foreach ($list as $item)
			$res .= ($res?';':'').$this->phone($item);
		return $res;
	}
	/** создание объекта с нужными полями */
	protected function makeObject($fields)
	{
		if (!empty($fields['_addr']))
			$fields['_addr'] = trim(strip_tags($fields['_addr']));
		// добавляем координаты
		if (empty($fields['lat']) && !empty($fields['_addr']))
		{
			$geocoder = new Geocoder();
			$fields += $geocoder->getCoordsByAddress($fields['_addr']);
		}

		$obj = array();
		foreach ($this->fields as $k => $v)
			if (isset($fields[$k]) && $fields[$k] !== '')
				$obj[$k] = ''.$fields[$k];
			else
			{
				if (is_array($v)) $v = @$v[$this->region];
				if ($v) $obj[$k] = ''.$v;
			}
		return $obj;
	}
	/** фильтрация объекта не нашего региона */
	protected function isInRegion($city, $region, $text)
	{
		$t1 = $this->region == $region;   // совпадение по региону
		$t2 = preg_match("/$city/u", $text); // совпадение по адресу
		return ($t1 && $t2) || (!$t1 && !$t2)? 1 : 0; // оба совпали или оба не совпали
	}
	/** преобразование html таблицы в массив */
	protected function htmlTable2Array($html)
	{
		$a = [];
		$rowId = 0; $columnId = 0; $rowspan = []; $colspan = [];
		foreach (new SimpleXMLElement($html) as $tr)
		{
			$a[$rowId] = []; $columnId = 0;
			foreach ($tr->td as $td)
			{
				$value = (string)$td;

				while (!empty($rowspan[$columnId]))
				{
					$a[$rowId][$columnId] = trim($rowspan[$columnId][1]);
					if (--$rowspan[$columnId][0] < 1) unset($rowspan[$columnId]);
					$columnId++;
				}
				if ($n = (int)($td->attributes()['rowspan']))
					$rowspan[$columnId] = [$n-1, $value];

				$a[$rowId][$columnId] = trim($value);
				$columnId++;
			}
			$rowId++;
		}
		return $a;
	}
	/** добавление объекта во время парсинга страницы */
	protected function addObject($object)
	{
		array_push($this->objects, $object);
	}
	/** логирование */
	protected function log($st)
	{
		echo "[".date('H:i:s')."] $st\n";
	}
}
