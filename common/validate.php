<?php

$fname     = @$_SERVER['argv'][1];
$validator = @$_SERVER['argv'][2];
$region    = @$_SERVER['argv'][3];

$st = implode('', $_SERVER['argv']);
if (preg_match_all('#--([a-z-]+)#', $st, $m))
	foreach ($m[1] as $p) $GLOBALS[$p] = true;

if (empty($GLOBALS['no-cache']))
	$GLOBALS['pbf-cache'] = $GLOBALS['html-cache'] = true;

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
	$v->useCachePbf  = !empty($GLOBALS['pbf-cache']);
	$v->useCacheHtml = !empty($GLOBALS['html-cache']);
	$v->updateHtml   = !empty($GLOBALS['update']);
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
