<?php
	$bg_bibrefs_lang_name = 'Українська Турконяка';
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

	$bg_bibrefs_bookTitle = array(
		'Gen' 		=>'Буття', 
		'Ex' 			=>'Вихід', 
		'Lev' 		=>'Левіт', 
		'Num' 		=>'Числа', 
		'Deut' 		=>'Повторення Закону',
		'Nav' 		=>'Ісус Навин',
		'Judg'		=>'Суддів', 
		'Rth' 		=>'Рут',
		'1Sam' 		=>'1-ша Самуїлова', 
		'2Sam' 		=>'2-га Самуїлова', 
		'1King'	 	=>'1-ша царів', 
		'2King' 		=>'2-га царів',
		'1Chron' 	=>'1-ша хроніки', 
		'2Chron' 	=>'2-га хроніки', 
		'Ezr' 		=>'Ездри', 
		'Nehem' 		=>'Неемія', 
		'Est' 		=>'Естер',  
		'Job' 		=>'Йов',
		'Ps' 			=>'Псалми', 
		'Prov' 		=>'Приповісті', 
		'Eccl' 		=>'Екклезіяст', 
		'Song' 		=>'Пісня над піснями',
		'Is' 			=>'Ісая', 
		'Jer' 		=>'Єремія',
		'Lam' 		=>'Плач Єремії', 
		'Ezek'	 	=>'Єзекіїль',
		'Dan' 		=>'Даниїл', 
		'Hos' 		=>'Осія', 
		'Joel'	 	=>'Йоіл',
		'Am' 			=>'Амос', 
		'Avd' 		=>'Авдій', 
		'Jona' 		=>'Йона',
		'Mic' 		=>'Міхей', 
		'Naum' 		=>'Наум',
		'Habak' 		=>'Авакум', 
		'Sofon' 		=>'Софонія', 
		'Hag' 		=>'Огій', 
		'Zah' 		=>'Захарія',
		'Mal' 		=>'Малахії',
		'Mt' 			=>'Матвія',
		'Mk' 			=>'Маркам', 
		'Lk' 			=>'Луки', 
		'Jn' 			=>'Івана', 
		'Act' 		=>'Дії апостолів', 
		'Jac' 		=>'Якова', 
		'1Pet'	 	=>'1-ше Петра', 
		'2Pet'	 	=>'2-ге Петра',	
		'1Jn' 		=>'1-ше Івана', 
		'2Jn' 		=>'2-ге Івана', 
		'3Jn' 		=>'3-тє Івана',
		'Juda'	 	=>'Юди', 
		'Rom' 		=>'До римлян', 
		'1Cor' 		=>'1-ше до коринтян', 
		'2Cor' 		=>'2-ге до коринтян',
		'Gal'	 		=>'До галатів', 
		'Eph' 		=>'До ефесян', 
		'Phil' 		=>'До филип’ян', 
		'Col' 		=>'До колосян',
		'1Thes' 		=>'1-ше до солунян',
		'2Thes' 		=>'2-ге до солунян',  
		'1Tim' 		=>'1-ше до Тимофія', 
		'2Tim'	 	=>'2-ге до Тимофія',
		'Tit' 		=>'До Тита', 
		'Phlm'	 	=>'До Филимона', 
		'Hebr'	 	=>'До євреїв', 
		'Apok' 		=>'Об’явлення'
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
		'Gen'	 		=>'tub/gen',							//'Книга Бытия', 
		'Ex'	 		=>'tub/ex',							//'Книга Исход', 
		'Lev'	 		=>'tub/lev',							//'Книга Левит', 
		'Num'	 		=>'tub/num',							//'Книга Числа', 
		'Deut'	 	=>'tub/deu',							//'Второзаконие',
		// «Пророки» (Невиим) 
		'Nav'	 		=>'tub/nav',							//'Книга Иисуса Навина',
		'Judg'		=>'tub/sud',							//'Книга Судей Израилевых', 
		'Rth'	 		=>'tub/ruf',							//'Книга Руфь',
		'1Sam'	 	=>'tub/king1',						//'Первая книга Царств (Первая книга Самуила)', 
		'2Sam'	 	=>'tub/king2',						//'Вторая книга Царств (Вторая книга Самуила)', 
		'1King' 		=>'tub/king3',						//'Третья книга Царств (Первая книга Царей)', 
		'2King' 		=>'tub/king4',						//'Четвёртая книга Царств (Вторая книга Царей)',
		'1Chron' 	=>'tub/para1',						//'Первая книга Паралипоменон (Первая книга Хроник, Первая Летопись)', 
		'2Chron' 	=>'tub/para2',						//'Вторая книга Паралипоменон (Вторая книга Хроник, Вторая Летопись)', 
		'Ezr'	 		=>'tub/ezr1',						//'Книга Ездры (Первая книга Ездры)', 
		'Nehem' 		=>'tub/nee',							//'Книга Неемии', 
		'Est'	 		=>'tub/esf',							//'Книга Есфири',  
		// «Писания» (Ктувим)
		'Job'	 		=>'tub/iov',							//'Книга Иова',
		'Ps' 			=>'tub/ps',							//'Псалтирь', 
		'Prov'	 	=>'tub/prov',						//'Книга Притчей Соломоновых', 
		'Eccl'	 	=>'tub/eccl',						//'Книга Екклезиаста, или Проповедника', 
		'Song'	 	=>'tub/song',						//'Песнь песней Соломона',

		'Is' 			=>'tub/isa',							//'Книга пророка Исайи', 
		'Jer' 		=>'tub/jer',							//'Книга пророка Иеремии',
		'Lam' 		=>'tub/lam',							//'Книга Плач Иеремии', 
		'Ezek'	 	=>'tub/eze',							//'Книга пророка Иезекииля',
		'Dan' 		=>'tub/dan',							//'Книга пророка Даниила', 
		// Двенадцать малых пророков 
		'Hos' 		=>'tub/hos',							//'Книга пророка Осии', 
		'Joel'	 	=>'tub/joe',							//'Книга пророка Иоиля',
		'Am' 			=>'tub/am',							//'Книга пророка Амоса', 
		'Avd' 		=>'tub/avd',							//'Книга пророка Авдия', 
		'Jona'	 	=>'tub/jona',						//'Книга пророка Ионы',
		'Mic' 		=>'tub/mih',							//'Книга пророка Михея', 
		'Naum' 		=>'tub/nau',							//'Книга пророка Наума',
		'Habak' 		=>'tub/avv',							//'Книга пророка Аввакума', 
		'Sofon' 		=>'tub/sof',							//'Книга пророка Софонии', 
		'Hag' 		=>'tub/agg',							//'Книга пророка Аггея', 
		'Zah' 		=>'tub/zah',							//'Книга пророка Захарии',
		'Mal' 		=>'tub/mal',							//'Книга пророка Малахии',
		// Новый Завет
		// Евангилие
		'Mt' 			=>'tub/mf',							//'Евангелие от Матфея',
		'Mk' 			=>'tub/mk',							//'Евангелие от Марка', 
		'Lk' 			=>'tub/lk',							//'Евангелие от Луки', 
		'Jn' 			=>'tub/jn',							//'Евангелие от Иоанна', 
		// Деяния и послания Апостолов
		'Act' 		=>'tub/act',							//'Деяния святых Апостолов', 
		'Jac'	 		=>'tub/jak',							//'Послание Иакова', 
		'1Pet'	 	=>'tub/pe1',							//'Первое послание Петра', 
		'2Pet'	 	=>'tub/pe2',							//'Второе послание Петра',	
		'1Jn'	 		=>'tub/jn1',							//'Первое послание Иоанна', 
		'2Jn'	 		=>'tub/jn2',							//'Второе послание Иоанна', 
		'3Jn'	 		=>'tub/jn3',							//'Третье послание Иоанна',
		'Juda'	 	=>'tub/jud',							//'Послание Иуды', 
		// Послания апостола Павла
		'Rom' 		=>'tub/rom',							//'Послание апостола Павла к Римлянам', 
		'1Cor'	 	=>'tub/co1',							//'Первое послание апостола Павла к Коринфянам', 
		'2Cor'	 	=>'tub/co2',							//'Второе послание апостола Павла к Коринфянам',
		'Gal' 		=>'tub/gal',							//'Послание апостола Павла к Галатам', 
		'Eph' 		=>'tub/eph',							//'Послание апостола Павла к Ефесянам', 
		'Phil'	 	=>'tub/flp',							//'Послание апостола Павла к Филиппийцам', 
		'Col' 		=>'tub/col',							//'Послание апостола Павла к Колоссянам',
		'1Thes'	 	=>'tub/fe1',							//'Первое послание апостола Павла к Фессалоникийцам (Солунянам)',
		'2Thes'	 	=>'tub/fe2',							//'Второе послание апостола Павла к Фессалоникийцам (Солунянам)',  
		'1Tim' 		=>'tub/ti1',							//'Первое послание апостола Павла к Тимофею', 
		'2Tim' 		=>'tub/ti2',							//'Второе послание апостола Павла к Тимофею',
		'Tit' 		=>'tub/tit',							//'Послание апостола Павла к Титу', 
		'Phlm'	 	=>'tub/flm',							//'Послание апостола Павла к Филимону', 
		'Hebr'	 	=>'tub/heb',							//'Послание апостола Павла к Евреям', 
		'Apok'	 	=>'tub/rev'							//'Откровение Иоанна Богослова (Апокалипсис)'
	);						
		