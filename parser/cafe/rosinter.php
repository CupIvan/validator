<?php
require_once 'Validator.class.php';

class rosinter extends Validator
{
	// откуда скачиваем данные
	protected $domain = 'http://www.rosinter.ru';
	static $urls = array(
		'RU-MOW' => '/locator/RestaurantsFeed.aspx?city=1',
		'RU-MOS' => '/locator/RestaurantsFeed.aspx?city=3',
	);

	protected function cuisine($x)
	{
		$a=[
			'Американская' => 'american',
			'Итальянская'  => 'italian',
			'Кофейня'      => 'coffee_shop',
			'Русская'      => 'russian',
			'Японская'     => 'japanese',
		];
		if (!empty($a[$x])) return $a[$x];
		echo 'Unknown cuisine: '.$x."\n";
		return '';
	}

	// парсер страницы
	protected function parse($st)
	{
		$xml = new SimpleXMLElement($st);
		foreach ($xml->Restaurants->item as $xml)
		{
			$obj['lat']   = (string)$xml->latitude;
			$obj['lon']   = (string)$xml->longitude;
			$obj['name']  = (string)$xml->brand;
			$obj['contact:phone'] = $this->phone((string)$xml->telephone);
			$obj['opening_hours'] = $this->time((string)$xml->opentime);
			$obj['cuisine'] = $this->cuisine((string)$xml->cuisine);
			$obj['_addr'] = (string)$xml->address;
			if ($obj['name'] == $this->fields['name'])
				$this->addObject($this->makeObject($obj));
		}
	}
}
