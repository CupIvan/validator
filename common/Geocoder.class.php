<?php
class Geocoder
{
	/** геокодирование адреса */
	public function getCoordsByAddress($st)
	{
		$st = preg_replace('/ /',   ' ', $st);
		$st = preg_replace('/([\.,;])(\S)/u', '$1 $2', $st); // после знака препинания пробел, а то глюки
		$st = preg_replace('/\s+/', ' ', $st);

		$res = $this->geocode($st);
		if (!isset($res['matches'][0]['lat'])) return array();
		$res = array_intersect_key($res['matches'][0], array('lat'=>0, 'lon'=>0));

		return $res;
	}
	/** геокодирование */
	private function geocode($st)
	{
		$res = $this->load($st);
		if ($res) return $res;

		$res = @file_get_contents('http://osm.org.ru/api/autocomplete?'.
		'q='.urlencode($st).'&email=cupivan@narod.ru&from=validator');
		if (!$res) { echo "Error geocode: $st\n"; return false; }

		$res = json_decode($res, 1);

		$this->save($st, $res);

		return $res;
	}
	/** выдача закешированного значения */
	private function load($st)
	{
		$fname = $this->getFileName($st);
		if (file_exists($fname) && time() - filemtime($fname) < 7*24*3600)
			return unserialize(file_get_contents($fname));
		return false;
	}
	/** сохранение значения в кеше */
	private function save($st, $value)
	{
		$fname = $this->getFileName($st);
		$dir = preg_replace('#[^/]+$#', '', $fname);
		if (!file_exists($dir)) mkdir($dir, 0777, true);
		return file_put_contents($fname, serialize($value));
	}
	/** имя файла на основе запроса */
	private function getFileName($st)
	{
		$md5 = md5($st);
		return '../_/_geocoder/'.substr($md5, 0, 2)."/$md5.sz";
	}
}
