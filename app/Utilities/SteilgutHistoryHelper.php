<?php

namespace App\Utilities;

class SteilgutHistoryHelper
{
	public static $STEILGUT_HISTORY_FAKE_YEAR_LIST = null;
	public static $STEILGUT_HISTORY_CONTENT_LIST = array();
	public static function init()
	{
		$fakerRootDir = public_path() . '/images/faker/steilgutHistory';
		self::$STEILGUT_HISTORY_FAKE_YEAR_LIST = array_diff(
			scandir($fakerRootDir),
			array('.', '..', '.DS_Store', 'orig')
		);

		$year = 2016;
		for ($i = 0; $i < 6; $i++) {
			self::$STEILGUT_HISTORY_CONTENT_LIST[$i] = new \stdClass;
			self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->year = $year;

			switch ($year) {
				case 2016:
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->title = 'Наш первый год!';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->thread = <<< EOF
<p>Наш первый год! Мы встретились во время обучения за границей полярного круга, на архипелаге Шпицберген (геогр.). Зимние температуры здесь могут опускаться до минус 30° C, вечная тьма, а белых медведей на островах больше, чем людей. В это время наши мысли ещё не вращались вокруг собственного вина, да и климатические условия на Свальбарде (геогр.) были бы слишком плохи для виноделия. Мы полной грудью вдыхали Север – ходили в лыжные походы, на снегоходах забирались в пустынные уголки острова и любовались уникальной природой арктического архипелага.</p><br/><p>В июне 2016 года мы оба закончили обучение и вернулись в свои страны. Филипп вернулся на свою малую родину в деревню Бремм (геогр.) и устроился работать в консалтинговую фирму, Ирина стала работать инженером на подмосковной фабрике. Во время своих регулярных визитов на берега реки Мозель (геогр.) Ирина была восхищена удивительными ландшафтами, созданными виноделами в союзе с природой, прониклась уважением к труду мастеров виноделия и конечно же оценила вкус местного вина.</p><br/><p>Решение было принято: мы будем сами производить вино и откроем собственную винодельню. Мы начали поиск подходящих участков.</p>
EOF;

					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->title = 'Liebe im ewigen Eis!';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->thread = <<< EOF
<p>Im Jahr 2016 lernten wir uns während des Studiums auf Spitzbergen kennen. Damit beginnt unsere Geschichte und auch die Geschichte des „Steilguts“. Die Inselgruppe Spitzbergen liegt auf 78° nördlicher Breite, näher am Nordpol als am norwegischen Festland! Im Winter werden häufig Temperaturen von -30°C erreicht, einige Monate herrscht komplette Dunkelheit und auf den Inseln gibt es mehr Eisbären als Menschen. Keine guten Bedingungen für den Weinbau… Aber zu diesem Zeitpunkt drehten sich unsere Gedanken sowieso noch nicht um unseren eigenen Wein. Wir genossen unsere Zeit im hohen Norden - wir machten Skitouren, fuhren mit Schneemobilen in die wildesten Ecken der Insel, feierten durch die Wochenenden und bewunderten die einzigartige Natur des arktischen Archipels.</p><br/><p>Im Juni 2016 schlossen wir beide unser Studium abgeschlossen und kehrten vorerst in unsere Heimatländer zurück. Philipp nahm einen Job bei einer Beratungsfirma an und Irina begann als Ingenieurin in einer Fabrik in der Nähe von Moskau zu arbeiten. Während ihrer regelmäßigen Besuche Mosel war Irina begeistert von den atemberaubenden Landschaften an der Mosel, die Winzer in Verbindung mit der Natur geschaffen haben und sie lernte natürlich den Moselwein zu schätzen.</p><br/><p>Es dauerte einige Monate, dann trafen wir eine Entscheidung: Wir möchten selbst Wein produzieren und unser eigenes Weingut aufbauen. Die Suche nach den ersten Rebflächen begann.</p>
EOF;
					break;

				case 2017:
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->title = 'Покупка виноградников';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->thread = <<< EOF
<p>Были куплены первые участки общей площадью 3000 м2. Приобретённые виноградники расположены на склонах плоскогорья Bremmer Calmont (геогр) – самого крутого терруара Европы.</p><br/><p>Закуплен инструмент, проведены работы по замене деревянных опор, подвязке и глубокой подрезке лозы.</p>
EOF;

					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->title = 'Endlich Weinberge';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->thread = <<< EOF
<p>Wir machten uns auf die Suche und fanden schnell einen Verkäufer, dessen Weinberge wir nach der Lese des Jahres 2017 übernehmen konnten. 3000 m² Rebfläche im Bremmer Calmont und im Neefer Frauenberg wechselten den Besitzer.</p><br/><p>Manche erklärten uns für verrückt, und wir mussten uns Sätze anhören wie „Wie kann man denn nur so blöd im Kopp‘ sein und solche Wingerte kaufen“ (eigentlich ausgesprochen in Dialekt, aber wir verwenden hier die Übersetzung ins Hochdeutsche). Uns war es egal, voller Vorfreude begannen wir unsere Arbeit in den steilsten Weinbergsterrassen der Welt.</p>
EOF;
					break;

				case 2018:
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->title = 'Первый урожай';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->thread = <<< EOF
<p>Благодаря комбинации превосходной погоды и удачного расположения виноградников был собран уникальный по качеству и количеству ягод урожай. Проведён отжим 2000 литров сока с его последующей винификацией.</p><br/><p>Новый участок “Naslei” (геогр.) теперь принадлежит винодельне Steilgut (уникал.).  Naslei — это виноградник терруара Bremmer Calmont (геогр.)  площадью 5500 м2, возделывание которого было прекращено более 30 лет назад. Примерно половина виноградника покрыта зарослями ежевики, такая же часть площади занята одичавшим виноградом сорта Рислинг. Начата подготовка земли для высадки новых саженцев в 2019 году.</p> 
EOF;

					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->title = 'Das glückliche erste Jahr';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->thread = <<< EOF
<p>Dank des ausgezeichneten Wetters hatten wir in diesem Jahr eine hervorragende Ernte von einzigartiger Qualität und Quantität. Die Trauben waren kerngesund und hocharomatisch. Das erste Jahr meinte es sehr gut mit uns!</p><br/><p>Da uns der Calmont als „Prototyp“ des Steillagenweinbaus immer stärker begeisterte, beschlossen wir, zusätzlich ein Brachstück zu rekultivieren. In der Gemarkung „Naslei“ kauften wir eine Fläche von 5500 m², auf der schon seit über 30 Jahren und länger kein Weinbau mehr betrieben wurde. Ein Großteil des Weinbergs ist mittlerweile mit Brombeerhecken und kleinen Bäumen bedeckt, auf kleinen Teilen findet man noch alte Riesling-Reben von damals.</p><br/><p>Wir begannen einen kleinen Teil des verbuschten Landes zu roden. Alles Handarbeit… Kreuzhacke, Wiedehopf, Säge, Haumesser waren unsere ständigen Begleiter.</p>  
EOF;
					break;

				case 2019:
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->title = 'Наши вина нашли своих ценителей';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->thread = <<< EOF
<p>Первые вина Südwand и Neefer Frauenberg нашли своих ценителей! В первые месяцы после бутилировки было продано полтысячи бутылок нашего вина, это составило шестую часть от всего произведённого объёма.</p><br/><p>500 саженцев Рислинга были высажены на участке “Naslei”. 2019 год стал одним из многих в последнее время лет с критическими скачками температур, которые буквально спалили наши только что укоренившиеся саженцы. Первой волной жары накрыло примерно половину от высаженных лоз, после дождя продолжить рост смогли лишь 40% из них.</p><br/><p>Мы продолжили движение с юга-востока на юга-запад! Теперь с нами новый виноградник Geichkaul (геогр.), расположенный на западной части плоскогорья Calmont (геогр.) и посему носящей имя Eller Calmont (геогр.). На участке проведены работы по сезонной обрезке лозы и подготовке участка к зимовке.</p>
EOF;

					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->title = 'Der wohlersehnte Lohn';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->thread = <<< EOF
<p>Unsere ersten beiden Weine aus dem Bremmer Calmont und Neefer Frauenberg kamen auf die Flaschen, nach knapp einem Jahr Spontangärung. In den ersten Monaten nach der Abfüllung wurden ein halbes Tausend Flaschen unseres Weins verkauft, was ein Sechstel des gesamten produzierten Volumens ausmachte.</p><br/><p>Und natürlich widmeten wir uns weiterhin unserem Lieblingsprojekt, der „Naslei“: Dort pflanzten wir ca. 500 neue Riesling-Reben. 2019 war eines der vielen letzten Jahre mit kritischen Temperaturanstiegen, die unsere neu verwurzelten Setzlinge buchstäblich verbrannten. Die heißen und trockenen Monate Juni und Juli mit Temperaturen von über 40°C brachte das Wachstum von etwa der Hälfte der gepflanzten Reben zum Erliegen und viele vertrockneten. Nach starken Regenfälle Anfang August erholten sich jedoch einige Reben wieder.</p><br/><p>Zusätzlich kaufen wir weitere Parzellen im Bremmer Calmont in der Gemarkung „Geichkaul“. Gemeinsam mit Philipps Cousin Max teilten wir den Weinberg auf. Wir freuen uns, dass Max und seine Frau Lydia (Weingut Baldes) nun ebenfalls Flächen im Calmont bewirtschaften.</p>    
EOF;
					break;

				case 2020:
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->title = 'Упорный рост и новое вино';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->thread = <<< EOF
<p>Мы снова растём! Теперь в нашем составе участок на противоположной стороне реки – терруар Neefer Frauenberg. Как ни удивительно, этот виноградник, как и участки Bremmer Calmont, повёрнут к югу. Это ценнейшее для виноделия расположение склонов образовано рекой Mosel, которая здесь поворачивает на 180°.</p><br/><p>Этой весной проведены самые масштабные работы по высадке саженцев и подготовке участков. Вновь на территории виноградника «Naslei» мы высадили 600 саженцев и освободили от зарослей сорняков участок площадью в 500м2. Здесь начата рекультивация одичавших кустов Рислинга. На участках, освобождённых от сорняков, будет продолжена высадка молодых лоз.</p><br/><p>Собран урожай массой в 2,5 тонны винограда, для его винификации нам понадобилось докупить 2 новых танка, теперь в нашем арсенале 4 танка из высококачественной стали – 2*1000, 600 и 300 литров. В самом маленьком, почти бургундском баррике, мы планируем сделать наше новое, абсолютно сухое вино – пока мы думаем над названием, время покажет нам каким будет его вкус.</p> 
EOF;

					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->title = 'Wir wachsen weiter!';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->thread = <<< EOF
<p>In diesem Frühjahr arbeiteten wir wieder intensiv in der „Naslei“, um die Parzellen vorzubereiten und neue Rebstöcke zu pflanzen. Insgesamt pflanzten wir 600 Setzlinge und befreiten ein 500 m² großes Stück Land vom Unkraut. Hier arbeiteten wir ebenfalls an der Rekultivierung alter Rebstöcke.</p><br/><p>Für die Weinbereitung mussten wir zwei neue Tanks kaufen. In unserem Arsenal befinden sich nun vier Tanks aus hochwertigem Edelstahl – zwei haben Platz für 1000 Liter, einer für 600 sowie ein weiterer für 300 Liter. In dem kleinsten Tank planen wir, einen neuen, absolut trockenen Calmont-Wein herzustellen. Während wir über den Namen nachdenken, wird die Zeit zeigen, wie er sich entwickelt. Doch die Zeichen stehen gut!</p>   
EOF;
					break;

				case 2021:
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->title = 'Теперь мы начинаем понимать, во что ввязались';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->RU->thread = <<< EOF
<p>“Есть три способа разориться: самый быстрый – скачки, самый приятный – женщины, а самый надёжный – сельское хозяйство” – Уильям Питт, граф Амхерст, британский аристократ. Надеемся, что 2021 год останется в нашей памяти самым сырым и облачным годом. Поздняя весна, подарившая нам запоздалое раскрытие почек и их сиюминутное поедание гусеницей Пяденицы дымчатой, сменилась холодным и дождливым летом, когда ягоды не успев сформироваться на ветке уже начали гнить. Дождливый июль, смывший город, а заодно и виноградники в долине реки Ар, коснулся нас только краем: дорога к виноградникам была перекрыта разлившейся рекой, и мы добирались к участкам по сопке. Трава, внезапно получившая много воды, росла как нельзя лучше.</p><br/><p>Июль и август старались исправить ситуацию, но помогли только от части – трава, имея достаточно влаги в тепле набрала невиданную доселе скорость роста, а виноград, шокированный резкой сменой температуры, догорал прямо на лозе. Сентябрь и октябрь подарили нам долгожданную и такую нужную винограду прохладу, наполнив оставшиеся гроздья ароматом. Он пришёлся по вкусу нашим давним друзьям-оппонентам диким свиньям, которые до последней косточки съели весь виноград на одном из наших участков.</p><br/><p>Мы закончили сбор урожая 19 октября, когда после двух ночей нон-стоп работы, мы пили чай на вершине Frauenberg в компании с нашей скрытой силой – мамой и папой Филиппа, которые собрали свои первые гроздья более 60-ти лет назад.</p>
EOF;

					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE = new \stdClass;
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->title = 'Das „Winzersein“';
					self::$STEILGUT_HISTORY_CONTENT_LIST[$i]->DE->thread = <<< EOF
<p>Jetzt beginnen wir langsam zu verstehen, worauf wir uns eingelassen haben. William Pitt, Earl of Amherst, ein britischer Aristokrat sagte einmal: „Es gibt drei Möglichkeiten, pleite zu gehen: Am schnellsten geht es mit Pferderennen, am angenehmsten geht es mit Frauen und am zuverlässigsten mit der Landwirtschaft“. Wir hoffen, dass uns das Jahr 2021 als Einzelfall in Erinnerung bleiben wird, doch nach obigem Zitat dürfte das wohl nicht der Fall sein.</p><br/><p>Nach dem milden Winter ließ ein kurzes, fast frühsommerliches Intermezzo mit Temperaturen um 25°C ließ unsere Reben in den warmen Steillagen schnell aus dem Winterschlaf erwachen. Allerdings folgten die kältesten April- und Mail-Monate der letzten Jahrzehnte. Die Reben bleiben für lange Zeit in dem verwundbaren Stadium um bzw. kurz nach dem Austrieb stehen. Dies erlaubte den Erdraupen und dem Rhombenspanner einen beträchtlichen Schaden an den neuen Trieben anzurichten.</p><br/><p>Dem kalten Frühling folgte ein regnerischer Sommer, in dem uns die Pilzkrankheiten und später die Fäulnis zu schaffen machte. Dessen trauriger Höhepunkt, das Ahrhochwasser am 14. Juli, schockierte uns zutiefst. Die Mosel selbst war weniger stark betroffen, doch auch sie überflutete binnen Stunden in der Nacht vom 15. Auf den 16. Juli Straßen und die ufernahen Bereiche, sodass wir unsere Weinberge nur über lange Umwege erreichen konnten.</p><br/><p>Nur das Gras und Unkraut fühlte sich bei so viel Nässe wohl, es wuchs und wuchs. September und Oktober brachten uns einige kühle Tage und füllten die Trauben mit Aroma. Die Säure blieb hoch und das Mostgewicht eher durchschnittlich. Unsere „Freunde“, die Wildschweine, waren auch schon auf den Geschmack gekommen und fraßen in einer Parzelle alle Trauben, fast bis auf die letzte Beere.</p><br/><p>Wir beendeten die Weinlese am 19. Oktober, als wir nach zwei Tagen mit nächtlicher Lese (wie fingen jeweils um 3 Uhr morgens an) oben auf dem Frauenberg Tee tranken, begleitet von unseren stillen Helden, Philipps Eltern, die vor über 60 Jahren ihre ersten Trauben geerntet haben.</p>							 
EOF;
					break;
			}
			$year++;
		}
	}
}

SteilgutHistoryHelper::init();
