<?php
require_once 'Validator.class.php';

class bashneft extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.bashneft-azs.ru';
	static $urls = array(
		'RU-BA'  => array('62' => '/network_azs/?region_azs=$1&set_filter=Y'),
		'RU-VOR' => array('56' => '/network_azs/?region_azs=$1&set_filter=Y'),
		'RU-TA'  => array('47' => '/network_azs/?region_azs=$1&set_filter=Y'),
		'RU-CHE' => array('48' => '/network_azs/?region_azs=$1&set_filter=Y'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'fuel',
		'brand'    => 'Башнефть',
		'operator' => '',
		'website'  => 'http://www.bashneft-azs.ru',
		'ref'      => '',
		'payment:cards'      => '',
		'payment:fuel_cards' => '',
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
	protected $filter = array('amenity=fuel', 'башн');

	// парсер страницы
	protected function parse($st)
	{
		$this->objectsCached = 0;
		if (preg_replace_callback('#GeoPoint\(.{1,200}АЗС.+?\)\);#su', function($x)
		{
			if (!preg_match('#'
			.'(?<lon>[\d\.]+),(?<lat>[\d\.]+)'
			.'.+?(?<operator>(Партнер )?О[ОА]О .+?), АЗС'
			.'.+?№\s*(?<ref>[\dА-Я/-]+)'
			.'.+?Адрес: (?<_addr>.+?)<'
			.'(?<text>.+)'
			."#su", $x[0], $obj)) return;

			// организация
			$op = $obj['operator'];
			$op = preg_replace('/Партнер.+?»/u', '', $op);
			$op = str_replace('«', '"', $op);
			$op = str_replace('»', '"', $op);
			$obj['operator'] = trim($op);

			// виды топлива
			$obj["fuel:octane_98"] = mb_stripos($obj['text'], 'Аи-98') ? 'yes' : '';
			$obj["fuel:octane_95"] = mb_stripos($obj['text'], 'Аи-95') ? 'yes' : '';
			$obj["fuel:octane_92"] = mb_stripos($obj['text'], 'Аи-92') ? 'yes' : '';
			$obj["fuel:octane_80"] = mb_stripos($obj['text'], 'Аи-80') ? 'yes' : '';
			$obj["fuel:lpg"]       = mb_strpos( $obj['text'], 'Газ')   ? 'yes' : '';
			$obj["fuel:diesel"]    = mb_strpos( $obj['text'], 'Дизель')? 'yes' : '';

			// карты
			$obj['payment:cards']      = mb_strpos($obj['text'], 'банковским') ? 'yes' : '';
			$obj['payment:fuel_cards'] = mb_strpos($obj['text'], 'топливным')  ? 'yes' : '';

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
