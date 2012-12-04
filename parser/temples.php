<?php
require_once 'Validator.class.php';

class temples extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.temples.ru';
	static $urls = array(
		'RU-MOW' => array('41' => '/export_osm.php?send=on&RegionID=$1#$1'),
		'RU-MOS' => array('42' => '/export_osm.php?send=on&RegionID=$1#$1'),
		'RU-BA'  => array('688'=> '/export_osm.php?send=on&RegionID=$1#$1'),
		'RU-LEN' => array('709'=> '/export_osm.php?send=on&RegionID=$1#$1'),
		'RU-SPE' => array('703'=> '/export_osm.php?send=on&RegionID=$1#$1'),
		'RU-TVE' => array('47' => '/export_osm.php?send=on&RegionID=$1#$1'),
		'RU-VOR' => array('35' => '/export_osm.php?send=on&RegionID=$1#$1'),
	);
	// поля объекта
	protected $fields = array(
		'amenity'  => 'place_of_worship',
		'building' => '',
		'name'     => '',
		'religion' => 'christian',
		'denomination' => 'russian_orthodox',
		'disused'      => '',
		'alt_name'     => '',
		'ref:temples.ru' => '',
		'community:gender' => '',
		'start_date' => '',
		'website'    => '',
		'lat'   => '',
		'lon'   => '',
		'_id'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=place_of_worship', 'place');

	// парсер страницы
	protected function parse($st)
	{
		$st = str_replace(' />', '></end>', $st);
		if (preg_match_all('#'
		.'ID="(?<id>\d+)'
		.'.+?Name>(?<name>[^<]+)'
		.'.+?Status>(?<state>[^<]+)'
		.'.+?TypeObject>(?<type>[^<]+)'
		.'.+?Address>(?<_addr>[^<]+)'
		.'.+?WebSite>(?<website>[^<]*)'
		.'.+?Date>(?<start_date>[^<]+)'
		.'.+?Confession>(?<confession>[^<]+)'
		.'.+?Coordinates>(?<lon>[\d.]+),(?<lat>[\d.]+)'
		."#su", $st, $list, PREG_SET_ORDER))
		foreach ($list as $obj)
		{
			if ($obj['state'] == 'сохр.') $obj['disused']  = 'yes';

			$obj['ref:temples.ru'] = $obj['id'];
			$obj['name']  = preg_replace('/,? (что|во|в|на|при|у) .+/', '', $obj['name']); // сокращаем название
			$obj['name']  = preg_replace('/\(.+?\)/', '', $obj['name']); // убираем название в скобках

			// TODO: добавить тег-расшифровку конфессий
/*
			if ($obj['confession'] == 'РПЦ МП') $obj['denomination:ru'] = 'Русская Православная Церковь';
			if ($obj['confession'] == 'РосПЦ')  $obj['denomination:ru'] = 'Российская Православная Церковь';
			if ($obj['confession'] == 'РПАЦ')   $obj['denomination:ru'] = 'Русская Православная Автономная Церковь';
*/
			// FIXME: обрабатывать в датах фразы типа "2-я треть", "1-я пол."
			$date = $obj['start_date'];
			$date = str_replace(
				array('ок. ', 'нач.', 'сер.', 'кон.', 'не позже', '-е', '-х',
					'строится', ' в.', ' вв.', 'рубеж',
					'XXI', 'XX', 'XIX', 'XVIII', 'XVII', 'XVI', 'XV', 'XIV',
				),
				array('~', 'early', 'mid', 'late', 'before', 's', 's',
					'','','','',
					'C21', 'C20', 'C19', 'C18', 'C17', 'C16', 'C15', 'C14',
				),
				$date);
			$date = preg_replace('/\s*-\s*/', '-',$date);
			$obj['start_date'] = trim($date);

			$obj['website'] = preg_replace('#/$#', '', $obj['website']);

			if (mb_stripos(' '.$obj['name'],  'собор'))     $obj['building'] = 'cathedral';
			if (mb_stripos(' '.$obj['name'],  'часовня'))   $obj['building'] = 'chapel';
			if (mb_stripos(' '.$obj['name'],  'монастырь')){$obj['building'] = 'monastery';
				if (mb_stripos(' '.$obj['name'], 'мужск')) $obj['community:gender'] = 'male';
				if (mb_stripos(' '.$obj['name'], 'женск')) $obj['community:gender'] = 'female';
			}
			if (0
				|| mb_stripos(' '.$obj['name'],  'церковь')
				|| mb_stripos(' '.$obj['name'],  'храм')
				) $obj['building'] = 'church';

			$this->addObject($this->makeObject($obj));
		}
	}
}
