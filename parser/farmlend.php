<?php
// Показываем все ошибки
error_reporting(E_ALL);

require_once 'Validator.class.php';

class farmlend extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.farmlend.ru/apteki/';
	static $urls = array( 'RU-BA'  => 'bash',);
	// поля объекта
	protected $fields = array(
		'amenity'   => 'pharmacy',
		'dispensing'    => 'no',
		'operator' => 'Фармленд',
		'website'  => 'http://www.farmlend.ru',
		'ref'   => '',
		'phone' => '',
		'lat'   => '',
		'lon'   => '',
		'_addr' => '',
		);
	// фильтр для поиска объектов в OSM
	protected $filter = array('amenity=pharmacy', 'фармл');

	// парсер страницы
	protected function parse($st)
	{
        $st = str_replace('&ndash;', '-', $st);
        $st = str_replace('&nbsp;', '', $st);
        $st = str_replace('&laquo;', '"', $st);
        $st = str_replace('<br />', '', $st);
        $st = str_replace(' т.ф.', ' тел.', $st);
        $st = str_replace(' т. ', ' тел. ', $st);
        $st = str_replace(' т.(', ' тел. (', $st);
        $st = str_replace(', (347', ', тел. (347', $st);

$this->objectsCached = 0;

        if (preg_match_all($regexp = '#'
            ."а(пт\.|/п) ?(?<ref>\d+)"
            .".+?(?<_addr>.+?)(,|) т"
            .".+?(ел\.)? (?<text>.+?</li>)"
            ."#su", $st, $m, PREG_SET_ORDER))
        foreach ($m as $obj)
        {
            $str1 = $obj['_addr'];
            $str1 = str_replace('/-\D/'  , '/- \D/',$str1);
            $str1 = str_replace('- '  , '',$str1);
            $str1 = str_replace('/-\w/'  , '/\w/',$str1);
            $str1 = trim($str1);
            $str2 = $obj['text'];
            $str2 = str_replace('8 Марта','',$str2);
            $str2 = preg_replace('/,.+$/','',$str2);
            $str2 = preg_replace('/\D/', '', $str2);
            $str2 = trim($str2);
            if (strlen($str2)==7) 
            {
                $str2 = '+7347'.$str2;
                $obj['_addr'] = 'г.Уфа, '.$str1;
            }
            if (strlen($str2)==10) 
            {
                $str2 = '+7'.$str2;
                $obj['_addr'] = $str1;
            }
            $obj['phone'] = $this->phone($str2); 
			$this->addObject($this->makeObject($obj));
        }
	}
}
