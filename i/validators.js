var osm = new osm_cl()
	.region('Москва', 'RU-MOW')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Служба крови','blood')
		.validator('Альфабанк',   'alfabank')
		.validator('Промсбербанк','promsberbank')
		.validator('МИнБ',        'minbank')
		.validator('МКБ',         'mkb')
		.validator('М.Видео',     'mvideo')
		.validator('Перекресток', 'perekrestok')
		.validator('Белый ветер', 'beli_veter')
		.validator('Асна',        'asna')
		.validator('Азбука вкуса','azbuka')
		.validator('Газпромнефть','gazprom')
		.validator('Лукойл',      'lukoil')
		.validator('Роснефть',    'rosneft')
		.validator('Автопаскер',  'autopasker')
		.validator('Авто49',      'auto49')
		.validator('Церкви',      'temples')
		.validator('Дикси',       'diksi')
		.validator('Ашан',        'auchan')
		.validator('Атак',        'atak')
		.validator('Зоомагазин "4 лапы"', 'lapy4')
		.validator('Избёнка',     'izbenka')
		.validator('Терволина',   'tervolina')
		.validator('Подружка',    'podruzhka')
	.region('Московская область', 'RU-MOS')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Служба крови','blood')
		.validator('Альфабанк',   'alfabank')
		.validator('Промсбербанк','promsberbank')
		.validator('МИнБ',        'minbank')
		.validator('МКБ',         'mkb')
		.validator('М.Видео',     'mvideo')
		.validator('Перекресток', 'perekrestok')
		.validator('Белый ветер', 'beli_veter')
		.validator('Азбука вкуса','azbuka')
		.validator('Асна',        'asna')
		.validator('Лукойл',      'lukoil')
		.validator('Роснефть',    'rosneft')
		.validator('Газпромнефть','gazprom')
		.validator('Автопаскер',  'autopasker')
		.validator('Авто49',      'auto49')
		.validator('Церкви',      'temples')
		.validator('Дикси',       'diksi')
		.validator('Атак',        'atak')
		.validator('Зоомагазин "4 лапы"', 'lapy4')
		.validator('Терволина',   'tervolina')
		.validator('Подружка',    'podruzhka')
	.region('Санкт-Петербург', 'RU-SPE')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Служба крови','blood')
		.validator('Перекресток', 'perekrestok')
		.validator('Роснефть',    'rosneft')
		.validator('Дикси',       'diksi')
		.validator('Белый ветер', 'beli_veter')
		.validator('Лукойл',      'lukoil')
		.validator('Газпромнефть','gazprom')
		.validator('Ашан',        'auchan')
		.validator('МИнБ',        'minbank')
		.validator('Церкви',      'temples')
		.validator('Авто49',      'auto49')
	.region('Ленинградская область', 'RU-LEN')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Служба крови','blood')
		.validator('Перекресток', 'perekrestok')
		.validator('Роснефть',    'rosneft')
		.validator('Лукойл',      'lukoil')
		.validator('Газпромнефть','gazprom')
		.validator('Дикси',       'diksi')
		.validator('МИнБ',        'minbank')
		.validator('Церкви',      'temples')

	.region('Адыгея', 'RU-AD')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Астраханская область', 'RU-ARK')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Башкирия', 'RU-BA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Башнефть',    'bashneft')
		.validator('Фармленд',    'farmlend')
		.validator('Церкви',      'temples')
		.validator('Авто49',      'auto49')
		.validator('Лукойл',      'lukoil')
	.region('Белгородская область', 'RU-BEL')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Церкви',      'temples')
	.region('Брянская область', 'RU-BRY')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Церкви',      'temples')
	.region('Владимирская область', 'RU-VLA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Дикси',       'diksi')
	.region('Волгоградская область', 'RU-VGG')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Лукойл',      'lukoil')
	.region('Вологодская область', 'RU-VLG')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Лукойл',      'lukoil')
	.region('Воронежская область', 'RU-VOR')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Перекресток', 'perekrestok')
		.validator('Роснефть',    'rosneft')
		.validator('Автопаскер',  'autopasker')
		.validator('Церкви',      'temples')
		.validator('Башнефть',    'bashneft')
		.validator('Ашан',        'auchan')
		.validator('Авто49',      'auto49')
	.region('Иркутская область', 'RU-IRK')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
	.region('Калининградская область')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Альфабанк','alfabank')
		.validator('Лукойл',   'lukoil')
	.region('Калужская область', 'RU-KLU')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Газпромнефть','gazprom')
		.validator('Промсбербанк','promsberbank')
		.validator('Дикси',       'diksi')
		.validator('Перекресток', 'perekrestok')
	.region('Кемеровская область', 'RU-KEM')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Церкви',      'temples')
	.region('Кировская область', 'RU-KIR')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Хлынов', 'hlinov')
	.region('Краснодарский край', 'RU-KDA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',     'sberbank')
		.validator('Почта',        'russian_post')
		.validator('Служба крови', 'blood')
		.validator('Лукойл',       'lukoil')
		.validator('Роснефть',     'rosneft')
	.region('Красноярский край', 'RU-KYA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Курская область', 'RU-KRS')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',          'sberbank')
	.region('Липецкая область', 'RU-LIP')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',          'sberbank')
		.validator('Почта',             'russian_post')
		.validator('Перекрёсток',       'perekrestok')
	.region('Мурманская область', 'RU-MUR')
		.validator('Сбербанк',           'sberbank')
		.validator('Почта',              'russian_post')
		.validator('Альфабанк',          'alfabank')
		.validator('Альфабанк.Банкоматы','alfabank_atm')
		.validator('Дикси',       'diksi')
	.region('Нижегородская область', 'RU-NIZ')
		.validator('Сбербанк', 'sberbank')
		.validator('Перекресток', 'perekrestok')
	.region('Новгородская область', 'RU-NGR')
		.validator('Сбербанк', 'sberbank')
		.validator('Дикси',       'diksi')
	.region('Омская область', 'RU-OMS')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк',          'sberbank')
		.validator('Почта',             'russian_post')
	.region('Орловская область', 'RU-ORL')
		.validator('Сбербанк', 'sberbank')
	.region('Пензенская область', 'RU-PNZ')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Пермский край', 'RU-PER')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Лукойл',   'lukoil')
	.region('Приморский край', 'RU-PRI')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Ростовская область', 'RU-ROS')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Рязанская область', 'RU-RYA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Самарская область', 'RU-SAM')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Белый ветер', 'beli_veter')
		.validator('Перекресток', 'perekrestok')
		.validator('Ашан',        'auchan')
	.region('Саратовская область', 'RU-SAR')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
	.region('Свердловская область', 'RU-SVE')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
	.region('Ставропольский край', 'RU-STA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
	.region('Тверская область', 'RU-TVE')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Церкви',   'temples')
	.region('Татарстан', 'RU-TA')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Башнефть', 'bashneft')
		.validator('Белый ветер', 'beli_veter')
		.validator('Перекресток', 'perekrestok')
	.region('Тульская область', 'RU-TUL')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
	.region('Ульяновская область', 'RU-ULY')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Хабаровский край', 'RU-KHA')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Челябинская область', 'RU-CHE')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Башнефть',    'bashneft')
	.region('Якутия', 'RU-SA')
		.validator('Населенные пункты', 'wiki_places')
	.region('Ярославская область', 'RU-YAR')
		.validator('Населенные пункты', 'wiki_places')
		.validator('Сбербанк', 'sberbank')
		.validator('Дикси',       'diksi')
		.validator('Белый ветер', 'beli_veter')
		.validator('Перекресток', 'perekrestok')
		.validator('Газпромнефть','gazprom')
		.validator('Зоомагазин "4 лапы"', 'lapy4')


var links = {
	'sberbank':    'http://sbrf.ru/moscow/ru/about/branch/list_branch/',
	'perekrestok': 'http://www.perekrestok.ru/shops/',
	'azbuka':      'http://av.ru/index.aspx?sPage=63',
	'beli_veter':  'http://www.digital.ru/shops/all/view',
	'gazprom':     'http://www.gpnbonus.ru/our_azs/',
	'hlinov':      'http://bank-hlynov.ru/about/unit_of_the_bank/additional_offices/',
	'asna':        'http://www.asna.ru/drugstores',
	'alfabank':    'http://www.alfabank.ru/russia/moscow/',
	'lukoil':      'http://www.lukoil.ru/new/azslocator',
	'rosneft':     'http://www.rosneft.ru/Downstream/petroleum_product_sales/servicestations/',
	'russian_post':'http://www.russianpost.ru/rp/servise/ru/home/postuslug/searchops1',
	'autopasker':  'http://avtopasker.ru/info/list.php?town=all',
	'promsberbank':'http://www.promsbank.ru/contact',
	'temples':     'http://www.temples.ru/tree.php',
	'diksi':       'http://dixy.ru/shops',
	'bashneft':    'http://www.bashneft-azs.ru/network_azs/',
	'atak':        'http://www.ataksupermarket.ru/atak.html?rid=1',
	'auchan':      'http://www.auchan.ru/ru/moscow',
	'farmlend':    'http://www.farmlend.ru/apteki/',
	'izbenka':     'http://vkusvill.ru/shops/shoplist/',
	'minbank':     'http://www.minbank.ru/list/373/',
	'lapy4':       'http://4lapy.ru/pet_stores_amp_services/',
	'auto49':      'http://www.auto49.ru/import',
	'mkb':         'http://mkb.ru/about_bank/address/?type=office',
	'tervolina':   'http://www.tervolina.ru/moscow.aspx',
	'podruzka':    'http://www.podrygka.ru/shops/find/',
	'mvideo':      'http://www.mvideo.ru/shops/',
	'blood':       'http://yadonor.ru/where.htm',
_:0};

var fields = {
	'sberbank':    ['_addr', 'ref', 'operator', 'branch', 'department', 'name', 'contact:phone', 'contact:website', 'disused', 'opening_hours', 'wheelchair'],
	'perekrestok': ['_addr', 'operator', 'name', 'phone', 'website', 'opening_hours'],
	'azbuka':      ['_addr', 'operator', 'name', 'website', 'opening_hours'],
	'beli_veter':  ['_addr', 'ref', 'operator', 'name', 'phone', 'website', 'opening_hours'],
	'gazprom':     ['_addr', 'ref', 'operator', 'brand', 'name', 'website', 'opening_hours', 'payment:cards', 'shop', 'toilets', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:diesel', 'fuel:lpg'],
	'hlinov':      ['_addr', 'operator', 'name', 'website'],
	'asna':        ['_addr', 'ref', '_name', 'brand', 'contact:phone', 'opening_hours', 'contact:website', 'contact:email'],
	'alfabank':    ['_addr', 'operator', 'name', 'official_name', 'website', 'opening_hours'],
	'alfabank_atm':['_addr', 'operator', 'website', 'opening_hours', 'currency:RUR', 'currency:USD', 'currency:EUR'],
	'lukoil':      ['_addr', 'ref', 'operator', 'brand', 'contact:website', 'opening_hours', 'payment:cards', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:diesel', 'fuel:lpg', 'car_wash', 'shop', 'toilets', 'compressed_air'],
	'rosneft':     ['_addr', 'ref', 'operator', 'brand', 'website', 'opening_hours', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:octane_80', 'fuel:diesel'],
	'russian_post':['_addr', 'ref', 'operator', 'name', 'contact:website', 'contact:phone', 'opening_hours', '_name'],
	'autopasker':  ['_addr', 'operator', 'brand', 'phone', 'website', 'opening_hours', 'payment:cards'],
	'promsberbank':['_addr', 'ref', 'operator', 'name', 'website', 'phone', '_data'],
	'temples':     ['_addr', 'ref:temples.ru', 'start_date', 'name', 'alt_name', 'community:gender', 'building', 'disused', 'denomination', 'denomination:ru', 'russian_orthodox', 'religion', 'phone'],
	'diksi':       ['_addr', 'operator', 'name', 'payment:cards', 'opening_hours'],
	'bashneft':    ['_addr', 'ref', 'operator', 'brand', 'name', 'payment:cards', 'payment:fuel_cards', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:diesel', 'fuel:lpg'],
	'atak':        ['_addr', 'operator', 'brand', 'name', 'phone', 'website', 'opening_hours'],
	'auchan':      ['_addr', 'ref', 'operator', 'brand', 'name', 'website', 'opening_hours'],
	'farmlend':    ['_addr', 'ref', 'operator', 'phone', 'website', 'dispensing'],
	'izbenka':     ['_addr', 'operator', 'brand', 'name', 'website', 'opening_hours'],
	'minbank':     ['_addr', 'operator', 'name', 'website', 'opening_hours'],
	'lapy4':       ['_addr', 'name', 'phone', 'opening_hours', 'pets', 'aquarium', 'veterinary', 'grooming', 'payment:cards', 'website'],
	'wiki_places': ['name', 'name:ru', 'official_status', 'place', 'population', '_population2013', '_population2012', '_population2010', 'wikipedia', 'old_name', 'contact:website', 'addr:postcode', 'okato:user', 'addr:country', 'addr:region', 'addr:district'],
	'auto49':      ['_addr', 'operator', 'brand', 'phone', 'website', 'opening_hours', 'payment:cards'],
	'mkb':         ['_addr', 'operator', 'department', 'name', 'contact:phone', 'contact:website', 'opening_hours'],
	'tervolina':   ['_addr', 'operator', 'name', 'brand', 'phone', 'website', 'opening_hours'],
	'podruzhka':   ['_addr', 'operator', 'name', 'brand', 'contact:phone', 'contact:website', 'opening_hours'],
	'mvideo':      ['_addr', 'ref', 'operator', 'name', 'brand', 'contact:phone', 'contact:website', 'opening_hours'],
	'blood':       ['_addr', 'name', 'contact:phone', 'opening_hours', 'contact:website', 'contact:email', 'operator'],
_:0}

C_Empty    = 1;
C_Skip     = 2;
C_Diff     = 3;
C_Equal    = 4;
C_Similar  =14;
C_NoCoords = 5;
C_NotFound = 6;
C_FoundRef = 7;
C_Double   = 8;
C_Excess   = 9;
C_Total    = 0;


function osm_cl()
{
	this._regions = {};
	this._filter  = {page: 0};
	this._fast_filter = {};
	this._fast_filter_enable = 0;
	this._fast_filter_search_osm = 0;
	this._cityList = null;
	this.activeRegion = '';
	this.activeValidator = '';
	this.numPerPage = 30;

	// добавить регион
	this.region = function(title, code)
	{
		this._regions[code] = {title: title, validators: {}};
		this.activeRegion  = code;
		return this;
	}

	// добавить валидатор к текущему региону
	this.validator = function(title, code, data)
	{
		if (!data) data = this.activeRegion;
		this._regions[this.activeRegion].validators[code] = {title: title, code: code, data: data}
		return this;
	}

	// select список регионов
	this.regions = function()
	{
		var i, st = '';
		for (i in this._regions)
		st += '<option value="'+i+'">'+this._regions[i]['title']+'</option>';
		if (st) st = '<select id="region" onchange="osm.changeRegion(this.value)">'+
			'<option value="">Выберите регион</option>'+st+'</select>';
		return st;
	}

	// смена региона
	this.changeRegion = function(x)
	{
		if (!this._regions[x]) return;
		this.activeRegion = x;
		document.location = '#'+x;
		$('validators', x ? osm.validators(x) : '');
		this._filter = {page: 0};
		this.changeValidator(this.activeValidator || 'sberbank');
		style($$('div.hidden'), 'display: block');
	}

	// select список валидаторов региона
	this.validators = function(region)
	{
		var i, st = '';
		for (i in this._regions[region].validators)
		st += '<option value="'+i+'">'+this._regions[region].validators[i]['title']+'</option>';
		if (st) st = '<select id="validator" onchange="osm.changeValidator(this.value)">'+st+'</select>';
		return st;
	}

	// смена валидатора
	this.changeValidator = function(x)
	{
		if (!this._regions[this.activeRegion].validators[x]) return;
		this.activeValidator = x;
		if ($('validator').value != x) $('validator').value = x;

		document.location = '#'+this.activeRegion+'/'+x;
		$('search').value = '';
		$('validate', '');

		this.loaded_objects = {};

		// добавляем инфу о времени последнего обновления
		var st = '', d = this._regions[this.activeRegion].validators[x].data;
		var _ = function(x, y, Z) { return state[x+'.'+y] ? '<span title="'+date('H:i:s', state[x+'.'+y][Z])+'">'+date('d.m.Y', state[x+'.'+y][Z])+'</span>' : '?'; }
		st = 'Обновлено '+_(this.activeRegion, x, 2)+', OSM данные от '+_(this.activeRegion, x, 3)+
			', <a href="'+links[x]+'">объекты</a> от '+_(x, (typeof(d)=='string'?d:d[0]), 2);
		st += '<input type="button" onclick="osm.update()" value="Перевалидировать" id="btn_revalidate">'
		$('date', st);

		this.validate(this.activeRegion, x);
	}

	// хэш функция по координтам
	this.hash = function(lat, lon)
	{
		lat = Math.round(parseFloat(lat));
		lon = Math.round(parseFloat(lon));
		return ''+lat+''+lon;
	}

	// генерация таблицы валидатора
	this.validate = function(region, validator)
	{
		var v = this._regions[region].validators[validator];
		$('validate', '');

		this.osm_data  = {};
		this.real_data = [];
		this.osm_data_by_ref = {};

		this.log('Загрузка данных с сервера...');

		// данные osm
		ajax.load('data/'+region+'/'+v.code+'.js', function(a){
			var i, hash, corr = {};

			// первый эл-т массива - данные, остальные - поправки
			if (typeof(a) == 'string')
			a = eval('(['+a+'])');

			// находим поправки
			for (i = 1; i < a.length; i++)
				corr[a[i].id] = a[i];

			a = a[0];
			for (i = 0; i < a.length; i++)
			{
				if (corr[a[i].id]) // применяем поправку
				{
					corr[a[i].id].lat = a[i].lat;
					corr[a[i].id].lon = a[i].lon;
					a[i] = corr[a[i].id];
				}

				hash = osm.hash(a[i].lat, a[i].lon); // берем хэш от координат, чтобы было легко найти
				if (!osm.osm_data[hash]) osm.osm_data[hash] = [];
				osm.osm_data[hash].push(a[i]);

				// индекс по ref
				if (a[i].ref)
				osm.osm_data_by_ref[a[i].ref] = {hash: hash, id: osm.osm_data[hash].length - 1};
			}

			osm.revalidate();
		});
		// реальные данные
		var data = v.data;
		if (typeof(data) == 'string') data = [data];
		for (var i = 0; i < data.length; i++)
		ajax.load('data/'+v.code+'/'+data[i]+'.js', function(a){
			if (typeof(a) == 'string') a = eval('('+a+')');
			osm.real_data = osm.real_data.concat(a);

			osm.revalidate();
		});
	}
	// функция генерации таблицы валидатора
	this.revalidate  = function() { if (this.timerRevalidate) clearInterval(this.timerRevalidate);
		this.timerRevalidate = setTimeout(function(){ osm.revalidate_(); }, 200); }

	// валидация подсчет кол-ва объектов
	this.revalidate_ = function()
	{
		var a = osm.real_data, osm_data, state, f, i, j, t;
		this.count = [0,0,0,0,0,0,0,0,0,0,0,0];

		this.log('Обработка данных...');

		f = fields[this.activeValidator];

		this._fast_filter = {};

		// вспомогательная функция регистрации быстрого фильтра
		var _ = function(a, x)
		{
			if (a && a[x])
			{
				if (!osm._fast_filter[x]) osm._fast_filter[x] = {};
				osm._fast_filter[x][a[x]] = 1 + (osm._fast_filter[x][a[x]] || 0);
			}
		}

		for (i = 0; i < a.length; i++)
		{
			osm_data = osm.search(a[i], true);

			if (!osm_data)
				a[i]._state = a[i].lat ? C_NotFound : C_NoCoords;
			else
			{
				if (osm_data._used > 1) a[i]._double = C_Double; // дубликат

				if (!a[i].lat) { a[i]._ref = C_FoundRef; this.count[C_FoundRef]++; };
				a[i]._state = 0;
				for (j in f)
				{
					state = osm.compareField(osm_data, a[i], f[j]);

					if (state == C_Skip)  continue;
					if (state == C_Diff) { a[i]._state = state; break; }
					if (state == C_Empty)
						if (!a[i]._state) a[i]._state = state;
				}
				if (!a[i]._state) a[i]._state = C_Equal;
				if (osm_data._used > 1)
				this.count[C_Double]    = (this.count[C_Double] || 0) + 1;
			}

			this.count[a[i]._state] = (this.count[a[i]._state] || 0) + 1;
			this.count[0]++;

			// формируем быстрый фильтр
			t = this._fast_filter_search_osm ? osm_data : a[i];
			_(t, 'place');
			_(t, 'addr:district');
			_(t, 'official_status');
			_(t, 'operator');
			_(t, 'brand');
			_(t, 'branch');
			_(t, 'department');
			_(t, 'building');
			_(t, 'denomination');
			if (osm.activeValidator != 'wiki_places')
			if (osm.activeValidator != 'temples')
			_(t, 'website');
			if (osm.activeValidator != 'russian_post')
			if (osm.activeValidator != 'wiki_places')
			if (osm.activeValidator != 'temples')
			_(t, 'name');
		}

		// кол-во непривязанных OSM объектов
		for (i in this.osm_data)
		for (j in this.osm_data[i])
			if (!this.osm_data[i][j]._used) this.count[C_Excess]++;

		osm._cityList = null;

		// открываем объекты с ошибкой
		if (this.count[C_Diff])     this.filter({_state: C_Diff});
		else
		if (this.count[C_Empty])    this.filter({_state: C_Empty});
		else
		if (this.count[C_NotFound]) this.filter({_state: C_NotFound});
		else
		if (this.count[C_FoundRef]) this.filter({_state: C_FoundRef});
		else
			this.filter()
		this.log();
	}

	// функция отрисовки страницы с данными
	this.updatePage = function(){
		var i, j, st = '', dataId, _, N=0;
		var a = osm.filter_data;
		if (!a) return;
		osm.category = {};

		this.log('Генерация таблицы...');

		st += '<tr>';
		st += '<th colspan="2"></th>';
		for (i in fields[osm.activeValidator])
		{
			j = fields[osm.activeValidator][i];
			st += '<th title="'+j+'">';
			j = j
				.replace('ref:temples.ru', '<span title="temples.ru">ref</span>')
				.replace('start_date', 'Дата постр.')
				.replace('alt_name',  '<span title="Альтернативное название">Альт.</span>')
				.replace('disused',   '<span title="не работает?">Закр.</span>')
				.replace('denomination:ru', '<span title="конфессия русск.">Конф.</span>')
				.replace('denomination', '<span title="конфессия">Конф.</span>')
				.replace('russian_orthodox', '<span title="признают Патриарха?">ПП</span>')
				.replace('contact:phone',     'Телефон')
				.replace('phone',     'Телефон')
				.replace('building',  'Здание')
				.replace('old_name',  '<span title="Прежнее название">Прежн.</span>')
				.replace('name:ru',   'Русское')
				.replace('name',      'Название')
				.replace('addr:postcode', 'Индекс')
				.replace('community:gender', '<span title="community:gender">Пол</span>')
				.replace('official_status', 'Статус')
				.replace('addr:country', '<span title="Страна">RU</span>')
				.replace('population', '<span title="Население">Нас.</span>')
				.replace('_addr', 'Адрес');
			st += j+'</th>';
		}
		st += '</tr>';

		var yasearch = '';

		for (i = osm._filter.page < 0 ? 0 : osm._filter.page * osm.numPerPage; i < a.length; i++)
		{
			if (!osm.category[a[i]._cat]) osm.category[a[i]._cat] = 0;
			osm.category[a[i]._cat]++;

			yasearch = this.activeValidator == 'wiki_places'
				? a[i]['addr:district']+', '+(a[i]['official_status']||'').replace('ru:', '')+' '+a[i]['name:ru']
				: a[i]._addr;

			osm_data = osm.search(a[i]);
			if (osm_data) a[i].id = osm_data.id;
			st += '<tr'+(osm_data && osm_data._used > 1 ?
				' class="multi" title="Объект привязан несколько раз, необходимо его расчленить!'+osm_data._used_name+'"' : '')+'>'
				+'<td class="c">'+(osm_data
					? (osm_data && osm_data._used > 1?' '+osm.link(a[i]):'')+osm.link(osm_data.id)
					: osm.link(a[i]))+
					' '+osm.link_yasearch(yasearch)+
					'</td>'
				+'<td class="c">'+(osm_data
					? osm.link_open_josm(osm_data.id)+' '+
						(osm_data._used > 1 ? '' : osm.link_export_update(a[i], osm_data))
					: osm.link_find_josm(a[i])+' '+osm.link_export_create(a[i])) +'</td>'
				+ osm.compare(osm_data ? osm_data : {}, a[i], fields[osm.activeValidator])
				+'</tr>';


			if (++N >= osm.numPerPage && osm._filter.page >= 0) break;
		}
		if (st) st = '<table>'+st+'</table>';
		$('validate', st);

		// быстрая выборка по населенным пунктам
		var t='',c=1; st = '';
		for (i in osm._cityList)
		{
			t = osm._cityList[i].name.replace(/"/g, '&quote;');
			c = osm._cityList[i].count + '';
			st += '<option value="'+t+'">'+
				t+' '.repeat(25 - t.length - c.length)+c+'</option>';
		}
		if (st) st = '<select onchange="osm.searchByName($(\'search\').value = this.value)">'+
			'<option value="">Населённый пункт</option>'+st+'</select>';
		$('city', st);

		// номера страниц
		st = '';
		var _ = function(x){
			return '<a href="#" class="'+(eval(x) == osm._filter._state?'active':'')+
				'" onclick="osm._cityList = null; return osm.filter({_state:'+x+'})" ';
		}
		var R = function(f, code){
			return '<a href="#" class="'+(eval(code) == osm._filter[f]?'active':'')+
				'" onclick="osm._cityList = null; return osm.filter({'+f+':'+code+'})" ';
		}
		if (this.count)
		st += 'Состояние: '+
			'   '+_('C_Equal')   +'title="Без ошибок">'+this.count[C_Equal]+'</a>'+
			' + '+_('C_Diff')    +'title="Ошибка">'+this.count[C_Diff]+'</a>'+
			' + '+_('C_Empty')   +'title="Неполные данные">'+this.count[C_Empty]+'</a>'+
			' + '+_('C_NotFound')+'title="Не найдено в OSM">'+this.count[C_NotFound]+'</a>'+
			' + '+_('C_NoCoords')+'title="Ошибка геокодинга">'+this.count[C_NoCoords]+'</a>'+
			' = '+_('').replace(/ret.+"/, 'delete osm._filter._state;'+
				'return osm.filter()"')+'title="Все объекты">'+this.count[C_Total]+'</a>'+
			' | '+R('_ref',  'C_FoundRef')+'title="Найдено по ref">'+this.count[C_FoundRef]+'</a>'+
			' | '+R('_double', 'C_Double')+'title="Дубликаты">'+this.count[C_Double]+'</a>'+
			' | '+R('_used', 0)+'title="&quot;Лишние&quot; объекты в OSM">'+this.count[C_Excess]+'</a>';
		$('state', st);

		st = 'Отфильтровано: '+a.length+' <a href="#" title="Нам нужно больше параметров!" class="simple" onclick="return osm.fastFilterToggle()">еще...</a>'+'<br>'+osm.drawFastFilter()+'<br>';
		var numPages = Math.ceil(a.length / osm.numPerPage);
		var big = numPages > 25 ? 1 : 0, skip = 0;
		var st_nav = '';
		if (osm._filter.page < 0)
			st_nav = '<br><a href="#all" onclick="return osm.page(0)">по страницам</a>';
		else
		if (numPages > 1)
		{
			st_nav += '<br>';
			for (i = 0; i < numPages; i++)
			{
				if (big)
					if (i > 10 && i < numPages - 5)
						if (mod(i - osm._filter.page) > 2) { skip = 1; continue; }
				if (skip) { st += ' ... '; skip = 0; }
				st_nav += '<a href="#"'+(osm._filter.page == i?'class="active"':'')+
					'onclick="return osm.page('+i+')">'+(i+1)+'</a> ';
			}
			st_nav += '<a href="#all" onclick="return osm.page(-1)">все</a>'
		}
		st += st_nav;
		$('pages', st);
		$('pages_bottom', numPages > 1 ? st_nav : '');
		this.log();
	}

	// отрисовка быстрого фильтра
	this.drawFastFilter = function()
	{
		var i, j, st = '', a;
		if (this._fast_filter_enable)
		for (i in this._fast_filter)
		{
			st += '<li>'+i+':<br>';
			a = asort(this._fast_filter[i]);
			for (j in a)
				st += '<a href="#" onclick="return osm.fastFilter(this)">'+j+' ('+a[j]+')</a>';
			st += '</li>';
		}
		if (!st) return '';
		return '<br>'
			+'<label><input type="checkbox" '+(this._fast_filter_search_osm?'checked':'')
			+' name="tsearch" onchange="osm.fastFilterOSMToggle(this.checked)">поиск по OSM объектам</label>'
			+'<ul>' + st + '</ul>';
	}

	// выключатель быстрого фильтра
	this.fastFilterToggle = function() { this._fast_filter_enable ^= 1; this.filter(); return false; }

	// выключатель поиска по OSM
	this.fastFilterOSMToggle = function(x) { this._fast_filter_search_osm = x; this.revalidate(); return false; }

	// быстрая фильтрация
	this.fastFilter = function(x)
	{
		var value = x.innerHTML.replace(/\s*\(.+/, '');
		$('search').value = value;
		osm.searchByName(value);
		return false;
	}

	// смена страницы
	this.page = function(x)
	{
		this._filter.page = x;
		this.filter(this._filter, 1);
		return false;
	}

	// фильтрация записей
	this.filter = function(x, skipFilter)
	{
		var i, j;
		if (!x) x = {};
		if (this._filter[i='ref']   && x[i] == undefined) x[i] = this._filter[i];
		if (this._filter[i='_addr'] && x[i] == undefined) x[i] = this._filter[i];
		this._filter = x;
		if (!this._filter.page) this._filter.page = 0;
		if (skipFilter) { this.updatePage(); return false; }

		// фильтруем записи
		this.filter_data = []; var self = this;

		var _ = function(a){
			var skip = 0, j = 0, f;
			// перебираем поля фильтра по каждой записи
			for (j in self._filter)
			if (j != 'page')
			{
				if (j == '_used' && a._used) { skip = 1; break; } // объект использовался, а мы выводим непривязанные
				if (typeof(self._filter[j]) == 'string')
					f = self._filter[j].toLowerCase();
				if (j == '_addr' && self.activeValidator == 'wiki_places')
				{
					skip = 1;
					if (a[j='name:ru']         && a[j].toLowerCase().indexOf(f) != -1) skip = 0;
					if (a[j='place']           && a[j].toLowerCase().indexOf(f) != -1) skip = 0;
					if (a[j='official_status'] && a[j].toLowerCase().indexOf(f) != -1) skip = 0;
					if (a[j='addr:district']   && a[j].toLowerCase().indexOf(f) != -1) skip = 0;
				}
				else
				if (j != '_used')
				if (a[j] == undefined) { skip = 1; continue; }
				else
				{
					if (typeof(self._filter[j]) == 'string')
						if (a[j].toLowerCase().indexOf(f) == -1)
							{ skip = 1; break; }
					if (typeof(self._filter[j]) == 'number')
						if (a[j] != self._filter[j])
							{ skip = 1; break; }
				}
			}
			if (j && skip) return;
			// если дошли до сюда - добавляем запись в выборку
			self.filter_data.push(a);
		}

		if (this._filter._used != undefined)
			for (i in this.osm_data)
			for (j in this.osm_data[i])
				_(this.osm_data[i][j]);
		else
			for (i in this.real_data)
				_(this.real_data[i]);

		this.updateCityList();
		this.updatePage();

		return false;
	}

	// обновление списка городов отфильтрованных записей
	this.updateCityList = function()
	{
		var city, list = {};
		if (osm._cityList) return;
		for (i in osm.filter_data)
		{
			city = /(г\.|п\.|с\.|д\.|п\/о|пос\.|дер\.|р\.п\.+)\s*([А-Я].+?)(,|$)/.exec(osm.filter_data[i]._addr);
			city = city ? city[2] : '';
			city = city.replace(/ ул.+/, '');
			city = city.replace(/[\(\)].*/, '');
			if (city)
			if (!list[city]) list[city] = 1;
			else list[city]++;
		}
		osm._cityList = [];
		for (i in list) osm._cityList.push({name:i, count: list[i]});
		osm._cityList.sort(function(x,y)
		{
			var N = 2;
			if (x.count > N && y.count <= N) return -1;
			if (y.count > N && x.count <= N) return  1;
			return x.name < y.name ? -1 : (x.name > y.name?1:0);
		});
	}

	// поиск по названию
	this.searchByName = function(x)
	{
		if (osm.timerSearch)
			clearInterval(osm.timerSearch);
		osm.timerSearch = setTimeout(function(){
			document.location = '#'+osm.activeRegion+'/'+osm.activeValidator+'/'+x;
			osm.filter({_addr: x});
		}, 1000);
	}

	// поиск по номеру
	this.searchByRef = function(x)
	{
		if (osm.timerSearchRef)
			clearInterval(osm.timerSearchRef);
		osm.timerSearchRef = setTimeout(function(){
//			document.location = '#'+osm.activeRegion+'/'+osm.activeValidator+'/'+x;
			osm.filter({ref: x});
		}, 1000);
	}

	// поиск osm объекта
	this.search = function(a, saveId) // a - реальный объект для поиска
	{
		var i, ref, hash, data, delta = 0.005, minObjId = -1;
		if (this.activeValidator == 'wiki_places') delta = 0.02;
		this.delta = delta;

		if (a.lat)
		{
			hash = this.hash(a.lat, a.lon);
			data = this.osm_data[hash];
			if (!data) return null;

			var minDistance = 0;

			// пробуем найти в окрестности точки
			for (i = 0; i < data.length; i++)
				if (1
					&& mod(a.lat - data[i].lat) < delta/2
					&& mod(a.lon - data[i].lon) < delta
				)
				{
					if (0 // совпадение по ref
						|| (a[ref='ref']            && a[ref] == data[i][ref])
						|| (a[ref='ref:temples.ru'] && a[ref] == data[i][ref])
						|| (a[ref='okato:user']     && a[ref] == data[i][ref])
					)
					{
						minObjId = i; break;
					}

					// или ищем минимальное удаление от адреса
					d = this.calcDistance(a, data[i]);
					if (minObjId < 0 || d < minDistance)
					{
						minObjId = i;
						minDistance = d;
					}
				}
		}

		if (minObjId < 0 && a.ref) // если не найдено объектов - пробуем найти по ref
		if (i = this.osm_data_by_ref[a.ref])
		{
			data     = this.osm_data[i.hash];
			minObjId = i.id;
		}

		if (saveId && minObjId >= 0)
		{
			data[minObjId]._used = (data[minObjId]._used || 0) + 1;
			if (!data[minObjId]._used_name) data[minObjId]._used_name = '';
			data[minObjId]._used_name += '\n'+(a['name:ru'] || a['name'])+
				' (lat='+(Math.round(a.lat*1000)/1000)+'&lon='+(Math.round(a.lon*1000)/1000)+');';
		}

		return minObjId < 0 ? null : data[minObjId];
	}

	// расстояние между объектами
	this.calcDistance = function(x, y)
	{
		return mod(x.lat - y.lat) * mod(x.lat - y.lat) + mod(x.lon - y.lon) * mod(x.lon - y.lon);
	}

	// ссылка на сайт OSM
	this.link = function(id)
	{
		if (!id) return '';

		var d = this.delta;
		if (typeof(id) == 'object')
		if (!id.lat) return '';
		else
			return '<a href="http://www.openstreetmap.org/?box=yes&'+
				'bbox='+encodeURIComponent([id.lon-d,id.lat-0+d/2,id.lon-0+d,id.lat-d/2])+
				'" target="_blank" title="открыть на openstreetmap.org">' +
			'<img valign="absmiddle" width="32" src="http://www.openstreetmap.org/assets/osm_logo-bd070644a6d1e2ea4db5d1893091b1e7.png"/>'+
			'</a>';

		var pic = '';
		if (id.charAt(0) == 'n') pic = 'b/b5/Mf_node';
		if (id.charAt(0) == 'w') pic = '8/83/Mf_area';
		if (id.charAt(0) == 'r') pic = '5/59/Relation';

		var url = 'http://www.openstreetmap.org/browse/'+id
			.replace('n', 'node/').replace('w', 'way/').replace('r', 'relation/');

		id = id.replace(/\D/g, '');

		return '<a href="'+url+'" target="_blank" title="открыть на openstreetmap.org">' +
			'<img valign="absmiddle" src="http://wiki.openstreetmap.org/w/images/' + pic + '.png"/>'+
			'</a>';
	}
	// ссылка на "добавление ноды"
	this.link_export_create = function(a)
	{
		if (!a.lat) return '';
		var i, url = 'http://'+document.domain+'/validator/import.php?';
		for (i in a) if (i.charAt(0) != '_')
				url += '&'+i+'='+encodeURIComponent(a[i]);
		return '<a href="#create" onclick="return osm.export_create(\''+url+'\')" target="josm" title="Добавить объект в OSM" class="btn">add</a>';
	}
	this.export_create = function(url)
	{
		$('josm').src = 'http://localhost:8111/import?url='+encodeURIComponent(url);
	}
	// координаты в формате top/bottom/left/right
	this.coords = function(a, d)
	{
		if (!d) d = 0.00001;
		a.lat = parseFloat(a.lat);
		a.lon = parseFloat(a.lon);
		return ''
			+'&top='   +(a.lat+d/2)
			+'&bottom='+(a.lat-d/2)
			+'&right=' +(a.lon+d)
			+'&left='  +(a.lon-d);
	}
	// ссылка на "обновление информации"
	this.link_export_update = function(a, b) // a - real, b - osm
	{
		if (!a.id) return '';
		var i, url = '';//'http://'+document.domain+'/validator/import.php?';
		var f = fields[this.activeValidator], k, v;
		for (i in f) if (f[i].charAt(0) != '_')
			if (this.compareField(b, a, f[i]) != C_Equal)
			{
				k = f[i]; v = a[k];
				if (!v) continue;

				// не устанавливаем устаревшие теги
				if (k == 'phone')   a[k = 'contact:phone'] = v;
				if (k == 'website') a[k = 'contact:website'] = v;

				url += (url?'|':'')+encodeURIComponent(k)+'='+encodeURIComponent(v);
			}
		if (!url) return '';

		// заодно стираем устаревшие теги, если в OSM есть замена
		if (this.josmCanDeleteTags)
		{
			i = 'phone';   if (b[i] && a['contact:'+i]) url += '|'+i+'=%20';
			i = 'website'; if (b[i] && a['contact:'+i]) url += '|'+i+'=%20';
		}

		var d; if (a.id.charAt(0) != 'n') d = 0.001; // FIXME: лучше передавать координату одного из угла, чтобы загружался только один объект!
		url = url.replace(/"/g, '&quot;').replace(/'/g, "\\'");
		return '<a href="#export" onclick="return osm.export_update(\''+a.id+'\', \''+url+'\')" title="Обновить объект в OSM" class="btn">upd</a>';
	}
	this.export_update = function(id, url)
	{
		osm.loaded_objects[id] = 1;
		url = encodeURIComponent(url);
		$('josm').src = 'http://localhost:8111/load_object?objects='+id+'&addtags='+url;
		return false;
	}
	// ссылка "открыть в JOSM"
	this.link_open_josm = function(id)
	{
		return '<a href="#load" onclick="return osm.open_josm(\''+id+'\')" title="Открыть объект в OSM" class="btn">josm</a>';
	}
	this.open_josm = function(id)
	{
		osm.loaded_objects[id] = 1;
		$('josm').src = 'http://localhost:8111/load_object?objects='+id;
		return false;
	}
	// ссылка "координаты в JOSM"
	this.link_find_josm = function(a)
	{
		if (!a.lat) return '';
		return '<a href="#bbox" onclick="osm.find_josm(\''+osm.coords(a, 0.0004)+'\')" title="Найти координаты в OSM" class="btn">josm</a>';
	}
	this.find_josm = function(coords)
	{
		osm.loaded_objects[''] = 1;
		$('josm').src = 'http://localhost:8111/load_and_zoom?'+coords;
	}

	// поиск по адресу в яндекса
	this.link_yasearch = function(st)
	{
		return '<a href="/OSMvsNarod.html#q='+st+'" target="_blank" title="Поиск адреса в НЯКе">'+
			'<img src="http://yandex.st/lego/2.2.6/common/block/b-service-icon/_ico/b-service-icon_maps.ico"/></a>';
	}

	// сравнение одного поля в объектах
	this.compareField = function(osm, real, field)
	{
/*
		// не проверяем телефон 8800* у сбера
		if (real.name == 'Сбербанк'
			&& real.phone.indexOf('+7-800') != -1
			&& osm .phone.indexOf('-800-')  == -1)
			real[field] = '';
*/
		if (!osm) osm = {};
		var a = osm[field] || '', b = real[field];
		if (!b || field.charAt(0) == '_') return C_Skip;
		if (a == b) return C_Equal;

		a = (''+a).replace(/ё/g, 'е');
		b = (''+b).replace(/ё/g, 'е');

		if (field == 'name')
		{
			// хак для почты: Отделение связи №XX
			var _ = function(x) {
				var _ = function(x, n) { return x.substr(-n).replace(/^0+/, ''); }
				x = x.replace(/(Почтовое отделение|Почта|Отделение почтовой связи)/, 'Отделение связи');
				x = x.replace(new RegExp('№'+real.ref), '!'); // совпадение по полному индексу
				x = x.replace(new RegExp('№'+_(real.ref, 3)), '!'); // посление три цифры
				x = x.replace(new RegExp('№'+_(real.ref, 2)), '!'); // посление две цифры
				x = x.replace(new RegExp('№'+_(real.ref, 1)), '!'); // последняя цифра
				return x;
			}
			if (real.ref && real.ref.length == 6)
			{
				a = _(a); b = _(b);
				// если отделение имеет название - считаем это правильным
				if (/Отделение связи "[^"]+"/.exec(a)) a = b;
				// если в названии нет цифр - то тоже пропускаем
				if (osm.name && !/\d/.exec(osm.name) && osm.name.toLowerCase() != 'почта') a = b;
			}
		}

		// игнорируем выходные дни в opening_hours
		if (field == 'opening_hours')
		{
			a = a.replace(/;[ a-z,-]+ off/i, '');
			b = b.replace(/;[ a-z,-]+ off/i, '');
		}

		// ищем телефонный номер в разных полях
		if (field == 'phone' && !a) a = osm['contact:phone']||'';
		if (field == 'contact:phone' && !a) a = osm['phone']||'';

		// ищем website в разных полях
		if (field == 'website' && !a) a = osm['contact:website']||'';
		if (field == 'contact:website' && !a) a = osm['website']||'';

		if (field == 'contact:phone' || field == 'phone')
		{
			// игнорируем дефисы в телефонах
			a = a.replace(/-/g, ' ')
			b = b.replace(/-/g, ' ')
		}

		if (field == 'website' || field == 'contact:website')
		{
			// игнорируем слеш на конце после имени домена
			a = a.replace(/(\.[a-z]{2,3})\/$/, '$1')
			b = b.replace(/(\.[a-z]{2,3})\/$/, '$1')
			// хак для сбера
			a = a.replace('/sberbank.', '/sbrf.');
			b = b.replace('/sberbank.', '/sbrf.');
			// игнорируем www
			a = a.replace(/www\./, '');
			b = b.replace(/www\./, '');
		}

		if (field == 'operator')
		{
			a = a.replace(/.*?"(.+?)".*/, '$1');
			b = b.replace(/.*?"(.+?)".*/, '$1');
		}

		// не считаем ошибкой небольшое изменение населения
		if (field == 'population')
		{
			if (Math.abs(a - b) < 100 || Math.abs(a - b) < a * 0.1)
				b = a;
		}

		// считаем пгт и рабочий посёлок равнозначными
		if (field == 'official_status')
		{
			a = a.replace('ru:рабочий поселок', 'ru:поселок городского типа');
			b = b.replace('ru:рабочий поселок', 'ru:поселок городского типа');
		}

		if (!a) return C_Empty;
		return (a != b) ? C_Diff : C_Similar;
	}

	// сравнение объектов и генерация ячеек
	this.compare = function(osm, real, fields)
	{
		var i, st = '', v, t, cl, td_cl, cmp_res;
		for (i in fields)
		{
			cl = t = td_cl = '';
			v  = osm[fields[i]] || '?';
			switch (cmp_res = this.compareField(osm, real, fields[i]))
			{
				case C_Skip:
					{
						cl = '';
						t  = 'Правильное значение не известно';
						break;
					}
				case C_Empty:
					{
						cl = 'unknow';
						t  = 'Нужно установить: '+real[fields[i]];
						break;
					}
				case C_Similar:
				case C_Diff:
					{
						cl = 'ok'; if (v == '?') v = '';
						if (cmp_res == C_Similar) td_cl += ' similar';
						t  = 'Нужно изменить на: '+real[fields[i]];
						// простая раскраска, данные из OSM
						if (!this.color || this.color == 'osm')
						{
							if (real[fields[i]] != v) cl = 'err';
						}
						else
						// в таблице выводим реальные данные
						if (this.color == 'real')
						{
							t = 'В OSM значение: '+v;
							if (real[fields[i]] != v) cl = 'err';
							v = real[fields[i]];
						}
						else
						// отмечаем посимвольно где ошибка
						if (this.color == 'diff')
						v = (function(from, to){
							var i, res = '', c, cl, L = to.length; if (from.length > L) L = from.length;
							for (i = 0; i < L; i++)
							{
								c = from.charAt(i); cl = '';
								if (!c) { c = to.charAt(i); cl = 'unknow'; }
								else if (c != to.charAt(i)) cl = 'err';
								if (cl) cl = ' class="'+cl+'"';
								res += '<span'+cl+'>'+c+'</span>';
							}
							return res;
						})(v, real[fields[i]]);
						break;
					}
				case C_Equal:
					{
						cl = 'ok';
						t  = 'Верно: '+real[fields[i]];
						break;
					}
			}
			if (v == '?') v = osm[fields[i]] || real[fields[i]] || '?'; // COMMENT: нужно для вывода _addr

			if (fields[i] == '_addr')
			{
				cl += ' addr'+(osm.lat?'" rel="&lat='+osm.lat+'&lon='+osm.lon:'');
				if (real.lat && real.lat != '?')
				v = '<a href="/OSMvsNarod.html#lat='+real.lat+
					'&lon='+real.lon+'&zoom=17&marker=yes"'+
					'title="Посмотреть метку геокодера"'+
					'target="_blank">'+v+'</a>';
			}

			if (fields[i] == 'ref:temples.ru' && real[fields[i]])
				v = '<a href="http://www.temples.ru/card.php?ID='+real[fields[i]]+'" target="_blank">'+v+'</a>';
			if (fields[i] == 'wikipedia' && real[fields[i]])
			{
				v = '<a href="http://ru.wikipedia.org/wiki/'+real[fields[i]]+'" target="_blank">'+v+'</a>';
				if (location.hostname != 'osm.cupivan.ru') // локальная фича только на тестовом сайте
				v +=' <small><a href="/validator/clearWikiCache.php?id='+osm.id+'&region='+this.activeRegion+'">[очистить]</a></small>';
			}

			if (cl) cl = 'class="'+cl+'"';
			if (t)  t  = 'title="'+t.replace(/"/g, '&quot;')+'"';

			if (fields[i] == '_addr' && real._ref == C_FoundRef)
				td_cl += 'foundByRef';

			if (td_cl) td_cl = ' class="'+td_cl+'"';

			st += '<td'+td_cl+'><span '+cl+t+'>'+v+'</span></td>';
		}
		return st;
	}

	// перевалидация
	this.update = function()
	{
		var i, objects=[], is_new=0;
		for (i in osm.loaded_objects)
			if (!i) is_new = 1;
			else
				objects.push(i);

		var N = objects.length;

		if (!N && !is_new)
		{
			var st = this._regions[this.activeRegion].validators[this.activeValidator].title;
			if (!confirm(st+' будет перевалидирован в регионе '+this._regions[this.activeRegion].title+'.\n\n'
				+'Физически процедура обновления будет запущена завтра после создания дампа региона.\n'
				+'Для мгновенной перевалидации загрузите объекты в JOSM, используя кнопки во второй колонке.')) return;
		}
		else
			if (!confirm('Будет перевалидирован'+ok(N,'','о','о')+' '+objects.length+' объект'+ok(N,'','а','ов')+'.\n'
				+(is_new?'Только что созданные объекты будут обработаны не раньше чем через день.\n':'')
				+'\nПеред запуском удостоверьтесь, что вы отправили изменения на сервер и закрыли пакет правок!')) return;

		$('btn_revalidate').value    = 'Ждите...';
		$('btn_revalidate').disabled = true;

		ajax.send('revalidate.php',
			{region: osm.activeRegion, validator: osm.activeValidator,
				code: osm._regions[osm.activeRegion].validators[osm.activeValidator].data,
				objects:objects, fields: fields[osm.activeValidator]},
			function(x){
				if (x)
				{
					alert(x);
					$('btn_revalidate').value    = 'Перевалидировать';
					$('btn_revalidate').disabled = false;
					return;
				}
				document.location = '#'+osm.activeRegion+'/'+osm.activeValidator;
				document.location.reload();
			}
		);
		osm.loaded_objects = {};
	}

	// проверка адресов
	this.addrCheck = function()
	{
		$$('.addr', function(x){
			if (!x.getAttribute('rel')) return;
			var f = '_f' + Math.round(Math.random()*100000000);
			window[f] = function(a)
			{
				var st = x.innerHTML;
				st = st.replace(/<i.+/, '');
				a = a.address;
				st += '<i style="color: #777"><br><br>г. '+(a.city||a.town||'?') + ', ' + (a.road||'?') + ', д. ' + (a.house_number||'?')+'</i>';
				x.innerHTML = st;
			}
			var url = 'http://nominatim.openstreetmap.org/reverse?json_callback='+f+
				'&format=json&accept-language=ru&email=mail@cupivan.ru';
			url += x.getAttribute('rel');
			ajax.loadJS(url);
		});
	}

	// смена раскраски таблицы
	this.color_scheme = function(name)
	{
		this.color = name;
		this.updatePage();
	}

	// лог работы
	this.log = function(x)
	{
		x = x ? '<div>'+x+'</div>' : '';
		$('log', x);
	}

	// проверка включен ли Josm нужной версии
	this.checkJosm = function()
	{
		ajax.load('http://localhost:8111/version', function(x){
			var st = '', color = '';
			if (!x)
			{
				st = '<b>Не запущен JOSM!</b>'; color = '#D33';
				setTimeout(osm.checkJosm, 30*1000); // проверяем снова через 30 секунд
			}
			else
			{
				var version = x.protocolversion.major+'.'+x.protocolversion.minor;
				if (version >= '1.5')
					osm.josmCanDeleteTags = true;
				else
					st = 'Требуется обновление JOSM! <a href="http://gis-lab.info/programs/josm/josm-tested.jar">Загрузить</a>';
					color = '#990';
			}
			if (st) st = '<div style="display: table; color: '+color+'; padding: 5px 20px; margin: 10px 0; border: 1px dashed '+color+'">'+st+'</div>';
			$('checkJosm', st);
		});
	}

	return this;
}

function mod(x) { return x < 0 ? -x : x; }
String.prototype.repeat = function(x){
	var i = 0, s = '', st = this;
	while (i < x) { s += st; i++; }
	return s;
}

/** сортировка хэша */
function asort(a)
{
	var i, tmp=[];
	for (i in a)
		tmp.push([i,a[i]]);
	tmp.sort(function(x,y){ x=x[0];y=y[0]; if(x==y)return 0; return x>y?1:-1; });
	a={};
	for (i in tmp)
		a[tmp[i][0]] = tmp[i][1];
	return a;
}
