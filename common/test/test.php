<?php

trait test
{
	public function test($x, $right, $title = '')
	{
		$res = $x == $right;
		if (!$res) $right .= ' != '.$x;
		if ($res && $title) $right = mb_substr($title, 0, 50);
		printf("%s %".(50-mb_strlen($right))."s %s\n", $right, ' ', $res ? '[ OK ]' : '[FAIL] <-');
		return $res;
	}
}
