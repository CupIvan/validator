<?php
require_once 'Validator.class.php';

class magnit extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.magnit-info.ru';
	static $urls = array(
		'RU-MOW' => '/buyers/adds/list.php?SECTION_ID=1258&RID=1305',
		'RU-MOS' => '/buyers/adds/list.php?SECTION_ID=1258&RID=15',
		'RU-KLU' => '/buyers/adds/list.php?SECTION_ID=1258&RID=16',
		'RU-KDA' => '/buyers/adds/list.php?SECTION_ID=1258&RID=25',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'supermarket',
		'name'     => 'Магнит',
		'operator' => 'ЗАО "Тандер"',
		'website'  => 'http://www.magnit-info.ru',
		'opening_hours' => '',
		'phone'    => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);

	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'магни');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Search region pages');

		$page = $this->download($this->domain.self::$urls[$this->region]);
		if (!preg_match('#index_tabs.+?</table>#s', $page, $m)) return false;

		if (preg_match_all('#/buyers/adds/list.php[^"]+#', $m[0], $m))
		{
			self::$urls[$this->region] = $m[0];
			parent::update();
		}
	}

	// парсер страницы
	protected function parse($st)
	{
		if (!preg_match('#"addresses.+?</table>#s', $st, $m)) return false;
		$st = $m[0];
		if (preg_match_all('#'
			.'<tr>'
			.'.+?<td>'
			.'.+?<td>(?<_addr>.+?)</td>'
			.'.+?<td>(?<hours>.+?)</td>'
			.'#us', $st, $m, PREG_SET_ORDER))
		foreach ($m as $obj)
		{
			if ($obj['hours'] == '-') $obj['hours'] = '';
			$obj['opening_hours'] = $this->time($obj['hours']);

			$this->addObject($this->makeObject($obj));
		}
	}
}
