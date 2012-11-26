#!/usr/bin/php
<?php

require_once 'test.php';
require_once '../Validator.class.php';

class Tester extends Validator
{
	function __construct() {}
	function t($x) { return $this->time($x); }
}

$v = new Tester('');

test($v->t('8:00-20:00'),       '08:00-20:00');
test($v->t('Пн-Пт 8:15-20:00; Сб-Вс выходной'), 'Mo-Fr 08:15-20:00; Sa-Su Off');
test($v->t('8-20'),       '08:00-20:00');
test($v->t('Пн-Вс 8-20'),       '08:00-20:00');
test($v->t('Пн-Вс 0-24'),       '24/7');
test($v->t('с 8 до 20'),        '08:00-20:00');
test($v->t('С 9 до 18:20'),     '09:00-18:20');
test($v->t('Вт,Ср, Чт, Пт-Сб 10-11'), 'Tu-Sa 10:00-11:00');
test($v->t('с 8 до 20, выходные 10-16'),             '08:00-20:00; Sa-Su 10:00-16:00');
test($v->t('Пн-сб с 9 до 20.45. Вскр с 9.15 до 17.45'), 'Mo-Sa 09:00-20:45; Su 09:15-17:45');
test($v->t('Пн и вт 10-11'),     'Mo-Tu 10:00-11:00');
