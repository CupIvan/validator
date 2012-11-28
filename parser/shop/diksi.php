<?php
require_once 'Validator.class.php';

class diksi extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://dixy.ru';
	static $urls = array(
		'RU-BRY' => 'Брянская область',
		'RU-VLA' => 'Владимирская область',
		'RU-VLG' => 'Вологодская область',
		'RU-IVA' => 'Ивановская область',
		'RU-KLU' => 'Калужская область',
		'RU-KOS' => 'Костромская область',
		'RU-LEN' => 'Ленинградская область',
		'RU-MOW' => 'Москва',
		'RU-MOS' => 'Московская область',
		'RU-MUR' => 'Мурманская область',
		'RU-NGR' => 'Новгородская область',
		'RU-PSK' => 'Псковская область',
		'RU-KR'  => 'Республика Карелия',
		'RU-RYA' => 'Рязанская область',
		'RU-SPE' => 'Санкт-Петербург',
		'RU-SMO' => 'Смоленская область',
		'RU-TVE' => 'Тверская область',
		'RU-TUL' => 'Тульская область',
		'RU-CHE' => 'Челябинская область',
		'RU-YAR' => 'Ярославская область',
	);
	// поля объекта
	protected $fields = array(
		'shop'     => 'supermarket',
		'name'     => 'Дикси',
		'operator' => '', // ЗАО "Дикси Юг"
		'website'  => 'http://dixy.ru',
		'opening_hours' => '',
		'payment:cards' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'дикси');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data '.$this->region);

		$regionStr = static::$urls[$this->region];

		// устанавливаем куку с регионом
		$this->context = stream_context_create(array(
			'http' => array(
				'method'  => 'GET',
				'header'  => "Cookie: dixy_region=".urlencode($regionStr)."\n",
			)
		));
		$this->parse($this->download($this->domain.'/shops#'.$regionStr));
	}
	// парсер страницы
	protected function parse($st)
	{
		// получаем города на каждую точку
		$GLOBALS['city'] = array();
		if (preg_match_all('/town">(\d+). (?<name>[^,]+)/s', $st, $m, PREG_SET_ORDER))
		foreach ($m as $item) $GLOBALS['city'][$item[1] - 1] = $item[2];
		// основная инфа
		if (preg_replace_callback('#\d+\]=new YMaps.+?Overlay#s', function($x)
		{
			if (!preg_match('#'
			."(?<id>\d+)"
			.".+?(?<lon>[\d\.]+), (?<lat>[\d\.]+)"
			.".+?description='(?<_addr>[^<]+)"
			.".+?работы.{1,30}?(?<hours>\d[\d-: ]+)?</p>"
			.".+?Overlay#su", $x[0], $obj)) return;

			// валидируем часы работы
			$time = @$obj['hours'];
			$time = str_replace(' ', '', $time);
			$time = preg_replace('/^(\d):/', '0$1:', $time);
			if (strpos($obj[0], '24 часа')) $time = '24/7';
			$obj['opening_hours'] = $time;

			// банковские карты
			if (strpos($obj[0], 'карты не'))   $obj['payment:cards'] = 'no';
			if (0
				|| strpos($obj[0], 'Прием банк')
				|| strpos($obj[0], 'visa.png')
			) $obj['payment:cards'] = 'yes';

			// добавляем к адресу название города
			if (isset($GLOBALS['city'][$obj['id']]))
				$obj['_addr'] = 'г. '. $GLOBALS['city'][$obj['id']].', '.$obj['_addr'];

			$this->addObject($this->makeObject($obj));
		}, $st));
	}
}
