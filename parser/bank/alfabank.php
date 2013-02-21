<?php
require_once 'Validator.class.php';

class alfabank extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://alfabank.ru';
	static $urls = array(
		'RU-MOW' => array(
			'moscow' => '/russia/$1/',
		),
		'RU-MOS' => array(
			'balashiha' => '/russia/$1/',
			'korolev'   => '/russia/$1/',
			'odintsovo' => '/russia/$1/',
			'khimki'    => '/russia/$1/',
		),
		'RU-KGD' => array(
			'kaliningrad' => '/$1/address/',
		),
		'RU-MUR' => array(
			'murmansk' => '/$1/address/',
		),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'bank',
		'official_name' => '',
		'name'     => 'Альфа-Банк',
		'operator' => 'ОАО "Альфа-Банк"',
		'website'  => 'http://www.alfabank.ru',
		'opening_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=bank', 'альфа');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('/'
			."\'(?<id>\d+)\': *{"
			.".+?type: *'(?<type>\d+)"
			.".+?title: *'(?<official_name>[^']+)"
			.".+?href: *'(?<href>[^']+)"
			.".+?address: *'(?<_addr>[^']+)"
			.".+?lat: *'(?<lat>[^']+)"
			.".+?lon: *'(?<lon>[^']+)"
			.".+?operationTime: *'(?<time>[^']+)"
			.'.+?},/s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			if (!strpos($obj['time'], 'физ')) continue; // пропускаем отделения не для физиков
			$obj['official_name'] = str_replace(array('«','»'), array('"','"'), $obj['official_name']);

			$time = $obj['time'];
			$time = preg_replace('/<b>.+/', '', $time);
			$time = preg_replace('/-?выходной/', ' off', $time);
			$time = preg_replace('/.+Обслуживание физических лиц.+?>/', '', $time);
			$time = preg_replace('/<br>/', '', $time);
			$obj['opening_hours'] = $this->time($time);
			$obj['opening_hours'] = preg_replace('/\s*[а-я].+$/ui', '$1', $obj['opening_hours']);
			$obj['opening_hours'] = preg_replace('/(.+(0|ff)).*/',  '$1', $obj['opening_hours']);

			$this->addObject($this->makeObject($obj));
		}
	}
}
