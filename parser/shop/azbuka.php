<?php
require_once 'Validator.class.php';

class azbuka extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://av.ru';
	static $urls = array(
		'RU-MOW' => '/georss-ymapsml.xml#$1',
		'RU-MOS' => '/georss-ymapsml.xml#$1',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'supermarket',
		'name'     => 'Азбука вкуса',
		'operator' => 'ООО "Городской супермаркет"',
		'website'  => 'http://av.ru',
		'opening_hours' => '',
		'phone'    => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);

	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'азб');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#'
			.'gml:pos>(?<lon>[\d\.]+) (?<lat>[\d\.]+)'
			.'.+?Адрес:.+?>(?<_addr>.+?)<'
			.'.+?Телефон:.+?>(?<phone>.+?)<'
			.'.+?работы:.+?>(?<hours>.+?)<'
			.'#us', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			$obj['opening_hours'] = $this->time($obj['hours']);
			$obj['phone']         = $this->phone($obj['phone']);

			$is = mb_stripos(' '.$obj['_addr'], 'Москва');
			if ($this->region == 'RU-MOW' && !$is) continue;
			if ($this->region == 'RU-MOS' &&  $is) continue;

			$this->addObject($this->makeObject($obj));
		}
	}
}
