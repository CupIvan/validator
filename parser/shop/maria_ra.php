<?php
require_once 'Validator.class.php';

class maria_ra extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.maria-ra.ru/';
	static $urls = array(
		'RU-ALT' => array('1256', 'Алтайский край'),
		'RU-KEM' => array('1259', 'Кемеровская область'),
		'RU-NVS' => array('1257', 'Новосибирская область'),
		'RU-AL'  => array('1258', 'Республика Алтай'),
		'RU-TOM' => array('1260', 'Томская область')
		);
	// поля объекта
	protected $fields = array(
		'shop'  => 'supermarket',
		'name'     => 'Мария-Ра',
		'operator' => 'ООО "Розница-1"',
		'website'  => 'http://www.maria-ra.ru/',
		'ref'      => '',
		'opening_hours' => '',
		'phone' => '',
		'lat'   => '',
		'lon'   => '',
		'_name' => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'мария');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data '.$this->region);
		$url =  'o-nas/adresa-magazinov/?region='.static::$urls[$this->region][0];

		//определяем число страниц
		$page = $this->download($this->domain.$url);		
		preg_match('/modern.page.dots.+?PAGEN_1.+?PAGEN_1=(?<pages>\d+)"/s', $page, $obj);
		$pages = intval($obj['pages']);

		for ($i = 1; $i <= $pages; $i++)
		{
			$page = $this->download($this->domain.$url.'&PAGEN_1='.$i);
			$this->parse($page);
		}
	}
	// парсер страницы
	protected function parse($st)
	{

		if (!preg_match_all('#'
            .'<h4>(?<city>.+?)</h4>'
            .'#su', $st, $places)) return;
        $cityBody = preg_split('#'
            .'(<h4>.+?</h4>)'
            .'#su', $st);

        foreach ($places['city'] as $i => $city)
        {
            preg_match_all('#'
                .'.+?'
                .'<h2>(?<address>.+?)</h2>'
                .'.+?'
                .'<div class="accord_body">'
                .'.+?'
                .'<b>(?<type>.+?),(?<time>.+?)</b>'
                .'.+?'
                .'<div class="coordmag">(?<lat>.+?),(?<lon>.+?)</div>'
                .'.+?'
                .'#su', $cityBody[$i + 1], $shops);

            for ($j = 0; $j < count($shops['address']); $j++)
            {
                $hours = $shops['time'][$j];
                $hours = str_replace("воскр.", "вс", $hours);
                $hours = $this->time($hours);
                $obj = array();
                $obj['_addr'] = static::$urls[$this->region][1].', '.$city.', '.$shops['address'][$j];
                print $obj['_addr']."\n";
                $obj['opening_hours'] = $hours;
//                Координаты на сайте получены геокодером Яндекса. Ещё и криво получены.
//                $obj['lat'] = $shops['lat'][$j];
//                $obj['lon'] = $shops['lon'][$j];
//                Очень хотелось бы отобразить категорию магазина на карте
//                но, похоже это невозможно.
//                if ($shops['type'][$j] == 'супермаркет')
//                    $obj['shop'] = 'supermarket';
//                else
//                    $obj['shop'] = 'convenience';
                $this->addObject($this->makeObject($obj));
            }
        }

	}
}
