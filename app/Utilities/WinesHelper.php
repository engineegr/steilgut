<?php

namespace App\Utilities;

class WinesHelper
{

	public static $WINES_IMAGE_PATH_LIST = array();
	public static $WINE_COLORS = ['white', 'red'];
	public static $CATALOG_WINE_LIST = array();
	public static $SUDWAND_WINE_TYPE_2018 = null;
	public static $SUDWAND_WINE_TYPE_2019 = null;
	public static $NASLEI_WINE_TYPE_2020 = null;
	public static $SUDWAND_WINE_TYPE_2020 = null;
	public static $FRAUENBERG_WINE_TYPE_2018 = null;
	public static $FRAUENBERG_WINE_TYPE_2020 = null;
	public static $WINE_HARVEST_LIST = null;

	public static $STEILSET_WINE_TYPE = null;
	public static $PROBEPAKET_WINE_TYPE = null;
	public static $NASLEIPAKET_WINE_TYPE = null;

	public static $CATALOG_WINE_TITLE_LIST = array();

	public static function init()
	{
		$fakerRootDir = public_path() . '/images/faker/wines/';
		$imgTitleList = array_diff(
			scandir($fakerRootDir),
			array('.', '..', '.DS_Store', 'orig')
		);

		foreach ($imgTitleList as $index => $imgTitle) {
			self::$WINES_IMAGE_PATH_LIST[] = '/images/faker/wines/' . $imgTitle;
		}
		self::$WINE_HARVEST_LIST = [
			2016,
			2017,
			2018,
			2019,
			2021,
		];
		/*
		* Create standard wines: sudwand an frauenberg
		*
		* Generate: volume, area, age
		*
		*/
		$faker = \Faker\Factory::create();
		if (!self::$SUDWAND_WINE_TYPE_2018) {
			self::$SUDWAND_WINE_TYPE_2018 = new \stdClass;
		}
		if (!self::$SUDWAND_WINE_TYPE_2019) {
			self::$SUDWAND_WINE_TYPE_2019 = new \stdClass;
		}

		if (!self::$SUDWAND_WINE_TYPE_2020) {
			self::$SUDWAND_WINE_TYPE_2020 = new \stdClass;
		}

		if (!self::$NASLEI_WINE_TYPE_2020) {
			self::$NASLEI_WINE_TYPE_2020 = new \stdClass;
		}

		if (!self::$FRAUENBERG_WINE_TYPE_2018) {
			self::$FRAUENBERG_WINE_TYPE_2018 = new \stdClass;
		}

		if (!self::$FRAUENBERG_WINE_TYPE_2020) {
			self::$FRAUENBERG_WINE_TYPE_2020 = new \stdClass;
		}

		$sudwandRUTranslation = new \stdClass;
		$sudwandDETranslation = new \stdClass;
		$sudwandCNTranslation = new \stdClass;
		self::$SUDWAND_WINE_TYPE_2018->RU = $sudwandRUTranslation;
		self::$SUDWAND_WINE_TYPE_2018->DE = $sudwandDETranslation;
		self::$SUDWAND_WINE_TYPE_2018->zh_CN = $sudwandCNTranslation;

		$sudwandBackgroundImage = new \stdClass;
		$sudwandBackgroundImage->relative_path = 'single-wine-pg/sudwand-single-wine-pg';
		$sudwandBackgroundImage->base_name = 'bg-sudwand-single-wine-pg';
		self::$SUDWAND_WINE_TYPE_2018->background_image = $sudwandBackgroundImage;
		self::$SUDWAND_WINE_TYPE_2018->image = '/images/pictures/wine-bottles/sudwand.png';

		self::$SUDWAND_WINE_TYPE_2018->title = 'Südwand';
		$sudwandRUTranslation->title = 'Südwand';
		$sudwandDETranslation->title = 'Südwand';
		$sudwandCNTranslation->title = '苏得旺得2018年';

		self::$SUDWAND_WINE_TYPE_2018->order = 0;

		self::$SUDWAND_WINE_TYPE_2018->wineType = 'White, half-dry';
		$sudwandRUTranslation->wineType = 'Белое, полусухое';
		$sudwandDETranslation->wineType = 'Wit, halfdroog';
		$sudwandCNTranslation->wineType = '半干白葡萄酒';

		self::$SUDWAND_WINE_TYPE_2018->color = "White";
		$sudwandRUTranslation->color = 'Белое';
		$sudwandDETranslation->color = 'Wit';
		$sudwandCNTranslation->color = '白色';

		self::$SUDWAND_WINE_TYPE_2018->wineSort = 'Riesling, 100%';
		$sudwandRUTranslation->wineSort = 'Рислинг, 100%';
		$sudwandDETranslation->wineSort = 'Riesling, 100%';
		$sudwandCNTranslation->wineSort = '司令, 100%';

		self::$SUDWAND_WINE_TYPE_2018->harvest = 2018;
		self::$SUDWAND_WINE_TYPE_2018->price = 17.0;

		self::$SUDWAND_WINE_TYPE_2018->soil = 'Gray and red slate';
		$sudwandRUTranslation->soil = 'Серые и красные сланцы';
		$sudwandDETranslation->soil = 'Grau- und Rotschiefer';
		$sudwandCNTranslation->soil = '灰板岩和红板岩';

		self::$SUDWAND_WINE_TYPE_2018->terroir = 'Bremmer Calmont, Mosel';
		$sudwandRUTranslation->terroir = 'Bremmer Calmont, Mosel';
		$sudwandDETranslation->terroir = 'Bremmer Calmont, Mosel';
		$sudwandCNTranslation->terroir = 'Bremmer Calmont, Mosel';
		self::$SUDWAND_WINE_TYPE_2018->residual_sugar = 11.5;
		self::$SUDWAND_WINE_TYPE_2018->acidity = 5.3;
		self::$SUDWAND_WINE_TYPE_2018->strength = 12.0;

		/* TODO: no translation */
		self::$SUDWAND_WINE_TYPE_2018->harvest_aspect = <<<EOF
Südwand, harvested from the southern slope (this is how the name of the wine is translated into Russian) in 2018, is a semi-dry wine with a residual sugar content of 10 g / l. The grapes for this wine were harvested from the steepest vineyard in Europe, Bremmer Calmont, from a slope with a 100% southern exposure. The age of the vines in this area reaches 60 years.
Südwand 2018 has been preparing to present to your attention for over 1 year, undergoing vinification by natural fermentation in a steel tank.
EOF;
		$sudwandRUTranslation->harvest_aspect = <<<EOF
Südwand, собранный с южного склона (а именно так переводится на русский язык название вина) в 2018 году, это полусухое вино с содержанием остаточного сахара в 10 г/л. Виноград для этого вина был собран на самом крутом винограднике Европы Bremmer Calmont со склона со 100% южной экспозицией. Возраст лоз на этом участке достигает 60 лет. Südwand 2018 готовился предстать вашему вниманию более одного года, проходя винификацию путём естественного брожения в стальном танке.
EOF;
		$sudwandDETranslation->harvest_aspect = <<<EOF
Unser erster Wein! Die Witterung im Jahr 2018 war durchweg sehr warm und trocken, was uns kerngesunde Trauben von hoher Qualität bescherte. Der lange und schonende Ausbau - knapp 1 Jahr - erfolgte im Edelstahl-Tank. Wir setzten auf Spontanvergärung, um dem Wein den natürlichsten Charakter zu verleihen. 
EOF;
		$sudwandCNTranslation->harvest_aspect =  <<<EOF
苏得旺得（Südwand, 德语意为“南坡”），这款酒来自于2018年的摩泽尔河的南部山坡，是一种半干葡萄酒，糖含量为10克/升。酿制这款酒的葡萄生长于欧洲最陡峭的陡坡葡萄种植区布雷默•卡尔蒙特（Bremmer Calmont）葡萄园，该葡萄园所处的坡度为朝南100%。这一地区的葡萄树的树龄高达60年。 在钢桶内经历了为时一年多的自然发酵后，苏得旺得2018终于得以面世，并将自己呈现给大家。入口后散发着木瓜、梨、百香果、西柚清新而丰腴的水果风味，伴有一丝淡雅微妙的奶油和香草的气息。 2018年份苏得旺得, 酒体丰满，口感优雅圆润，散发着浓郁的蜜桃、甜瓜、西柚和矿物质的香气。
品过这款酒后，除了干白葡萄酒特有的爽脆清新，您的口中还会留下一点点混合水果和矿物质那种优雅又有层次感的余味。 余味的强度又突出了葡萄酒的丰富香气。 此酒非常适合搭配白肉，海鲜和奶油酱汁类菜肴。
EOF;

		self::$SUDWAND_WINE_TYPE_2018->taste = <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant multi-layered sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads
EOF;

		$sudwandRUTranslation->taste = <<<EOF
Вино начнётся с красивого и полного фруктового букета в аромате – айва, груша, маракуйя, грейпфрут, чудесно приправленного нежным флёром трав и сливок. Вино обладает изящной полнотой и наполнено сочными нотами персика, дыни, грейпфрута и минералов. Оно оставляет элегантное и многослойное ощущение фруктов и минералов в слегка сухом послевкусии. Сила послевкусия подчеркивает сочные ароматы носа вина.<br/><br/>Гармонично сочетается с белым мясом, морскими деликатесами, блюдами со сливочным соусом.  
EOF;
		$sudwandDETranslation->taste = <<<EOF
Purer Schiefer! Ein intensiver Geruch nach Trockenfrüchten, gepaart mit der starken Mineralik des Schiefers im Bremmer Calmont. Dennoch bleibt der Wein leicht und elegant. Er eignet sich besonders zu Fisch- sowie zu asiatischen Gerichten. Oder natürlich einfach für einen gemütlichen Abend mit Freunden! 
EOF;
		$sudwandCNTranslation->taste =  <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant layering sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads。
EOF;

		/*
			* Generate: volume, area, age
			*/
		self::$SUDWAND_WINE_TYPE_2018->volume = $faker->numberBetween(500, 1000);
		self::$SUDWAND_WINE_TYPE_2018->age = $faker->numberBetween(1, 21);


		/*
		 * NASLEI 
		 */
		$nasleiRUTranslation = new \stdClass;
		$nasleiDETranslation = new \stdClass;
		$nasleiCNTranslation = new \stdClass;
		self::$NASLEI_WINE_TYPE_2020->RU = $nasleiRUTranslation;
		self::$NASLEI_WINE_TYPE_2020->DE = $nasleiDETranslation;
		self::$NASLEI_WINE_TYPE_2020->zh_CN = $nasleiCNTranslation;

		$nasleiBackgroundImage = new \stdClass;
		$nasleiBackgroundImage->relative_path = 'single-wine-pg/sudwand-single-wine-pg';
		$nasleiBackgroundImage->base_name = 'bg-sudwand-single-wine-pg';
		self::$NASLEI_WINE_TYPE_2020->background_image = $nasleiBackgroundImage;
		self::$NASLEI_WINE_TYPE_2020->image = '/images/pictures/wine-bottles/naslei.png';

		self::$NASLEI_WINE_TYPE_2020->title = 'Naslei';
		$nasleiRUTranslation->title = 'Naslei';
		$nasleiDETranslation->title = 'Naslei';
		$nasleiCNTranslation->title = '苏得旺得2018年';

		self::$NASLEI_WINE_TYPE_2020->order = 2;

		self::$NASLEI_WINE_TYPE_2020->wineType = 'White, half-dry';
		$nasleiRUTranslation->wineType = 'Белое, полусухое';
		$nasleiDETranslation->wineType = 'Wit, halfdroog';
		$nasleiCNTranslation->wineType = '半干白葡萄酒';

		self::$NASLEI_WINE_TYPE_2020->color = "White";
		$nasleiRUTranslation->color = 'Белое';
		$nasleiDETranslation->color = 'Wit';
		$nasleiCNTranslation->color = '白色';

		self::$NASLEI_WINE_TYPE_2020->wineSort = 'Riesling, 100%';
		$nasleiRUTranslation->wineSort = 'Рислинг, 100%';
		$nasleiDETranslation->wineSort = 'Riesling, 100%';
		$nasleiCNTranslation->wineSort = '司令, 100%';

		self::$NASLEI_WINE_TYPE_2020->harvest = 2020;
		self::$NASLEI_WINE_TYPE_2020->price = 19.9;

		self::$NASLEI_WINE_TYPE_2020->soil = 'Gray and red slate';
		$nasleiRUTranslation->soil = 'Серые и красные сланцы';
		$nasleiDETranslation->soil = 'Grau- und Rotschiefer';
		$nasleiCNTranslation->soil = '灰板岩和红板岩';

		self::$NASLEI_WINE_TYPE_2020->terroir = 'Bremmer Calmont, Mosel';
		$nasleiRUTranslation->terroir = 'Bremmer Calmont, Mosel';
		$nasleiDETranslation->terroir = 'Bremmer Calmont, Mosel';
		$nasleiCNTranslation->terroir = 'Bremmer Calmont, Mosel';
		self::$NASLEI_WINE_TYPE_2020->residual_sugar = 0.8;
		self::$NASLEI_WINE_TYPE_2020->acidity = 5.2;
		self::$NASLEI_WINE_TYPE_2020->strength = 12.5;

		/* TODO: no translation */
		self::$NASLEI_WINE_TYPE_2020->harvest_aspect = <<<EOF
Naslei – вино, которого никогда не бывает много. Участок Naslei – это небольшая часть терруара Bremmer Calmont (всего 2222 м2), которая имеет полностью южную экспозицию склона и значительный сток поверхностных вод. Эти характеристики вместе с особенностями ландшафта, обеспечивающими охлаждение лозы в тёмное время суток, позволяют получить урожай первоклассного качества и, соответственно, вкуса. 
EOF;
		$nasleiRUTranslation->harvest_aspect = <<<EOF
Naslei – вино, которого никогда не бывает много. Участок Naslei – это небольшая часть терруара Bremmer Calmont (всего 2222 м2), которая имеет полностью южную экспозицию склона и значительный сток поверхностных вод. Эти характеристики вместе с особенностями ландшафта, обеспечивающими охлаждение лозы в тёмное время суток, позволяют получить урожай первоклассного качества и, соответственно, вкуса. 
EOF;
		$nasleiDETranslation->harvest_aspect = <<<EOF
Unser 2020er „Naslei“-Wein – aus dem steilsten Teil des Bremmer Calmont – ist für uns ein Wein wie kein anderer, komplett trocken nach 18 Monaten Spontangärung. Die kleine Gemarkung „Naslei“ (nur 2222 m²) liegt im vollständig nach Süden ausgerichteten Teil des Calmont und weist eine sehr gute Wasserversorgung auf. Diese Eigenschaften, zusammen mit den Besonderheiten des Reliefs, durch die nachts ein kühler Fallwind entsteht, ermöglichen eine Ernte von erstklassiger Qualität und entsprechendem Geschmack.
EOF;
		$nasleiCNTranslation->harvest_aspect =  <<<EOF
Naslei – вино, которого никогда не бывает много. Участок Naslei – это небольшая часть терруара Bremmer Calmont (всего 2222 м2), которая имеет полностью южную экспозицию склона и значительный сток поверхностных вод. Эти характеристики вместе с особенностями ландшафта, обеспечивающими охлаждение лозы в тёмное время суток, позволяют получить урожай первоклассного качества и, соответственно, вкуса.
EOF;

		self::$NASLEI_WINE_TYPE_2020->taste = <<<EOF
Naslei 2020 как нельзя лучше отражает гармонию года и терруара. Сперва округлый и нежный, после тёплый и фруктовый вкус открывает простор для воображения. Подкреплённое ароматом лета и фруктов долгое послевкусие начнётся с кокетливой кислинки, которая растворится на языке букетом минералов в составе уникального терруара Bremmer Calmont Naslei.
EOF;

		$nasleiRUTranslation->taste = <<<EOF
Naslei 2020 как нельзя лучше отражает гармонию года и терруара. Сперва округлый и нежный, после тёплый и фруктовый вкус открывает простор для воображения. Подкреплённое ароматом лета и фруктов долгое послевкусие начнётся с кокетливой кислинки, которая растворится на языке букетом минералов в составе уникального терруара Bremmer Calmont Naslei.  
EOF;
		$nasleiDETranslation->taste = <<<EOF
Der 2020er „Naslei“ spiegelt perfekt die Harmonie des Jahres und des Terroirs wider. Anfangs rund und zart, danach lässt ein warmer und fruchtiger Geschmack Raum für Fantasie. Unterlegt von Sommer- und Zitrusaromen beginnt der lange Abgang mit einer koketten Säure, die sich auf der Zunge mit einem mineralischen Bukett in der Komposition des einzigartigen Schieferterroirs auflöst.
EOF;
		$nasleiCNTranslation->taste =  <<<EOF
Naslei 2020 как нельзя лучше отражает гармонию года и терруара. Сперва округлый и нежный, после тёплый и фруктовый вкус открывает простор для воображения. Подкреплённое ароматом лета и фруктов долгое послевкусие начнётся с кокетливой кислинки, которая растворится на языке букетом минералов в составе уникального терруара Bremmer Calmont Naslei.  
EOF;
		/*
		 * NASLEI 
		 */

		/*
			* Frauenberg
		  */
		$frauenbergRUTranslation = new \stdClass;
		$frauenbergDETranslation = new \stdClass;
		$frauenbergCNTranslation = new \stdClass;
		self::$FRAUENBERG_WINE_TYPE_2018->RU = $frauenbergRUTranslation;
		self::$FRAUENBERG_WINE_TYPE_2018->DE = $frauenbergDETranslation;
		self::$FRAUENBERG_WINE_TYPE_2018->zh_CN = $frauenbergCNTranslation;

		$frauenbergBackgroundImage = new \stdClass;
		$frauenbergBackgroundImage->relative_path = 'single-wine-pg/frauenberg-single-wine-pg';
		$frauenbergBackgroundImage->base_name = 'bg-frauenberg-single-wine-pg';

		self::$FRAUENBERG_WINE_TYPE_2018->background_image = $frauenbergBackgroundImage;
		self::$FRAUENBERG_WINE_TYPE_2018->image = '/images/pictures/wine-bottles/frauenberg.png';

		self::$FRAUENBERG_WINE_TYPE_2018->title = 'Frauenberg';
		$frauenbergRUTranslation->title = 'Frauenberg';
		$frauenbergDETranslation->title = 'Frauenberg';
		$frauenbergCNTranslation->title = '尼弗·弗劳恩贝格2018年';

		self::$FRAUENBERG_WINE_TYPE_2018->order = 1;

		self::$FRAUENBERG_WINE_TYPE_2018->wineType = 'White, half-dry';
		$frauenbergRUTranslation->wineType = 'Белое, полусухое';
		$frauenbergDETranslation->wineType = 'Wit, halfdroog';
		$frauenbergCNTranslation->wineType = '半干白葡萄酒';

		self::$FRAUENBERG_WINE_TYPE_2018->color = 'White';
		$frauenbergRUTranslation->color = 'Белое';
		$frauenbergDETranslation->color = 'Wit';
		$frauenbergCNTranslation->color = '白色';

		self::$FRAUENBERG_WINE_TYPE_2018->wineSort = 'Riesling, 100%';
		$frauenbergRUTranslation->wineSort = 'Рислинг, 100%';
		$frauenbergDETranslation->wineSort = 'Riesling, 100%';
		$frauenbergCNTranslation->wineSort = '司令, 100%';

		self::$FRAUENBERG_WINE_TYPE_2018->harvest = 2018;
		self::$FRAUENBERG_WINE_TYPE_2018->price = 15.0;

		/* TODO: no translation */
		self::$FRAUENBERG_WINE_TYPE_2018->soil = 'Gray shale with interlayers of sand and clay';
		$frauenbergRUTranslation->soil = 'Серые сланцы с прослойками песка и глины';
		$frauenbergDETranslation->soil = 'Gray shale with interlayers of sand and clay';
		$frauenbergCNTranslation->soil = 'Gray shale with interlayers of sand and clay';


		self::$FRAUENBERG_WINE_TYPE_2018->terroir = 'Neefer Frauenberg, Mosel';
		/* TODO: no translation */
		$frauenbergRUTranslation->terroir = 'Neefer Frauenberg, Mosel';
		$frauenbergDETranslation->terroir = 'Neefer Frauenberg, Mosel';
		$frauenbergCNTranslation->terroir = 'Neefer Frauenberg, Mosel';

		self::$FRAUENBERG_WINE_TYPE_2018->residual_sugar = 17.5;
		self::$FRAUENBERG_WINE_TYPE_2018->acidity = 5.6;
		self::$FRAUENBERG_WINE_TYPE_2018->strength = 11.5;

		/* TODO: no translation, no harvest aspect */
		self::$FRAUENBERG_WINE_TYPE_2018->harvest_aspect = <<<EOF
Südwand, harvested from the southern slope (this is how the name of the wine is translated into Russian) in 2018, is a semi-dry wine with a residual sugar content of 10 g / l. The grapes for this wine were harvested from the steepest vineyard in Europe, Bremmer Calmont, from a slope with a 100% southern exposure. The age of the vines in this area reaches 60 years.
Südwand 2018 has been preparing to present to your attention for over 1 year, undergoing vinification by natural fermentation in a steel tank.
EOF;
		$frauenbergRUTranslation->harvest_aspect = <<<EOF
Neefer Frauenberg, 2018 — это полусухое вино (17 г/л остаточного сахара, сбалансированного кислотностью) из винограда сорта Рислинг, выращенного на лозах средним возрастом 65 лет. Особенную минеральную лёгкость во вкусе вино обрело благодаря произрастанию лозы на сланцево-песочных почвах участка Neefer Frauenberg, склоны которого обращены на юг. 
EOF;
		$frauenbergDETranslation->harvest_aspect = <<<EOF
Dieser Wein aus dem Neefer Frauenberg stammt von Weinreben mit einem Durchschnittsalter von 65 Jahren. In diesem Alter bringen die Reben nur noch geringe Erträge, aber dafür extraktreiche Trauben von hoher Qualität. Die Schieferböden in der Lage „Frauenberg“ sind durchzogen von Sand- und Lehmschichten, die dem Wein neben der Mineralität eine fruchtige Note verleihen. 
EOF;
		$frauenbergCNTranslation->harvest_aspect =  <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant layering sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads。
EOF;

		self::$FRAUENBERG_WINE_TYPE_2018->taste = <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant layering sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads。
EOF;
		$frauenbergRUTranslation->taste = <<<EOF
Первым впечатлением от вина станет чистый и свежий аромат спелых груш и абрикосов, который окутает вас и проводит к персикам, дыне, взбитым сливкам. Спелая кислотность вина оттенена спокойными кремовыми и красочными фруктовыми нотами. Вино оставляет приятное ощущение многослойности в долгом и аппетитном послевкусии. Лёгкая фруктовая сладость гармонична вписана во вкусовую палитру, она добавляет ощущение гладкой шелковистости долгому и интенсивному послевкусию. Станет прекрасной парой с пряными блюдами азиатской кухни, лёгкими супами и салатами. 
EOF;
		$frauenbergDETranslation->taste = <<<EOF
Ein ausgezeichneter Riesling für schöne Sommerabende oder zu scharfen Gerichten. In der Nase Aromen von Pfirsich, Aprikose und Melone. Geschmacklich bringt der Wein eine ausgewogene und Balance zwischen reifer Säure, fruchtigen Noten und leichter Restsüße mit.  
EOF;
		$frauenbergCNTranslation->taste =  <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant layering sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads。
EOF;

		self::$FRAUENBERG_WINE_TYPE_2018->volume = $faker->numberBetween(500, 1000);
		self::$FRAUENBERG_WINE_TYPE_2018->age = $faker->numberBetween(1, 21);

		foreach (get_object_vars(self::$FRAUENBERG_WINE_TYPE_2018) as $key => $value) {
			self::$FRAUENBERG_WINE_TYPE_2020->$key = $value;
		}
		self::$FRAUENBERG_WINE_TYPE_2020->harvest = 2020;

		foreach (get_object_vars(self::$SUDWAND_WINE_TYPE_2018) as $key => $value) {
			self::$SUDWAND_WINE_TYPE_2019->$key = $value;
			self::$SUDWAND_WINE_TYPE_2020->$key = $value;
		}

		self::$SUDWAND_WINE_TYPE_2019->harvest = 2019;
		self::$SUDWAND_WINE_TYPE_2020->harvest = 2020;

		$sudwand2019RUTranslation = new \stdClass;
		$sudwand2019DETranslation = new \stdClass;
		$sudwand2019CNTranslation = new \stdClass;
		self::$SUDWAND_WINE_TYPE_2019->RU = $sudwand2019RUTranslation;
		self::$SUDWAND_WINE_TYPE_2019->DE = $sudwand2019DETranslation;
		self::$SUDWAND_WINE_TYPE_2019->zh_CN = $sudwand2019CNTranslation;

		foreach (get_object_vars(self::$SUDWAND_WINE_TYPE_2018->RU) as $key => $value) {
			self::$SUDWAND_WINE_TYPE_2019->RU->$key = $value;
		}

		foreach (get_object_vars(self::$SUDWAND_WINE_TYPE_2018->DE) as $key => $value) {
			self::$SUDWAND_WINE_TYPE_2019->DE->$key = $value;
		}

		foreach (get_object_vars(self::$SUDWAND_WINE_TYPE_2018->zh_CN) as $key => $value) {
			self::$SUDWAND_WINE_TYPE_2019->zh_CN->$key = $value;
		}

		self::$SUDWAND_WINE_TYPE_2019->harvest_aspect = <<<EOF
Südwand, harvested from the southern slope (this is how the name of the wine is translated into Russian) in 2018, is a semi-dry wine with a residual sugar content of 10 g / l. The grapes for this wine were harvested from the steepest vineyard in Europe, Bremmer Calmont, from a slope with a 100% southern exposure. The age of the vines in this area reaches 60 years.
Südwand 2018 has been preparing to present to your attention for over 1 year, undergoing vinification by natural fermentation in a steel tank.
EOF;
		$sudwand2019RUTranslation->harvest_aspect = <<<EOF
Контрастный 2019 начался очень рано, что обеспечило лозе долгий период созревания. Уже в начале июня началось цветение, после было несколько сногсшибательных дней, когда градусник держался выше 35 °С, именно в эти дни лоза получила заряд энергии, который вы можете ощутить в вине. Нежный сентябрь подарил нашему Рислингу 2019 чудесный аромат, приправленный мёдом августа. Мы собрали виноград в начале октября, вино было готово через 1 год и 1 месяц, в ноябре 2020  мы поняли, что на данный это наше лучшее вино.  
EOF;
		$sudwand2019DETranslation->harvest_aspect = <<<EOF
Witterungstechnisch war das Jahr 2019 interessanter als 2018. Kurze nasse Perioden wechselten sich mit sehr heißen und langen Trockenphasen ab, vor allem während der Sommermonate. Temperaturen über 40°C markierten Ende Juli den Höhepunkt dieses Wechselspiels. Die Ernte fiel deutlich geringer aus als im Jahr 2018, allerdings waren die Inhaltstoffe in den Beeren umso konzertierter. Anfang Oktober 2019 ernteten wir die Trauben, nach knapp 13-monatigem Ausbau im Edelstahltank wurde der Wein im November 2020 gefüllt.    
EOF;
		$sudwand2019CNTranslation->harvest_aspect =  <<<EOF
Südwand, harvested from the southern slope (this is how the name of the wine is translated into Russian) in 2018, is a semi-dry wine with a residual sugar content of 10 g / l. The grapes for this wine were harvested from the steepest vineyard in Europe, Bremmer Calmont, from a slope with a 100% southern exposure. The age of the vines in this area reaches 60 years.
Südwand 2018 has been preparing to present to your attention for over 1 year, undergoing vinification by natural fermentation in a steel tank.
EOF;

		self::$SUDWAND_WINE_TYPE_2019->taste = <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant layering sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads.
EOF;
		$sudwand2019RUTranslation->taste = <<<EOF
Яркое и насыщенное как жаркое лето 2019 это вино сразу обращает на себя внимание – во вкусе хоровод тропических фруктов в плену медовых, нежных минеральных тонов. Глубоким золотом цвета вино пленяет вас с первого взгляда и станет чудесной парой к красному мясу, пряным блюдам, а также кисло-сладким шедеврам азиатской кухни.   
EOF;
		$sudwand2019DETranslation->taste = <<<EOF
Ein Wein so intensiv wie das Jahr 2019, ein perfektes Abbild der Lage und Witterung! Extraktreich und vollmundig mit einem komplexen Aromaspektrum präsentiert sich dieser Wein in Geruch und Geschmack. Die leichte Restsüße schafft eine hervorragende Balance zwischen dem Alkoholgehalt und der Säure.     
EOF;
		$sudwand2019CNTranslation->taste =  <<<EOF
The first impression of the wine will be a clean and fresh aroma of ripe pears and apricots, which will envelop you and lead you to peaches, melons, whipped cream. Ripe acidity of the wine is set off by calm creamy and colorful fruity notes. The wine leaves a pleasant layering sensation with a long and mouth-watering finish. Light fruity sweetness harmoniously fits into the palate, it adds a smooth silky sensation to a long and intense aftertaste.
Perfect pairing with spicy Asian dishes, light soups and salads.
EOF;

		if (!self::$STEILSET_WINE_TYPE) 
		{
			self::$STEILSET_WINE_TYPE = new \stdClass;
		}

		if (!self::$PROBEPAKET_WINE_TYPE)
		{
			self::$PROBEPAKET_WINE_TYPE = new \stdClass;			
		}

		if (!self::$NASLEIPAKET_WINE_TYPE)
		{
			self::$NASLEIPAKET_WINE_TYPE = new \stdClass;			
		}

		$steilsetRUTranslation = new \stdClass;
		$steilsetDETranslation = new \stdClass;
		$steilsetCNTranslation = new \stdClass;

		self::$STEILSET_WINE_TYPE->RU = $steilsetRUTranslation;
		self::$STEILSET_WINE_TYPE->DE = $steilsetDETranslation;
		self::$STEILSET_WINE_TYPE->zh_CN = $steilsetCNTranslation;

		$probepaketRUTranslation = new \stdClass;
		$probepaketDETranslation = new \stdClass;
		$probepaketCNTranslation = new \stdClass;

		self::$PROBEPAKET_WINE_TYPE->RU = $probepaketRUTranslation;
		self::$PROBEPAKET_WINE_TYPE->DE = $probepaketDETranslation;
		self::$PROBEPAKET_WINE_TYPE->zh_CN = $probepaketCNTranslation;

		$nasleipaketRUTranslation = new \stdClass;
		$nasleipaketDETranslation = new \stdClass;
		$nasleipaketCNTranslation = new \stdClass;

		self::$NASLEIPAKET_WINE_TYPE->RU = $nasleipaketRUTranslation;
		self::$NASLEIPAKET_WINE_TYPE->DE = $nasleipaketDETranslation;
		self::$NASLEIPAKET_WINE_TYPE->zh_CN = $nasleipaketCNTranslation;

		self::$STEILSET_WINE_TYPE->price = 181;
		self::$PROBEPAKET_WINE_TYPE->price = 97.4;
		self::$NASLEIPAKET_WINE_TYPE->price = 119.4;

		self::$STEILSET_WINE_TYPE->image = '/images/pictures/wine-set/steilset.png';
		self::$PROBEPAKET_WINE_TYPE->image = '/images/pictures/wine-set/probepaket.png';
		self::$NASLEIPAKET_WINE_TYPE->image = '/images/pictures/wine-set/nasleipaket.png';

		self::$STEILSET_WINE_TYPE->title = 'STEILSET «3x4»';
		$steilsetRUTranslation->title = 'STEILSET «3x4»';
		$steilsetDETranslation->title = 'STEILSET «3x4»';
		$steilsetCNTranslation->title = 'STEILSET «3x4»';

		self::$PROBEPAKET_WINE_TYPE->title = 'Probepaket';
		$probepaketRUTranslation->title = 'Probepaket';
		$probepaketDETranslation->title = 'Probepaket';
		$probepaketCNTranslation->title = 'Probepaket';

		self::$NASLEIPAKET_WINE_TYPE->title = 'Das (knochen-)trockene Naslei-Paket';
		$nasleipaketRUTranslation->title = 'Das (knochen-)trockene Naslei-Paket';
		$nasleipaketDETranslation->title = 'Das (knochen-)trockene Naslei-Paket';
		$nasleipaketCNTranslation->title = 'Das (knochen-)trockene Naslei-Paket';

		self::$STEILSET_WINE_TYPE->min_harvest = 2020;
		self::$STEILSET_WINE_TYPE->max_harvest = 2021;
		self::$STEILSET_WINE_TYPE->count = 3;

		self::$PROBEPAKET_WINE_TYPE->min_harvest = 2020;
		self::$PROBEPAKET_WINE_TYPE->max_harvest = 2021;
		self::$PROBEPAKET_WINE_TYPE->count = 6;

		self::$NASLEIPAKET_WINE_TYPE->min_harvest = 2020;
		self::$NASLEIPAKET_WINE_TYPE->max_harvest = 2021;
		self::$NASLEIPAKET_WINE_TYPE->count = 6;

		self::$STEILSET_WINE_TYPE->terroir = '"Südwand" und Frauenberg, Mosel';
		$steilsetRUTranslation->terroir = '"Südwand" und Frauenberg, Mosel';
		$steilsetDETranslation->terroir = '"Südwand" und Frauenberg, Mosel';
		$steilsetCNTranslation->terroir = '"Südwand" und Frauenberg, Mosel';

		self::$PROBEPAKET_WINE_TYPE->terroir = 'Naslei, "Südwand" und Frauenberg, Mosel';
		$probepaketRUTranslation->terroir = 'Naslei, "Südwand" und Frauenberg, Mosel';
		$probepaketDETranslation->terroir = 'Naslei, "Südwand" und Frauenberg, Mosel';
		$probepaketCNTranslation->terroir = 'Naslei, "Südwand" und Frauenberg, Mosel';

		self::$NASLEIPAKET_WINE_TYPE->terroir = 'Bremmer Calmont Naslei, Mosel';
		$nasleipaketRUTranslation->terroir = 'Bremmer Calmont Naslei, Mosel';
		$nasleipaketDETranslation->terroir = 'Bremmer Calmont Naslei, Mosel';
		$nasleipaketCNTranslation->terroir = 'Bremmer Calmont Naslei, Mosel';

		self::$CATALOG_WINE_LIST['SUDWAND_2018'] = self::$SUDWAND_WINE_TYPE_2018;
		self::$CATALOG_WINE_LIST['FRAUENBERG_2018'] = self::$FRAUENBERG_WINE_TYPE_2018;
		self::$CATALOG_WINE_LIST['SUDWAND_2019'] = self::$SUDWAND_WINE_TYPE_2019;
		self::$CATALOG_WINE_LIST['SUDWAND_2020'] = self::$SUDWAND_WINE_TYPE_2020;
		self::$CATALOG_WINE_LIST['FRAUENBERG_2020'] = self::$FRAUENBERG_WINE_TYPE_2020;

		self::$CATALOG_WINE_LIST['STEILSET'] = self::$STEILSET_WINE_TYPE;
		self::$CATALOG_WINE_LIST['PROBEPAKET'] = self::$PROBEPAKET_WINE_TYPE;
		self::$CATALOG_WINE_LIST['NASLEIPAKET'] = self::$NASLEIPAKET_WINE_TYPE;

		self::$CATALOG_WINE_TITLE_LIST['SUDWAND'] = self::$SUDWAND_WINE_TYPE_2018;
		self::$CATALOG_WINE_TITLE_LIST['FRAUENBERG'] = self::$FRAUENBERG_WINE_TYPE_2020;
		self::$CATALOG_WINE_TITLE_LIST['FANAGORIA'] = self::$SUDWAND_WINE_TYPE_2018;
		self::$CATALOG_WINE_TITLE_LIST['ABRAMDUSO'] = self::$FRAUENBERG_WINE_TYPE_2020;
		self::$CATALOG_WINE_TITLE_LIST['ALMAVALLEY'] = self::$SUDWAND_WINE_TYPE_2018;
		self::$CATALOG_WINE_TITLE_LIST['MEZON'] = self::$FRAUENBERG_WINE_TYPE_2020;
	}
}

WinesHelper::init();
