#!/usr/bin/php
<?php

require_once 'test.php';
require_once '../Validator.class.php';
require_once '../../parser/bank/sberbank.php';

class Tester extends sberbank
{
	use test;
	function __construct() {}
	function t($x, $right) { $this->test($this->time($this->parseTime($x)), $right, $right); }
}

$v = new Tester('');

$v->t('Пн.:с 09:00 до 13:00, Сб.:с 09:00 до 13:00', 'Mo,Sa 09:00-13:00');
$v->t('Пн.:с 09:00 до 14:15 (обед с 13:00 до 13:30)', 'Mo 09:00-13:00,13:30-14:15');
