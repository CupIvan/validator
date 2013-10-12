<?php
require_once 'Validator.class.php';

class blood extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://yadonor.ru';
	static $urls = array(
		'RU-MOW' => '/where_35.htm',
		'RU-MOS' => '/where_2.htm',
		'RU-SPE' => '/where_79.htm',
		'RU-LEN' => '/where_81.htm',
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'blood_donation',
		'name'     => 'Служба крови',
		'contact:website' => '',
		'contact:phone' => '',
		'contact:email' => '',
		'opening_hours' => '',
		'_name' => '',
		'_addr' => '',
		'lat' => '',
		'lon' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=blood_donation');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#'
			.'app-show-smallmap'
			.'.+?data-gm1="(?<lat>[\d.]*)'
			.'.+?data-gm2="(?<lon>[\d.]*)'
			.'.+?data-name="(?<_name>[^"]*)'
			.'.+?data-address="(?<_addr>[^"]*)'
			.'.+?data-phone="(?<phone>[^"]*)'
			.'.+?data-worktime="(?<time>[^"]*)'
			.'.+?data-email="(?<email>[^"]*)'
			.'.+?data-site="(?<website>[^"]*)'
			.'#su', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$obj['contact:website'] = $obj['website'];
			$obj['contact:email']   = $obj['email'];
			$obj['opening_hours'] = $this->time($obj['time']);
			$obj['contact:phone'] = $this->phone($obj['phone']);

			$this->addObject($this->makeObject($obj));
		}
	}
}
