<?php
require_once 'Validator.class.php';

class novex extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.novex-trade.ru/stores/';
	static $urls = array(
		'RU-ALT' => 'Алтайский край',
		'RU-KEM' => 'Кемеровская область',
		'RU-NVS' => 'Новосибирская область',
		'RU-AL'  => 'Республика Алтай',
		'RU-TOM' => 'Томская область'
		);
	// поля объекта
	protected $fields = array(
		'shop'  => 'supermarket',
		'name'     => 'Новэкс',
		'operator' => 'ООО "Новэкс"',
		'ref'      => '',
		'opening_hours' => '',
		'contact:phone' => '',
		'lat'   => '',
		'lon'   => '',
		'_name' => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('shop=supermarket', 'новэкс');

	/** обновление данных по региону */
	public function update()
	{
		$this->log('Update real data '.$this->region);
        $page = $this->download($this->domain);
        $this->parse($page);

	}
	// парсер страницы
	protected function parse($st)
	{

        if (!preg_match_all('#'.
            '.*?<li>'.
            '.*?<h5><a href="(?<website>.+?)">(?<_name>.+?)</a></h5>'.
            '.*?<address>(?<_addr>.+?)(,?<br.*?(?<phone>\(.+?))?</address>'.
            '.*?</li>'.
            '#su', $st, $shops)) return;
//            var_dump($shops);

            for ($j = 0; $j < count($shops['_addr']); $j++)
            {
                $shops['_addr'][$j] = rtrim($shops['_addr'][$j], ",");

                if (strpos($shops['_addr'][$j], 'www.novex-trade.ru') === false &&
                    strpos($shops['_addr'][$j], static::$urls[$this->region]) !== false
                )
                {
                    $obj = array();
                    $obj['_addr'] = $shops['_addr'][$j];
                    $obj['contact:phone'] = $this->phone($shops['phone'][$j]);
                    $obj['contact:website'] = $shops['website'][$j];
                    $this->addObject($this->makeObject($obj));
                }



            }

	}
}
