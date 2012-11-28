<?php
require_once 'Validator.class.php';

class gazprom extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.gpnbonus.ru';
	static $urls = array(
		'RU-MOW' => array('136' => '/our_azs/#$1'),
		'RU-MOS' => array('136' => '/our_azs/#$1_'),
		'RU-SPE' => array('139' => '/our_azs/#$1'),
		'RU-LEN' => array('139' => '/our_azs/#$1_'),
		'RU-KLU' => array('133' => '/our_azs/#$1'),
		'RU-YAR' => array('145' => '/our_azs/#$1'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'fuel',
		'brand'    => 'Газпромнефть',
		'operator' => 'ОАО "Газпром нефть"',
		'website'  => 'http://www.gazprom-neft.ru',
		'ref'      => '',
		'opening_hours'      => '',
		'payment:cards'      => '',
		'fuel:octane_98' => '',
		'fuel:octane_95' => '',
		'fuel:octane_92' => '',
		'fuel:octane_80' => '',
		'fuel:diesel'    => '',
		'fuel:lpg'       => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=fuel', 'газпр');

	// для запроса страницы необходимо установит cookies
	public function update()
	{
		$ind = array_keys(static::$urls[$this->region]); $ind = $ind[0];
		$this->context = stream_context_create(array(
			'http' => array(
				'method'  => 'GET',
				'header'  => "Cookie: upd=1; MyCity=1; MyRegion=1; SortIndex=".$ind."; CenterLon=1; CenterLat=1\n",
			)
		));
		parent::update();
	}
	// парсер страницы
	protected function parse($st)
	{
		// сохраняем параметры заправок
		$this->ext = array();
		if (preg_match_all('#'
			.'azs_other_info_(?<ref>\d+)'
			.'.+?serviceText(?<text>.+?)<'
			.'#s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $item)
		{
			$a = array();
			if (mb_strpos($item['text'], 'Visa'))  $a['payment:cards']  = 'yes';
			if (mb_strpos($item['text'], '>98<'))  $a['fuel:octane_98'] = 'yes';
			if (mb_strpos($item['text'], '>95<'))  $a['fuel:octane_95'] = 'yes';
			if (mb_strpos($item['text'], '>92<'))  $a['fuel:octane_92'] = 'yes';
			if (mb_strpos($item['text'], '>80<'))  $a['fuel:octane_80'] = 'yes';
			if (mb_strpos($item['text'], '>ДТ<'))  $a['fuel:diesel']    = 'yes';
			if (mb_strpos($item['text'], '>ГАЗ<')) $a['fuel:lpg']       = 'yes';
			if (mb_strpos($item['text'], 'руглосут')) $a['opening_hours'] = '24/7';
			$this->ext[$item['ref']] = $a;
		}

		// ищем все заправки
		if (preg_match_all('#'
			.'GeoPoint.(?<lon>[\d\.]+),(?<lat>[\d\.]+)'
			.'.+?№(?<ref>\d+)'
			.'.+?>(?<_addr>.+?)"'
			.'#s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			// фильтруем заправки не нашего региона
			if ( $this->code == 136)
			if (!$this->isInRegion('Москва|Зеленогр', 'RU-MOW', $obj['_addr'])) continue;
			if ( $this->code == 139)
			if (!$this->isInRegion('Петербург',       'RU-SPE', $obj['_addr'])) continue;

			if (isset($this->ext[$obj['ref']]))
				$obj += $this->ext[$obj['ref']];
			$this->addObject($this->makeObject($obj));
		}
	}
}
