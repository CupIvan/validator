<?php
require_once 'Validator.class.php';

class wiki_places extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://ru.wikipedia.org';
	static $urls = array(
		'RU-ARK' => 'Категория:Населённые_пункты_Архангельской_области',
		'RU-VOR' => 'Категория:Населённые_пункты_Воронежской_области',
		'RU-BA'  => 'Категория:Населённые_пункты_Башкортостана',
		'RU-BRY' => 'Категория:Населённые_пункты_Брянской_области',
		'RU-IRK' => 'Категория:Населённые_пункты_Иркутской_области',
		'RU-KGD' => 'Категория:Населённые_пункты_Калининградской_области',
		'RU-KIR' => 'Категория:Населённые_пункты_Кировской_области',
		'RU-KDA' => 'Категория:Населённые_пункты_Краснодарского_края',
		'RU-KYA' => 'Категория:Населённые_пункты_Красноярского_края',
		'RU-KRS' => 'Категория:Населённые_пункты_Курской_области',
		'RU-LEN' => 'Категория:Населённые_пункты_Ленинградской_области',
		'RU-MOS' => 'Категория:Населённые_пункты_Московской_области',
		'RU-PER' => 'Категория:Населённые_пункты_Пермского_края',
		'RU-PRI' => 'Категория:Населённые_пункты_Приморского_края',
		'RU-ROS' => 'Категория:Населённые_пункты_Ростовской_области',
		'RU-RYA' => 'Категория:Населённые_пункты_Рязанской_области',
		'RU-SAM' => 'Категория:Населённые_пункты_Самарской_области',
		'RU-SAR' => 'Категория:Населённые_пункты_Саратовской_области',
		'RU-SVE' => 'Категория:Населённые_пункты_Свердловской_области',
		'RU-TUL' => 'Категория:Населённые_пункты_Тульской_области',
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
		'okato:user' => '',
		'wikipedia'  => '',
		'website'    => '',
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
	}

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Search wikipedia pages');
		$url  = $this->domain.'/wiki/'.urlencode(self::$urls[$this->region]);
		// список районов в области
		$page = $this->download($url);
		if (!preg_match_all("#(/wiki/[A-Z0-9%_:\(\)]+)\">Населённые пункты#su", $page, $m)) return false;
		// список городов в каждом районе
		$list = array();
		foreach ($m[1] as $url)
		{
			$page = $this->download($this->domain.$url);
			$page = preg_replace('#.+?Страницы в категории(.+?)/bodycontent.+#s', '$1', $page);
			if (!preg_match_all("#/wiki/[A-Z0-9%_:\(,\).-]+#su", $page, $m1)) continue;
			foreach ($m1[0] as $url)
			if (!strpos(urldecode($url), 'пункты'))
			if (!strpos(urldecode($url), 'пунктов'))
			if (!strpos(urldecode($url), 'район_('))       // в списке городов может быть
			if (mb_substr(urldecode($url), -5) != 'район') // ссылка на описание района
				$list[] = $url.'?action=edit';
		}
		self::$urls[$this->region] = $list;
		parent::update();
	}

	// парсер страницы
	protected function parse($st)
	{
		$obj = array('place_type'=>''); $p = array('pop'=>null, 'st'=>'');

		// заголовок страницы (для ссылки на wiki)
		$title = preg_match('#"auto">Редактирование ([^<]+?)<#', $st, $m) ? $m[1] : '';

		if (!mb_strpos($st, '{{НП-')) { $this->log("Error parse '$title'!"); return false; }

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
			array('|',   '&lt;', '&gt;', '&amp;', '&nbsp;', ' '),
			array("\n|", '<',    '>',    '&',     ' ',      ' '),
		$st);
		$st = preg_replace('#<ref.+?</ref>#s', '', $st);
		$st = preg_replace("# +#", ' ', $st);
		$st =  str_replace(array('у́', 'я́', 'а́'), array('у', 'я', 'а'), $st); // убираем ударения

		if (preg_match('#\|русское название\s*=\s*(.+)#', $st, $m)) $obj['name:ru']    = trim($m[1]);
		if (preg_match('#\|оригинальное название\s*=\s*\{{lang-(.{2})\|(.+?)}}#', $st, $m)) $obj['name:'.$m[1]] = trim($m[2]);
		if (preg_match('#\|статус\s*=\s*(.+)#', $st, $m))             $obj['official_status'] = 'ru:'.($p['st'] = trim(mb_strtolower($m[1])));
		if (preg_match('#\|население\s*=.+?(\d[\d ]*)#', $st, $m))    $obj['population'] = $p['pop'] = (int)str_replace(' ', '', $m[1]);
		if (preg_match('#\|почтовый индекс\s*=\s*(\d{5}[1-9])#', $st, $m)) $obj['addr:postcode']   = $m[1]; // COMMENT: 0 на конце признак нескольких индексов у города
		if (preg_match('#\|регион\s*=\s*(.+)#', $st, $m))             $obj['addr:region']   = trim($m[1]);
		if (preg_match('#\|район\s*=\s*(.+?район)#', $st, $m))        $obj['addr:district'] = trim($m[1]);
		if (preg_match('#\|сайт\s*=\s*(http://.+?)/?$#m', $st, $m))   $obj['website'] = trim($m[1]);
		if (preg_match('#\|цифровой идентификатор\s*=\s*(\d+)#', $st, $m)) $obj['okato:user'] = $m[1];
		if (preg_match('#\|вид поселения\s*=(.*)#', $st, $m))         $obj['place_type'] = mb_strtolower(trim($m[1]));
		if ($title) $obj['wikipedia'] = "ru:$title";

		// TODO: прежние имена
		if (preg_match('#\|прежние имена\s*=\s*([^|]+)#u', $st, $m))
		{
			$obj['old_name'] = trim(strip_tags($m[1]));
			if (strpos($obj['old_name'], '{{') !== false) $obj['old_name'] = '';
		}

		// координаты
		if (preg_match('#\|lat_deg\s*=\s*([\d\.]+)#', $st, $m))
		{
			$obj['lat']  = $m[1];
			if (preg_match('#\|lat_min\s*=\s*(\d+)#', $st, $m)) $obj['lat'] += $m[1] / 60;
			if (preg_match('#\|lat_sec\s*=\s*(\d+)#', $st, $m)) $obj['lat'] += $m[1] / 3600;
		}
		if (preg_match('#\|lon_deg\s*=\s*([\d\.]+)#', $st, $m))
		{
			$obj['lon']  = $m[1];
			if (preg_match('#\|lon_min\s*=\s*(\d+)#', $st, $m)) $obj['lon'] += $m[1] / 60;
			if (preg_match('#\|lon_sec\s*=\s*(\d+)#', $st, $m)) $obj['lon'] += $m[1] / 3600;
		}

		// убираем все шаблоны
		$st = preg_replace('#{{[^{]+?}}#s', '', $st);
		$st = preg_replace('#{{[^{]+?}}#s', '', $st);

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
		if ($p['pop'] === 0) $obj['place'] = 'locality';
		else
		if (0
			|| ($p['pop'] > 100000*0.9)
			|| ($p['adm_center'] && $p['adm_subject'])
		) $obj['place'] = $p['pop'] > 40000*0.9 ? 'city' : 'town';
		else
		if (0
			|| ($p['st'] == 'город')
			|| ($p['adm_center'] && $p['pop'] > 4000*0.9 && $p['adm_district'])
			|| ($p['adm_center'] && $p['pop'] > 2000*0.9 && $p['pgt'])
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
		if ($p['st'] == 'хутор' && ($p['pop'] == null || $p['pop'] < 10)) $obj['place'] = 'isolated_dwelling';
		else
		if ($p['selo'] && $p['pop'] > 5) $obj['place'] = 'hamlet';

		$this->addObject($this->makeObject($obj));
	}
}
