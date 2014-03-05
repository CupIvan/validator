<?php
require_once 'Validator.class.php';

class coffeehouse extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.coffeehouse.ru';
	static $urls = array(
		'RU-MOW' => '/adress/?id_townv=24',
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'cafe',
		'name'     => 'КофеХауз',
		'name:en'  => 'Coffee House',
		'cuisine'  => 'coffee_shop',
		'contact:website' => 'http://coffehouse.ru',
		'payment:cards'   => 'yes',
		'opening_hours'   => '',
		'internet_access'     => '',
		'internet_access:fee' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=cafe', 'Кофех');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all("#BX_GMapAddPlacemark.({.+?})#s", $st, $m))
		foreach ($m[1] as $st)
		if (preg_match('#'
			.'.*?LON.:.(?<lon>[\d.]+)'
			.'.*?LAT.:.(?<lat>[\d.]+)'
			.'.*?title.">(?<name>[^<]+)'
			.'#s', $st, $obj))
		{
			if (preg_match('#\d[\d: -]+:[\d: -]+\d#', $st, $m)) $obj['opening_hours'] = $this->time($m[0]);
			if (strpos($st, '24 часа'))  $obj['opening_hours'] = '24/7';
			if (strpos($st, 'ico wifi')) $obj += ['internet_access'=>'wlan', 'internet_access:fee'=>'no'];
			$this->addObject($this->makeObject($obj));
		}
	}
}
