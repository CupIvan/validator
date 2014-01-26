<?php
require_once 'Validator.class.php';

class wiki_places extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://ru.wikipedia.org';
	static $urls = array(
		'RU-AD'  => 'Категория:Населённые_пункты_Адыгеи',
		'RU-ARK' => 'Категория:Населённые_пункты_Архангельской_области',
		'RU-VLA' => 'Категория:Населённые_пункты_Владимирской_области',
		'RU-VGG' => 'Категория:Населённые_пункты_Волгоградской_области',
		'RU-VLG' => 'Категория:Населённые_пункты_Вологодской_области',
		'RU-VOR' => 'Категория:Населённые_пункты_Воронежской_области',
		'RU-BA'  => 'Категория:Населённые_пункты_Башкортостана',
		'RU-BEL' => 'Категория:Населённые_пункты_Белгородской_области',
		'RU-BRY' => 'Категория:Населённые_пункты_Брянской_области',
		'RU-IRK' => 'Категория:Населённые_пункты_Иркутской_области',
		'RU-KLU' => 'Категория:Населённые_пункты_Калужской_области',
		'RU-KGD' => 'Категория:Населённые_пункты_Калининградской_области',
		'RU-KEM' => 'Категория:Населённые_пункты_Кемеровской_области',
		'RU-KIR' => 'Категория:Населённые_пункты_Кировской_области',
		'RU-KDA' => 'Категория:Населённые_пункты_Краснодарского_края',
		'RU-KYA' => 'Категория:Населённые_пункты_Красноярского_края',
		'RU-KRS' => 'Категория:Населённые_пункты_Курской_области',
		'RU-LEN' => 'Категория:Населённые_пункты_Ленинградской_области',
		'RU-LIP' => 'Категория:Населённые_пункты_Липецкой_области',
		'RU-MOS' => 'Категория:Населённые_пункты_Московской_области',
		'RU-OMS' => 'Категория:Населённые_пункты_Омской_области',
		'RU-PER' => 'Категория:Населённые_пункты_Пермского_края',
		'RU-PRI' => 'Категория:Населённые_пункты_Приморского_края',
		'RU-ROS' => 'Категория:Населённые_пункты_Ростовской_области',
		'RU-RYA' => 'Категория:Населённые_пункты_Рязанской_области',
		'RU-SAM' => 'Категория:Населённые_пункты_Самарской_области',
		'RU-SAR' => 'Категория:Населённые_пункты_Саратовской_области',
		'RU-STA' => 'Категория:Населённые_пункты_Ставропольского_края',
		'RU-SVE' => 'Категория:Населённые_пункты_Свердловской_области',
		'RU-TUL' => 'Категория:Населённые_пункты_Тульской_области',
		'RU-TVE' => 'Категория:Населённые_пункты_Тверской_области',
		'RU-ULY' => 'Категория:Населённые_пункты_Ульяновской_области',
		'RU-KHA' => 'Категория:Населённые_пункты_Хабаровского_края',
		'RU-CHE' => 'Категория:Населённые_пункты_Челябинской_области',
		'RU-SA'  => 'Категория:Населённые_пункты_Якутии',
		'RU-YAR' => 'Категория:Населённые_пункты_Ярославской_области',
	);
	// поля объекта
	protected $fields = array(
		'addr:country'  => 'RU',
		'addr:region'   => '',
		'addr:district' => '',
		'addr:postcode' => '',
		'place'      => '',
		'name:ru'    => '',
		'old_name'   => '',
		'official_status' => '',
		'population' => '',
		'population:date' => '',
		'_population2010'=> '', // население из переписи
		'_population2012'=> '',
		'_population2013'=> '',
		'okato:user' => '',
		'wikipedia'  => '',
		'contact:website' => '',
		'abandoned:place' => '',
		'lat'   => '',
		'lon'   => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('node,place=city,town,village,hamlet,isolated_dwelling,locality');

	public function __construct($x)
	{
		$this->context = stream_context_create(array(
			'http' => array('header'  => "User-agent: Mozilla")
		));
		parent::__construct($x);
		$this->population2010 = str_replace('ё', 'е', @file_get_contents('../parser/population2010.txt'));
		$this->population2012 = str_replace('ё', 'е', @file_get_contents('../parser/population2012.txt'));
		$this->population2013 = str_replace('ё', 'е', @file_get_contents('../parser/population2013.txt'));
		$this->populationFix  = str_replace('ё', 'е', @file_get_contents('../parser/populationFix.txt'));
	}

	private function getPlacePages($url, $ignore = array())
	{
		$links = array();

		if (empty($ignore[$url])) $ignore[$url] = 1;
		else return $links;

		$page = $this->download($this->domain.$url);
		if ($page)
		{
			$from = strpos($page,  'bodycontent');
			$to   = strpos($page, '/bodycontent');
		}
		if (empty($to))
		{
			$from = strpos($page,  'mw-subcategories');
			$to   = strpos($page, 'printfooter');
		}
		$page = substr($page, $from, $to - $from);

		// добавляем ссылки из этой категории
		$url = urldecode($url);
		if (preg_match_all('#<li><a href="(/wiki/.+?)"#s', $page, $m))
		foreach ($m[1] as $url)
		{
			$st = urldecode($url);
			if (0
				|| strpos($st, '/Населённые')
				|| strpos($st, '/Города')
				|| strpos($st, '/Список')
			) continue;
			$links[] = $url.'?action=edit';
		}

		// добавляем ссылки из подразделов
		if (preg_match_all('#(/wiki/'.urlencode('Категория').':.+?)"#', $page, $m))
		foreach ($m[1] as $url)
		{
			$st = urldecode($url);
			if (0
				|| strpos($st, ':Населённые_пункты')
				|| strpos($st, ':Города')
				|| strpos($st, ':Посёлки_городского_типа')
			)
			$links = array_merge($links, $this->getPlacePages($url, $ignore));
		}
		return $links;
	}

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Search wikipedia pages');

		self::$urls[$this->region] = array_unique($this->getPlacePages('/wiki/'.urlencode(self::$urls[$this->region])));

		parent::update();
	}

	// парсер страницы
	protected function parse($st)
	{
		$obj = array('place_type'=>''); $p = array('pop'=>null, 'st'=>'');

		// заголовок страницы (для ссылки на wiki)
		$title = preg_match('#"auto">Редактирование ([^<]+?)<#', $st, $m) ? $m[1] : '';

		$st = str_replace('{{НП2',       '{{НП-Россия', $st);
		$st = str_replace('{{НП+Россия', '{{НП-Россия', $st);

		if (!mb_strpos($st, '{{НП-')) { if (!$title) $title = urldecode($this->url); $this->log("Error parse '$title'!"); return false; }

		// названия на других языках
		if (preg_match_all('#\[\[(?<lang>[a-z]{2}):(?<name>[^&\(]+?)]]#', $st, $m, PREG_SET_ORDER))
		foreach ($m as $a)
		{
			$obj['name:'.$a['lang']] = $a['name'];
			$this->fields['name:'.$a['lang']] = ''; // разблокировка языка в фильтре
		}

		$st = preg_replace("#<table.+?</table>#s", '', $st); // вырезаем предпросмотр старых изменений
		$st = substr($st, strpos($st, '<textarea')-9, 5000);
		$st = strip_tags($st);

		$st = preg_replace("#.+?({{НП-Россия.+?\n}}.+?\n)== .+#s", '$1', "$st\n==  ");
		$st = preg_replace("#({{НП-Россия.*\|)(.+)#", "$1\n|статус = $2", $st); // параметры без имени
		$st = preg_replace("#({{НП-Россия.*\|)(.+)#", "$1\n|русское название = $2", $st);
		$st = preg_replace("#\[\[[^|\]]+\|([^|\]]+)\]\]#", '$1', $st); // удаление wiki-ссылок [[...|...]]
		$st = preg_replace("#[\[\]]#",                     '$1', $st); // удаление wiki-ссылок [[...]]
		$st =  str_replace( // исправляем баги в синтаксисе статьи
			array('|',   '&lt;', '&gt;', '&amp;', '&nbsp;', ' ', '«', '»'),
			array("\n|", '<',    '>',    '&',     ' ',      ' ', '"', '"'),
		$st);
		$st = preg_replace('#<ref.+?</ref>#s', '', $st);
		$st = preg_replace("# +#", ' ', $st);
		$st =  str_replace(array('у́', 'я́', 'а́', 'и́', '́', "'"), array('у', 'я', 'а', 'и', '', ""), $st); // убираем ударения

		if (preg_match('#\|русское название\s*=\s*([^|]+)#', $st, $m)) $obj['name:ru']    = trim(strip_tags($m[1]));
		if (preg_match('#\|оригинальное название\s*=\s*\{{lang-(.{2})\|(.+?)}}#', $st, $m)) $obj['name:'.$m[1]] = trim($m[2]);
		if (preg_match('#\|статус\s*=\s*([^|]+)#', $st, $m))             $obj['official_status'] = 'ru:'.($p['st'] = trim(mb_strtolower($m[1])));
		if (preg_match('#\|почтовый индекс\s*=\s*(\d{5}[1-9])#', $st, $m)) $obj['addr:postcode']   = $m[1]; // COMMENT: 0 на конце признак нескольких индексов у города
		if (preg_match('#\|регион\s*=\s*([^|]*)#', $st, $m))             $obj['addr:region']   = trim($m[1]);
		if (preg_match('#\|район\s*=\s*([^|]+?район)#', $st, $m))     $obj['addr:district'] = trim($m[1]);
		if (preg_match('#\|сайт\s*=\s*(http://.+?)/?$#m', $st, $m))   $obj['contact:website'] = trim($m[1]);
		if (preg_match('#\|цифровой идентификатор\s*=\s*(\d+)#', $st, $m)) $obj['okato:user'] = $m[1];
		if (preg_match('#\|вид поселения\s*=([^|]*)#', $st, $m))           $obj['place_type'] = mb_strtolower(trim($m[1]));
		if (preg_match('#\|население\s*=.*?(\d+)#', $st, $m))              $obj['population'] = $m[1];
		if (preg_match('#\|год переписи\s*=.*?(\d+)#', $st, $m))           $obj['population:date'] = $m[1];
		if (preg_match('#\|население\s*=.+?(\d[0-9 ,.]*)(.*?(?<m>|тыс|млн))#', $st, $m))
		{
			$obj['population'] = (float)str_replace(array(' ',','), array('','.'), $m[1]);
			// COMMENT: если население указано в тысячах - домножаем
			if ($m['m'] == 'тыс') $obj['population'] *= 1000;
			if ($m['m'] == 'млн') $obj['population'] *= 1000000;
		}
		if ($title) $obj['wikipedia'] = "ru:$title";

		// население задано через шаблон - пытаемся распознать его из карточки
		if (strpos($st, '{{ Население'))
		{
			$st_ = $this->download($this->domain.str_replace(['/wiki/', '?action=edit'], ['/wiki/ru:', ''], $this->url));
			if (preg_match('#Население</td>.+?<td.+?\>(.+?)</td>#su', $st_, $m))
			{
				if (preg_match('#(\d+) год#su', $m[0], $m_))
					$obj['population:date'] = $m_[1];
				$pop = strip_tags($m[0]);
				$pop = preg_replace('#\D*(\d+).*#', ' $1 ', $pop);
				$obj['population'] = (float)$pop;
			} else unset($obj['population']);
		}

		// TODO: прежние имена
		if (preg_match('#\|прежние имена\s*=\s*([^|]+)#u', $st, $m))
		{
			$obj['old_name'] = trim(strip_tags($m[1]));
			if (strpos($obj['old_name'], '{{') !== false) $obj['old_name'] = '';
			$obj['old_name'] = preg_replace('/,\s+/', ';', $obj['old_name']);
		}

		// координаты
		if (preg_match('#\|\s*lat_deg\s*=\s*\+?([\d\.]+)#', $st, $m))
		{
			$obj['lat']  = $m[1];
			if (preg_match('#\|\s*lat_min\s*=\s*(\d+)#', $st, $m)) $obj['lat'] += $m[1] / 60;
			if (preg_match('#\|\s*lat_sec\s*=\s*(\d+)#', $st, $m)) $obj['lat'] += $m[1] / 3600;
		}
		if (preg_match('#\|\s*lon_deg\s*=\s*\+?([\d\.]+)#', $st, $m))
		{
			$obj['lon']  = $m[1];
			if (preg_match('#\|\s*lon_min\s*=\s*(\d+)#', $st, $m)) $obj['lon'] += $m[1] / 60;
			if (preg_match('#\|\s*lon_sec\s*=\s*(\d+)#', $st, $m)) $obj['lon'] += $m[1] / 3600;
		}

		// обновляем население, согласно переписи
		$this->updatePopulationFromCensus($obj);

		// убираем все шаблоны
		$st = preg_replace('#{{[^{]+?}}#s', '', $st);
		$st = preg_replace('#{{[^{]+?}}#s', '', $st);

		if (isset($obj['population']))
		$p['pop']          = $obj['population'];
		$p['adm_center']   = strpos($st, 'административный центр');
		$p['adm_subject']  = preg_match('#центр.+?(области|края|республики)#', $st);
		$p['adm_district'] = preg_match('#центр.+(района|округа)[^а-я]#', $st);
		$p['adm_sp']       = preg_match('#центр.+сельского#', $st);
		if ($p['adm_district'] || $p['adm_sp']) $p['adm_subject'] = false; // если центр района, то уже не центр области
		$s = $p['st'];
		$p['selo']     = $s == 'деревня' || $s == 'село' || $s == 'сельсовет'
			|| $s == 'станица' || $s == 'хутор' || $s == 'аул'
			|| $s == 'посёлок сельского типа' || $obj['place_type'] == 'сельское поселение';
		$p['pgt'] = ($s == 'посёлок городского типа') || ($s == 'рабочий посёлок') || ($s == 'дачный посёлок');

		// населенные пункты
		if ($p['pop'] === 0.0)
		{
			$obj['place'] = 'locality';
			$obj['abandoned:place'] = ($p['st'] == 'хутор') ? 'isolated_dwelling' : 'hamlet';
		}
		else
		if (0
			|| ($p['pop'] > 100000*0.9)
			|| ($p['adm_center'] && $p['adm_subject'])
		) $obj['place'] = $p['pop'] > 40000*0.9 ? 'city' : 'town';
		else
		if (0
			|| ($p['st'] == 'город')
			|| ($p['adm_center'] && $p['pop'] > 4000*0.9 && $p['adm_district'])
			|| ($p['adm_center'] && $p['pop'] > 2000*0.9 && $p['adm_district'] && $p['pgt'])
			|| ($p['pop'] > 5000*0.9 && $p['pgt'])
			|| ($p['pop'] > 8000*0.9 && $p['selo'])
		) $obj['place'] = 'town';
		else
		if (0
			|| ($p['pgt'])
			||(($p['adm_center'] || $p['adm_sp']) && ($p['pop'] == null || $p['pop'] > 100*0.9))
			|| ($p['pop'] > 300*0.9)
		) $obj['place'] = 'village';
		else
		if ($p['st'] == 'хутор' && ($p['pop'] && $p['pop'] < 10)) $obj['place'] = 'isolated_dwelling';
		else
		if ($p['selo'] && $p['pop'] > 5) $obj['place'] = 'hamlet';

		$this->addObject($this->makeObject($obj));
	}
	/** обновление населения согласно переписи */
	private function updatePopulationFromCensus(&$obj)
	{
		$name  = preg_replace('/ая$/', 'ая^^', @$obj['name:ru']); // станица *-ая значится как *-ое сельское поселение
		$name .= ' '; // COMMENT: пробел нужен, чтобы отследить конец названия
		$regexp = '#'.@$obj['addr:region'].'\s+?'.@$obj['addr:district'].'.+?'.$name.'\s*?(?<N>\d+)#';
		$regexp = str_replace('|',        '\\|', $regexp);
		$regexp = str_replace('ё',          'е', $regexp);
		$regexp = str_replace('ая^^', '(ая|ое)', $regexp);

		if (preg_match($regexp, $this->population2010, $m))
			$obj['_population2010'] = (int)$m['N'];
		if (preg_match($regexp, $this->population2012, $m))
			$obj['_population2012'] = (int)$m['N'];
		if (preg_match($regexp, $this->population2013, $m))
			$obj['_population2013'] = (int)$m['N'];

		if (!empty($obj['okato:user']))
		{
			$regexp = '\s+'.$obj['okato:user'].'\s+(?<N>\d+)#m';
			if (preg_match('#^(2010|2012|2013)'.$regexp, $this->populationFix, $m))
				$obj['_population'.$m[1]] = (int)$m['N'];
		}

		if (!empty($obj['_population2010'])) { $obj['population:date'] = 2010; $obj['population'] = $obj['_population2010']; }
		if (!empty($obj['_population2012'])) { $obj['population:date'] = 2012; $obj['population'] = $obj['_population2012']; }
		if (!empty($obj['_population2013'])) { $obj['population:date'] = 2013; $obj['population'] = $obj['_population2013']; }
	}
}
