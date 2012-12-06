<?php
require_once 'Validator.class.php';

class sberbank extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.sbrf.ru';
	static $urls = array(
		'RU-MOW' => array('г.Москва',                'Московский банк'),
		'RU-MOS' => array('Московская область',      'Среднерусский банк'),
		'RU-SPE' => array('г.Санкт-Петербург',       'Северо-Западный банк'),
		'RU-LEN' => array('Ленинградская область',   'Северо-Западный банк'),

		'RU-ARK' => array('Астраханская область',    'Поволжский банк'),
		'RU-BA'  => array('Республика Башкортостан', 'Уральский банк'),
		'RU-BRY' => array('Брянская область',        'Среднерусский банк'),
		'RU-BEL' => array('Белгородская область',    'Центрально-Черноземный банк'),
		'RU-VOR' => array('Воронежская область',     'Центрально-Черноземный банк'),
		'RU-VLG' => array('Вологодская область',     'Северный банк'),
		'RU-VGG' => array('Волгоградская область',   'Поволжский банк'),
		'RU-VLA' => array('Владимирская область',    'Волго-Вятский банк'),
		'RU-IRK' => array('Иркутская область',       'Байкальский банк'),
		'RU-KGD' => array('Калининградская область', 'Северо-Западный банк'),
		'RU-KLU' => array('Калужская область',       'Среднерусский банк'),
		'RU-KEM' => array('Кемеровская область',     'Сибирский банк'),
		'RU-KIR' => array('Кировская область',       'Волго-Вятский банк'),
		'RU-KDA' => array('Краснодарский край',      'Юго-Западный банк'),
		'RU-KYA' => array('Красноярский край',       'Восточно-Сибирский банк'),
		'RU-KRS' => array('Курская область',         'Центрально-Черноземный банк'),
		'RU-MUR' => array('Мурманская область',      'Северо-Западный банк'),
		'RU-NIZ' => array('Нижегородская область',   'Волго-Вятский банк'),
		'RU-ORL' => array('Орловская область',       'Центрально-Черноземный банк'),
		'RU-PNZ' => array('Пензенская область',      'Поволжский банк'),
		'RU-PER' => array('Пермский край',           'Западно-Уральский банк'),
		'RU-PRI' => array('Приморский край',         'Дальневосточный банк'),
		'RU-ROS' => array('Ростовская область',      'Юго-Западный банк'),
		'RU-SAM' => array('Самарская область',       'Поволжский банк'),
		'RU-SAR' => array('Саратовская область',     'Поволжский банк'),
		'RU-SVE' => array('Свердловская область',    'Уральский банк'),
		'RU-STA' => array('Ставропольский край',     'Северо-Кавказский банк'),
		'RU-TUL' => array('Тульская область',        'Среднерусский банк'),
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
		'website'  => 'http://sbrf.ru',
		'phone'    => '',
		'ref'      => '',
		'department' => '',
		'wheelchair' => '',
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
		$action = urlencode('Искать'); $pageNumber = 1;
		do
		{
			$this->log("page = $pageNumber");
			$this->context = stream_context_create(array(
				'http' => array(
					'method'  => 'POST',
					'header'  => "Content-Type: application/x-www-form-urlencoded\n",
					'content' => "rid115=$regionName&cid115=0&clt115=0&action115=$action&page=$pageNumber",
				)
			));
			$page = $this->download($this->domain.$url.'#'.$this->region."-$pageNumber");

			$this->parse($page);

			// следующая страница
			if (!preg_match("#active.>$pageNumber</span>.{0,80}?fsubmit\((\d+)#s", $page, $m)) break;
			$pageNumber = $m[1];
		} while ($pageNumber);
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
			$obj['phone'] = $this->phone($obj['phone']);

			// номер отделения
			if (preg_match('#[\d/]+#', $obj['_name'], $m_))
				$obj['ref'] = $m_[0];

			// формируем часы работы
			$st = $obj['hours'];
			$st = str_replace(
				array('Пн.','Вт.','Ср.','Чт.','Пт.','Сб.','Вск.'), $days_list =
				array('Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'),
				$st);
			$st = str_replace('круглосуточно', '00:00-24:00', $st);
			$days  = explode(',', explode(' ',$st)[0]);
			preg_match_all('/(.)(\d\d:\d\d)/', $st, $hours);
			$day = 0; $skobka = $hours[1]; $hours = $hours[2]; // skobka[i]=='(' - признак времени обеда

			// формируем часы работы по дням
			$a = array(); $i = 0;
			foreach ($days as $day)
			if ($day)
			{
				if (isset($skobka[$i+2]) && $skobka[$i+2] == '(')
				{
					if ($hours[$i+3] != '00:00')
						$time = $hours[$i].'-'.$hours[$i+2].','.$hours[$i+3].'-'.$hours[$i+1];
					else
						$time = $hours[$i].'-'.$hours[$i+1];
					$i += 2; // пропускаем обед
				}
				else
					$time = $hours[$i].'-'.$hours[$i+1];

				$a[$day] = $time;
				$i += 2;
			}
			$obj['opening_hours'] = $this->time($a);

			// обрабатываем адрес
			$obj['_addr'] = preg_replace('/\d{6}/i', '', $obj['_addr']); // убираем индекс
			$obj['_addr'] = preg_replace('/(^[^а-я0-9]+|[^а-я0-9]+$)/ui', '', $obj['_addr']); // мусор на границах
			$obj['_addr'] = preg_replace('/\(.+/ui', '', $obj['_addr']); // убираем все что вскобках и правее

			// отделение
			if (preg_match('/[а-я]+ отделение/iu', $obj['_name'], $m))
				$obj['department'] = $m[0];

			// заменяем координаты с сайта сбербанка на геокодированные
			$geocoder = new Geocoder();
			$obj = array_merge($obj, $geocoder->getCoordsByAddress($obj['_addr']));

			$this->addObject($this->makeObject($obj));
		}
	}
}
