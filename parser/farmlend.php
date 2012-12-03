<?php
require_once 'Validator.class.php';

class farmlend extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.farmlend.ru';
	static $urls = array('RU-BA' => '/apteki/bash');
	// поля объекта
	protected $fields = array(
		'amenity'    => 'pharmacy',
		'dispensing' => 'no',
		'operator' => 'Фармленд',
		'website'  => 'http://www.farmlend.ru',
		'ref'   => '',
		'phone' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=pharmacy', 'фармл');

	// парсер страницы
	protected function parse($st)
	{
		$st = str_replace('&ndash;',   '-',      $st);
		$st = str_replace('&nbsp;',    '',       $st);
		$st = str_replace('&laquo;',   '"',      $st);
		$st = str_replace('<br />',    '',       $st);
		$st = str_replace(' т.ф.',     ' тел. ', $st);
		$st = str_replace(' т. ',      ' тел. ', $st);
		$st = str_replace(' т.(',      ' тел. (',$st);
		$st = str_replace('тел.(',     'тел. (', $st);
		$st = str_replace(', (347',    ', тел. (347', $st);
		$st = str_replace('Пр.',       'пр.',    $st);
		$st = str_replace('(24 часа)', '',       $st);
		$st = str_replace('-',         '-',      $st);
		$st = preg_replace('#(Бирск|Мелеуз) \d,#', '$1,', $st);

		if (preg_match_all($regexp = '#'
			."а(пт\.|/п) ?(?<ref>\d+)"
			.".+?(?<_addr>.+?)(,|) т"
			.".+?(ел\.)? (?<text>.+?</li>)"
			."#su", $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$addr = trim(str_replace('- '  , '',$obj['_addr]));

			$phone = $obj['text'];
			$phone = str_replace('8 Марта','',$phone);
			$phone = preg_replace('/,.+$/','',$phone);
			$phone = preg_replace('/\D/', '', $phone);
			$phone = trim($phone);

			if (strlen($phone) == 7)
			{
				$phone = '+7-347-'.$phone;
				$obj['_addr'] = 'г.Уфа, '.$addr;
			}
			else
			if (strlen($phone) == 10)
			{
				$phone = '+7'.$phone;
				$obj['_addr'] = $addr;
			}

			$obj['phone'] = $this->phone($phone);

			$this->addObject($this->makeObject($obj));
		}
	}
}
