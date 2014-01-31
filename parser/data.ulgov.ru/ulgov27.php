<?php
require_once 'Validator.class.php';

class ulgov27 extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://data.ulgov.ru/assets/upload/';
	static $urls = array('RU-ULY' => '27-524d656a085b6.csv');
	// поля объекта
	protected $fields = array(
		'amenity' => 'doctors',
		'contact:phone'   => '',
		'ref' => '',
		'_name' => '',
		'_addr' => '',
		'lat'   => '',
		'lon'   => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=doctors');

	// парсер страницы
	protected function parse($st)
	{
		$st = iconv('cp1251', 'utf-8', $st);
		$list = explode("\n", $st);
		for ($i = 1; $i < count($list); $i++)
		{
			$a = explode(';', str_replace('""', '"', preg_replace('/"?;"?/s', ';', $list[$i])));
			if (empty($a[0])) continue;

			$obj['_name']           = trim($a[0]);
			$obj['_addr']           = trim($a[1]);
			if (preg_match('/№\s*(\d+)/', $obj['_name'], $m))
				$obj['ref']         = $m[1];
			else
				unset($obj['ref']);
			$obj['contact:phone']   = $this->phone($a[3]);
			$this->addObject($this->makeObject($obj));
		}
	}
}
