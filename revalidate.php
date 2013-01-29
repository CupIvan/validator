<?php

if (!isset($_POST['objects'])) exit;

require_once './common/OsmFunctions.class.php';

$REGION    = $_POST['region'];
$VALIDATOR = $_POST['validator'];
$CODE      = $_POST['code'];
$fields    = array_fill_keys(explode(',', 'id,lat,lon,'.$_POST['fields']), 1);
$list      = explode(',', $_POST['objects']);

$st = '';
foreach ($list as $id)
if ($id)
{
	$object = OsmFunctions::getObject($id);
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
