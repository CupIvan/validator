<?php
require_once 'Validator.class.php';

class izbenka extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://vkusvill.ru';
	static $urls = array(
		'RU-MOW' => '/shops/shoplist/',
	);
	// поля объекта
	protected $fields = array(
		'shop'  => 'milk',
		'brand'    => 'Избёнка',
		'operator' => 'ООО "Проект Избёнка"',
		'website'  => 'http://izbenka.msk.ru',
		'_hours' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=milk', 'изб');

	// парсер страницы
	protected function parse($st)
	{
		if (preg_match_all('#<tr>\s'
			.'.+?</td>'
			.'\s+<td>\s*(?<_addr>.+?)\s*</'
			.'.+?<td>\s*(?<hours>.+?)\s*<'
			.'.+?lng=(?<lon>[0-9.]+)&lat=(?<lat>[0-9.]+)'
			.'.+?</tr>#su', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			if (strlen($obj['_addr']) < 10) continue;

			// FIXME: сделать валидацию часов работы
			$hours = strip_tags($obj['hours']);
			$obj['_hours'] = $hours;

			$this->addObject($this->makeObject($obj));
		}
	}
}
