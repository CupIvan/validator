<?php
require_once 'Validator.class.php';

class lukoil extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.lukoil.ru';
	static $urls = array(
		'RU-MOW' => array('36' => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
		'RU-MOS' => array('38' => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
		'RU-KGD' => array( '8' => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
		'RU-KDA' => array('44' => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
		'RU-SPE' => array('21' => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
		'RU-LEN' => array('22' => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
		'RU-VLG' => array('7'  => '/back/azs/azs.asp?RegionId=$1&pagesize=0'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'fuel',
		'brand'    => 'Лукойл',
		'operator' => array(
			'RU-MOW' => 'ООО "ЛУКОЙЛ-Центрнефтепродукт"',
			'RU-MOS' => 'ООО "ЛУКОЙЛ-Центрнефтепродукт"',
			'RU-KGD' => 'ООО "ЛУКОЙЛ-Северо-Западнефтепродукт"',
			'RU-KDA' => 'ООО "ЛУКОЙЛ-Югнефтепродукт"',
			'RU-SPE' => 'ООО "ЛУКОЙЛ-Северо-Западнефтепродукт"',
			'RU-LEN' => 'ООО "ЛУКОЙЛ-Северо-Западнефтепродукт"',
			'RU-VLG' => 'ООО "ЛУКОЙЛ-Волганефтепродукт"',
		),
		'website'  => 'http://www.lukoil.ru',
		'ref'      => '',
		'opening_hours' => '24/7',
		'fuel:octane_98' => '',
		'fuel:octane_95' => '',
		'fuel:octane_92' => '',
		'fuel:diesel'    => '',
		'fuel:lpg'       => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=fuel', 'лукойл');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_replace_callback('#<td width="200".+?</tr>\s+<tr>#s', function($x)
		{
			if (!preg_match('/'
			."№(?<ref>\d+)"
			.'.+?text-descr">(?<_addr>.+?)<'
			.'(.+?98_ekto2(?<octane_98>_na)?.gif)?'
			.'(.+?95_ekto2(?<octane_951>_na)?.gif)?'
			.'(.+?95(?<octane_952>_na)?.gif)?'
			.'(.+?92_ekto2(?<octane_921>_no)?.gif)?'
			.'(.+?92(?<octane_922>_na)?.gif)?'
			.'(.+?dt_ekto2(?<diesel1>_na)?.gif)?'
			.'(.+?dt(?<diesel2>_na)?.gif)?'
			.'(.+?gaz(?<lpg>_na)?.gif)?'
			.'(.+?table>)' // COMMENT: скобки нужны, чтобы всегда присутствовали предыдущие <lpg>
			."/su", $x[0], $obj)) return;

			$f='octane_98'; $obj["fuel:$f"] = $obj[$f] ? 'no' : 'yes';
			$f='octane_95'; $obj["fuel:$f"] = $obj[$f.'1'] && $obj[$f.'2'] ? 'no' : 'yes';
			$f='octane_92'; $obj["fuel:$f"] = $obj[$f.'1'] && $obj[$f.'2'] ? 'no' : 'yes';
			$f='diesel';    $obj["fuel:$f"] = $obj[$f.'1'] && $obj[$f.'2'] ? 'no' : 'yes';
			$f='lpg';       $obj["fuel:$f"] = $obj[$f] ? 'no' : 'yes';

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
