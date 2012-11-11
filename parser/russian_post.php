<?php
require_once 'Validator.class.php';

class russian_post extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.russianpost.ru';
	static $urls = array(
		'RU-MOW' => array(101, 135),
		'RU-MOS' => array(140, 144),
		'RU-ARK' => array(163, 165),
		'RU-MUR' => array(183, 184),
		'RU-LEN' => array(187, 188),
		'RU-SPE' => array(190, 199),
		'RU-KGD' => array(236, 238),
		'RU-KDA' => array(350, 354),
		'RU-VOR' => array(394, 397),
		'RU-VGG' => array(400, 404),
		'RU-TA'  => array(420, 423),
		'RU-ULY' => array(432, 433),
		'RU-PNZ' => array(440, 442),
		'RU-BA'  => array(450, 453),
		'RU-KIR' => array(610, 613),
		'RU-VLA' => array(600, 602),
		'RU-KYA' => array(660, 663),
		'RU-KHA' => array(680, 682),
		'RU-PRI' => array(690, 692),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'post_office',
		'name'     => '',
		'operator' => 'Почта России',
		'website'  => 'http://www.russianpost.ru',
		'ref'      => '',
		'opening_hours' => '',
		'phone' => '',
		'lat'   => '',
		'lon'   => '',
		'_name' => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=post_office', 'почт');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data '.$this->region);
		$url = '/PostOfficeFindInterface/FindOPSByPostOfficeID.aspx?index=';
		// "идентифицуируемся" :-)
		$page = $this->download($this->domain.$url, 1);
		if (preg_match('/"key" value="(\d+)"/', $page, $a))
		$this->context = stream_context_create(array(
			'http' => array(
				'method'  => 'POST',
				'header'  => "Content-Type: application/x-www-form-urlencoded\n",
				'content' => 'key='.$a[1],
			)
		));
		$page = $this->download($this->domain.$url, 1);

		list($min, $max) = static::$urls[$this->region]; $err = 0; $nerr = 0;
		$min *= 1000;
		$max  = ($max+1)*1000;
		for ($this->index = $min; $this->index < $max; $this->index++)
		{
			if ($this->index % 500 == 0) $this->log("ref = ".$this->index);
			$page = $this->download($this->domain.$url.$this->index);
			$this->parse($page);
		}
	}
	// парсер страницы
	protected function parse($st)
	{
		if (!preg_match('#'
			.'индекс:.+?;">(?<ref>\d+)'
			.'.+?связи:.+?;">(?<type>[^<]+)\s*'
			.'.+?Наименование:.+?;">(?<_name>[^<]+)\s*'
			.'.+?Телефон:.+?;">(?<phone>[^<]+)\s*'
			.'.+?Адрес:.+?">(?<_addr>[^<]+)'
			.'.+?работы:(?<hours>.+?)</tr>'
			.'.+?Перерыв:(?<dinner>.+?)</tr>'
			.'#su', $st, $obj)) return;

		// время работы
		$t = array('Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su');
		$time = array();
		if (preg_match_all('#">[^\d<]+([^<]+)#s',     $obj['hours'],  $a))
		if (preg_match_all('#">[^\d<]+(.*?)\s*</t#s', $obj['dinner'], $b))
		for ($i = 0; $i < 7; $i++)
		{
			$x = explode(' до ', $a[1][$i]);
			$y = explode(' до ', $b[1][$i]);

			if (isset($x[1]) && ($x[1] == '00:00' || $x[1] == '0:00')) continue;

			if ($x[0] == ' ')
			$time[$t[$i]] = 'Off';
			else
			$time[$t[$i]] = isset($y[1])
				? $x[0].'-'.$y[0].','.$y[1].'-'.$x[1]
				: $x[0].'-'.$x[1];
		}
		$obj['opening_hours'] = $this->time($time);

		// баги адресации
		$obj['_addr'] = str_replace('Татарстан ',    ', Татарстан ',    $obj['_addr']);
		$obj['_addr'] = str_replace('Башкортостан ', ', Башкортостан ', $obj['_addr']);

		$obj['phone'] = $this->phone($obj['phone']);

		$obj['name'] = 'Отделение связи №'.$obj['ref'];

		$this->addObject($this->makeObject($obj));
	}
	/** сохранение страницы */
	protected function savePage($url, $content)
	{
		$md5 = $this->index;
		$fname = '../_/_html/russian_post/'.$this->region.'/'.substr($md5, 0, 3);
		if (!file_exists($fname)) mkdir($fname, 0777, 1);
		$fname .= "/$md5.html";

		if (!strpos($content, '<table')) $content = '-'; // сокращаем по-минимуму страницы без индекса
		file_put_contents($fname, $content);

		return $content;
	}
	/** загрузка страницы */
	protected function loadPage($url)
	{
		$md5 = $this->index;
		$fname = '../_/_html/russian_post/'.$this->region.'/'.substr($md5, 0, 3);
		$fname .= "/$md5.html";

		if (file_exists($fname))
		if (filesize($fname) < 10) return '-'; // такого индекса нет, и не будем заново проверять
		else
		if (time() - filemtime($fname) < 3600*24*7 || mt_rand(0,9))
			return file_get_contents($fname); // старые файлы обновляем с вероятностью 1/10

		return false;
	}
}
