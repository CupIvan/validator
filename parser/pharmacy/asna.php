<?php
require_once 'Validator.class.php';

class asna extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.asna.ru';
	static $urls = array(
		'RU-MOW' => '/maps/json/city.php?id=1#$1',
		'RU-MOS' => '/maps/json/city.php?id=1#$1',
	);
	// поля объекта
	protected $fields = array(
		'amenity' => 'pharmacy',
		'brand'   => 'АСНА',
		'contact:website'  => 'http://asna.ru',
		'contact:email'    => '',
		'contact:phone'    => '',
		'opening_hours'    => '',
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
		$list = json_decode($st, true);
		if (!$list) return false;

		$id_obl = '137,214,158,188,16,90,208,220,222,223,157,169,206,199';
		$id_obl = array_fill_keys(explode(',', $id_obl), 1);

		foreach($list['items'] as $a)
		{
			$obj = array('_name' => $a['name'], 'lat'=>$a['x'], 'lon'=>$a['y']);

			list($url, $hours, $phone, $email) = explode('<br>', $a['html']);

			if (preg_match('#"(?<url>.+?/(?<ref>\d+)/)">(?<_addr>[^<]*)#', $url, $m))
				$obj += $m;

			$is =  !isset($id_obl[@$obj['ref']]);
			if ($this->region == 'RU-MOW' && !$is) continue;
			if ($this->region == 'RU-MOS' &&  $is) continue;

			$obj['contact:website'] = preg_replace('/.+"(.+?)".+/', '$1', $url);
			$obj['contact:phone']   = $this->phone($phone);
			$obj['contact:email']   = $email;
			$obj['opening_hours']   = $this->time($hours);

			$this->addObject($this->makeObject($obj));
		}
	}
}
