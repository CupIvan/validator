<?php
require_once 'Validator.class.php';

class podruzhka extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.podrygka.ru';
	static $urls = array(
		'RU-MOW' => '/ajax/allshops.php',
		'RU-MOS' => '/ajax/allshops.php',
		'RU-SPE' => '/ajax/allshops.php',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'chemist',
		'name'     => 'Подружка',
		'brand'    => 'Подружка',
		'operator' => 'ООО "Табер Трейд"',
		'contact:website' => 'http://www.podrygka.ru',
		'contact:phone'   => '+7-495-9268082',
		'opening_hours'   => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		'website' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=chemist', 'подруж');

	// парсер страницы
	protected function parse($st)
	{
		$json = json_decode($st, true);

		foreach ($json['shops-list'] as $key => $shop) {
			$obj['lat'] = $shop['coords'][0];
			$obj['lon'] = $shop['coords'][1];
			$obj['website'] = $this->domain . $shop['link'] . '/';
			$obj['opening_hours'] = $this->time(str_replace('без выходных и прерывов', '', $shop['time']));
			$obj['_addr'] = $shop['address'];

			$this->addObject($this->makeObject($obj));
		}
	}
}
