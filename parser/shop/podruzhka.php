<?php
require_once 'Validator.class.php';

class podruzhka extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.podrygka.ru';
	static $urls = array(
		'RU-MOW' => '/shops/find/',
		'RU-MOS' => '/shops/find/',
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
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=chemist', 'подруж');

	// парсер страницы
	protected function parse($st)
	{
		if (!preg_match('#points = (\[.+\]);</script>#s', $st, $m)) return false;
		$a = json_decode($m[1], true);
		foreach ($a as $obj)
		{
			if (preg_match('#г\.\s*\w+#u', $obj['TEXT'], $m))
			{
				$city = $m[0];
				if ($this->region == 'RU-MOW') continue;
			}
			else
			{
				$city = 'Москва';
				if ($this->region != 'RU-MOW') continue;
			}

			$obj['lat'] = $obj['LAT'];
			$obj['lon'] = $obj['LON'];

			if (preg_match('#Адрес:</b>\s*(.+?)<#',  $obj['TEXT'], $m)) $obj['_addr'] = $city.', '.$m[1];
			if (preg_match('#с .+? до .+?\d+,#', $obj['TEXT'], $m))
				$obj['opening_hours'] = $this->time(str_replace('без выходных и прерывов', '', $m[0]));

			$obj['_addr'] = str_replace('&quot;', '"', $obj['_addr']);

			$this->addObject($this->makeObject($obj));
		}
	}
}
