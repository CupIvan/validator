<?php
require_once 'Validator.class.php';

class temples extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.temples.ru';
	static $urls = array(
		'RU-MOW' => array('41' => '/getkml.php?TreeID=$1#$1'),
		'RU-MOS' => array('42' => '/getkml.php?TreeID=$1#$1'),
		'RU-VOR' => array('35' => '/getkml.php?TreeID=$1#$1'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'place_of_worship',
		'name'  => '',
		'denomination' => '',
		'religion'     => '',
		'disused'      => '',
		'alt_name'     => '',
		'ref:temples.ru' => '',
		'start_date' => '',
		'lat'   => '',
		'lon'   => '',
		'_id'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=place_of_worship', 'place');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_replace_callback('#<Placemark>.+?</Placemark>#s', function($x)
		{
			if (!preg_match('#'
			."<!--.+?\#(?<id>\d+)"
			.".+?<name>(?<name>.+?) \((?<state>[^\(]+?)\)</name>"
			.".+?CDATA\[(?<data>.+?)\]\]"
			.'.+?<coordinates>(?<lon>[^,]+),(?<lat>[^,]+)'
			."#su", $x[0], $obj)) { print_r($x); exit; return;}

			if (strpos(' '.$obj['state'], 'не сохр')) return; // не сохранившиеся не проверяем
			if (strpos(' '.$obj['state'], 'сохр')) $obj['disused'] = 'yes';

			$obj['ref:temples.ru'] = $obj['id'];
			$obj['name']  = preg_replace('/,? (что|во|в|на|при|у) .+/', '', $obj['name']); // сокращаем название
			$obj['name']  = preg_replace('/\(.+?\)/', '', $obj['name']); // убираем название в скобках
			$obj['data']  = trim(strip_tags($obj['data']));
			$obj['_addr'] = preg_replace('/Подроб.+/', '', $obj['data']);

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
