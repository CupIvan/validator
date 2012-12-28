<?php
require_once 'Validator.class.php';

class minbank extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.minbank.ru';
	static $urls = array(
		'RU-MOW' => array('MOW' => '/include/ajax_map.php?region=95#$1'),
		'RU-MOS' => array('MOS' => '/include/ajax_map.php?region=95#$1'),
		'RU-SPE' => array('SPE' => '/include/ajax_map.php?region=173#$1'),
		'RU-LEN' => array('LEN' => '/include/ajax_map.php?region=173#$1'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'bank',
		'name'     => 'Московский индустриальный банк',
		'operator' => 'ОАО "МИнБ"',
		'website'  => 'http://www.minbank.ru',
		'opening_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=bank', 'индустр');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('/options = {.+?group\.add/s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $item)
		if (preg_match('#'
			.'(?<lon>[\d\.]+), (?<lat>[\d\.]+)'
			.'.+?Адрес</b><br>(?<_addr>[^<]+)'
			.'(.+?работы</b><br>(?<hours>.+?)<)?'
			.'.+?s(?<type>\d)_group.add'
			.'#us', $item[0], $obj))
		{
			$is = mb_stripos($obj['_addr'], 'Москва') || mb_stripos($obj['_addr'], 'Зеленоград');
			if ($this->code == 'MOW' && !$is) continue;
			if ($this->code == 'MOS' &&  $is) continue;
			$is = mb_stripos($obj['_addr'], 'Петербург');
			if ($this->code == 'SPE' && !$is) continue;
			if ($this->code == 'LEN' &&  $is) continue;

			// 1 - банкомат
			// 2 - банкомат cash in
			// 6 - банкомат 24/7
			// 5 - банк
			if ($obj['type'] != 5) continue;

			$hours = $obj['hours'];
			$obj['opening_hours'] = $this->time($hours);
			$this->addObject($this->makeObject($obj));
		}
	}
}
