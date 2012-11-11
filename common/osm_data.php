#!/usr/bin/php
<?php

// ARGUMENTS
// 1 - REGION
// 2 - NAME
// 3 - FILE

if (isset($_SERVER['argv'][3]))
	osm_data($_SERVER['argv'][3], $_SERVER['argv'][1], $_SERVER['argv'][2]);

function osm_data($data, $region, $name, $param = '')
{
	if (is_string($data))
		$data = @unserialize(@file_get_contents($data));

	if (!$data) { echo "Empty data! $data\n"; return; }

	$count = count($data);
	echo "Make JS $region/$name/$param [$count objects]\n";

	if ($param != '') // если параметр не задан - это объекты OSM по области
	{
		// если задан - это объекты из реальной жизни
		$region = $name;
		$name   = $param;
	}

	$timestamp = time();
	if (is_string($data[count($data)-1]))
	{
		$timestamp = array_pop($data);
		date_default_timezone_set('UTC');
		$timestamp = strtotime($timestamp);
	}

	$dir = '/home/cupivan/http/_.cupivan.ru/osm/validator/data/'.$region;
	if (!file_exists($dir)) mkdir($dir);

	$fname = $dir.'/'.$name.'.js';
	$st = ' '.json_encode($data)."\n"; // пробел спереди - чтобы не evalил в ajax

	// сжимаем
	$st = gzencode($st);
	file_put_contents($fname, ''); // COMMENT: пустой файл нужен для nginx
	$fname .= ".gz";

	// сохраняем данные
	if (!file_exists($dir)) mkdir($dir);
	file_put_contents($fname, $st);
	chmod($fname, 0666);




	// обновляем список валидаторов
	$fname = '/home/cupivan/http/_.cupivan.ru/osm/validator/data/state.js';
	$data = @file_get_contents($fname);
	$data = substr($data, 2, -1);

	$data = json_decode($data, true);
	if (!$data) $data = array();

	$data["$region.$name"] = array($region, $name, time(), $timestamp);

	$data = json_encode($data);

	$data = "_($data)";
	file_put_contents($fname, $data);
}
