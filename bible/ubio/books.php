<?php
	$bg_bibrefs_lang_name = 'Українська Огієнка';
	$bg_bibrefs_book_lang = 'uk';
	$bg_bibrefs_chapter = 'Розділ';
	$bg_bibrefs_ch = 'рз.';
	$bg_bibrefs_psalm = 'Псалом';
	$bg_bibrefs_ps = 'пс.';
	
	$bg_bibrefs_url = array(		// Допустимые обозначения книг Священного Писания
		// Ветхий Завет
		// Пятикнижие Моисея															
		'Gen'			=>'Gen',		//'Книга Бытия', 	
		'Бытие'		=>'Gen',					
		'Быт'			=>'Gen',					
		'Буття'		=>'Gen',					
		'Бут'			=>'Gen',					
		'1M'			=>'Gen',		
		'Ex'			=>'Ex',	 		//'Книга Исход', 			
		'Исх'			=>'Ex',	 					
		'Вихід'		=>'Ex',	 					
		'Вих'			=>'Ex',	 					
		'2М'			=>'Ex',	 					
		'Lev'			=>'Lev', 		//'Книга Левит', 		
		'Левит'		=>'Lev', 							
		'Лев'			=>'Lev', 							
		'Лв'			=>'Lev', 							
		'3М'			=>'Lev', 							
		'Num'			=>'Num', 		//'Книга Числа',	
		'Числа'		=>'Num', 						
		'Числ'		=>'Num', 						
		'Чис'			=>'Num', 						
		'Чс'			=>'Num', 						
		'4М'			=>'Num', 						
		'Deut'		=>'Deut',		//'Второзаконие',		
		'Втор'		=>'Deut',							
		'Повтор'		=>'Deut',							
		'Повт'		=>'Deut',							
		'5М'			=>'Deut',							
		// «Пророки» (Невиим) 
		'Nav'			=>'Nav', 		//'Книга Иисуса Навина',	
		'Нав'			=>'Nav', 						
		'ИсНав'		=>'Nav', 						
		'Ісус'		=>'Nav', 						
		'Єг'			=>'Nav', 						
		'Judg'		=>'Judg', 		//'Книга Судей Израилевых', 	
		'Судей'		=>'Judg', 						
		'Суддів'		=>'Judg', 						
		'Суд'			=>'Judg', 						
		'Сд'			=>'Judg', 						
		'Rth'			=>'Rth',		//'Книга Руфь',	
		'Руфь'		=>'Rth',						
		'Руф'			=>'Rth',						
		'Рут'			=>'Rth',						
		'1Sam'		=>'1Sam',		//'Первая книга Царств (Первая книга Самуила)', 						
		'1Сам'		=>'1Sam',						
		'1См'			=>'1Sam',						
		'1С'			=>'1Sam',						
		'2Sam'		=>'2Sam',		//'Вторая книга Царств (Вторая книга Самуила)', 							
		'2Сам'		=>'2Sam',						
		'2См'			=>'2Sam',						
		'2С'			=>'2Sam',						
		'1King'		=>'1King', 		//'Третья книга Царств (Первая книга Царей)', 
		'1Цар'		=>'1King', 					
		'1Царей'		=>'1King', 					
		'1Царів'		=>'1King', 					
		'1Цр'			=>'1King', 					
		'1Ц'			=>'1King', 					
		'2King'		=>'2King', 		//'Четвертая книга Царств (Вторая книга Царей)', 
		'2Цар'		=>'2King', 					
		'2Царей'		=>'2King', 					
		'2Царів'		=>'2King', 					
		'2Цр'			=>'2King', 					
		'2Ц'			=>'2King', 					
		'1Chron'		=>'1Chron',		//'Первая книга Паралипоменон (Первая книга Хроник, Первая Летопись)', 
		'1Пар'		=>'1Chron',		
		'1Хрон'		=>'1Chron',		
		'1Хр'			=>'1Chron',		
		'1Лет'		=>'1Chron',		
		'2Chron'		=>'2Chron',		//'Вторая книга Паралипоменон (Вторая книга Хроник, Вторая Летопись)', 
		'2Пар'		=>'2Chron',		
		'2Хрон'		=>'2Chron',		
		'2Хр'			=>'2Chron',		
		'2Лет'		=>'2Chron',		
		'Ezr'			=>'Ezr', 		//'Книга Ездры (Первая книга Ездры)', 
		'1Ездр'		=>'Ezr', 				
		'1Езд'		=>'Ezr', 				
		'Ездр'		=>'Ezr', 				
		'Езд'			=>'Ezr', 				
		'Ез'			=>'Ezr', 				
		'Nehem'		=>'Nehem', 		//'Книга Неемии',	
		'Неемія'		=>'Nehem', 						
		'Неем'		=>'Nehem', 						
		'Нм'			=>'Nehem', 						
		'Est'			=>'Est', 		//'Книга Есфири',  
		'Есф'			=>'Est', 							
		'Эсф'			=>'Est', 							
		'Естер'		=>'Est', 							
		'Ест'			=>'Est', 							
		'Ес'			=>'Est', 							
		// «Писания» (Ктувим)		
		'Job'			=>'Job', 		//'Книга Иова',			
		'Иов'			=>'Job', 								
		'Йов'			=>'Job', 								
		'Іов'			=>'Job',								
		'Ps'			=>'Ps',			//'Псалтирь', 	
		'Псалми'		=>'Ps',							
		'Псалт'		=>'Ps',							
		'Псал'		=>'Ps',							
		'Пс'			=>'Ps',							
		'Prov'		=>'Prov', 		//'Книга Притчей Соломоновых', 
		'Притчи'		=>'Prov', 					
		'Притч'		=>'Prov', 					
		'Прит'		=>'Prov', 					
		'Прип'		=>'Prov', 					
		'Пр'			=>'Prov', 					
		'Eccl'		=>'Eccl', 		//'Книга Екклезиаста, или Проповедника', 		
		'Еккл'		=>'Eccl', 							
		'Екк'			=>'Eccl', 							
		'Екл'			=>'Eccl', 							
		'Ек'			=>'Eccl', 							
		'Song'		=>'Song',		//'Песнь песней Соломона',		
		'Песня'		=>'Song',							
		'Песн'		=>'Song',							
		'Пісня'		=>'Song',							
		'Пісн'		=>'Song',							
		'Is'			=>'Is', 		//'Книга пророка Исайи',		
		'Исайи'		=>'Is', 							
		'Исаи'		=>'Is', 							
		'Ис'			=>'Is', 							
		'Ісая'		=>'Is', 							
		'Іс'			=>'Is', 							
		'Jer'			=>'Jer',		//'Книга пророка Иеремии',			
		'Иер'			=>'Jer',								
		'Єремія'		=>'Jer',								
		'Єрем'		=>'Jer',								
		'Єр'			=>'Jer',								
		'Lam'			=>'Lam', 		//'Книга Плач Иеремии', 	
		'Плч'			=>'Lam', 						
		'Плач'		=>'Lam', 						
		'Ezek'		=>'Ezek',		//'Книга пророка Иезекииля',		
		'Иез'			=>'Ezek',							
		'Єзек'		=>'Ezek',							
		'Єз'			=>'Ezek',							
		'Dan'			=>'Dan', 		//'Книга пророка Даниила',			
		'Даниїл'		=>'Dan', 								
		'Дан'			=>'Dan', 								
		'Днл'			=>'Dan', 								
		// Двенадцать малых пророков 
		'Hos'			=>'Hos',  		//'Книга пророка Осии', 		
		'Осии'		=>'Hos',  							
		'Осія'		=>'Hos',  							
		'Ос'			=>'Hos',  							
		'Joel'		=>'Joel', 		//'Книга пророка Иоиля',
		'Иоиль'		=>'Joel', 					
		'Иоил'		=>'Joel', 					
		'Йоїл'		=>'Joel', 					
		'Am'			=>'Am',			//'Книга пророка Амоса',	
		'Амос'		=>'Am',							
		'Амс'			=>'Am',							
		'Ам'			=>'Am',							
		'Avd'			=>'Avd', 		//'Книга пророка Авдия',			
		'Авд'			=>'Avd', 								
		'Овдій'		=>'Avd', 								
		'Овд'			=>'Avd', 								
		'Jona'		=>'Jona', 		//'Книга пророка Ионы',	
		'Иона'		=>'Jona', 						
		'Ион'			=>'Jona', 						
		'Йона'		=>'Jona', 						
		'Йон'			=>'Jona', 						
		'Mic'			=>'Mic', 		//'Книга пророка Михея',			
		'Михей'		=>'Mic', 								
		'Мих'			=>'Mic', 								
		'Мх'			=>'Mic', 								
		'Naum'		=>'Naum', 		//'Книга пророка Наума',		
		'Наум'		=>'Naum', 							
		'Habak'		=>'Habak', 		//'Книга пророка Аввакума',		
		'Аввак'		=>'Habak', 							
		'Авв'			=>'Habak', 							
		'Ав'			=>'Habak', 							
		'Sofon'		=>'Sofon', 		//'Книга пророка Софонии',					
		'Софон'		=>'Sofon', 							
		'Соф'			=>'Sofon', 							
		'Hag'			=>'Hag', 		//'Книга пророка Аггея',					
		'Агг'			=>'Hag', 							
		'Аг'			=>'Hag', 							
		'Огій'		=>'Hag', 							
		'Ог'			=>'Hag', 							
		'Zah'			=>'Zah',		//'Книга пророка Захарии',						
		'Захар'		=>'Zah',								
		'Зах'			=>'Zah',								
		'Зхр'			=>'Zah',								
		'Mal'			=>'Mal',		//'Книга пророка Малахии',						
		'Малах'		=>'Mal',								
		'Мал'			=>'Mal',								
		// Второканонические книги
		'1Mac'		=>'1Mac',		//'Первая книга Маккавейская',					
		'1Мак'		=>'1Mac',							
		'2Mac'		=>'2Mac', 		//'Вторая книга Маккавейская',					
		'2Мак'		=>'2Mac', 							
		'3Mac'		=>'3Mac', 		//'Третья книга Маккавейская',					
		'3Мак'		=>'3Mac', 							
		'Bar'			=>'Bar', 		//'Книга пророка Варуха',						
		'Варух'		=>'Bar', 								
		'Вар'			=>'Bar', 								
		'2Ezr'		=>'2Ezr',		//'Вторая книга Ездры', 				
		'2Ездр'		=>'2Ezr',						
		'2Езд'		=>'2Ezr',						
		'3Ezr'		=>'3Ezr',		//'Третья книга Ездры',				
		'3Ездр'		=>'3Ezr',						
		'3Езд'		=>'3Ezr',						
		'Judf'		=>'Judf', 		//'Книга Иудифи',			
		'Иудифь'		=>'Judf', 					
		'Иудиф'		=>'Judf', 					
		'Юдит'		=>'Judf', 					
		'pJer'		=>'pJer', 		//'Послание Иеремии',	
		'ПослИер'	=>'pJer', 			
		'ПослЄр'		=>'pJer', 			
		'Solom'		=>'Solom', 		//'Книга Премудрости Соломона',		
		'Прем'		=>'Solom', 				
		'ПремСол'	=>'Solom', 				
		'Sir'			=>'Sir', 		//'Книга Премудрости Иисуса, сына Сирахова', 				
		'Сирах'		=>'Sir', 						
		'Сир'			=>'Sir', 						
		'Tov'			=>'Tov', 		//'Книга Товита',				
		'Товит'		=>'Tov', 						
		'Тов'			=>'Tov', 						
		// Новый Завет
		// Евангилие
		'Mt'			=>'Mt', 		//'Евангелие от Матфея',				
		'Мф'			=>'Mt', 						
		'Мт'			=>'Mt', 						
		'Матфея'		=>'Mt', 						
		'Матф'		=>'Mt', 						
		'Матв'		=>'Mt', 						
		'Мтв'			=>'Mt', 	
		'Мат'			=>'Mt',					
		'Мв'			=>'Mt', 						
		'Mk'			=>'Mk', 		//'Евангелие от Марка',			
		'Марка'		=>'Mk', 					
		'Марк'		=>'Mk', 					
		'Мар'			=>'Mk', 					
		'Мр'			=>'Mk', 					
		'Мк'			=>'Mk', 					
		'Lk'			=>'Lk',			//'Евангелие от Луки',			
		'Луки'		=>'Lk',						
		'Лук'			=>'Lk',						
		'Лк'			=>'Lk',						
		'Jn'			=>'Jn',			//'Евангелие от Иоанна',				
		'Иоанна'		=>'Jn',							
		'Иоан'		=>'Jn',							
		'Ин'			=>'Jn',							
		'Іван'		=>'Jn',							
		'Ів'			=>'Jn',							
		'Ін'			=>'Jn',							
		// Деяния и послания Апостолов
		'Act'			=>'Act', 		//'Деяния святых Апостолов',				
		'Деяния'		=>'Act', 						
		'Деян'		=>'Act', 						
		'Дії'			=>'Act', 						
		'Jac'			=>'Jac', 		//'Послание Иакова',						
		'Иакова'		=>'Jac', 								
		'Иаков'		=>'Jac', 								
		'Иак'			=>'Jac', 								
		'Яков'		=>'Jac', 								
		'Як'			=>'Jac', 								
		'1Pet'		=>'1Pet',		//'Первое послание Петра', 			
		'1Петра'		=>'1Pet',					
		'1Петр'		=>'1Pet',					
		'1Пет'		=>'1Pet',					
		'2Pet'		=>'2Pet',		//'Второе послание Петра',			
		'2Петра'		=>'2Pet',					
		'2Петр'		=>'2Pet',					
		'2Пет'		=>'2Pet',					
		'1Jn'			=>'1Jn', 		//'Первое послание Иоанна'				
		'1Иоанна'	=>'1Jn', 						
		'1Иоан'		=>'1Jn', 						
		'1Ин'			=>'1Jn', 						
		'1Іван'		=>'1Jn', 						
		'1Ів'			=>'1Jn', 						
		'1Ін'			=>'1Jn', 						
		'2Jn'			=>'2Jn', 		//'Второе послание Иоанна',				
		'2Иоанна'	=>'2Jn', 						
		'2Иоан'		=>'2Jn', 						
		'2Ин'			=>'2Jn', 						
		'2Іван'		=>'2Jn', 						
		'2Ів'			=>'2Jn', 						
		'2Ін'			=>'2Jn', 						
		'3Jn'			=>'3Jn', 		//'Третье послание Иоанна',				
		'3Иоанна'	=>'3Jn', 						
		'3Иоан'		=>'3Jn', 						
		'3Ин'			=>'3Jn', 						
		'3Іван'		=>'3Jn', 						
		'3Ів'			=>'3Jn', 						
		'3Ін'			=>'3Jn', 						
		'Juda'		=>'Juda', 		//'Послание Иуды',					
		'Иуды'		=>'Juda', 							
		'Иуда'		=>'Juda', 							
		'Иуд'			=>'Juda', 							
		'Юда'			=>'Juda', 							
		'Юди'			=>'Juda', 							
		'Юд'			=>'Juda', 							
		// Послания апостола Павла
		'Rom'			=>'Rom', 		//'Послание апостола Павла к Римлянам',				
		'Римл'		=>'Rom', 						
		'Рим'			=>'Rom', 						
		'1Cor'		=>'1Cor', 		//'Первое послание апостола Павла к Коринфянам',					
		'1Кор'		=>'1Cor', 							
		'2Cor'		=>'2Cor',		//'Второе послание апостола Павла к Коринфянам',					
		'2Кор'		=>'2Cor',							
		'Gal'			=>'Gal', 		//'Послание апостола Павла к Галатам',						
		'Галат'		=>'Gal', 								
		'Гал'			=>'Gal', 								
		'Eph'			=>'Eph', 		//'Послание апостола Павла к Ефесянам'					
		'Ефесян'		=>'Eph', 							
		'Ефес'		=>'Eph', 							
		'Еф'			=>'Eph', 							
		'Phil'		=>'Phil',  		//'Послание апостола Павла к Филиппийцам',		
		'Филип'		=>'Phil',  				
		'Фил'			=>'Phil',  				
		'Флп'			=>'Phil',  				
		'Col'			=>'Col',		//'Послание апостола Павла к Колоссянам',						
		'Колос'		=>'Col',								
		'Кол'			=>'Col',								
		'1Thes'		=>'1Thes', 		//'Первое послание апостола Павла к Фессалоникийцам (Солунянам)',			
		'1Солун'		=>'1Thes', 					
		'1Сол'		=>'1Thes', 					
		'1Фес'		=>'1Thes', 					
		'2Thes'		=>'2Thes', 		//'Второе послание апостола Павла к Фессалоникийцам (Солунянам)',			
		'2Солун'		=>'2Thes', 					
		'2Сол'		=>'2Thes', 					
		'2Фес'		=>'2Thes', 					
		'1Tim'		=>'1Tim', 		//'Первое послание апостола Павла к Тимофею', 					
		'1Тимоф'		=>'1Tim', 							
		'1Тим'		=>'1Tim', 							
		'2Tim'		=>'2Tim',		//'Второе послание апостола Павла к Тимофею',					
		'2Тимоф'		=>'2Tim',							
		'2Тим'		=>'2Tim',							
		'Tit'			=>'Tit', 		//'Послание апостола Павла к Титу', 						
		'Титу'		=>'Tit', 								
		'Тита'		=>'Tit', 								
		'Тит'			=>'Tit', 								
		'Phlm'		=>'Phlm', 		//'Послание апостола Павла к Филимону', 				
		'Филим'		=>'Phlm', 						
		'Флм'			=>'Phlm', 						
		'Hebr'		=>'Hebr', 		//'Послание апостола Павла к Евреям',					
		'Евреям'		=>'Hebr', 							
		'Евр'			=>'Hebr', 							
		'Євреїв'		=>'Hebr', 							
		'Євр'			=>'Hebr', 							
		'Apok'		=>'Apok',		//'Откровение Иоанна Богослова (Апокалипсис)'				
		'Откр'		=>'Apok',					
		'Отк'			=>'Apok',					
		'Апок'		=>'Apok',					
		'Об\'явл'	=>'Apok',					
		'Об'			=>'Apok'
	);				

	$bg_bibrefs_bookTitle = array(			// Полные названия Книг Священного Писания
		'Gen' 		=>'Буття', 
		'Ex' 			=>'Вихід', 
		'Lev' 		=>'Левит', 
		'Num' 		=>'Числа', 
		'Deut' 		=>'Повторення Закону',
		'Nav' 		=>'Iсус Навин',
		'Judg'		=>'Книга Суддів', 
		'Rth' 		=>'Рут',
		'1Sam' 		=>'1-а Самуїлова', 
		'2Sam' 		=>'2-а Самуїлова', 
		'1King'	 	=>'1-а царiв', 
		'2King' 		=>'2-а царiв',
		'1Chron' 	=>'1-а хронiки', 
		'2Chron' 	=>'2-а хронiки', 
		'Ezr' 		=>'Ездра', 
		'Nehem' 		=>'Неемія', 
		'Est' 		=>'Естер',  
		'Job' 		=>'Йов',
		'Ps' 			=>'Псалми', 
		'Prov' 		=>'Приповiстi', 
		'Eccl' 		=>'Екклезiяст', 
		'Song' 		=>'Пiсня над пiснями',
		'Is' 			=>'Iсая', 
		'Jer' 		=>'Єремiя',
		'Lam' 		=>'Плач Єремiї', 
		'Ezek'	 	=>'Єзекiїль',
		'Dan' 		=>'Даниїл', 
		'Hos' 		=>'Осiя', 
		'Joel'	 	=>'Йоїл',
		'Am' 			=>'Амос', 
		'Avd' 		=>'Овдiй', 
		'Jona' 		=>'Йона',
		'Mic' 		=>'Михей', 
		'Naum' 		=>'Наум',
		'Habak' 		=>'Авакум', 
		'Sofon' 		=>'Софонiя', 
		'Hag' 		=>'Огiй', 
		'Zah' 		=>'Захарiя',
		'Mal' 		=>'Малахiї',
		'Mt' 			=>'Вiд Матвiя',
		'Mk' 			=>'Вiд Марка', 
		'Lk' 			=>'Вiд Луки', 
		'Jn' 			=>'Вiд Iвана', 
		'Act' 		=>'Дiї', 
		'Jac' 		=>'Якова', 
		'1Pet'	 	=>'1-е Петра', 
		'2Pet'	 	=>'2-е Петра',	
		'1Jn' 		=>'1-е Iвана', 
		'2Jn' 		=>'2-е Iвана', 
		'3Jn' 		=>'3-е Iвана',
		'Juda'	 	=>'Юда', 
		'Rom' 		=>'До римлян', 
		'1Cor' 		=>'1-е до коринтян', 
		'2Cor' 		=>'2-е до коринтян',
		'Gal'	 		=>'До галатiв', 
		'Eph' 		=>'До ефесян', 
		'Phil' 		=>'До филип\'ян', 
		'Col' 		=>'До колоссян',
		'1Thes' 		=>'1-е до солунян',
		'2Thes' 		=>'2-е до солунян',  
		'1Tim' 		=>'1-е Тимофiю', 
		'2Tim'	 	=>'2-е Тимофiю',
		'Tit' 		=>'До Тита', 
		'Phlm'	 	=>'До Филимона', 
		'Hebr'	 	=>'До євреїв', 
		'Apok' 		=>'Об\'явлення'
	);

	$bg_bibrefs_shortTitle = array(			// Стандартные обозначения книг Священного Писания
		// Ветхий Завет
		// Пятикнижие Моисея															
		'Gen'			=>"Бут.", 
		'Ex'			=>"Вих.", 
		'Lev'			=>"Лев.",
		'Num'			=>"Чис.",
		'Deut'		=>"Повт.",
		// «Пророки» (Невиим) 
		'Nav'			=>"Ісус.",
		'Judg'		=>"Суд.",
		'Rth'			=>"Рут.",
		'1Sam'		=>"1Сам.",
		'2Sam'		=>"2Сам.",
		'1King'		=>"1Царів.",
		'2King'		=>"2Царів.",
		'1Chron'		=>"1Хрон.",
		'2Chron'		=>"2Хрон.",
		'Ezr'			=>"Ездр.",
		'Nehem'		=>"Неем.",
		'Est'			=>"Ест.",
		// «Писания» (Ктувим)
		'Job'			=>"Йов.",
		'Ps'			=>"Пс.",
		'Prov'		=>"Прит.", 
		'Eccl'		=>"Еккл.",
		'Song'		=>"Пісн.",
		'Is'			=>"Іс.",
		'Jer'			=>"Єр.",
		'Lam'			=>"Плч.",
		'Ezek'		=>"Єз.",
		'Dan'			=>"Дан.",	
		// Двенадцать малых пророков 
		'Hos'			=>"Ос.",
		'Joel'		=>"Йоїл.",
		'Am'			=>"Ам.",
		'Avd'			=>"Овд.",
		'Jona'		=>"Йон.",
		'Mic'			=>"Мих.",
		'Naum'		=>"Наум.",
		'Habak'		=>"Авв.",
		'Sofon'		=>"Соф.",
		'Hag'			=>"Ог.",
		'Zah'			=>"Зах.",
		'Mal'			=>"Мал.",
		// Второканонические книги
		'1Mac'		=>"1Мак.",
		'2Mac'		=>"2Мак.",
		'3Mac'		=>"3Мак.",
		'Bar'			=>"Вар.",
		'2Ezr'		=>"2Езд.",
		'3Ezr'		=>"3Езд.",
		'Judf'		=>"Юдит.",
		'pJer'		=>"ПослИер.",
		'Solom'		=>"Прем.",
		'Sir'			=>"Сир.",
		'Tov'			=>"Тов.",
		// Новый Завет
		// Евангилие
		'Mt'			=>"Мв.",
		'Mk'			=>"Мк.",
		'Lk'			=>"Лк.",
		'Jn'			=>"Ін.",
		// Деяния и послания Апостолов
		'Act'			=>"Дії.",
		'Jac'			=>"Як.",
		'1Pet'		=>"1Пет.",
		'2Pet'		=>"2Пет.",
		'1Jn'			=>"1Ін.", 
		'2Jn'			=>"2Ін.",
		'3Jn'			=>"3Ін.",
		'Juda'		=>"Юд.",
		// Послания апостола Павла
		'Rom'			=>"Рим.",
		'1Cor'		=>"1Кор.",
		'2Cor'		=>"2Кор.",
		'Gal'			=>"Гал.",
		'Eph'			=>"Еф.",
		'Phil'		=>"Флп.",
		'Col'			=>"Кол.",
		'1Thes'		=>"1Сол.",
		'2Thes'		=>"2Сол.",
		'1Tim'		=>"1Тим.",
		'2Tim'		=>"2Тим.",
		'Tit'		=>"Тит.",
		'Phlm'		=>"Флм.",
		'Hebr'		=>"Євр.",
		'Apok'		=>"Об.");

	$bg_bibrefs_bookFile = array(						// Таблица названий файлов книг
		// Ветхий Завет
		// Пятикнижие Моисея
		'Gen'	 		=>'ubio/gen',							//'Книга Бытия', 
		'Ex'	 		=>'ubio/ex',							//'Книга Исход', 
		'Lev'	 		=>'ubio/lev',							//'Книга Левит', 
		'Num'	 		=>'ubio/num',							//'Книга Числа', 
		'Deut'	 	=>'ubio/deu',							//'Второзаконие',
		// «Пророки» (Невиим) 
		'Nav'	 		=>'ubio/nav',							//'Книга Иисуса Навина',
		'Judg'		=>'ubio/sud',							//'Книга Судей Израилевых', 
		'Rth'	 		=>'ubio/ruf',							//'Книга Руфь',
		'1Sam'	 	=>'ubio/king1',						//'Первая книга Царств (Первая книга Самуила)', 
		'2Sam'	 	=>'ubio/king2',						//'Вторая книга Царств (Вторая книга Самуила)', 
		'1King' 		=>'ubio/king3',						//'Третья книга Царств (Первая книга Царей)', 
		'2King' 		=>'ubio/king4',						//'Четвёртая книга Царств (Вторая книга Царей)',
		'1Chron' 	=>'ubio/para1',						//'Первая книга Паралипоменон (Первая книга Хроник, Первая Летопись)', 
		'2Chron' 	=>'ubio/para2',						//'Вторая книга Паралипоменон (Вторая книга Хроник, Вторая Летопись)', 
		'Ezr'	 		=>'ubio/ezr1',						//'Книга Ездры (Первая книга Ездры)', 
		'Nehem' 		=>'ubio/nee',							//'Книга Неемии', 
		'Est'	 		=>'ubio/esf',							//'Книга Есфири',  
		// «Писания» (Ктувим)
		'Job'	 		=>'ubio/iov',							//'Книга Иова',
		'Ps' 			=>'ubio/ps',							//'Псалтирь', 
		'Prov'	 	=>'ubio/prov',						//'Книга Притчей Соломоновых', 
		'Eccl'	 	=>'ubio/eccl',						//'Книга Екклезиаста, или Проповедника', 
		'Song'	 	=>'ubio/song',						//'Песнь песней Соломона',

		'Is' 			=>'ubio/isa',							//'Книга пророка Исайи', 
		'Jer' 		=>'ubio/jer',							//'Книга пророка Иеремии',
		'Lam' 		=>'ubio/lam',							//'Книга Плач Иеремии', 
		'Ezek'	 	=>'ubio/eze',							//'Книга пророка Иезекииля',
		'Dan' 		=>'ubio/dan',							//'Книга пророка Даниила', 
		// Двенадцать малых пророков 
		'Hos' 		=>'ubio/hos',							//'Книга пророка Осии', 
		'Joel'	 	=>'ubio/joe',							//'Книга пророка Иоиля',
		'Am' 			=>'ubio/am',							//'Книга пророка Амоса', 
		'Avd' 		=>'ubio/avd',							//'Книга пророка Авдия', 
		'Jona'	 	=>'ubio/jona',						//'Книга пророка Ионы',
		'Mic' 		=>'ubio/mih',							//'Книга пророка Михея', 
		'Naum' 		=>'ubio/nau',							//'Книга пророка Наума',
		'Habak' 		=>'ubio/avv',							//'Книга пророка Аввакума', 
		'Sofon' 		=>'ubio/sof',							//'Книга пророка Софонии', 
		'Hag' 		=>'ubio/agg',							//'Книга пророка Аггея', 
		'Zah' 		=>'ubio/zah',							//'Книга пророка Захарии',
		'Mal' 		=>'ubio/mal',							//'Книга пророка Малахии',
		// Новый Завет
		// Евангилие
		'Mt' 			=>'ubio/mf',							//'Евангелие от Матфея',
		'Mk' 			=>'ubio/mk',							//'Евангелие от Марка', 
		'Lk' 			=>'ubio/lk',							//'Евангелие от Луки', 
		'Jn' 			=>'ubio/jn',							//'Евангелие от Иоанна', 
		// Деяния и послания Апостолов
		'Act' 		=>'ubio/act',							//'Деяния святых Апостолов', 
		'Jac'	 		=>'ubio/jak',							//'Послание Иакова', 
		'1Pet'	 	=>'ubio/pe1',							//'Первое послание Петра', 
		'2Pet'	 	=>'ubio/pe2',							//'Второе послание Петра',	
		'1Jn'	 		=>'ubio/jn1',							//'Первое послание Иоанна', 
		'2Jn'	 		=>'ubio/jn2',							//'Второе послание Иоанна', 
		'3Jn'	 		=>'ubio/jn3',							//'Третье послание Иоанна',
		'Juda'	 	=>'ubio/jud',							//'Послание Иуды', 
		// Послания апостола Павла
		'Rom' 		=>'ubio/rom',							//'Послание апостола Павла к Римлянам', 
		'1Cor'	 	=>'ubio/co1',							//'Первое послание апостола Павла к Коринфянам', 
		'2Cor'	 	=>'ubio/co2',							//'Второе послание апостола Павла к Коринфянам',
		'Gal' 		=>'ubio/gal',							//'Послание апостола Павла к Галатам', 
		'Eph' 		=>'ubio/eph',							//'Послание апостола Павла к Ефесянам', 
		'Phil'	 	=>'ubio/flp',							//'Послание апостола Павла к Филиппийцам', 
		'Col' 		=>'ubio/col',							//'Послание апостола Павла к Колоссянам',
		'1Thes'	 	=>'ubio/fe1',							//'Первое послание апостола Павла к Фессалоникийцам (Солунянам)',
		'2Thes'	 	=>'ubio/fe2',							//'Второе послание апостола Павла к Фессалоникийцам (Солунянам)',  
		'1Tim' 		=>'ubio/ti1',							//'Первое послание апостола Павла к Тимофею', 
		'2Tim' 		=>'ubio/ti2',							//'Второе послание апостола Павла к Тимофею',
		'Tit' 		=>'ubio/tit',							//'Послание апостола Павла к Титу', 
		'Phlm'	 	=>'ubio/flm',							//'Послание апостола Павла к Филимону', 
		'Hebr'	 	=>'ubio/heb',							//'Послание апостола Павла к Евреям', 
		'Apok'	 	=>'ubio/rev'							//'Откровение Иоанна Богослова (Апокалипсис)'
	);						
		