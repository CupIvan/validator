<?php
require_once 'Validator.class.php';

class atak extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.ataksupermarket.ru/';
	static $urls = array(
		'RU-MOW' => 'atak.html?rid=1',
		'RU-MOS' => 'atak.html?rid=2',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'supermarket',
		'brand'    => 'Атак',
		'operator' => 'ООО "Атак"',
		'website'  => 'http://www.ataksupermarket.ru',
		'phone'    => '',
		'opening_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'атак');

	// получение страниц
	public function update()
	{
		// формируем ссылки по каждому отделению
		$url  = static::$urls[$this->region];
		$page = $this->download($this->domain . $url);
		$url  = str_replace('?', '\\?', $url);
		if (preg_match_all('#('.$url.'&id=\d+)" class="mn"#', $page, $m))
		{
			static::$urls[$this->region] = $m[1]; // заменяем ссылку по региону на ссылки по отделениям
			parent::update();
		}
	}

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match('#'.
			'<h2>(?<_addr>.+?)</h2>'.
			'(.{1,20}?(?<phone>[\+\d\(\) -]+).*?<)?'.
			'(.{1,20}?(?<hours>[089][\d+ \.:-]+))?'.
			'#su', $st, $obj))
		{
			if (isset($obj['phone']))
				$obj['phone'] = $this->phone($obj['phone']);

			if (isset($obj['hours']))
			{
				$hours = $obj['hours'];
				$hours = str_replace('.', ':', $hours);
				$obj['opening_hours'] = $this->time($hours);
			}

			$this->addObject($this->makeObject($obj));
		}
		else $this->log('No match "atak": '.$this->code);
	}
}
