<?php
/*******************************************************************************
   Создание контента цитаты 
   Вызывает biblerefs_printVerses() - см. ниже
*******************************************************************************/  
function biblerefs_getQuotes($book, $chapter, $type, $lang, $prll='') {
	global $biblerefs_option;
	global $biblerefs_chapter, $biblerefs_ch, $biblerefs_psalm, $biblerefs_ps;
	global $biblerefs_url, $biblerefs_bookTitle, $biblerefs_shortTitle, $biblerefs_bookFile;
	$lang = include_books($lang);

	// error_log( print_r($lang, true) );



/*******************************************************************************
   Преобразование обозначения книги из формата azbyka.ru в формат patriarhia.ru
   чтение и преобразование файла книги
*******************************************************************************/  
	if (!$book) return "";
	if (!$biblerefs_bookFile[$book]) return "";


	// Имя файла книги
	$book_file = 'bible/'.$biblerefs_bookFile[$book];										

	// получаем файл
	$upload_dir = wp_upload_dir();
	$path = $upload_dir['basedir'].'/'.$book_file;
	$url = $upload_dir['baseurl'].'/'.$book_file;



	// Получаем данные из файла	
	$code = false;

	// Попытка1. Если данные не получены попробуем применить file_get_contents()
	if ($biblerefs_option['fgc'] == 'on' && function_exists('file_get_contents')) {		
		$code = file_get_contents($path);		
	}

	// Попытка 2. Если данные опять не получены попробуем применить fopen() 
	if ($biblerefs_option['fopen'] == 'on' && !$code) {									
		$ch=fopen($path, "r" );// Открываем файл для чтения
		if($ch)
		{
			while (!feof($ch))	{
				$code .= fread($ch, 2097152);// загрузка текста (не более 2097152 байт)
			}
			fclose($ch);// Закрываем файл
		}
	}

	// Попытка3. Если установлен cURL
	if ($biblerefs_option['curl'] == 'on' && function_exists('curl_init') && !$code) {						
		$ch = curl_init($url);// создание нового ресурса cURL
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// возврат результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер
		$code = curl_exec($ch);// загрузка текста
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);										
		if ($httpCode != '200') $code = false;// Проверка на код http 200
		curl_close($ch);// завершение сеанса и освобождение ресурсов
	} 

	if (!$code) return "";// Увы. Паранойя хостера достигла апогея. Файл не прочитан или ошибка


	// Преобразовать полученный json в массив
	$json = json_decode($code, true);		
	
	
/*******************************************************************************
Разбор ссылки и формирование текста стихов Библии
  
*******************************************************************************/  

	$verses = "";

	
	$jj = 0;
	$chr = 0; // Предыдущая глава

	while (preg_match("/\\d+/u", $chapter, $matches, PREG_OFFSET_CAPTURE)) { // Должно быть число - номер главы 
		$jj++;																					// Защита от зацикливания (не более 10 циклов)
		if ($jj > 30) return "***";
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
				if ($ii >30) return "***";
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

					// получаем стихи (отдельно для каждого диапазона, напрриме - Пс. 1,1; 2,1-5; 3,1 - будет вызвано 3 раза для каждого диапазона: 1 - Пс.1,1  2 - Пс.2,1-5 ....)
					// заголовок диапазона
					$range_title = '<div class="biblerefs_book_title">'.biblerefs_getTitle($book).' '.$ch1;
					if ($vr1 != $vr2) $range_title .= ':'.$vr1.'-'.$vr2; else $range_title .= ':'.$vr1;
					$range_title .= '</div>';

					$verses = $verses.$range_title.biblerefs_printVerses ($json, $book, $chr, $ch1, $ch2, $vr1, $vr2, $type, $lang, $prll).'<br>';

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

			
			// получаем стихи (глава полностью)
			$range_title = '<div class="biblerefs_book_title">'.biblerefs_getTitle($book).' '.$ch1.'</div>';

			$verses = $verses.$range_title.biblerefs_printVerses ($json, $book, $chr, $ch1, $ch2, $vr1, $vr2, $type, $lang, $prll);

			$chr = $ch2;
		}
		if ($sp == "") break;
	}

	


	if (!$verses) return "";


	return $verses;
}
/*******************************************************************************
	Формирование содержания цитаты
*******************************************************************************/  
function biblerefs_printVerses ($json, $book, $chr, $ch1, $ch2, $vr1, $vr2, $type, $lang, $prll='') {
	global $biblerefs_option;
	global $biblerefs_chapter, $biblerefs_ch, $biblerefs_psalm, $biblerefs_ps;
	global $biblerefs_url, $biblerefs_bookTitle, $biblerefs_shortTitle, $biblerefs_bookFile;

	// $json - книга 
	// $book - имя книги (Ps, Lk, Mt) 
	// $chr - количество глав в сниппете 
	// $ch1 - первая глава из диапазона
	// $ch2 - последняя глава из диапазона
	// $vr1 - первый стих из диапазона 
	// $vr2 - последний стих из диапазона 
	// $type - книга 
	// $lang - язык (SYNO, UBIO, HOM...) 





   // $bg_show_fn = get_option( 'biblerefs_show_fn' );

	$shortTitle = $biblerefs_shortTitle[$book];
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
				// if ($fn != '*' && $bg_show_fn != 'on') $fn="";
			} else {
				$fn="";
			}

			// номер главы и стиха
			if ( $type == 't_verses') { 
				if ($json[$i]['stix'] == 0) $pointer = "<em>".$json[$i]['part']."</em>   "; // непонятно но Есфирь 0 стих в первой главе
				else $pointer = "<em>".$json[$i]['part'].":".$json[$i]['stix_n'].$fn."</em> "; // Номер главы : номер стиха
			}  else { 
				$pointer = "";
			}

			// текст стиха
			$txt = trim(strip_tags($json[$i]['text'])); 

			// error_log( print_r($txt, true) );

			if ($txt) {
				if ($json[$i]['stix'] == 0) $txt = $pointer.$txt;
				// зачем-то первые стихи псалмов подсвечены жирным
				//else if (isset($biblerefs_psalm) && $book == 'Ps' && $json[$i]['order'] == 1) $txt = $pointer."<strong>".$txt."</strong>";
				else  $txt = $pointer.$txt;

				$verses = $verses.$txt.'<br>'; // каждый стих с новой строки

			} 
		}
	}
	return $verses;
}

