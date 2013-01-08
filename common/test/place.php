#!/usr/bin/php
<?php

chdir('..');

require_once 'test.php';
require_once '../parser/wiki_places.php';

class Tester extends wiki_places
{
	use test;
	function t($wiki, $right)
	{
		$this->region = 'TEST';
		$this->useCache = true;
		$url  = $this->domain.'/wiki/'.urlencode($wiki).'?action=edit';
		$url  = str_replace(array('%28', '%29'), array('(', ')'), $url);
		$page = $this->download($url);
		$this->parse($page);
		$obj = $this->objects[count($this->objects) - 1];
		$this->test($obj['place'], $right, $wiki);
	}
}

$v = new Tester('RU-MOS');

$v->t('Развилка_(Московская_область)', 'town'); // сельский от 8 тыс.
$v->t('Бобров_(город)', 'town'); // адм. центр района
$v->t('Олонецкий_Шлюз', 'locality'); // Хутор, но населения 0
$v->t('Верхние_Осельки','village');  // адм. центр сельского поселения
$v->t('Лапшаур',        'village');  // село, адм. центр без населения
$v->t('Старый_Сибай',   'village');
$v->t('Коммунар_(Брасовский_район)', 'hamlet');
$v->t('Николаевка_(Ульяновская_область)', 'town'); // рабочий посёлок = пгт
$v->t('Хутор_Некрасова', 'hamlet'); // разросшийся хутор
$v->t('Катениновский',   'hamlet'); // деревня с очень малым населением
