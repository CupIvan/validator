<?php
require_once 'Validator.class.php';

class auchan extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.auchan.ru';
	static $urls = array(
		'RU-MOW' => '/ru/moscow',
		'RU-VOR' => '/ru/voronezh',
		'RU-SPE' => '/ru/saint_petersburg',
		'RU-SAM' => '/ru/samara',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'supermarket',
		'name'     => 'Ашан',
		'brand'    => 'Auchan',
		'operator' => 'ООО "АШАН"',
		'website'  => 'http://www.auchan.ru',
		'opening_hours' => '',
		'ref'   => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'ашан');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_replace_callback('#<li><strong.+?</li>#s', function($x)
		{
			if (!preg_match('#<li>'
			.'.+?(?<ref>[^>]+)</a>'
			.'.+?дрес.+?(>)(?<_addr>.+?)</p>'
			.'(.+?работы.+?/>(?<time>.+?)</p>)?'
			.".*?</li>#su", $x[0], $obj)) return;

			$obj['_addr'] = preg_replace('/\d{6}/', '', $obj['_addr']);

			if (strpos($obj['ref'], 'Сити'))
			{
				$obj['ref']  = str_replace('АШАН Сити ', '', $obj['ref']);
				$obj['name'] = 'Ашан Сити';
			}
			else
			if (strpos($obj['ref'], 'Сад'))
			{
				$obj['ref']  = str_replace('АШАН Сад ',  '', $obj['ref']);
				$obj['name'] = 'Ашан Сад';
			}

			if (isset($obj['time']))
			{
				$time = $obj['time'];
				$time = str_replace(
					array('ежедневно', ' с ', 'по', '.', '<br />'),
					array('',          ' ',  '-',  ':', '; '),
				$time);
				$obj['opening_hours'] = $this->time($time);
			}

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
