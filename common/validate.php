<?php

$fname     = @$_SERVER['argv'][1];
$validator = @$_SERVER['argv'][2];
$region    = @$_SERVER['argv'][3];

require_once "../parser/$fname";

if (!$region) // регион не указан - обрабатываем все
	$regions = $validator::getRegions();
else
	$regions = explode(',', $region); // можно передать список, разделенный запятой

// запускаем каждую область
foreach ($regions as $region)
if ($validator::isRegion($region))
	validate($region);

function validate($region)
{
	global $validator;
	$v = new $validator($region);
	$v->loadOSM();
	$v->update();
	//$v->validate();

	// временно сохраняем в старом формате
	require_once './osm_data.php';
	$objects = $v->getOSMObjects();
	array_push($objects, $v->getNewestTimestamp());
	osm_data($objects, $region, $region, $validator);
	osm_data($v->getObjects(), $region, $validator, $region);
}
