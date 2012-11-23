var osm = new osm_cl()
	.region('Москва', 'RU-MOW')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Альфабанк',   'alfabank')
		.validator('Промсбербанк','promsberbank')
		.validator('Перекресток', 'perekrestok')
		.validator('Белый ветер', 'beli_veter')
		.validator('Асна',        'asna',    'moscow')
		.validator('Азбука вкуса','azbuka',  'moscow')
		.validator('Газпромнефть','gazprom')
		.validator('Лукойл',      'lukoil')
		.validator('Роснефть',    'rosneft')
		.validator('Автопаскер',  'autopasker')
		.validator('Церкви',      'temples')
		.validator('Дикси',       'diksi')
		.validator('Ашан',        'auchan')
		.validator('Атак',        'atak')
	.region('Московская область', 'RU-MOS')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Альфабанк',   'alfabank')
		.validator('Промсбербанк','promsberbank')
		.validator('Перекресток', 'perekrestok')
		.validator('Белый ветер', 'beli_veter')
		.validator('Лукойл',      'lukoil')
		.validator('Роснефть',    'rosneft')
		.validator('Газпромнефть','gazprom')
		.validator('Автопаскер',  'autopasker')
		.validator('Церкви',      'temples')
		.validator('Дикси',       'diksi')
		.validator('Атак',        'atak')
	.region('Санкт-Петербург', 'RU-SPE')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Перекресток', 'perekrestok')
		.validator('Роснефть',    'rosneft')
		.validator('Дикси',       'diksi')
		.validator('Белый ветер', 'beli_veter')
		.validator('Газпромнефть','gazprom')
		.validator('Ашан',        'auchan')
	.region('Ленинградская область', 'RU-LEN')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Перекресток', 'perekrestok')
		.validator('Роснефть',    'rosneft')
		.validator('Газпромнефть','gazprom')
		.validator('Дикси',       'diksi')

	.region('Астраханская область', 'RU-ARK')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Башкирия', 'RU-BA')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Башнефть',    'bashneft')
		.validator('Фармленд',    'farmlend')
	.region('Владимирская область', 'RU-VLA')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Дикси',       'diksi')
	.region('Волгоградская область', 'RU-VGG')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
	.region('Вологодская область', 'RU-VLG')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
	.region('Воронежская область', 'RU-VOR')
		.validator('Сбербанк',    'sberbank')
		.validator('Почта',       'russian_post')
		.validator('Перекресток', 'perekrestok')
		.validator('Роснефть',    'rosneft')
		.validator('Автопаскер',  'autopasker')
		.validator('Церкви',      'temples')
		.validator('Башнефть',    'bashneft')
		.validator('Ашан',        'auchan')
	.region('Калининградская область')
		.validator('Сбербанк', 'sberbank')
		.validator('Альфабанк','alfabank')
		.validator('Лукойл',   'lukoil')
	.region('Калужская область', 'RU-KLU')
		.validator('Сбербанк', 'sberbank')
		.validator('Газпромнефть','gazprom')
		.validator('Промсбербанк','promsberbank')
		.validator('Дикси',       'diksi')
		.validator('Перекресток', 'perekrestok')
	.region('Кировская область', 'RU-KIR')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Хлынов', 'hlinov', 'kirov')
	.region('Краснодарский край', 'RU-KDA')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Лукойл',   'lukoil')
		.validator('Роснефть', 'rosneft')
	.region('Красноярский край', 'RU-KYA')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Курская область', 'RU-KRS')
		.validator('Сбербанк', 'sberbank')
	.region('Мурманская область', 'RU-MUR')
		.validator('Сбербанк',           'sberbank')
		.validator('Почта',              'russian_post')
		.validator('Альфабанк',          'alfabank')
		.validator('Альфабанк.Банкоматы','alfabank_atm')
		.validator('Дикси',       'diksi')
	.region('Нижегородская область', 'RU-NIZ')
		.validator('Сбербанк', 'sberbank')
		.validator('Перекресток', 'perekrestok')
	.region('Орловская область', 'RU-ORL')
		.validator('Сбербанк', 'sberbank')
	.region('Пензенская область', 'RU-PNZ')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Пермский край', 'RU-PER')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта', 'russian_post')
	.region('Приморский край', 'RU-PRI')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Ростовская область', 'RU-ROS')
		.validator('Сбербанк', 'sberbank')
	.region('Самарская область', 'RU-SAM')
		.validator('Сбербанк', 'sberbank')
		.validator('Белый ветер', 'beli_veter')
		.validator('Перекресток', 'perekrestok')
		.validator('Ашан',        'auchan')
	.region('Саратовская область', 'RU-SAR')
		.validator('Сбербанк', 'sberbank')
	.region('Свердловская область', 'RU-SVE')
		.validator('Сбербанк', 'sberbank')
	.region('Ставропольский край', 'RU-STA')
		.validator('Сбербанк', 'sberbank')
	.region('Татарстан', 'RU-TA')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
		.validator('Башнефть', 'bashneft')
		.validator('Белый ветер', 'beli_veter')
		.validator('Перекресток', 'perekrestok')
	.region('Тульская область', 'RU-TUL')
		.validator('Сбербанк', 'sberbank')
	.region('Ульяновская область', 'RU-ULY')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Хабаровский край', 'RU-KHA')
		.validator('Сбербанк', 'sberbank')
		.validator('Почта',    'russian_post')
	.region('Челябинская область', 'RU-CHE')
		.validator('Сбербанк', 'sberbank')
		.validator('Башнефть',    'bashneft')
	.region('Ярославская область', 'RU-YAR')
		.validator('Сбербанк', 'sberbank')
		.validator('Дикси',       'diksi')
		.validator('Белый ветер', 'beli_veter')
		.validator('Перекресток', 'perekrestok')
		.validator('Газпромнефть','gazprom')


var links = {
	'sberbank':    'http://sbrf.ru/moscow/ru/about/branch/list_branch/',
	'perekrestok': 'http://www.perekrestok.ru/shops/',
	'azbuka':      'http://av.ru/index.aspx?sPage=63',
	'beli_veter':  'http://www.digital.ru/shops/all/view',
	'gazprom':     'http://www.gpnbonus.ru/our_azs/',
	'hlinov':      'http://bank-hlynov.ru/about/unit_of_the_bank/additional_offices/',
	'asna':        'http://www.asna.ru/drugstores',
	'alfabank':    'http://www.alfabank.ru/russia/moscow/',
	'lukoil':      'http://www.lukoil.ru/back/azs/azs.asp?tab=1',
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
_:0};

var fields = {
	'sberbank':    ['ref', 'operator', 'branch', 'name', 'phone', 'website', 'opening_hours', 'wheelchair', '_addr'],
	'perekrestok': ['operator', 'name', 'phone', 'website', 'opening_hours', '_addr'],
	'azbuka':      ['operator', 'name', 'website', 'opening_hours', '_addr'],
	'beli_veter':  ['ref', 'operator', 'name', 'phone', 'website', 'opening_hours', '_addr'],
	'gazprom':     ['ref', 'operator', 'brand', 'name', 'website', 'opening_hours', 'payment:cards', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:diesel', 'fuel:lpg', '_addr'],
	'hlinov':      ['operator', 'name', 'website', '_addr'],
	'asna':        ['brand', 'official_name', 'phone', 'website', 'website', 'opening_hours', '_addr'],
	'alfabank':    ['operator', 'name', 'official_name', 'website', 'opening_hours', '_addr'],
	'alfabank_atm':['operator', 'website', 'opening_hours', 'currency:RUR', 'currency:USD', 'currency:EUR', '_addr'],
	'lukoil':      ['ref', 'operator', 'brand', 'website', 'opening_hours', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:diesel', 'fuel:lpg', '_addr'],
	'rosneft':     ['ref', 'operator', 'brand', 'website', 'opening_hours', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:octane_80', 'fuel:diesel', '_addr'],
	'russian_post':['ref', 'operator', 'name', 'website', 'phone', 'opening_hours', '_name', '_addr'],
	'autopasker':  ['operator', 'brand', 'phone', 'website', 'opening_hours', 'payment:cards', '_addr'],
	'promsberbank':['ref', 'operator', 'name', 'website', 'phone', '_data', '_addr'],
	'temples':     ['ref:temples.ru', 'start_date', 'name', 'alt_name', 'disused', 'denomination', 'religion', 'phone', '_addr'],
	'diksi':       ['operator', 'name', 'payment:cards', 'opening_hours', '_addr'],
	'bashneft':    ['ref', 'operator', 'brand', 'name', 'payment:cards', 'payment:fuel_cards', 'fuel:octane_98', 'fuel:octane_95', 'fuel:octane_92', 'fuel:diesel', 'fuel:lpg', '_addr'],
	'atak':        ['operator', 'brand', 'name', 'phone', 'website', 'opening_hours', '_addr'],
	'auchan':      ['ref', 'operator', 'brand', 'name', 'website', 'opening_hours', '_addr'],
	'farmlend':    ['ref', 'operator', 'phone', 'website', '_addr'],
_:0}

C_Empty    = 1;
C_Skip     = 2;
C_Diff     = 3;
C_Equal    = 4;
C_NoCoords = 5;
C_NotFound = 6;
C_FoundRef = 7;
C_Double   = 8;
C_Total    = 0;


function osm_cl()
{
	this._regions = {};
	this._filter  = {page: 0};
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

		// данные osm
		ajax.load('data/'+region+'/'+v.code+'.js', function(a){
			var i, hash, corr = {};

			// первый эл-т массива - данные, остальные - поправки
			if (typeof(a) == 'string') // FIXME: убрать, когда перейду на новый формат
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

			// поиск всех населенных пунктов
			var city;
			osm.cityList = [];
			for (i in osm.real_data)
			{
				city = /(г\.|п\.|с\.|д\.|п\/о|пос\.|дер\.|р\.п\.+)\s*([А-Я].+?)(,|$)/.exec(osm.real_data[i]._addr);
				city = city ? city[2] : '';
				city = city.replace(/ ул.+/, '');
				if (city)
				if (!osm.cityList[city]) osm.cityList[city] = 1;
				else osm.cityList[city]++;
			}

			osm.revalidate();
		});
	}
	// функция генерации таблицы валидатора
	this.revalidate  = function() { if (this.timerRevalidate) clearInterval(this.timerRevalidate);
		this.timerRevalidate = setTimeout(function(){ osm.revalidate_(); }, 200); }

	// валидация подсчет кол-ва объектов
	this.revalidate_ = function()
	{
		var a = osm.real_data, osm_data, state, f;
		this.count = [0,0,0,0,0,0,0,0,0,0,0,0];

		f = fields[this.activeValidator];

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
		}

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
	}

	// функция отрисовки страницы с данными
	this.updatePage = function(){
		var i, j, st = '', dataId, _, N=0;
		var a = osm.filter_data;
		if (!a) return;
		osm.category = {};

		st += '<tr>';
		st += '<th colspan="2"></th>';
		for (i in fields[osm.activeValidator])
		{
			j = fields[osm.activeValidator][i];
			if (j == '_addr') j = 'Адрес'
			st += '<th>'+j+'</th>';
		}
		st += '</tr>';

		for (i = osm._filter.page < 0 ? 0 : osm._filter.page * osm.numPerPage; i < a.length; i++)
		{
			if (!osm.category[a[i]._cat]) osm.category[a[i]._cat] = 0;
			osm.category[a[i]._cat]++;

			osm_data = osm.search(a[i]);
			if (osm_data) a[i].id = osm_data.id;
			st += '<tr'+(osm_data && osm_data._used > 1 ?
				' class="multi" title="Объект привязан несколько раз, необходимо его расчленить!"' : '')+'>'
				+'<td class="c">'+(osm_data
					? osm.link(osm_data.id)
					: osm.link(a[i]))+
					' '+osm.link_yasearch(a[i]._addr)+
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
		st = '';
		var list = [];
		for (i in osm.cityList) list.push(i);
		list.sort();
		for (i in list)
			st += '<option value="'+list[i].replace(/"/g, '&quote;')+'">'+list[i]+'</option>';
		if (st) st = '<select onchange="osm.searchByName($(\'search\').value = this.value)"><option value="">Населённый пункт</option>'+st+'</select>';
		$('city', st);

		// номера страниц
		st = '';
		var _ = function(x){
			return '<a href="#" class="'+(eval(x) == osm._filter._state?'active':'')+
				'" onclick="return osm.filter({_state:'+x+'})" ';
		}
		var R = function(f, code){
			return '<a href="#" class="'+(eval(code) == osm._filter[f]?'active':'')+
				'" onclick="return osm.filter({'+f+':'+code+'})" ';
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
			' | '+R('_double', 'C_Double')+'title="Дубликаты">'+this.count[C_Double]+'</a>';
		$('state', st);

		st = 'Отфильтровано: '+a.length+'<br>';
		var numPages = Math.ceil(a.length / osm.numPerPage);
		var big = numPages > 25 ? 1 : 0, skip = 0;
		if (osm._filter.page < 0)
			st += '<br><a href="#all" onclick="osm.page(0)">по страницам</a>';
		else
		if (numPages > 1)
		{
			st += '<br>';
			for (i = 0; i < numPages; i++)
			{
				if (big)
					if (i > 10 && i < numPages - 5)
						if (mod(i - osm._filter.page) > 2) { skip = 1; continue; }
				if (skip) { st += ' ... '; skip = 0; }
				st += '<a href="#"'+(osm._filter.page == i?'class="active"':'')+
					'onclick="return osm.page('+i+')">'+(i+1)+'</a> ';
			}
			st += '<a href="#all" onclick="osm.page(-1)">все</a>'
		}
		$('pages', st);
	}

	// смена страницы
	this.page = function(x)
	{
		this._filter.page = x;
		this.filter(this._filter, 1);
	}

	// фильтрация записей
	this.filter = function(x, skipFilter)
	{
		var i, j, skip;
		if (!x) x = {};
		if (this._filter[i='ref']   && x[i] == undefined) x[i] = this._filter[i];
		if (this._filter[i='_addr'] && x[i] == undefined) x[i] = this._filter[i];
		this._filter = x;
		if (!this._filter.page) this._filter.page = 0;
		if (skipFilter) { this.updatePage(); return false; }

		// фильтруем записи
		this.filter_data = [];
		for (i in this.real_data)
		{
			skip = 0; j = 0;
			// перебираем поля фильтра по каждой записи
			for (j in this._filter)
			if (j != 'page')
			{
				if (this.real_data[i][j] == undefined) { skip = 1; continue; }
				else
				{
					if (typeof(this._filter[j]) == 'string')
						if (this.real_data[i][j].toLowerCase().indexOf(this._filter[j].toLowerCase()) == -1)
							{ skip = 1; break; }
					if (typeof(this._filter[j]) == 'number')
						if (this.real_data[i][j] != this._filter[j])
							{ skip = 1; break; }
				}
			}
			if (j && skip) continue;
			// если дошли до сюда - добавляем запись в выборку
			this.filter_data.push(this.real_data[i]);
		}

		this.updatePage();
		return false;
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
	this.search = function(a, saveId)
	{
		var i, hash, data, delta = 0.005, minObjId = -1;

		if (a.lat)
		{
			hash = this.hash(a.lat, a.lon);
			data = this.osm_data[hash];
			if (!data) return null;

			var minDistance = 0;

			// пробуем найти в окрестности точки
			for (i = 0; i < data.length; i++)
				if (1
					&& mod(a.lat - data[i].lat) < delta
					&& mod(a.lon - data[i].lon) < delta
				)
				{
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
			data[minObjId]._used = (data[minObjId]._used || 0) + 1;

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

		var d = 0.00008;
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
	// ссылка на "обновление информации"
	this.link_export_update = function(a, b)
	{
		if (!a.id) return '';
		var i, url = 'http://'+document.domain+'/validator/import.php?';
		var f = fields[this.activeValidator];
		for (i in f) if (f[i].charAt(0) != '_')
			if (this.compareField(b, a, f[i]) != C_Equal)
				if (a[f[i]])
				url += '&'+f[i]+'='+encodeURIComponent(a[f[i]]);
		return '<a href="#export" onclick="osm.export_update(\''+a.id+'\', \''+url+'\')" title="Обновить объект в OSM" class="btn">upd</a>';
	}
	this.export_update = function(id, url)
	{
		this.open_josm(id);
		setTimeout(function(){
			url += '&id='+id;
			$('josm').src = 'http://localhost:8111/import?url='+encodeURIComponent(url);
		}, 1000);
	}
	// ссылка "открыть в JOSM"
	this.link_open_josm = function(id)
	{
		return '<a href="#load" onclick="osm.open_josm(\''+id+'\')" title="Открыть объект в OSM" class="btn">josm</a>';
	}
	this.open_josm = function(id)
	{
		osm.loaded_objects[id] = 1;
		$('josm').src = 'http://localhost:8111/load_object?objects='+id;
	}
	// ссылка "координаты в JOSM"
	this.link_find_josm = function(a)
	{
		var d = 0.0004;
		if (!a.lat) return '';
		return '<a href="#bbox" onclick="osm.find_josm('
				+(a.lat-0+d/2)+','+(a.lat-d/2)+','
				+(a.lon-0+d)  +','+(a.lon-d)+','
			+'0)" title="Найти координаты в OSM" class="btn">josm</a>';
	}
	this.find_josm = function(t, b, r, l)
	{
		osm.loaded_objects[''] = 1;
		$('josm').src = 'http://localhost:8111/load_and_zoom?top='+t+'&bottom='+b+'&right='+r+'&left='+l;
	}

	// поиск по адресу в яндекса
	this.link_yasearch = function(st)
	{
		return '<a href="/OSMvsNarod.html#'+st+'" target="_blank" title="Поиск адреса в НЯКе">'+
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
		var a = osm[field], b = real[field];
		if (!b || field.charAt(0) == '_') return C_Skip;
		if (!a) return C_Empty;

		a = (''+a).replace(/ё/g, 'е');
		b = (''+b).replace(/ё/g, 'е');

		if (field == 'phone')
			a = a.replace(/ /g, '-');

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
				if (!/\d/.exec(osm.name) && osm.name.toLowerCase() != 'почта') a = b;
			}
		}

		// игнорируем выходные дни в opening_hours
		if (field == 'opening_hours')
		{
			a = a.replace(/;[ a-z,-]+ Off/i, '');
			b = b.replace(/;[ a-z,-]+ Off/i, '');
		}

		if (field == 'website')
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

		if (a != b) return C_Diff;
		return C_Equal;
	}

	// сравнение объектов и генерация ячеек
	this.compare = function(osm, real, fields)
	{
		var i, st = '', v, t, cl;
		for (i in fields)
		{
			cl = t = '';
			v  = osm[fields[i]] || real[fields[i]] || '?';
			switch (this.compareField(osm, real, fields[i]))
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
				case C_Diff:
					{
						cl = 'ok';
						t  = 'Нужно изменить на: '+real[fields[i]];
						// простая раскраска
						if (!this.color)
						{
							if (real[fields[i]] != v) cl = 'err';
						}
						else
						// отмечаем посимвольно где ошибка
						if (this.color == 'ext')
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

			if (fields[i] == '_addr')
			{
				cl += ' addr'+(osm.lat?'" rel="&lat='+osm.lat+'&lon='+osm.lon:'');
				if (real.lat && real.lat != '?')
				v = '<a href="/OSMvsNarod.html?lat='+real.lat+
					'&lon='+real.lon+'&zoom=17&marker=yes"'+
					'title="Посмотреть метку геокодера"'+
					'target="_blank">'+v+'</a>';
			}

			if (fields[i] == 'ref:temples.ru' && v != '?')
				v = '<a href="http://www.temples.ru/card.php?ID='+v+'" target="_blank">'+v+'</a>';

			if (cl) cl = 'class="'+cl+'"';
			if (t)  t  = 'title="'+t.replace(/"/g, '&quot;')+'"';

			st += '<td><span '+cl+t+'>'+v+'</span></td>';
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
			if (!confirm('Запрос перевалидации объектов по области '+this.activeRegion+'.\n'
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
			var url = 'http://nominatim.openstreetmap.org/reverse?json_callback='+f+'&format=json&email=mail@cupivan.ru';
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

	return this;
}

function mod(x) { return x < 0 ? -x : x; }
