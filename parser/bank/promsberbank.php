<?php
require_once 'Validator.class.php';

class promsberbank extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.promsbank.ru';
	static $urls = array(
		'RU-MOW' => array('Москва' => '/files/sgm_nodes.json'),
		'RU-MOS' => array('Подольск|Климовск|Щербинка|Щелково' => '/files/sgm_nodes.json'),
		'RU-KLU' => array('Обнинск' => '/files/sgm_nodes.json'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'bank',
		'name'     => 'Промсбербанк',
		'operator' => 'ЗАО "Промсбербанк"',
		'website'  => 'http://www.promsbank.ru/',
		'phone'    => '',
		'ref'      => '',
		'lat'   => '',
		'lon'   => '',
		'_data' => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=bank', 'промсбер');

	// парсер страницы
	protected function parse($st)
	{
		$a = json_decode($st, 1);

		foreach ($a as $obj)
		if ($obj['cat_name'] == 'Офисы') // TODO: добавить банкоматы
		{
			// фильтруем только "наш" регион
			if (!preg_match('/('.$this->code.')/', $obj['name'])) continue;

			// разделяем адрес и данные
			$obj['body'] = str_replace('&nbsp;', ' ', $obj['body']);
			preg_match('/^(?<addr>.{10,}?)(?<data><.+)/s', $obj['body'], $d);
			$obj['_data'] = preg_replace('/<.+?>/', ' ', $d['data']);

			// адрес
			$obj['_addr'] = strip_tags($d['addr']);
			if (!strpos($obj['_addr'], $obj['name']))
				$obj['_addr'] = 'г. '.$obj['name'].', '.$obj['_addr'];

			// телефон
			if (preg_match('#\([\d\) -]+#', $obj['_data'], $m))
				$obj['phone'] = $this->phone($m[0]);

			// номер отделения
			if (0
				|| preg_match('/№\s*(\d+)/', $obj['_data'], $m)
				|| preg_match('/№\s*(\d+)/', $obj['title'], $m)
			) $obj['ref'] = $m[1];

			list($obj['lat'], $obj['lon']) = explode(', ', $obj['gmap_coordinates']);

			unset($obj['name']); // стираем неправильное название

			$this->addObject($this->makeObject($obj));
		}
	}
}
