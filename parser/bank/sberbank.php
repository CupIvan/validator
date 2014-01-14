<?php
require_once 'Validator.class.php';

class sberbank extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.sberbank.ru';
	static $urls = array(
		'RU-MOW' => array('г.Москва',                'Московский банк'),
		'RU-MOS' => array('Московская область',      'Среднерусский банк'),
		'RU-SPE' => array('г.Санкт-Петербург',       'Северо-Западный банк'),
		'RU-LEN' => array('Ленинградская область',   'Северо-Западный банк'),

		'RU-AD'  => array('Республика Адыгея',       'Юго-западный банк'),
		'RU-ARK' => array('Астраханская область',    'Поволжский банк'),
		'RU-BA'  => array('Республика Башкортостан', 'Уральский банк'),
		'RU-BRY' => array('Брянская область',        'Среднерусский банк'),
		'RU-BEL' => array('Белгородская область',    'Центрально-Черноземный банк'),
		'RU-VOR' => array('Воронежская область',     'Центрально-Черноземный банк'),
		'RU-VLG' => array('Вологодская область',     'Северный банк'),
		'RU-VGG' => array('Волгоградская область',   'Поволжский банк'),
		'RU-VLA' => array('Владимирская область',    'Волго-Вятский банк'),
		'RU-IRK' => array('Иркутская область',       'Байкальский банк'),
		'RU-LIP' => array('Липецкая область',        'Центрально-Черноземный банк'),
		'RU-KGD' => array('Калининградская область', 'Северо-Западный банк'),
		'RU-KLU' => array('Калужская область',       'Среднерусский банк'),
		'RU-KEM' => array('Кемеровская область',     'Сибирский банк'),
		'RU-KIR' => array('Кировская область',       'Волго-Вятский банк'),
		'RU-KDA' => array('Краснодарский край',      'Юго-Западный банк'),
		'RU-KYA' => array('Красноярский край',       'Восточно-Сибирский банк'),
		'RU-KRS' => array('Курская область',         'Центрально-Черноземный банк'),
		'RU-MUR' => array('Мурманская область',      'Северо-Западный банк'),
		'RU-NIZ' => array('Нижегородская область',   'Волго-Вятский банк'),
		'RU-NGR' => array('Новгородская область',    'Северо-Западный банк'),
		'RU-NVS' => array('Новосибирская область',   'Сибирский банк'),
		'RU-OMS' => array('Омская область',          'Западно-Сибирский банк'),
		'RU-ORL' => array('Орловская область',       'Центрально-Черноземный банк'),
		'RU-PNZ' => array('Пензенская область',      'Поволжский банк'),
		'RU-PER' => array('Пермский край',           'Западно-Уральский банк'),
		'RU-PRI' => array('Приморский край',         'Дальневосточный банк'),
		'RU-ROS' => array('Ростовская область',      'Юго-Западный банк'),
		'RU-RYA' => array('Рязанская область',       'Среднерусский банк'),
		'RU-SAM' => array('Самарская область',       'Поволжский банк'),
		'RU-SAR' => array('Саратовская область',     'Поволжский банк'),
		'RU-SVE' => array('Свердловская область',    'Уральский банк'),
		'RU-STA' => array('Ставропольский край',     'Северо-Кавказский банк'),
		'RU-TUL' => array('Тульская область',        'Среднерусский банк'),
		'RU-TVE' => array('Тверская область',        'Среднерусский банк'),
		'RU-TA'  => array('Республика Татарстан',    'Волго-Вятский банк'),
		'RU-ULY' => array('Ульяновская область',     'Поволжский банк'),
		'RU-KHA' => array('Хабаровский край',        'Дальневосточный банк'),
		'RU-CHE' => array('Челябинская область',     'Уральский банк'),
		'RU-YAR' => array('Ярославская область',     'Северный банк'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'bank',
		'name'     => 'Сбербанк',
		'operator' => 'ОАО "Сбербанк России"',
		'branch'   => '',
		'contact:website' => 'http://sbrf.ru',
		'contact:phone' => '',
		'ref'      => '',
		'disused'  => '',
		'department'    => '',
		'wheelchair'    => '',
		'opening_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=bank', 'сбер');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data '.$this->region);

		list($regionName, $branch) = static::$urls[$this->region];
		$this->fields['branch'] = $branch;

		$url = '/moscowoblast/ru/about/branch/list_branch//index.php';
		$pageNumber = 1;
		do
		{
			$this->log("page = $pageNumber");
			$this->context = stream_context_create(array(
				'http' => array(
					'method'  => 'POST',
					'header'  => "Content-Type: application/x-www-form-urlencoded",
					'content' => 
						"&rid115=".urlencode($regionName).
						"&cid115=0".
						"&clt115=".urlencode("физических лиц").
						"&street115=".
						"&name115=".
						"&action115=".urlencode('Искать').
						"&charset=utf8".
						"&page=$pageNumber".
						"",
				)
			));
			$page = $this->download($this->domain.$url.'#'.$this->region."-$pageNumber");

			$this->parse($page);

			// следующая страница
			if (!preg_match("#active.>$pageNumber</span>.{0,80}?fsubmit\((\d+)#s", $page, $m)) break;
			$pageNumber = $m[1];
		} while ($pageNumber);
	}
	protected function parseTime($st)
	{
		$st = str_replace(
			array('.:с', ' до ', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вск'),
			array('',    '-',    'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'),
			$st);
		$st = str_replace('круглосуточно', '00:00-24:00', $st);

		$res = array();

		if (preg_match_all('#'.
			'(?<day>Mo|Tu|We|Th|Fr|Sa|Su)'.
			'\D+?(\d\d:\d\d)\D+?(\d\d:\d\d)'.
			'(?:\D+?обед\D+?(\d\d:\d\d)\D+?(\d\d:\d\d))?'.
			'#u', $st, $m, PREG_SET_ORDER))
		foreach ($m as $a)
			$res[$a['day']] = (!empty($a[4])) ? "${a[2]}-${a[4]},${a[5]}-${a[3]}" : "${a[2]}-${a[3]}";

		return $res;
	}
	// парсер страницы
	protected function parse($st)
	{
		$st = preg_replace('/[\w\d]{100,}/', '', $st); // убираем слишком длинную строку, иначе рушится регулярка
		if (!preg_match_all('#'.
			'.*?<strong>(?<_name>[^<]+?\d[^<]+?)<'.
			'.*?Телефон: (?<phone>.+?)<br>'.
			'.*?Режим работы: (?<hours>.+?)<br>'.
			'(?<wheel>[^<]+?маломобильн)?'.
			'.*?Адрес: .+?, (?<_addr>.+?)<br>'. // в начале строки вырезаем ФИО
			'(.{0,1500}?viewPointOnMap..(?<lon>[\d.]+).,.(?<lat>[\d.]+).)?'.
			'#su', $st, $m, PREG_SET_ORDER)) return;

		foreach ($m as $obj)
		{
			if ($obj['wheel']) $obj['wheelchair'] = 'yes';
			$obj['contact:phone'] = $this->phone($obj['phone']);

			// номер отделения
			if (preg_match('#[\d/]+#', $obj['_name'], $m_))
				$obj['ref'] = $m_[0];

			// формируем часы работы
			$obj['opening_hours'] = $this->time($this->parseTime($obj['hours']));

			// обрабатываем адрес
			$obj['_addr'] = preg_replace('/\d{6}/i', '', $obj['_addr']); // убираем индекс
			$obj['_addr'] = preg_replace('/(^[^а-я0-9]+|[^а-я0-9]+$)/ui', '', $obj['_addr']); // мусор на границах
			$obj['_addr'] = preg_replace('/\(.+/ui', '', $obj['_addr']); // убираем все что в скобках и правее

			// отделение
			if (preg_match('/[а-я]+ отделение/iu', $obj['_name'], $m))
				$obj['department'] = $m[0];

			if (strpos($obj[0], 'не обслуживаются'))
			{
				$obj['disused'] = 'yes';
				$obj['opening_hours'] = '';
			}

			// заменяем координаты с сайта сбербанка на геокодированные
			$geocoder = new Geocoder();
			$obj = array_merge($obj, $geocoder->getCoordsByAddress($obj['_addr']));

			$this->addObject($this->makeObject($obj));
		}
	}
}
