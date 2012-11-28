<?php
require_once 'Validator.class.php';

class alfabank_atm extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://alfabank.ru';
	static $urls = array(
		'RU-MOW' => array(
			'moscow' => '/russia/$1/',
		),
		'RU-MOS' => array(
			'balashiha' => '/russia/$1/',
			'korolev'   => '/russia/$1/',
			'odintsovo' => '/russia/$1/',
			'khimki'    => '/russia/$1/',
		),
		'RU-KGD' => array(
			'kaliningrad' => '/$1/address/',
		),
		'RU-MUR' => array(
			'murmansk' => '/$1/atm/$1/',
		),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'atm',
		'name'     => 'Альфа-Банк',
		'operator' => 'ОАО "Альфа-Банк"',
		'website'  => 'http://www.alfabank.ru',
		'opening_hours' => '',
		'currency:RUR' => '',
		'currency:USD' => '',
		'currency:EUR' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=atm', 'альфа');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_replace_callback('/is_online.+?atm_currency.+?},/s', function($x)
		{
			if (!preg_match('/'
			."is24h:'(?<is24>.)"
			.".+?lat:'(?<lat>[^']+)"
			.".+?lon:'(?<lon>[^']+)"
			.".+?external_name:'(?<ext>[^']*)"
			.".+?processing_time:'(?<time>[^']*)"
			.".+?address:'(?<_addr>[^']+)"
			.".+?cout:(?<curr>[^}]+])"
			."/su", $x[0], $obj)) return;

			// банкоматы партнеров
			if (mb_strpos(' '.$obj['ext'], 'Росб'))
			{
				$obj['name']     = 'Росбанк';
				$obj['operator'] = 'ОАО АКБ "Росбанк"';
				$obj['website']  = 'http://www.rosbank.ru';
			}
			else
			if (mb_strpos(' '.$obj['ext'], 'МДМ'))
			{
				$obj['name']     = 'МДМ Банк';
				$obj['operator'] = 'ОАО "МДМ Банк"';
				$obj['website']  = 'http://www.mdm.ru';
			}
			else
			if (mb_strpos(' '.$obj['ext'], 'Промсв'))
			{
				$obj['name']     = 'Промсвязьбанк';
				$obj['operator'] = 'ОАО "Промсвязьбанк"';
				$obj['website']  = 'http://www.psbank.ru/';
			}
			// партнеров пропускаем, т.к. там говорят ошибки :-(
			if (isset($obj['name'])) return;

			// валюта выдачи
			$currency = str_replace("'", '"', $obj['curr']);
			$currency = json_decode($currency);
			foreach ($currency as $v)
			if (0);
			elseif ($v == 'rur') $obj['currency:RUR'] = 'yes';
			elseif ($v == 'usd') $obj['currency:USD'] = 'yes';
			elseif ($v == 'eur') $obj['currency:EUR'] = 'yes';

			if ($obj['is24']) $obj['opening_hours'] = '24/7';
			else
			if (preg_match('/\d{2}.\d{2}-\d{2}.\d{2}/', $obj['time'], $m))
				$obj['opening_hours'] = str_replace('.', ':', $m[0]);

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
