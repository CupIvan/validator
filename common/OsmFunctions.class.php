<?php
/**
 * Функции для работы с OSM данными
 */
class OsmFunctions
{
	protected $osm_objects = array();
	private   $timestamp   = '';
	public    $useCachePbf  = false; // использовать только кеш

	static    $prefix = '/home/cupivan/http/_.cupivan.ru/osm/validator/_/';

	/** загрузка данных OSM */
	public function loadOSM()
	{
		$this->log("Load OSM data for ".$this->region);
		$this->updatePbf($this->region);

		$type  = explode('=', preg_replace('/[^=]+?,/', '', $this->filter[0]));
		$type  = ($type[0] == 'place') ? $type[0] : $type[1];
		$fname = $this->extractPbf($this->filter[0], $type);

		$this->filterOsm($fname, @$this->filter[1]);
	}
	/** обновление pbf */
	private function updatePbf($region)
	{
		$url = 'http://data.gis-lab.info/osm_dump/dump/latest';
		$fname = $region.'.osm.pbf';

		ob_start();
		passthru("wget -q -O - $url/$fname.meta");
		$st = ob_get_clean();
		$remote_date = preg_replace('/.+?\nversion = ([^ ]+).+/s', '$1', $st);
		if (!file_exists('../_/pbf')) mkdir('../_/pbf', 0777);
		$local_date  = date('Y-m-d', @filemtime("../_/pbf/$fname"));
		if ($remote_date != $local_date)
		if (!$this->useCachePbf || !file_exists("../_/pbf/$fname"))
		{
			$this->log("Download $fname");
			passthru("if wget -cq $url/$fname -O /tmp/$fname; then mv -f /tmp/$fname ../_/pbf/$fname; fi");
			touch("../_/pbf/$fname", strtotime($remote_date));
		}
	}
	/** OSM объекты */
	public function getOSMObjects()
	{
		return $this->osm_objects;
	}
	/** самый "свежий" объект */
	public function getNewestTimestamp()
	{
		return $this->timestamp;
	}
	/** выделение из pbf нужных объектов */
	private function extractPbf($filter, $type)
	{
		// выделяем объекты нужного типа
		$osm = $this->region.'.osm'; $fname = $this->region.'.osm.pbf';
		if (!file_exists("../_/$type")) mkdir("../_/$type");
		if ( file_exists("../_/pbf/$fname")
		    && filemtime("../_/pbf/$fname") != @filemtime("../_/$type/$osm"))
		{
			$this->log("Extract $type from $fname");
			passthru("osmosis -q \
					".$this->osmosisFilter($fname, $filter)." \
					--write-xml - compressionMethod=none \
					| sed -r 's/uid.+?lat=/lat=/' \
					> ../_/$type/$osm"); // COMMENT: sed'ом убираем ненужные теги
			touch("../_/$type/$osm", filemtime("../_/pbf/$fname"));
		}
		return "../_/$type/$osm";
	}
	/** фильтр для osmosis'а */
	private function osmosisFilter($fname, $filter)
	{
		if (strpos(" $filter", 'relation'))
		{
			$filter = preg_replace('/relation,?/', '', $filter);
			$f = "--read-pbf ../_/pbf/$fname \
				--tf reject-nodes --tf reject-ways \
				--tf accept-relations $filter";
		}
		else
		if (strpos(" $filter", 'node'))
		{
			$filter = preg_replace('/node,?/', '', $filter);
			$f = "--read-pbf ../_/pbf/$fname \
				--tf accept-nodes $filter\
				--tf reject-ways --tf reject-relations";
		}
		else
		{
			$f = "--read-pbf ../_/pbf/$fname \
				--tf reject-relations --tf reject-nodes \
				--tf accept-ways $filter \
				outPipe.0=WAY \
				\
				--read-pbf ../_/pbf/$fname \
				--tf reject-relations --tf reject-ways \
				--tf accept-nodes $filter \
				outPipe.0=NODE \
				\
				--read-pbf ../_/pbf/$fname \
				--tf reject-nodes --tf reject-ways \
				--tf accept-relations $filter \
				outPipe.0=RELATION \
				\
				--merge inPipe.0=WAY  inPipe.1=NODE outPipe.0=TEMP \
				--merge inPipe.0=TEMP inPipe.1=RELATION";
		}
		return $f;
	}
	/** загрузка и фильтрация объектов */
	private function filterOsm($fname, $filter='')
	{
		// загружаем объекты и отфильтровываем нужные
		$xml = file_get_contents($fname);
		if (!$xml) return;
		$xml = new SimpleXMLElement($xml);
		$this->osm_objects = array();
		mb_internal_encoding('utf-8');
		$this->timestamp = '';
		foreach ($xml->node as $v) $this->testObject($v, 'n', $filter);
		foreach ($xml->way  as $v) $this->testObject($v, 'w', $filter);
		foreach ($xml->relation as $v) $this->testObject($v, 'r', $filter);
	}
	/** попадает ли объект в фильтр? */
	private function testObject($item, $type, $filter='')
	{
		$a = array();
		foreach ($item->attributes() as $k => $v) $a[$k] = (string)$v;
		foreach ($item->tag as $tag) $a[(string)$tag->attributes()['k']] = (string)$tag->attributes()['v'];
		$a['id'] = $type.$a['id'];

		// опеделяем самую свежую правку
		if ($this->timestamp < $a['timestamp']) $this->timestamp = $a['timestamp'];

		// убираем ненужные теги
		unset($a['version']);
		unset($a['timestamp']);
		unset($a['uid']);
		unset($a['user']);

		// фильтруем
		$ok = $filter ? 0 : 1;
		if (!$ok)
		foreach ($a as $v)
			if (mb_stripos(" $v", $filter)) { $ok = 1; break; }

		if (!$ok && !isset($a['name']) && !isset($a['operator'])) $ok = 1; // анонимные объекты тоже сохраняем

		if (!$ok) return;

		// определяем средние координаты для площадных объектов
		if ($type == 'w') $a += self::getObjectCenter('w'.$a['id']);
		if ($type == 'r') $a += self::getObjectCenter('r'.$a['id']);

		array_push($this->osm_objects, $a);
	}
	/** текстовые XML данные объекта */
	static function getOsmXML($id)
	{
		$object = 'node';
		if ($id[0] == 'w') $object = 'way';
		if ($id[0] == 'r') $object = 'relation';
		$type = $object[0];

		$id  = preg_replace('/\D/', '', $id);
		$h   = substr("$id", 0, 2);
		$dir = self::$prefix."/_objects/$type/$h";
		@mkdir($dir, 0777, true);
		$fname = "$dir/$id";

		$page = '';
		if (file_exists($fname))
			$page = file_get_contents($fname);

		if (!strpos($page, '</osm>'))
		{
			echo "// Download $id\n";
//			$this->log("OSM API: $type$id");
			if ($object != 'node') $id .= '/full';
			$page = @file_get_contents("http://api.openstreetmap.org/api/0.6/$object/$id");
			if ($page)
			file_put_contents($fname, $page);
		}
		return $page;
	}
	/** все поля объекта в виде хеша */
	static function getObject($id)
	{
		$a = array();
		$st = self::getOsmXML($id);
		if (!$st) return $a;
		try {
		$osm = new SimpleXMLElement($st);
		} catch (Exception $e) { echo "// Error parse XML for $id\n"; return $a; }
		$item = ($id[0] == 'n') ? $osm->node : $osm->way;
		foreach ($item->attributes() as $k => $v) $a[$k] = (string)$v;
		foreach ($item->tag as $tag) $a[(string)$tag->attributes()['k']] = (string)$tag->attributes()['v'];
		ksort($a);
		$a['id'] = $id;
		return $a;
	}
	/** получение центра площадного объекта */
	static function getObjectCenter($id)
	{
		$st  = self::getOsmXML($id);
		if (!$st) return array();
		try {
		$osm = @new SimpleXMLElement($st);
		} catch (Exception $e) { echo "// Error parse XML for $id!\n"; return array(); }

		// рассчитываем средние координаты для веев
		$a = array('lat' => 0, 'lon' => 0); $n = 0;
		foreach ($osm->node as $nd)
		{
			$a['lat'] += (float)$nd->attributes()->lat;
			$a['lon'] += (float)$nd->attributes()->lon;
			$n++;
		}
		if ($n)
		{
			$a['lat'] /= $n;
			$a['lon'] /= $n;
		}
		return $a;
	}
}
