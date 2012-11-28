<?php
require_once 'Validator.class.php';

class hlinov extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://bank-hlynov.ru';
	static $urls = array(
		'RU-KIR' => '/about/unit_of_the_bank/additional_offices/',
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'bank',
		'official_name' => '',
		'name'     => 'Банк Хлынов',
		'operator' => 'ОАО КБ "Банк Хлынов"',
		'website'  => 'http://bank-hlynov.ru',
		'phone'    => '',
		'opening_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=bank', 'хлын');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#'
			.'<b'
			.'.{0,50}(?<_addr>(г\.|пгт\.)[^<]+)'
			.'.+?тел\.\s*(?<phone>.+?)<'
			.'.+?(?<hours>ПН.+?)</p>'
			.'#s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$hours = strip_tags($obj['hours']);
			$hours = str_replace('без перерыва', '', $hours);
			$hours = str_replace('без обеда', '', $hours);
			$obj['opening_hours'] = $this->time($hours);

			$phone = $obj['phone'];
			$phone = preg_replace('/^252-/', '+7 (8332) 252', $phone);
			$obj['phone'] = $this->phone($phone);

			$this->addObject($this->makeObject($obj));
		}
	}
}
