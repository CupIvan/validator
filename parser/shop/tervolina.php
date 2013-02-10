<?php
require_once 'Validator.class.php';

class tervolina extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.tervolina.ru';
	static $urls = array(
		'RU-MOW' => '/img/data.xml?8330',
		'RU-MOS' => '/img/data3.xml?4505',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'shoes',
		'name'     => 'Терволина',
		'brand'    => 'TERVOLINA',
		'operator' => 'ООО "Терволина"',
		'website'  => 'http://www.tervolina.ru',
		'phone'    => '',
		'opening_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=shoes', 'терволин');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#<office'
			.'.+?metro="(?<metro>.*?)"'
			.'.+?addr="(?<_addr>.+?)"'
			.'.+?tel="(?<phone>.+?)"'
			.'.+?time="(?<time>.*?)"'
			.'.+?/>#s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$obj['_addr'] .= ($this->region == 'RU-MOW') ? ', г. Москва' : ', г. '.$obj['metro'];
			$obj['_addr'] = str_replace('&quot;', '"', $obj['_addr']);

			$obj['phone'] = $this->phone($obj['phone']);
			$obj['opening_hours'] = $this->time($obj['time']);

			$this->addObject($this->makeObject($obj));
		}
	}
}
