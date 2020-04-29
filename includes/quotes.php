<?php
/*******************************************************************************
   Создание контента цитаты 
   Вызывает bg_bibrefs_printVerses() - см. ниже
*******************************************************************************/  
function bg_bibrefs_getQuotes($book, $chapter, $type, $lang, $prll='') {
	global $bg_bibrefs_option;
	global $bg_bibrefs_chapter, $bg_bibrefs_ch, $bg_bibrefs_psalm, $bg_bibrefs_ps;
	global $bg_bibrefs_url, $bg_bibrefs_bookTitle, $bg_bibrefs_shortTitle, $bg_bibrefs_bookFile;
	$lang = include_books($lang);

/*******************************************************************************
   Преобразование обозначения книги из формата azbyka.ru в формат patriarhia.ru
   чтение и преобразование файла книги
*******************************************************************************/  
	if (!$book) return "";
	if (!$bg_bibrefs_bookFile[$book]) return "";
//	$key='bible-'.$book.'_'.$lang;
//	if (!$bg_bibrefs_option['cashe'] || (false===($code=wp_cache_get($key,'bg-bible-refs'))) ){
		$book_file = 'bible/'.$bg_bibrefs_bookFile[$book];										// Имя файла книги
		$path = dirname(dirname(__FILE__ )).'/'.$book_file;										// Локальный URL файла
		$url = plugins_url( $book_file , dirname(__FILE__ ) );									// URL файла
		if (!file_exists($path)) {
			$upload_dir = wp_upload_dir();
			$path = $upload_dir['basedir'].'/'.$book_file;
			$url = $upload_dir['baseurl'].'/'.$book_file;
		}

	// Получаем данные из файла	
		$code = false;
		if ($bg_bibrefs_option['fgc'] == 'on' && function_exists('file_get_contents')) {		// Попытка1. Если данные не получены попробуем применить file_get_contents()
		
			$code = file_get_contents($path);		
		}

		if ($bg_bibrefs_option['fopen'] == 'on' && !$code) {									// Попытка 2. Если данные опять не получены попробуем применить fopen() 
			$ch=fopen($path, "r" );																	// Открываем файл для чтения
			if($ch)
			{
				while (!feof($ch))	{
					$code .= fread($ch, 2097152);													// загрузка текста (не более 2097152 байт)
				}
				fclose($ch);																		// Закрываем файл
			}
		}
		if ($bg_bibrefs_option['curl'] == 'on' && function_exists('curl_init') && !$code) {		// Попытка3. Если установлен cURL				
			$ch = curl_init($url);																	// создание нового ресурса cURL
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);											// возврат результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер
			$code = curl_exec($ch);																	// загрузка текста
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);										
			if ($httpCode != '200') $code = false;													// Проверка на код http 200
			curl_close($ch);																		// завершение сеанса и освобождение ресурсов
		} 

		if (!$code) return "";																	// Увы. Паранойя хостера достигла апогея. Файл не прочитан или ошибка

//		if ($bg_bibrefs_option['cashe']) wp_cache_set($key,$code,'bg-bible-refs',3600);		
//	}	
// Преобразовать json в массив
	$json = json_decode($code, true);															

	$verses = "";
/*******************************************************************************
   Разбор ссылки и формирование текста стихов Библии
  
*******************************************************************************/  
	
	$jj = 0;
	$chr = 0;																					// Предыдущая глава

	while (preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {					// Должно быть число - номер главы 
		$jj++;																					// Защита от зацикливания (не более 10 циклов)
		if ($jj > 10) return "***";
		$ch1 = (int)$matches[0][0];
		$chapter = substr($chapter,(int)$matches[0][1]);
		if (preg_match("/\\:|\\,|\\-/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {			// Допускается: двоеточие, запятая, тире или <конец строки>
			$sp = $matches[0][0];
			$chapter = substr($chapter,(int)$matches[0][1]);
		} else $sp = "";
		
		if (strcasecmp ($sp, ":") == 0) {
//		Двоеточие - далее стихи
			$ii = 0;
			while (preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {			// Должно быть число - номер стиха 
				$ii++;																			// Защита от зацикливания (не более 10 циклов)
				if ($ii >10) return "***";
				$vr1 = (int)$matches[0][0];
				$chapter = substr($chapter,(int)$matches[0][1]);
				if (preg_match("/\\:|\\,|\\-/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {	// Допускается:  двоеточие, запятая, тире или <конец строки>
					$sp = $matches[0][0];
					$chapter = substr($chapter,(int)$matches[0][1]);
				} else $sp = "";
				if (strcasecmp ($sp, ":") == 0) {												// Если двоеточие, то не номер стиха, а номер главы и далее стихи
					$ch1 = $vr1;
				} else {
					$ch2 = $ch1;
					if (strcasecmp ($sp, "-") == 0) {
						preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE);			// Должно быть число - номер стиха 
						$vr2 = (int)$matches[0][0];
						$chapter = substr($chapter,(int)$matches[0][1]);

						if (preg_match("/\\:|\\,/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {	// Допускается: двоеточие, запятая или <конец строки>
							$sp = $matches[0][0];
							$chapter = substr($chapter,(int)$matches[0][1]);
							if (strcasecmp ($sp, ":") == 0) {												// Если двоеточие, то не номер стиха, а номер главы и далее стихи
								$ch2 = $vr2;
								preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE);				// Должно быть число - номер стиха 
								$vr2 = (int)$matches[0][0];
								if (preg_match("/\\,/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {	// Допускается: запятая или <конец строки>
									$sp = $matches[0][0];
									$chapter = substr($chapter,(int)$matches[0][1]);
								} else $sp = "";
							}
							else if (strcasecmp ($sp, ",") == 0) {
								preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE);				// Должно быть число - номер стиха 
								$sp = $matches[0][0];
								$chapter = substr($chapter,(int)$matches[0][1]);
							} else $sp = "";
						} else $sp = "";
					} else {
						$vr2 = $vr1;
					}
					$verses = $verses.bg_bibrefs_printVerses ($json, $book, $chr, $ch1, $ch2, $vr1, $vr2, $type, $lang, $prll);
					$chr = $ch1;
					if ($sp == "") break;
				}
			}
		} else {
//		Далее до двоеточия только главы
			if (strcasecmp ($sp, "-") == 0) {
				preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE);					// Должно быть число - номер главы 
				$ch2 = (int)$matches[0][0];
				$chapter = substr($chapter,(int)$matches[0][1]);
/*				if (preg_match("/\\,/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {			// Допускается: запятая или <конец строки>
					$sp = $matches[0][0];
					$chapter = substr($chapter,(int)$matches[0][1]);
				} else $sp = ""; */
				$vr1 = 0;
				$vr2 = 999;
				if (preg_match("/\\:|\\,/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {	// Допускается: двоеточие, запятая или <конец строки>
					$sp = $matches[0][0];
					$chapter = substr($chapter,(int)$matches[0][1]);
					if (strcasecmp ($sp, ":") == 0) {												// Если двоеточие, то не номер стиха, а номер главы и далее стихи
						preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE);				// Должно быть число - номер стиха 
						$vr2 = (int)$matches[0][0];
						if (preg_match("/\\,/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) {	// Допускается: запятая или <конец строки>
							$sp = $matches[0][0];
							$chapter = substr($chapter,(int)$matches[0][1]);
						} else $sp = "";
					}
					else if (strcasecmp ($sp, ",") == 0) {
						$sp = $matches[0][0];
						$chapter = substr($chapter,(int)$matches[0][1]);
					} else $sp = "";
				} else $sp = "";
			} else {
				$ch2 = $ch1;
				$vr1 = 0;
				$vr2 = 999;
			}
			$verses = $verses.bg_bibrefs_printVerses ($json, $book, $chr, $ch1, $ch2, $vr1, $vr2, $type, $lang, $prll);
			$chr = $ch2;
		}
		if ($sp == "") break;
	}
	if (!$verses) return "";
	if ($type <> "quote") $verses = "<span class='".$bg_bibrefs_option['class']."_".$type."' style='display: block;'>".$verses."</span>";	
	if ($type == "book") $verses = "<h3>".bg_bibrefs_getTitle($book)."</h3>".$verses;
	else if ($type == "t_verses") $verses = bg_bibrefs_getTitle($book)."<br>".$verses;

	return $verses;
}
/*******************************************************************************
	Формирование содержания цитаты
*******************************************************************************/  
function bg_bibrefs_printVerses ($json, $book, $chr, $ch1, $ch2, $vr1, $vr2, $type, $lang, $prll='') {
	global $bg_bibrefs_option;
	global $bg_bibrefs_chapter, $bg_bibrefs_ch, $bg_bibrefs_psalm, $bg_bibrefs_ps;
	global $bg_bibrefs_url, $bg_bibrefs_bookTitle, $bg_bibrefs_shortTitle, $bg_bibrefs_bookFile;

   $bg_show_fn = get_option( 'bg_bibrefs_show_fn' );

	$shortTitle = $bg_bibrefs_shortTitle[$book];
	$verses = "";
	$cv1 = $ch1 *1000 + $vr1;
	$cv2 = $ch2 *1000 + $vr2;
	$cn_json = count($json);
	for ($i=0; $i < $cn_json; $i++) {
		$ch = (int)$json[$i]['part'];
		$vr = (int)$json[$i]['stix'];
		$cv = $ch *1000 + $vr;
		if ( $cv >= $cv1 && $cv <= $cv2) {
			if (isset($json[$i]['stix_fn'])) {
				$fn = $json[$i]['stix_fn'];
				if ($fn != '*' && $bg_show_fn != 'on') $fn="";
			} else $fn="";

			if ($type == 'book') { 																						// Тип: книга
				if ($chr != $ch) {
					if (isset($bg_bibrefs_psalm) && $book == 'Ps')
						$verses = $verses.$bg_bibrefs_psalm." ".$ch."<br>";					// Печатаем номер псалма
					else
						$verses = $verses.$bg_bibrefs_chapter." ".$ch."<br>";					// Печатаем номер главы
					$chr = $ch;
				}
				if ($json[$i]['stix'] == 0) $pointer = "";
				else $pointer = "<em>".$json[$i]['stix_n'].$fn."</em> ";													// Только номер стиха
			} else if ($type == 'verses' || $type == 't_verses') { 														// Тип: стихи или стихи с названием книг
				if ($json[$i]['stix'] == 0) $pointer = "<em>".$json[$i]['part']."</em>   ";
				else $pointer = "<em>".$json[$i]['part'].":".$json[$i]['stix_n'].$fn."</em> ";							// Номер главы : номер стиха
			} else if ($type == 'b_verses') { 																			// Тип: стихи
				if ($json[$i]['stix'] == 0) $pointer = "<em>".$shortTitle.$json[$i]['part'].$fn."</em>   ";
				else $pointer = "<em>".$shortTitle.$json[$i]['part'].":".$json[$i]['stix_n'].$fn."</em> ";				// Книга. номер главы : номер стиха
			} else {																									// Тип: цитата
				$pointer = "";																							// Ничего
			}
			$txt = trim(strip_tags($json[$i]['text']));
			if ($txt) {
				if ($json[$i]['stix'] == 0) $txt = $pointer.$txt;
				else if (isset($bg_bibrefs_psalm) && $book == 'Ps' && $json[$i]['order'] == 1) $txt = $pointer."<strong>".$txt."</strong>";
				else  $txt = $pointer.$txt;

				$verses = $verses.$txt;
				if ($type == 'quote') {$verses = $verses." ";}															// Если цитата, строку не переводим

			} 
		}
	}
	return $verses;
}

