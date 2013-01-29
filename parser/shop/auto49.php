<?php
require_once 'Validator.class.php';

class auto49 extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.auto49.ru';
	static $urls = array(
		'RU-MOW' => array('МОСКВА'  => '/site.php/shop/#$1'),
		'RU-MOS' => array('МОСКОВСКАЯ ОБЛАСТЬ' => '/site.php/shop/#$1'),
		'RU-SPE' => array('САНКТ-ПЕТЕРБУРГ' => '/site.php/shop/#$1'),
	);
	// поля объекта
	protected $fields = array(
		'shop' => 'car_parts',
		'brand' => 'АВТО 49',
		'website'  => 'http://www.auto49.ru',
		'phone' => '',
		'opening_hours' => '',
		'payment:cards' => 'yes',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=car_parts', '49');

	// парсер страницы
	protected function parse($st)
	{
		$region = '';
		if (preg_match_all('#std>\d.+?std>(?<text>.+?)</font>#s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$st = $obj['text'];
			if (!strpos($st, '<b>')) { $region = $st; continue; }
			if ($this->code != $region) continue;

			if (preg_match('#(.+?)\s*\(#', $st, $m))
				$obj['_addr'] = $m[1];
			if (preg_match('#\d[\d. до]*-[\d. ]+#u', $st, $m))
			{
				$t = $m[0];
				if (substr_count($t, '-') == 2)
				$t = preg_replace('#-(\d{2}(\s|$))#', ':$1', $t);
				$t = $this->time($t);
				$obj['opening_hours'] = $t;
			}
			if (preg_match('#тел. ([\d \(\)-]{7,})#u', $st, $m))
				$obj['phone'] = $this->phone($m[1]);

			$this->addObject($this->makeObject($obj));
		}
	}
}
