<?php
require_once 'Validator.class.php';

class lapy4 extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://4lapy.ru';
	static $urls = array(
		'RU-MOW' => '/pet_stores_amp_services/30/',
		'RU-MOS' => '/pet_stores_amp_services/31/',
		'RU-YAR' => '/pet_stores_amp_services/34/',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'pet',
		'name'     => 'Четыре лапы',
		'website'  => 'http://4lapy.ru',
		'phone'    => '',
		'opening_hours' => '',
		'payment:cards' => '',
		'pets'       => '',
		'aquarium'   => '',
		'veterinary' => '',
		'grooming'   => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=pet', 'лапы');

	/** обновление данных по региону */
	public function update()
	{
		$url  = $this->domain.self::$urls[$this->region];
		$page = $this->download($url);
		if (!preg_match_all("#href='(/pet_stores_amp_services/\d+/\d+/)'#su", $page, $m)) return false;
		self::$urls[$this->region] = $m[1];
		parent::update();
	}
	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#var placemark'
			.'.+?Point.(?<lon>[\d\.]+),(?<lat>[\d\.]+)'
			.'.+?<h3>(?<_addr>.+?)</h3>'
			.'.+?Телефон: (?<phone>.+?)<'
			.'.+?работы: (?<hours>.+?)<'
			.".+?class=.card(?<ext>.+?)\t</div>"
			."#su", $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$obj['_addr'] = html_entity_decode(strip_tags($obj['_addr']));
			$obj['phone'] = strip_tags($this->phone($obj['phone']));
			$obj['opening_hours'] = $this->time($obj['hours']);
			if (strpos($obj['ext'], 'visa.')) $obj['payment:cards'] = 'yes';
			if (strpos($obj['ext'], 'fish.')) $obj['aquarium']      = 'yes';
			if (strpos($obj['ext'], 'helf.')) $obj['veterinary']    = 'yes';
			if (strpos($obj['ext'], 'slon.')) $obj['pets']          = 'yes';
			if (strpos($obj['ext'], 'str.'))  $obj['grooming']      = 'yes';
			$this->addObject($this->makeObject($obj));
		}
	}
}
