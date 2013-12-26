<?php
class Geocoder
{
	private $context = null;
	static  $prefix  = '/home/cupivan/http/_.cupivan.ru/osm/validator/_/';

	public function __construct()
	{
		$this->context = stream_context_create(
			array('http' => array(
				'method'  => 'GET',
				'timeout' => 3,
				'header'  => "User-agent: OSM geocoder http://osm.cupivan.ru\r\n"
			))
		);
	}
	/** геокодирование адреса */
	public function getCoordsByAddress($st)
	{
		$st = preg_replace('/ /',   ' ', $st);
		$st = preg_replace('/([\.,;])(\S)/u', '$1 $2', $st); // после знака препинания пробел, а то глюки
		$st = str_replace('пр-т', 'проспект', $st);
		$st = str_replace('с.',   'село',     $st);
		$st = str_replace('Республика', ' ', $st);
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

		$url = 'http://osm.org.ru/api/autocomplete?q='.urlencode($st);
		$res = @file_get_contents($url.'&email=cupivan@narod.ru&from=validator', false, $this->context);
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
		$folder = '';

		if (preg_match('/([а-я]+)\s+обл/ui', $st, $m)) $folder = $m[1];
		if (preg_match('/((г|д|дер|пос|с|п|пгт|т)\.\s*|(станица|хутор|село|аул)\s+)([а-я]{2,})/ui',  $st, $m)) $folder = $m[4];

		if ($folder)
		{
			$folder = mb_convert_case($folder, MB_CASE_TITLE, 'utf-8');
			$folder = mb_substr($folder, 0, 1).'/'.mb_substr($folder, 0, 2)."/$folder";
		}
		else
			$folder = '_/'.substr($md5, 0, 2);

		return self::$prefix.'/_geocoder/'.$folder."/$md5.sz";
	}
}
