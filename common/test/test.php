<?php

function test($x, $right)
{
	$res = $x == $right;
	if (!$res) $right .= ' != '.$x;
	printf("%-50s %s\n", $right, $res ? '[ OK ]' : '[FAIL] <-');
	return $res;
}
