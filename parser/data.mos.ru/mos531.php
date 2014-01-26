<?php
require_once 'Validator.class.php';

class mos531 extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://data.mos.ru/datasets/download/';
	static $urls = array('RU-MOW' => '531');
	// поля объекта
	protected $fields = array(
		'amenity'         => 'theatre',
		'contact:website' => '',
		'_name' => '',
		'_addr' => '',
		'lat'   => '',
		'lon'   => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=theatre');

	// парсер страницы
	protected function parse($st)
	{
		$list = explode("\n", $st);
		for ($i = 1; $i < count($list); $i++)
		{
			$a = explode(';', preg_replace('/"?;"?/s', ';', $list[$i]));
			if (empty($a[0])) continue;

			$obj['_name']           = trim($a[1]);
			$obj['_addr']           = trim($a[2]);
			$obj['contact:website'] = trim($a[9]);
			$obj['lon'] = str_replace(',', '.', $a[3]);
			$obj['lat'] = str_replace(',', '.', $a[4]);
			$this->addObject($this->makeObject($obj));
		}
	}
}
