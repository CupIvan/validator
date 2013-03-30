<?php
require_once 'Validator.class.php';

class mkb extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://mkb.ru';
	static $urls = array(
		'RU-MOW' => '/about_bank/address/poi_data/search/?types[]=branch',
		'RU-MOS' => '/about_bank/address/poi_data/search/?types[]=branch',
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'bank',
		'department' => '',
		'name'     => 'МКБ',
		'operator' => 'ОАО "Московский кредитный банк"',
		'contact:website' => 'http://mkb.ru',
		'contact:phone'   => '',
		'opening_hours'   => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=bank', 'мкб');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#<filial'
			.'.+?lat="(?<lat>[^"]+)" lng="(?<lon>[^"]+)'
			.'.+?name>(?<official_name>.+?)<'
			.'.+?address>(?<_addr>[^<]+)'
			.'.+?city>(?<city>.+?)<'
			.'.+?interval>(?<time>.+?)<'
			.'.+?phones>(?<phone>.+?)</phones'
			.'.+?</filial>#s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			if ($this->region == 'RU-MOW' && $obj['city'] != 'Москва') continue;
			if ($this->region != 'RU-MOW' && $obj['city'] == 'Москва') continue;

			$phone = $obj['phone'];
			$phone = str_replace('><', '>;<', $phone); // телефоны в раздельных тегах
			$phone = preg_replace('/<.+?>/', '', $phone); // убираем теги
			$phone = str_replace('-', '', $phone);
			$obj['contact:phone'] = $this->phones($phone);
			$obj['opening_hours'] = $this->time($obj['time']);
			if (preg_match('/тделение "(.+?)"/', $obj['official_name'], $m))
				$obj['department'] = $m[1];

			$this->addObject($this->makeObject($obj));
		}
	}
}
