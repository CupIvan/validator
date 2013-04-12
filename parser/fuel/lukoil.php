<?php
require_once 'Validator.class.php';

class lukoil extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.lukoil.ru';
	static $urls = array(
		'RU-BA'  => 33,
		'RU-KGD' =>  8,
		'RU-KDA' => 44,
		'RU-LEN' => 22,
		'RU-MOS' => 38,
		'RU-MOW' => 36,
		'RU-PER' => 72,
		'RU-SPE' => 21,
		'RU-VLG' =>  7,
		'RU-VGG' =>  2,
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'fuel',
		'brand'    => 'Лукойл',
		'operator' => array(
			'RU-BA'  => 'ООО "ЛУКОЙЛ-Уралнефтепродукт"',
			'RU-KGD' => 'ООО "ЛУКОЙЛ-Северо-Западнефтепродукт"',
			'RU-KDA' => 'ООО "ЛУКОЙЛ-Югнефтепродукт"',
			'RU-MOS' => 'ООО "ЛУКОЙЛ-Центрнефтепродукт"',
			'RU-MOW' => 'ООО "ЛУКОЙЛ-Центрнефтепродукт"',
			'RU-PER' => 'ООО "ЛУКОЙЛ-Пермнефтепродукт"',
			'RU-SPE' => 'ООО "ЛУКОЙЛ-Северо-Западнефтепродукт"',
			'RU-LEN' => 'ООО "ЛУКОЙЛ-Северо-Западнефтепродукт"',
			'RU-VLG' => 'ООО "ЛУКОЙЛ-Волганефтепродукт"',
			'RU-VGG' => 'ООО "ЛУКОЙЛ-Нижневолжскнефтепродукт"',
		),
		'contact:website' => 'http://www.lukoil.ru',
		'ref'      => '',
		'opening_hours' => '24/7',
		'fuel:octane_98' => '',
		'fuel:octane_95' => '',
		'fuel:octane_92' => '',
		'fuel:diesel'    => '',
		'fuel:lpg'       => '',
		'shop'    => '',
		'toilets' => '',
		'compressed_air' => '',
		'payment:cards'  => '',
		'car_wash'       => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=fuel', 'лукойл');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data '.$this->region);

		$regionId = static::$urls[$this->region];

		$url = '/new/azslocator/GetStations/';
		$this->context = stream_context_create(array(
			'http' => array(
				'method'  => 'POST',
				'header'  => "Cookie: azslocator=SelectedTerritory=r$regionId\n",
				'content' => "bounds=36.237417495195615,2.9783614218749817,75.50938204012901,-164.365388578125",
			)
		));
		$page = $this->download($this->domain.$url.'#'.$this->region);
		$a = json_decode($page, true);

		if ($a)
			$this->parse($a['Stations']);
	}
	// парсер страницы
	protected function parse($stations)
	{
		foreach ($stations as $a)
		{
			$obj = array();
			$obj['ref']   = $a['Number'];
			$obj['_addr'] = $a['Address'];
			$obj['lat']   = $a['Lat'];
			$obj['lon']   = $a['Lng'];

			$fuel = array_fill_keys(array_values($a['FuelIds']), 1);
			$obj["fuel:octane_98"] = empty($fuel['98'])     && empty($fuel['ekto-sport'])  ? 'no' : 'yes';
			$obj["fuel:octane_95"] = empty($fuel['95'])     && empty($fuel['ekto-plus'])   ? 'no' : 'yes';
			$obj["fuel:octane_92"] = empty($fuel['92'])     && empty($fuel['ekto'])        ? 'no' : 'yes';
			$obj["fuel:diesel"]    = empty($fuel['diesel']) && empty($fuel['ekto-diesel']) ? 'no' : 'yes';
			$obj["fuel:lpg"]       = empty($fuel['gas']) ? 'no' : 'yes';

			$service = array_fill_keys(array_values($a['ServiceIds']), 1);
			if (!empty($service['market']))      $obj['shop']     = 'yes';
			if (!empty($service['bankomat']))    $obj['atm']      = 'yes';
			if (!empty($service['wc']))          $obj['toilets']  = 'yes';
			if (!empty($service['car-washing'])) $obj['car_wash'] = 'yes';
			if (!empty($service['card']))        $obj['payment:cards']  = 'yes';
			if (!empty($service['licard']))      $obj['fuel:discount']  = 'licard';
			if (!empty($service['tyre']))        $obj['compressed_air'] = 'yes';

			$this->addObject($this->makeObject($obj));
		}
	}
}
