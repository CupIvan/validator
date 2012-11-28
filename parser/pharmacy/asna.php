<?php
require_once 'Validator.class.php';

class asna extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.asna.ru';
	static $urls = array(
		'RU-MOW' => '/drugstores/network/#MOW',
		'RU-MOS' => '/drugstores/network/#MOS',
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'pharmacy',
		'brand'    => 'АСНА',
		'website'  => 'http://asna.ru',
		'opening_hours' => '',
		'phone' => '',
		'lat'   => '',
		'lon'   => '',
		'_name' => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=pharmacy', 'асна');

	// парсер страницы
	protected function parse($st)
	{
		$id_obl = '137,214,158,188,16,90,208,220,222,223,157,169,206,199';
		$id_obl = array_fill_keys(explode(',', $id_obl), 1);

		if (preg_match_all('#'
			.'GeoPoint.(?<lon>[\d.]+),(?<lat>[\d.]+)'
			.'.+?name = "(?<_name>[^"]+)"'
			.'.+?description = "(?<_addr>.+?)<br>'
			.'(?<phone>.+?)<br>'
			.'.+?: (?<hours>.+?)<br>'
			.".+?href='(?<url>[^']+.adress/(?<ref>\d+))'"
			.'.+?addOverlay'
			."#su", $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$is =  !isset($id_obl[$obj['ref']]);
			if ($this->region == 'RU-MOW' && !$is) continue;
			if ($this->region == 'RU-MOS' &&  $is) continue;

			$obj['opening_hours'] = $this->time($obj['hours']);
			$obj['phone'] = $this->phone($obj['phone']);

			$this->addObject($this->makeObject($obj));
		}
	}
}
