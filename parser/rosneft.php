<?php
require_once 'Validator.class.php';

class rosneft extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.rosneft.ru';
	static $urls = array(
		'RU-MOW' => array('Moscow-Region/Moscow' => '/Downstream/petroleum_product_sales/servicestations/$1/'),
		'RU-MOS' => array('Moscow-Region/Region' => '/Downstream/petroleum_product_sales/servicestations/$1/'),
		'RU-SPE' => array('St_Petersburg'        => '/Downstream/petroleum_product_sales/servicestations/$1/'),
		'RU-LEN' => array('Leningrad_Region'     => '/Downstream/petroleum_product_sales/servicestations/$1/'),
		'RU-VOR' => array('Voronezh_Region'      => '/Downstream/petroleum_product_sales/servicestations/$1/'),
		'RU-KDA' => array('Krasnodar_Territory'  => '/Downstream/petroleum_product_sales/servicestations/$1/'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'fuel',
		'brand'    => 'Роснефть',
		'operator' => 'ОАО "Роснефть"',
		'website'  => 'http://www.rosneft.ru',
		'ref'      => '',
		'opening_hours' => '24/7',
		'fuel:octane_98' => '',
		'fuel:octane_95' => '',
		'fuel:octane_92' => '',
		'fuel:octane_80' => '',
		'fuel:diesel'    => '',
		'lat'   => '?',
		'lon'   => '?',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=fuel', 'роснефть');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_replace_callback('#<tr>(.{1,100}нефтебаза.+?|.{1,200}[bg]>[АП]З[СК]?.+?)</tr>#su', function($x)
		{
			if (strpos($x[1], 'нефтебаза'))
			{
				if (strpos($x[1], 'Туапсе')) $GLOBALS['operator'] = 'ОАО "Роснефть-Туапсенефтепродукт"';
				else
				if ($this->region == 'RU-KDA')
					$GLOBALS['operator'] = 'ОАО "Роснефть-Кубаньнефтепродукт"';
				else
					$GLOBALS['operator'] = '';
			}
			if (!preg_match('#'
			."(?<ref>\d+)"
			.'.+?/>(?<_addr>.+?)</td'
			."#su", $x[0], $obj)) return;

			if (isset($GLOBALS['operator']))
				$obj['operator'] = $GLOBALS['operator'];

			$obj['_addr'] = trim(strip_tags(str_replace('&nbsp;', ' ', $obj['_addr'])));

			$obj["fuel:octane_98"] = strpos($x[0], 'Аи-98') ? 'yes' : '';
			$obj["fuel:octane_95"] = strpos($x[0], 'Аи-95') ? 'yes' : '';
			$obj["fuel:octane_92"] = strpos($x[0], 'Аи-92') ? 'yes' : '';
			$obj["fuel:octane_80"] = strpos($x[0], 'Аи-80') ? 'yes' : '';
			$obj["fuel:diesel"]    = strpos($x[0], 'ДТ')    ? 'yes' : '';

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
