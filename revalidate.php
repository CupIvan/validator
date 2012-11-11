<?php

if (!isset($_POST['objects'])) exit;

$REGION    = $_POST['region'];
$VALIDATOR = $_POST['validator'];
$CODE      = $_POST['code'];
$fields    = array_fill_keys(explode(',', 'id,lat,lon,'.$_POST['fields']), 1);
$list      = explode(',', $_POST['objects']);

$st = '';
foreach ($list as $id)
if ($id)
{
	$object = getOsmObject($id);
	if (!$object) continue;
	$object = array_intersect_key($object, $fields);
	$st .= ','.json_encode($object)."\n";
}

$fname = "./data/$REGION/$VALIDATOR.js";
if ($st && file_exists($fname))
	file_put_contents($fname, $st, FILE_APPEND);
else
	echo 'Заявка на перевалидацию зарегистрирована';

file_put_contents('./data/update.log', "$REGION $VALIDATOR $CODE ".
	date("H:i:s d.m.Y").' '.$_SERVER['REMOTE_ADDR'].' '.$_POST['objects']."\n", FILE_APPEND);

function getOsmObject($id)
{
	$url = $id;
	$url = str_replace('n', 'node/',     $url);
	$url = str_replace('w', 'way/',      $url);
	$url = str_replace('r', 'relation/', $url);

	$type = 'node';
	if ($id[0] == 'w') $type = 'way';
	if ($id[0] == 'r') $type = 'relation';

	$xml = @file_get_contents("http://api.openstreetmap.org/api/0.6/$url");
	if (!$xml) return false;

	$xml = new SimpleXMLElement($xml);

	$data = array();

	$data['id'] = $id;
	$lat = (string)@$xml->$type->attributes()->lat;
	if ($lat)
	{
		$data['lat'] = $lat;
		$data['lon'] = (string)$xml->$type->attributes()->lon;
	}

	foreach ($xml->$type->tag as $tag)
	{
		$data[(string)$tag->attributes()->k] = (string)$tag->attributes()->v;
	}

	// сортируем ключи, т.к. OSM почему-то выдает каждый раз в случайном порядке!! ]:-<
	ksort($data);

	return $data;
}
