<?php 
/******************************************************************************************
	Страница настроек
    отображает содержимое страницы для подменю Bible References
*******************************************************************************************/
function biblerefs_options_page() {
// http://azbyka.ru/biblia/?Lk.4:25-5:13,6:1-13&crgli&rus&num=cr

	$active_tab = 'settings';
	if( isset( $_GET[ 'tab' ] ) ) $active_tab = $_GET[ 'tab' ];
	
    // имена опций и полей
	$biblerefs_site = 'biblerefs_site';				// Имя ссылки
	
   //  $c_lang_name = 'biblerefs_c_lang';					// Церковно-славянский
   //  $r_lang_name = 'biblerefs_r_lang';					// Русский
   //  $g_lang_name = 'biblerefs_g_lang';					// Греческий
   //  $l_lang_name = 'biblerefs_l_lang';					// Латинский
   //  $i_lang_name = 'biblerefs_i_lang';					// Иврит
   //  $c_font_name = 'biblerefs_c_font';					// Шрифт для церковно-славянского текста

	$biblerefs_page = 'biblerefs_page';				// Ссылка на предварительно созданную страницу для вывода текста Библии

	$bg_verses_lang = 'biblerefs_verses_lang';			// Язык стихов из Библии во всплывающей подсказке
   //  $bg_show_fn = 'biblerefs_show_fn';					// Отображать оригинальные номера стихов

	$bg_headers = 'biblerefs_headers';					// Подсвечивать ссылки в заголовках H1-H6
	$bg_interpret = 'biblerefs_interpret';				// Включить ссылки на толкование Священного Писания
	$bg_parallel = 'biblerefs_parallel';				// Включить ссылки на паралельные места Священного Писания

	$bg_norm_refs = 'biblerefs_norm_refs';				// Преобразовывать ссылки к нормализованному виду
	// $bg_verses_name = 'biblerefs_show_verses';			// Отображать стихи из Библии во всплывающей подсказке

    $bg_perm_dot = 'biblerefs_dot';					// Разрешить отсутствие точки после обозначения книги
    $bg_perm_romeh = 'biblerefs_romeh';				// Разрешить Римские цифры
    $bg_perm_sepc = 'biblerefs_sepc';					// Разрешить запятую, как разделитеть между главой и стихами (западная традиция)
	$bg_strip_space = 'biblerefs_strip_space';			// Удалять пробелы в обозначениях книг, начинающихся с цифр
	$bg_perm_exceptions = 'biblerefs_exceptions';		// Словосочетания, не являющиеся ссылками на Библию
	
	$bg_curl_name = 'biblerefs_curl';					// Чтение файлов Библии с помощью cURL
	$bg_fgc_name = 'biblerefs_fgc';					// Чтение файлов Библии с помощью file_get_contents()
	$bg_fopen_name = 'biblerefs_fopen';				// Чтение файлов Библии с помощью fopen()
	
	// $biblerefs_pload = 'biblerefs_preload';			// Предварительно загружать стихи из Библии в всплывающие подсказки - до создания строницы (php)
	// $biblerefs_preq = 'biblerefs_prereq';				// Предварительно загружать стихи из Библии в всплывающие подсказки - после создания страницы (ajax)
	
	$biblerefs_maxtime = "biblerefs_maxtime";			// Максимальное время работы скрипта

    $biblerefs_ajaxurl = "biblerefs_ajaxurl";			// Внешний AJAX Proxy
	$bg_content = 'biblerefs_content';					// Контейнер, внутри которого будут отображаться подсказки
	$links_class = 'biblerefs_class';					// CSS класс для ссылок на Библию
	// $bg_refs_file = 'biblerefs_refs_file';				// Пользовательский файл цитат из Библии
	
	$biblerefs_debug_name = 'biblerefs_debug';		// Включить запись в лог
	
    $hidden_field_name = 'biblerefs_submit_hidden';	// Скрытое поле для проверки обновления информацции в форме
	
	biblerefs_options_ini (); 			// Параметры по умолчанию
	
    // Читаем существующие значения опций из базы данных
    $biblerefs_site_val = get_option( $biblerefs_site );
	
   //  $c_lang_val = get_option( $c_lang_name );
   //  $r_lang_val = get_option( $r_lang_name );
   //  $g_lang_val = get_option( $g_lang_name );
   //  $l_lang_val = get_option( $l_lang_name );
   //  $i_lang_val = get_option( $i_lang_name );
   //  $font_val = get_option( $c_font_name );

    $biblerefs_page_val = get_option( $biblerefs_page );
	
    $bg_verses_lang_val = get_option( $bg_verses_lang );
   //  $bg_show_fn_val = get_option( $bg_show_fn );

    $bg_headers_val = get_option( $bg_headers );
    $bg_interpret_val = get_option( $bg_interpret );
    $bg_parallel_val = get_option( $bg_parallel );

    $bg_norm_refs_val = get_option( $bg_norm_refs );
   //  $bg_verses_val = get_option( $bg_verses_name );

    $bg_perm_dot_val = get_option( $bg_perm_dot );
    $bg_perm_romeh_val = get_option( $bg_perm_romeh );
    $bg_perm_sepc_val = get_option( $bg_perm_sepc );
    $bg_strip_space_val = get_option( $bg_strip_space );
    $bg_perm_exceptions_val = get_option( $bg_perm_exceptions );

    $bg_curl_val = get_option( $bg_curl_name );
    $bg_fgc_val = get_option( $bg_fgc_name );
    $bg_fopen_val = get_option( $bg_fopen_name );

   //  $biblerefs_pload_val = get_option( $biblerefs_pload );
	// $biblerefs_preq_val = get_option( $biblerefs_preq );
	
	$biblerefs_maxtime_val = (int) get_option($biblerefs_maxtime);

	$biblerefs_ajaxurl_val = get_option($biblerefs_ajaxurl);
   //  $bg_content_val = get_option( $bg_content );
    $class_val = get_option( $links_class );
   //  $bg_refs_file_val = get_option( $bg_refs_file );
	
    $biblerefs_debug_val = get_option( $biblerefs_debug_name );
	
// Проверяем, отправил ли пользователь нам некоторую информацию
// Если "Да", в это скрытое поле будет установлено значение 'Y'
    if( isset( $_POST[ $hidden_field_name ] ) && $_POST[ $hidden_field_name ] == 'Y' ) {

	// Сохраняем отправленное значение в БД
		$biblerefs_site_val = sanitize_text_field(( isset( $_POST[$biblerefs_site] ) && $_POST[$biblerefs_site] ) ? $_POST[$biblerefs_site] : '') ;
		update_option( $biblerefs_site, $biblerefs_site_val );

		// $c_lang_val = sanitize_text_field(( isset( $_POST[$c_lang_name] ) && $_POST[$c_lang_name] ) ? $_POST[$c_lang_name] : '') ;
		// update_option( $c_lang_name, $c_lang_val );

		// $r_lang_val = sanitize_text_field(( isset( $_POST[$r_lang_name] ) && $_POST[$r_lang_name] ) ? $_POST[$r_lang_name] : '') ;
		// update_option( $r_lang_name, $r_lang_val );

		// $g_lang_val = sanitize_text_field(( isset( $_POST[$g_lang_name] ) && $_POST[$g_lang_name] ) ? $_POST[$g_lang_name] : '') ;
		// update_option( $g_lang_name, $g_lang_val );

		// $l_lang_val = sanitize_text_field(( isset( $_POST[$l_lang_name] ) && $_POST[$l_lang_name] ) ? $_POST[$l_lang_name] : '') ;
		// update_option( $l_lang_name, $l_lang_val );

		// $i_lang_val = sanitize_text_field(( isset( $_POST[$i_lang_name] ) && $_POST[$i_lang_name] ) ? $_POST[$i_lang_name] : '') ;
		// update_option( $i_lang_name, $i_lang_val );

		// $font_val = sanitize_text_field(( isset( $_POST[$c_font_name] ) && $_POST[$c_font_name] ) ? $_POST[$c_font_name] : '') ;
		// update_option( $c_font_name, $font_val );

		$biblerefs_page_val = esc_url(( isset( $_POST[$biblerefs_page] ) && $_POST[$biblerefs_page] ) ? $_POST[$biblerefs_page] : '') ;
		update_option( $biblerefs_page, $biblerefs_page_val );

		$bg_verses_lang_val = sanitize_text_field(( isset( $_POST[$bg_verses_lang] ) && $_POST[$bg_verses_lang] ) ? $_POST[$bg_verses_lang] : '') ;
		update_option( $bg_verses_lang, $bg_verses_lang_val );

		// $bg_show_fn_val = sanitize_text_field(( isset( $_POST[$bg_show_fn] ) && $_POST[$bg_show_fn] ) ? $_POST[$bg_show_fn] : '') ;
		// update_option( $bg_show_fn, $bg_show_fn_val );


		$bg_headers_val = sanitize_text_field(( isset( $_POST[$bg_headers] ) && $_POST[$bg_headers] ) ? $_POST[$bg_headers] : '') ;
		update_option( $bg_headers, $bg_headers_val );

		$bg_interpret_val = sanitize_text_field(( isset( $_POST[$bg_interpret] ) && $_POST[$bg_interpret] ) ? $_POST[$bg_interpret] : '') ;
		update_option( $bg_interpret, $bg_interpret_val );

		$bg_parallel_val = sanitize_text_field(( isset( $_POST[$bg_parallel] ) && $_POST[$bg_parallel] ) ? $_POST[$bg_parallel] : '') ;
		update_option( $bg_parallel, $bg_parallel_val );

		$bg_norm_refs_val = sanitize_text_field(( isset( $_POST[$bg_norm_refs] ) && $_POST[$bg_norm_refs] ) ? $_POST[$bg_norm_refs] : '') ;
		update_option( $bg_norm_refs, $bg_norm_refs_val );

		// $bg_verses_val = sanitize_text_field(( isset( $_POST[$bg_verses_name] ) && $_POST[$bg_verses_name] ) ? $_POST[$bg_verses_name] : '') ;
		// update_option( $bg_verses_name, $bg_verses_val );

		$bg_perm_dot_val = sanitize_text_field(( isset( $_POST[$bg_perm_dot] ) && $_POST[$bg_perm_dot] ) ? $_POST[$bg_perm_dot] : '') ;
		update_option( $bg_perm_dot, $bg_perm_dot_val );

		$bg_perm_romeh_val = sanitize_text_field(( isset( $_POST[$bg_perm_romeh] ) && $_POST[$bg_perm_romeh] ) ? $_POST[$bg_perm_romeh] : '') ;
		update_option( $bg_perm_romeh, $bg_perm_romeh_val );

		$bg_perm_sepc_val = sanitize_text_field(( isset( $_POST[$bg_perm_sepc] ) && $_POST[$bg_perm_sepc] ) ? $_POST[$bg_perm_sepc] : '') ;
		update_option( $bg_perm_sepc, $bg_perm_sepc_val );

		$bg_strip_space_val = sanitize_text_field(( isset( $_POST[$bg_strip_space] ) && $_POST[$bg_strip_space] ) ? $_POST[$bg_strip_space] : '') ;
		update_option( $bg_strip_space, $bg_strip_space_val );

		$bg_perm_exceptions_val = sanitize_textarea_field(( isset( $_POST[$bg_perm_exceptions] ) && $_POST[$bg_perm_exceptions] ) ? $_POST[$bg_perm_exceptions] : '') ;
		update_option( $bg_perm_exceptions, $bg_perm_exceptions_val );

		$bg_curl_val = sanitize_text_field(( isset( $_POST[$bg_curl_name] ) && $_POST[$bg_curl_name] ) ? $_POST[$bg_curl_name] : '') ;
		update_option( $bg_curl_name, $bg_curl_val );

		$bg_fgc_val = sanitize_text_field(( isset( $_POST[$bg_fgc_name] ) && $_POST[$bg_fgc_name] ) ? $_POST[$bg_fgc_name] : '') ;
		update_option( $bg_fgc_name, $bg_fgc_val );

		$bg_fopen_val = sanitize_text_field(( isset( $_POST[$bg_fopen_name] ) && $_POST[$bg_fopen_name] ) ? $_POST[$bg_fopen_name] : '') ;
		update_option( $bg_fopen_name, $bg_fopen_val );

		// $biblerefs_pload_val = sanitize_text_field(( isset( $_POST[$biblerefs_pload] ) && $_POST[$biblerefs_pload] ) ? $_POST[$biblerefs_pload] : '') ;
		// update_option( $biblerefs_pload, $biblerefs_pload_val );

		// $biblerefs_preq_val = sanitize_text_field(( isset( $_POST[$biblerefs_preq] ) && $_POST[$biblerefs_preq] ) ? $_POST[$biblerefs_preq] : '') ;
		// update_option( $biblerefs_preq, $biblerefs_preq_val );

		$biblerefs_maxtime_val = (int) sanitize_text_field(( isset( $_POST[$biblerefs_maxtime] ) && $_POST[$biblerefs_maxtime] ) ? $_POST[$biblerefs_maxtime] : '') ;
		update_option( $biblerefs_maxtime, $biblerefs_maxtime_val );

		$biblerefs_ajaxurl_val = esc_url(( isset( $_POST[$biblerefs_ajaxurl] ) && $_POST[$biblerefs_ajaxurl] ) ? $_POST[$biblerefs_ajaxurl] : '') ;
		update_option( $biblerefs_ajaxurl, $biblerefs_ajaxurl_val );

		// $bg_content_val = sanitize_text_field(( isset( $_POST[$bg_content] ) && $_POST[$bg_content] ) ? $_POST[$bg_content] : '') ;
		// update_option( $bg_content, $bg_content_val );

		$class_val = sanitize_html_class(( isset( $_POST[$links_class] ) && $_POST[$links_class] ) ? $_POST[$links_class] : '') ;
		update_option( $links_class, $class_val );

		// $bg_refs_file_val = esc_url(( isset( $_POST[$bg_refs_file] ) && $_POST[$bg_refs_file] ) ? $_POST[$bg_refs_file] : '') ;
		// update_option( $bg_refs_file, $bg_refs_file_val );

 		$biblerefs_debug_val = sanitize_text_field(( isset( $_POST[$biblerefs_debug_name] ) && $_POST[$biblerefs_debug_name] ) ? $_POST[$biblerefs_debug_name] : '') ;
		update_option( $biblerefs_debug_name, $biblerefs_debug_val );

       // Вывести сообщение об обновлении параметров на экран
		echo '<div class="updated"><p><strong>'.__('Options saved.', 'biblerefs' ).'</strong></p></div>';
    }
?>
<!--  форма опций -->
<script>
// function c_lang_checked() {
// 	azbyka_font = document.getElementById('biblerefs_azbyka_font');
// 	if (document.getElementById('c_lang').checked == true) azbyka_font.style.display = '';
// 	else azbyka_font.style.display = 'none';
// }
// function biblerefs_site_checked() {
// 	elRadio = document.getElementsByName('<?php echo $biblerefs_site ?>');
// 	azbyka_lang = document.getElementById('biblerefs_azbyka_lang');
// 	azbyka_font = document.getElementById('biblerefs_azbyka_font');
// 	permalink = document.getElementById('biblerefs_permalink');
// 	if (elRadio[0].checked) {
// 		azbyka_lang.style.display = '';
// 		c_lang_checked();
// 	}
// 	else {
// 		azbyka_lang.style.display = 'none';
// 		azbyka_font.style.display = 'none';
// 	}
// 	if (elRadio[1].checked) permalink.style.display = '';
// 	else permalink.style.display = 'none';
// }
// function bg_verses_checked() {
// 	if (document.getElementById('bg_verses').checked == true) {
// 		document.getElementById('biblerefs_pload').disabled = false;
// 		document.getElementById('biblerefs_preq').disabled = false;
// 	} else {
// 		document.getElementById('biblerefs_pload').disabled = true;
// 		document.getElementById('biblerefs_pload').checked = false;
// 		document.getElementById('biblerefs_preq').disabled = true;
// 		document.getElementById('biblerefs_preq').checked = false;
// 	}
// }
// function biblerefs_check_preload() {
// 	if (document.getElementById('biblerefs_pload').checked == true) {
// 		document.getElementById('biblerefs_preq').checked = false;
// 	}
// }
// function biblerefs_check_prereq() {
// 	if (document.getElementById('biblerefs_preq').checked == true){
// 		document.getElementById('biblerefs_pload').checked = false;
// 	}
// }
function reading_off_checked() {
	if (document.getElementById('bg_curl').checked == true || document.getElementById('bg_fgc').checked == true || document.getElementById('bg_fopen').checked == true) {
		document.getElementById('bg_verses').disabled = false;
	} else {
		document.getElementById('bg_verses').disabled = true;
		document.getElementById('bg_verses').checked = false;
		// document.getElementById('biblerefs_pload').disabled = true;
		// document.getElementById('biblerefs_pload').checked = false;
		// document.getElementById('biblerefs_preq').disabled = true;
		// document.getElementById('biblerefs_preq').checked = false;
	}
}
</script>    
<table width="100%">
<tr><td valign="top">
<!--  Теперь отобразим опции на экране редактирования -->
<div class="wrap">
<!--  Заголовок -->
<h2><?php _e( 'Bible References Plugin Options', 'biblerefs' ); ?></h2>
<div id="biblerefs_resalt"></div>
<p><?php printf( __( 'Version', 'biblerefs' ).' <b>'.get_plugin_version().'</b>' ); ?></p>

<h2 class="nav-tab-wrapper">
<a href="?page=<?php echo BIBREFS_DIR_NAME; ?>&tab=settings" class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings', 'biblerefs') ?></a>
	<a href="?page=<?php echo BIBREFS_DIR_NAME; ?>&tab=permissions" class="nav-tab <?php echo $active_tab == 'permissions' ? 'nav-tab-active' : ''; ?>"><?php _e('Permissions', 'biblerefs') ?></a>
	<a href="?page=<?php echo BIBREFS_DIR_NAME; ?>&tab=additional" class="nav-tab <?php echo $active_tab == 'additional' ? 'nav-tab-active' : ''; ?>"><?php _e('Additional options', 'biblerefs') ?></a>
	<a href="?page=<?php echo BIBREFS_DIR_NAME; ?>&tab=bible" class="nav-tab <?php echo $active_tab == 'bible' ? 'nav-tab-active' : ''; ?>"><?php _e('Bible books', 'biblerefs') ?></a>
</h2>

<!-- Загрузка книг Библии -->
<?php if ($active_tab == 'bible') { 

	include_once ('books.php');

    //Create an instance of our package class...
    $biblerefs_bible_ListTable = new biblerefs_Bible_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $biblerefs_bible_ListTable->prepare_items();
    
?>
<div class="wrap">
	<div id="icon-users" class="icon32"><br/></div>
	<h2><?php _e('Choice Bible books', 'biblerefs') ?></h2>
<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
	<form id="biblerefs_books" method="get"> 
		<!-- For plugins, we also need to ensure that the form posts back to our current page -->
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
		<input type="hidden" name="tab" value="<?php echo $_REQUEST['tab'] ?>" />
		<!-- Now we can render the completed list table -->
		<?php $biblerefs_bible_ListTable->display(); ?>
	</form> 
</div>
<?php } else { ?>

<!-- Форма настроек -->
<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

	<!--  Основные параметры -->
	<!--  Главные настройки -->
	<table class="form-table" style="display: <?php echo $active_tab == 'settings' ? '' : 'none'; ?>;">
		<tr valign="top">
			<th scope="row"><?php _e('Language of references and tooltips', 'biblerefs' ); ?></th>
			<td>
				<select id="bg_verses_lang" name="<?php echo $bg_verses_lang ?>"> 
					<option <?php if($bg_verses_lang_val=="") echo "selected" ?> value=""><?php _e('Default', 'biblerefs' ); ?></option>
					<?php
						$path = BIBREFS_UPLOAD_DIR.'/bible/';
						if ($handle = opendir($path)) {
							while (false !== ($dir = readdir($handle))) { 
								if (is_dir ( $path.$dir ) && $dir != '.' && $dir != '..') {
									include ($path.$dir.'/books.php');
									echo "<option ";
									if($bg_verses_lang_val==$dir) echo "selected";
									echo " value=".$dir.">".$biblerefs_lang_name."</option>\n";
								}
							}
							closedir($handle); 
						}
					?>
				</select>
			</td>
		</tr>


		<tr valign="top">
		<th scope="row"><?php _e('Highlight references in the headers H1...H6', 'biblerefs' ); ?></th>
		<td>
		<input type="checkbox" id="bg_headers" name="<?php echo $bg_headers ?>" <?php if($bg_headers_val=="on") echo "checked" ?>  value="on"> <br />
		</td></tr>


		<script>
		bg_verses_checked();
		biblerefs_check_preload();
		biblerefs_check_prereq();
		</script>
	
	</table>










	<!--  Допустимые отклонения от стандарта ссылок -->
	<table class="form-table" style="display: <?php echo $active_tab == 'permissions' ? '' : 'none'; ?>;">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<tr valign="top">
			<th scope="row"><?php _e('Allow no dot after the book title', 'biblerefs' ); ?></th>
			<td>
				<input type="checkbox" id="bg_perm_dot" name="<?php echo $bg_perm_dot ?>" <?php if($bg_perm_dot_val=="on") echo "checked" ?>  value="on"> <br />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e('Allow Roman numerals', 'biblerefs' ); ?></th>
			<td>
				<input type="checkbox" id="bg_perm_romeh" name="<?php echo $bg_perm_romeh ?>" <?php if($bg_perm_romeh_val=="on") echo "checked" ?>  value="on"> <br />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e('Allow the comma as divider between chapter and verses (western tradition)', 'biblerefs' ); ?></th>
			<td>
				<input type="checkbox" id="bg_perm_sepc" name="<?php echo $bg_perm_sepc ?>" <?php if($bg_perm_sepc_val=="on") echo "checked" ?>  value="on"> <br />
				<?php _e('The plugin highlights references in both eastern and western notation. There is collision what is mean the reference containing two numbers devided by a comma (for example, Ps. 4,6). In the Western tradition, this is reference to Psalm 4 verse 6, but in the east tradition it is reference to Psalms 4 and 6. You can choose how to interpret such links by specifying it in the settings.', 'biblerefs' ); ?>
			</td>
		</tr>

		<tr valign="top">
		<th scope="row"><?php _e('Delete spaces between digit and letter in the book notation', 'biblerefs' ); ?></th>
		<td>
		<input type="checkbox" id="bg_strip_space" name="<?php echo $bg_strip_space ?>" <?php if($bg_strip_space_val=="on") echo "checked" ?>  value="on"> <br />
		</td></tr>

		<tr valign="top">
		<th scope="row"><?php _e('Convert references to the normalized form', 'biblerefs' ); ?></th>
		<td>
		<input type="checkbox" id="bg_norm_refs" name="<?php echo $bg_norm_refs ?>" <?php if($bg_norm_refs_val=="on") echo "checked" ?>  value="on"> <br />
		</th><td>
		</td></tr>

		<tr valign="top">
		<th scope="row"><?php _e('Phrases are not Bible reference', 'biblerefs' ); ?></th>
		<td>
		<textarea id="bg_perm_exceptions" name="<?php echo $bg_perm_exceptions ?>" rows="10" cols="60"><?php echo get_option($bg_perm_exceptions); ?></textarea><br>
		<i><?php _e('use a semicolon or new line as delimiter', 'biblerefs') ?></i>
		</td></tr>

	</table>



	<!--  Дополнительные параметры -->
	<table class="form-table" style="display: <?php echo $active_tab == 'additional' ? '' : 'none'; ?>;">
	<tr valign="top">
	<th scope="row"><?php _e('The maximum execution time', 'biblerefs') ?></th>
	<td>
	<input type="number" name="biblerefs_maxtime" value="<?php echo $biblerefs_maxtime_val; ?>" /> <?php _e('sec.', 'biblerefs' ); ?>
	</td></tr>

	<tr valign="top">
	<th scope="row"><?php _e('Method of reading files', 'biblerefs' ); ?></th>
	<td>
	<input type="checkbox" id="bg_fgc" name="<?php echo $bg_fgc_name ?>" <?php if($bg_fgc_val=="on") echo "checked" ?>  value="on" onclick='reading_off_checked();'> file_get_contents()<br />
	<input type="checkbox" id="bg_fopen" name="<?php echo $bg_fopen_name ?>" <?php if($bg_fopen_val=="on") echo "checked" ?>  value="on" onclick='reading_off_checked();'> fopen() - fread() - fclose()<br />
	<input type="checkbox" id="bg_curl" name="<?php echo $bg_curl_name ?>" <?php if($bg_curl_val=="on") echo "checked" ?> value="on" onclick='reading_off_checked();'> cURL<br />
	<?php _e('<i>(Plugin tries to read Bible files with marked methods in the order listed.<br>To do the reading faster, disable unnecessary methods - you need one only. <br><u>Warning:</u> Some methods may not be available on your server.)</i>', 'biblerefs' ); ?> <br />
	</td></tr>
	<script>
	reading_off_checked();
	</script>

	<tr valign="top">
	<th scope="row"><?php _e('External AJAX Proxy', 'biblerefs' ); ?></th>
	<td>
	<input type="text" id="biblerefs_ajaxurl" name="<?php echo $biblerefs_ajaxurl ?>" size="60" value="<?php echo $biblerefs_ajaxurl_val ?>"><br />
	<details>
	<summary><?php _e('Add into <em>functions.php</em> on this server the following PHP-code (see bellow)', "biblerefs"); ?></summary>
	<?php printf ('<code>function allow_origin () {<br>&nbsp;&nbsp;&nbsp;&nbsp;header ( "Access-Control-Allow-Origin: %1$s" );<br>}<br>add_action ( "init", "allow_origin" );</code>', get_site_url()); ?>
	</details>
	</td></tr>

	<tr valign="top">
	<th scope="row"><?php _e('Reference links CSS class', 'biblerefs' ); ?></th>
	<td>
	<input type="text" id="links_class" name="<?php echo $links_class ?>" size="20" value="<?php echo $class_val ?>"><br />
	</td></tr>


	<tr valign="top">
	<th scope="row"><?php _e('Debug', 'biblerefs' ); ?></th>
	<td>
	<input type="checkbox" id="biblerefs_debug" name="<?php echo $biblerefs_debug_name ?>" <?php if($biblerefs_debug_val=="on") echo "checked" ?>  value="on"'> <?php _e('<br><i>(If you enable this option the debug information will written to the file "debug.log" in the plugin directory.<br>The file will be updated in 30 minutes after the last record, or the filesize exceed 2 Mb.<br><font color="red"><b>Disable this option after the end of debugging!</b></font>)</i>', 'biblerefs' ); ?> <br />
	</td></tr>

	</table>

	<p class="submit">
	<input type="submit" name="Submit" class="button-primary" value="<?php _e('Update Options', 'biblerefs' ) ?>" />
	</p>

</form>

<?php } ?>

</div>
</td>

<!-- Информация о плагине -->
<td valign="top" align="left" width="45em">

<div class="biblerefs_info_box">

	<h3><?php _e('Thanks for using Biblie References', 'biblerefs') ?></h3>

</div>
</td></tr></table>
<?php 

} 