<?php
// Туалеты ГУП "Водоканал Санкт-Петербурга"
// http://www.vodokanal.spb.ru/kanalizovanie/tualety/
// Данные опубликованы в "кастомной карте" на Яндекс-Картах, доступна выгрузка в gml
// http://maps.yandex.ru/?um=WDqDzbzmS2lYw98G5j0M_UEhLMQkKSfM&ll=30.438506%2C59.892855&spn=0.849380%2C0.286366&z=11&l=map

require_once 'Validator.class.php';

class toilets_vodokanal_spb extends Validator 
{
	// откуда скачиваем данные
	protected $domain = 'http://maps.yandex.ru/';
	static $urls = array(
		'RU-SPE' => 'export/usermaps/WDqDzbzmS2lYw98G5j0M_UEhLMQkKSfM/'
	);
	// поля объекта
	protected $fields = array(
		'amenity' => 'toilets',
		'access' => 'public',
		'fee' => 'yes',
		'operator' => 'ГУП «Водоканал Санкт-Петербурга»',
		'contact:website' => 'http://www.vodokanal.spb.ru/kanalizovanie/tualety/',
		'opening_hours' => '',
		'lat' => '',
		'lon' => '',
		'_addr' => '',
	);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=toilets');

	// парсер страницы
	protected function parse($st)
	{
		$xml = simplexml_load_string($st);
		$xml->registerXPathNamespace('ym', 'http://maps.yandex.ru/ymaps/1.x');
		$xml->registerXPathNamespace('gml', 'http://www.opengis.net/gml');
		foreach ($xml->xpath('//ym:GeoObject') as $geoObject) {
			$obj = array();
			$obj['_addr'] = $geoObject->name;
			$descr = $geoObject->description;

			if (strpos($descr, "Время работы: с 9.00 до 21.00 ежедневно, с учетом технологических перерывов (20-40 мин.)") !== FALSE) {
				$obj['opening_hours'] = "09:00-21:00";
			} else if (strpos($descr, "Время работы: с 9.00 до 21.00 ежедневно в летний период (с мая по октябрь), с учетом технологических перерывов (20-40 мин.)") !== FALSE) {
				$obj['opening_hours'] = "May-Sep: 09:00-21:00";
			}

			list($lat, $lon) = explode(" ", $geoObject->Point->pos);
			$obj['lat'] = $lat;
			$obj['lon'] = $lon;
			$this->addObject($this->makeObject($obj));
		}
	}
}

?>