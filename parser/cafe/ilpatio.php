<?php
require_once '../parser/cafe/rosinter.php';

class ilpatio extends rosinter
{
	// поля объекта
	protected $fields = array(
		'amenity'  => 'cafe',
		'name'     => 'IL Патио',
		'contact:website' => 'http://www.ilpatio.ru',
		'contact:phone'   => '',
		'opening_hours'   => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=cafe', 'patio');
}
