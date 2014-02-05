<?php
require_once 'Validator.class.php';

class russian_postomat extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.russianpost.ru';
	static $urls = [
		'RU-MOW' => [15=>'/rp/servise/ru/home/postuslug/pochtomats/adres_pochtomata'],
		'RU-MOS' => [16=>'/rp/servise/ru/home/postuslug/pochtomats/adres_pochtomata'],
		'RU-NVS' => [19=>'/rp/servise/ru/home/postuslug/pochtomats/adres_pochtomata'],
		'RU-SPE' => [32=>'/rp/servise/ru/home/postuslug/pochtomats/adres_pochtomata'],
		'RU-SVE' => [34=>'/rp/servise/ru/home/postuslug/pochtomats/adres_pochtomata'],
	];
	// поля объекта
	protected $fields = [
		'amenity'       => 'vending_machine',
		'vending'       => 'parcel_pickup',
		'operator'      => 'Почта России',
		'ref'           => '',
		'postal_code'   => '',
		'opening_hours' => '',
		'_inside'       => '',
		'_addr' => '',
		'lat'   => '',
		'lon'   => '',
	];
	// фильтр для поиска объектов в OSM
	protected $filter = ['vending=parcel_pickup'];

	// парсер страницы
	protected function parse($st)
	{
		if (!preg_match('#out_txt_'.$this->code.'.+?(<table.+?</table>)#', $st, $m)) return false;
		$a = $this->htmlTable2Array($m[1]);
		for ($i = 1; $i < count($a); $i++)
		{
			$isInText = '(отделение почтовой связи)';
			$isIn = strpos($a[$i][4], $isInText) !== false;
			$obj = [
				'ref'           => $a[$i][1],
				'postal_code'   => $a[$i][2],
				'_inside'       => $isIn?'внутри почтового отделения':'',
				'_addr'         => str_replace($isInText, '', $a[$i][4]),
				'opening_hours' => $this->time($a[$i][5]),
			];
			$this->addObject($this->makeObject($obj));
		}
	}
}
