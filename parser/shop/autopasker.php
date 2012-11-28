<?php
require_once 'Validator.class.php';

class autopasker extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://avtopasker.ru';
	static $urls = array(
		'RU-MOW' => array('Москва'  => '/info/list.php?town=all#$1'),
		'RU-MOS' => array('Электр|Посад|Зуев|Ликин|Егорь|Воскр|Шату|Истр|Серпу|Коломн|Балаш|Дзержинский' => '/info/list.php?town=all#$1'),
		'RU-VOR' => array('Воронеж' => '/info/list.php?town=all#$1'),
		'RU-ORL' => array('Орел'    => '/info/list.php?town=all#$1'),
		'RU-RYA' => array('Рязан'   => '/info/list.php?town=all#$1'),
		'RU-VLA' => array('Владимир|Алексан|Гусь|Петушк' => '/info/list.php?town=all#$1'),
		'RU-NIZ' => array('Нижний|Нижег' => '/info/list.php?town=all#$1'),
	);
	// поля объекта
	protected $fields = array(
		'shop' => 'car_parts',
		'brand' => 'Автопаскер',
		'website'  => 'http://avtopasker.ru',
		'phone' => '',
		'opening_hours' => '',
		'payment:cards' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=car_parts', 'паскер');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_replace_callback('#\n\s*<p class="textblock">.+?</p>#s', function($x)
		{
			if (!preg_match('#'
			.">\s*(?<_addr>.+?)\n"
			.".+?тел.\s*(?<phone>.+?)\r?\n"
			."(.+?работы:\s*(?<time>.+?)\n)?"
			.".+?оплаты:\s*(?<money>.+?)\n"
			."#su", $x[0], $obj)) return;

			$obj['_addr'] = strip_tags($obj['_addr']);
			$obj['_addr'] = preg_replace('/\s*НОВЫЙ.+/', '', $obj['_addr']);

			$obj['phone'] = strip_tags($obj['phone']);
			$obj['phone'] = $this->phone($obj['phone']);

			// фильтруем только "наш" регион
			if (!preg_match('/('.$this->code.')/', $obj['_addr'])) return;

			if ($obj['time'])
			{
				$time  = strip_tags($obj['time']);
				$time  = preg_replace(
					array('/(\d)-(\d)/', '/(\d)\.(\d)/', '/ (\d:)/', '/без.+/'),
					array('$1:$2',       '$1:$2',        ' 0$1',     ''),
					$time);
				$obj['opening_hours'] = $this->time($time);
			}

			$obj['payment:cards'] = mb_stripos($obj['money'], 'безнал') ? 'yes' : 'no';

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
