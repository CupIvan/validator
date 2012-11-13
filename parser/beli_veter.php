<?php
require_once 'Validator.class.php';

class beli_veter extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.digital.ru';
	static $urls = array(
		'RU-MOW' => array('moscow'               => '/shops/$1/view'),
		'RU-MOS' => array('moskovskaya_oblast'   => '/shops/$1/view'),
		'RU-SPE' => array('saint_petersburg'     => '/shops/$1/view'),
		'RU-SAM' => array('samarskaya_oblast'    => '/shops/$1/view'),
		'RU-TA'  => array('respublika_tatarstan' => '/shops/$1/view'),
		'RU-YAR' => array('yaroslavskaya_oblast' => '/shops/$1/view'),
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'electronics',
		'name'     => 'Белый ветер',
		'operator' => 'ООО "Белый ветер"',
		'website'  => 'http://www.digital.ru',
		'ref'      => '',
		'opening_hours' => '',
		'phone'    => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);

	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=electronics', 'ветер');

	// парсер страницы
	protected function parse($st)
	{
		if (!preg_match('#StoresMap.init.\s*(.+?}}),#s', $st, $m)) return;

		$objects = json_decode($m[1], true);

		foreach ($objects as $id => $obj)
		{
			$obj['ref']   = $id;
			$obj['lon']   = $obj['lng'];
			$obj['_addr'] = $obj['address'];

			// часы работы
			$hours = mb_strtolower($obj['workMode']);
			$hours = preg_replace('/^(\d):/', '0$1:',
				str_replace(
					array('пн', 'чт', 'пт', 'сб', 'вс', 'вc', 'с', 'c', 'до', ' '),
					array('Mo', 'Th', 'Fr', 'Sa', 'Su', 'Su', '',  '',  '-',  ''),
					$hours
				)
			);
			$hours = preg_replace('/(.+)ввыходныеипраздничныедни-.+/', 'Mo-Fr $1 Sa-Su 00:00-24:00', $hours);

			$hours = preg_replace('/([a-z])(\d)/', '$1 $2', $hours);
			$hours = preg_replace('/;([A-Z])/', '; $1', $hours);
			$hours = preg_replace('/(\d)[,  ]+([A-Z])/', '$1; $2', $hours);
			$hours = preg_replace('/-0/', ':0', $hours);
			$obj['opening_hours'] = $this->time($hours);

			// номер телефона
			$phone = $obj['phoneNumbers'];
			$phone = preg_replace('/доб.+/', '', $phone);
			$obj['phone'] = $this->phone($phone);//substr($phone, 0, 12));

			$this->addObject($this->makeObject($obj));
		}
	}
}
