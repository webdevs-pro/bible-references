<?php
/* 
   Plugin Name: Bible References 
   Plugin URI: http://wp-bible.info
   Description: The plugin will highlight the Bible references and display Bible verses in popup.
   Version: 0.7.3
   Author: Alex Ischenko
   Author URI: https://shofar-media.in.ua 
	License:     GPL2
	Text Domain: biblerefs
	Domain Path: /languages
*/


/*****************************************************************************************
	Блок загрузки плагина
	
******************************************************************************************/

// Запрет прямого запуска скрипта
if ( !defined('ABSPATH') ) {
	die( 'Sorry, you are not allowed to access this page directly.' ); 
}

if( ! function_exists('get_plugin_data') ) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
define('BIBREFS_VERSION', get_plugin_data( __FILE__ )['Version']);

define('GITHUB_BOOKS_REPOSITORY', "webdevs-pro/bible-books"); // github user/repository
define('BIBREFS_DIR_NAME', plugin_basename(__FILE__));


$upload_dir = wp_upload_dir();
define('BIBREFS_UPLOAD_DIR', $upload_dir['basedir']);

$biblerefs_start_time = microtime(true);


// Таблица стилей для плагина
function bg_enqueue_frontend_styles () {
	wp_enqueue_style( "biblerefs_styles", plugins_url( '/css/styles.css', plugin_basename(__FILE__) ), array() , BIBREFS_VERSION  );
}
add_action( 'wp_enqueue_scripts' , 'bg_enqueue_frontend_styles' );
add_action( 'admin_enqueue_scripts' , 'bg_enqueue_frontend_styles' );

// JS скрипт 
function bg_enqueue_frontend_scripts () {

	$content=get_option( "biblerefs_content" );
	$ajaxurl = trim(get_option( 'biblerefs_ajaxurl' ));



	// error_log( print_r($bible_books, true) );
	
	if (!$ajaxurl) $ajaxurl=admin_url('admin-ajax.php');
	wp_enqueue_script( 'biblerefs_proc', plugins_url( 'js/biblerefs.js', __FILE__ ), false, BIBREFS_VERSION, true );
	wp_localize_script( 
		'biblerefs_proc', 
		'biblerefs', array( 
			'ajaxurl' => $ajaxurl, 
			'content' => $content, 
			'bible_books' => get_bible_books()
		) 
	);
}	 
if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts' , 'bg_enqueue_frontend_scripts' ); 
}

// Загрузка интернационализации
add_action( 'plugins_loaded', 'biblerefs_load_textdomain' );
function biblerefs_load_textdomain() {
  load_plugin_textdomain( 'biblerefs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

// Подключаем дополнительные модули
include_once('includes/settings.php');
include_once('includes/references.php');
include_once('includes/quotes.php');
// include_once('includes/search.php');
 
if ( defined('ABSPATH') && defined('WPINC') ) {
// Регистрируем крючок для обработки контента при его загрузке
	add_filter( 'the_content', 'biblerefs' );

// Регистрируем крючок для добавления меню администратора
	add_action('admin_menu', 'biblerefs_add_pages');
	
// Регистрируем крючок на удаление плагина
	if (function_exists('register_uninstall_hook')) {
		register_uninstall_hook(__FILE__, 'biblerefs_deinstall');
	}


// Инициализируем значения параметров настройки плагина по умолчанию

	biblerefs_options_ini ();	
	biblerefs_get_options ();
}

// Функция, исполняемая при активации плагина.
// function  biblerefs_activate() {
// 	$folders=array("ru");
// 	$bible_lang = get_bloginfo('language');	
// 	$bible_lang = substr($bible_lang,0, 2);
// 	$xml = @file_get_contents(BIBREFS_SOURCE_URL."filelist.xml");
// 	if ($xml) {
// 		$files = json_decode(json_encode((array)simplexml_load_string($xml)),1);
// 		$file = $files['file'];
// 		foreach ($file as $f){
// 			$lang = basename($f['filename'], ".zip");
// 			if ($lang == $bible_lang) {
// 				$folders=array($lang);
// 				break;
// 			}
// 		}
// 	}
// 	foreach ($folders as $book) {
// 		biblerefs_addFolder($book.'.zip');
// 	}
// 	update_option( 'biblerefs_version', BIBREFS_VERSION );
// }

// register_activation_hook( __FILE__, 'biblerefs_activate' );

// // Проверяем текущую версию плагина и обновляем папки с книгами Библии
// function biblerefs_upload_folders() {
// 	$version = get_option('biblerefs_version');
// 	if (!$version) {
// 		$folders=array('be','cu','en','ru','uk');
// 		update_option( 'biblerefs_folders', $folders );
// 	}
// 	if ( version_compare( $version, BIBREFS_VERSION, '<' ) ) {
// 		$folders=get_option('biblerefs_folders');
// 		if (!$folders) $folders = array("ru");			// Если нет папок, то по умолчанию русский язык
// 		foreach ($folders as $book) biblerefs_addFolder($book.'.zip');

// 		update_option( 'biblerefs_version', BIBREFS_VERSION );
// 	}
// }
// add_action( 'plugins_loaded', 'biblerefs_upload_folders' );

/** ************************************************************************
 * Добавить папку с Библией на сайт
 **************************************************************************/
function biblerefs_addFolder($book) {

	$source_url = 'https://github.com/' . GITHUB_BOOKS_REPOSITORY . '/raw/master/' . $book;
	error_log( print_r($source_url, true) );

	$local_url = dirname(__FILE__ ).'/'.$book;
	error_log( print_r($local_url, true) );

	// $subfolder = dirname(__FILE__ ).'/bible/'.basename($book, ".zip").'/';
	$subfolder = BIBREFS_UPLOAD_DIR.'/bible/'.basename($book, ".zip").'/';
	error_log( print_r($subfolder, true) );

	

	if (!file_exists($local_url)) {
		if (copy ( $source_url, $local_url )) {
			$zip = new ZipArchive; 
			$zip->open($local_url); 
			$zip->extractTo($subfolder); 
			$zip->close(); 
			unlink ( $local_url );
		}		
		$folders = biblerefs_getFolders();
		// update_option( 'biblerefs_folders', $folders );
	}
}
/** ************************************************************************
 * Удалить папку с Библией с сайта
 **************************************************************************/
function biblerefs_removeFolder($book) {
	$path = BIBREFS_UPLOAD_DIR.'/bible/';
	$dir=$path.basename($book, ".zip"); 
	if ($objs = glob($dir."/*")) {
		foreach($objs as $obj) {
			is_dir($obj) ? biblerefs_removeFolder($obj) : unlink($obj);
		}
	}
	@rmdir($dir);
	$folders = biblerefs_getFolders();
	// update_option( 'biblerefs_folders', $folders );
}
/** ************************************************************************
 * Получить список папок с Библией на сайте
 **************************************************************************/
function biblerefs_getFolders() {
	$folders = array();
	$path = BIBREFS_UPLOAD_DIR.'/bible/';
	$id = 0;
	if ($handle = @opendir($path)) {
		while (false !== ($dir = readdir($handle))) { 
			if (is_dir ( $path.$dir ) && $dir != '.' && $dir != '..') {
				$folders[$id] = $dir;
				$id++;
			}
		}
		closedir($handle); 
	}
	return $folders;
}


/*****************************************************************************************
	Функции установки языка Библии 
	
******************************************************************************************/
function set_bible_lang() {
	global $post;
	
	$bible_lang = get_bloginfo('language');										// Сначала берем язык блога (1)
	if (function_exists ( 'bg_custom_lang' )) $bible_lang = bg_custom_lang();	// Если определена внешняя функция определения языка, то используем ее (2)
	$bible_lang = substr($bible_lang, 0, 2);

	$bg_verses_lang_val = get_option( 'biblerefs_verses_lang' );
	if ($bg_verses_lang_val) 													// Если задан язык Библии в настройках плагина,
		$bible_lang = $bg_verses_lang_val;										// то язык из настроек (3)
	
	$bible_lang_posts_val = ($post)?get_post_meta($post->ID, 'bible_lang', true):"";	
	if ($bible_lang_posts_val) 													// Если задан язык Библии для поста,
		$bible_lang = $bible_lang_posts_val;									// то язык из поста (4)
	
	// $file_books = BIBREFS_UPLOAD_DIR.'/bible/'.$bible_lang.'/books.php';		// Если для установеннного языка отсутствует каталог с Библией,
	$file_books_uploaded = BIBREFS_UPLOAD_DIR.'/bible/'.$bible_lang.'/books.php';	
	if (!file_exists($file_books_uploaded)) {
			$bible_lang = '';	 				// то по умолчанию русский язык (5)
			// $file_books = BIBREFS_UPLOAD_DIR.'/bible/'.$bible_lang.'/books.php';		// Если для русского языка отсутствует каталог с Библией,
			// if (!file_exists($file_books)) $bible_lang = '';							// то язык не установлен
		}
	return $bible_lang;
}

/*****************************************************************************************
	Функции подключения языкового файла списка книг Библии 
	
******************************************************************************************/
function include_books($lang) {
	global $biblerefs_lang_name, $biblerefs_book_letters, $biblerefs_book_length;
	global $biblerefs_chapter, $biblerefs_ch, $biblerefs_psalm, $biblerefs_ps;
	global $biblerefs_url, $biblerefs_bookTitle, $biblerefs_shortTitle, $biblerefs_bookFile;
	

	$file_books = BIBREFS_UPLOAD_DIR.'/bible/'.$lang.'/books.php';
	// if (!file_exists($file_books)) {
	// 	$lang = set_bible_lang(); // Если язык задан неверно, устанавливаем язык системы
	// 	$file_books = dirname( __FILE__ ).'/bible/'.$lang.'/books.php';
	// }
	if ($lang) include($file_books);
	return $lang;
}

/*****************************************************************************************
	Функции запуска плагина
	
******************************************************************************************/
 
// Функция обработки ссылок на Библию 
function biblerefs($content) {
	$content = biblerefs_bible_proc($content);
	return $content;
}

// Функция действия перед крючком добавления меню
function biblerefs_add_pages() {
    // Добавим новое подменю в раздел Параметры 
    add_options_page( __('Bible References', 'biblerefs' ), __('Bible References', 'biblerefs' ), 'manage_options', __FILE__, 'biblerefs_options_page');
}


/*****************************************************************************************
	Формирует список книг Библии на заданном языке в виде объекта
	
******************************************************************************************/
function biblerefs_booklist ($lang) {
	global $biblerefs_bookTitle;
	$lang = include_books($lang);
	$num_books = count($biblerefs_bookTitle);
	$books = array_keys ( $biblerefs_bookTitle);
	$booklist = array();
	for ($i = 0; $i< $num_books; $i++) { 
		$booklist[$i]['value']=$books[$i];
		$booklist[$i]['name']=$biblerefs_bookTitle[$books[$i]];
	} 
	echo json_encode ($booklist);
}



function get_bible_books() {
	// array of available books with names and titles
	$bible_books = array();
	$path = BIBREFS_UPLOAD_DIR.'/bible/';
	if (is_dir($path) && $handle = opendir($path)) {
		while (false !== ($dir = readdir($handle))) { 
			if (is_dir ( $path.$dir ) && $dir != '.' && $dir != '..') {
				include ($path.$dir.'/books.php');
				$bible_books[] = array(
					'book_name' => $dir,
					'book_title' => $biblerefs_lang_name
				);
			}
		}
		closedir($handle); 
	} 
	return $bible_books;
}
/*****************************************************************************************
	Генератор ответа AJAX
	
******************************************************************************************/
add_action ('wp_ajax_biblerefs', 'biblerefs_callback');
add_action ('wp_ajax_nopriv_biblerefs', 'biblerefs_callback');

function biblerefs_callback() {
	
	if ( isset($_GET["blang"]) ) biblerefs_booklist ($_GET["blang"]);		
	else {
		$title = $_GET["title"];
		$chapter = $_GET["chapter"];
		if (!$chapter) $chapter = '1-999';
		$lang = $_GET["lang"];
		$type = $_GET["type"];
		if (!$type) $type = 'verses';
		
		// error_log( print_r($title, true) );
		// error_log( print_r($chapter, true) );
		// error_log( print_r($lang, true) );

		$verses = biblerefs_getQuotes($title, $chapter, $type, $lang); // получаем содержимое
		if ($verses) {
			echo $verses;
		} 
	}
	wp_die();
}
function get_plugin_version() {
	$plugin_data = get_plugin_data( __FILE__  );
	return $plugin_data['Version'];
}

/*****************************************************************************************
	Добавляем блок в основную колонку на страницах постов и пост. страниц 
	
******************************************************************************************/
add_action('admin_init', 'biblerefs_extra_fields', 1);
// Создание блока
function biblerefs_extra_fields() {
    add_meta_box( 'biblerefs_extra_fields', __('Bible References', 'biblerefs'), 'biblerefs_extra_fields_box_func', 'post', 'normal', 'high'  );
}
// Добавление полей
function biblerefs_extra_fields_box_func( $post ){
?>
	<label for="bg_verses_lang"><?php _e('Language of references and tooltips', 'biblerefs' ); ?></label>
		<select id="bg_verses_lang" name="biblerefs_extra[bible_lang]">
		<?php $bg_verses_lang_val = get_post_meta($post->ID, 'bible_lang', 1); ?>
			<option <?php if($bg_verses_lang_val=="") echo "selected" ?> value=""><?php _e('Default', 'biblerefs' ); ?></option>
			<?php 
			$path = BIBREFS_UPLOAD_DIR.'/bible/';
			if (is_dir($path) && $handle = opendir($path)) {
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
	&nbsp;
	<label for="bg_norefs"><?php _e('Ban to highlight references', 'biblerefs' ); ?></label>
		<select id="bg_norefs" name="biblerefs_extra[norefs]">
		<?php $bg_norefs_val = get_post_meta($post->ID, 'norefs', 1); ?>
			<option <?php if($bg_norefs_val=="") echo "selected" ?> value=""><?php _e('Off', 'biblerefs' ); ?></option>
			<option <?php if($bg_norefs_val) echo "selected" ?> value="on"><?php _e('On', 'biblerefs' ); ?></option>
		</select>
	
    <input type="hidden" name="biblerefs_extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}
// Сохранение значений произвольных полей при автосохранении поста
add_action('save_post', 'biblerefs_extra_fields_update', 0);

// Сохранение значений произвольных полей при сохранении поста
function biblerefs_extra_fields_update( $post_id ){

	if (!isset ($_POST['biblerefs_extra_fields_nonce']) ) return false;
    if ( !wp_verify_nonce($_POST['biblerefs_extra_fields_nonce'], __FILE__) ) return false;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
    if ( !current_user_can('edit_post', $post_id) ) return false;

    if( !isset($_POST['biblerefs_extra']) ) return false; 

    $_POST['biblerefs_extra'] = array_map('trim', $_POST['biblerefs_extra']);
    foreach( $_POST['biblerefs_extra'] as $key=>$value ){
        if( empty($value) ) {
            delete_post_meta($post_id, $key);
			continue;
		}
        update_post_meta($post_id, $key, $value);
    }
    return $post_id;
}






/*****************************************************************************************
	Параметры плагина
	
******************************************************************************************/
// Задание параметров по умолчанию
function biblerefs_options_ini () {
	add_option('biblerefs_site', "azbyka");
	// add_option('biblerefs_c_lang', "c");
	// add_option('biblerefs_r_lang', "r");
	// add_option('biblerefs_g_lang');
	// add_option('biblerefs_l_lang');
	// add_option('biblerefs_i_lang');
	// add_option('biblerefs_c_font', "ucs");
	add_option('biblerefs_page', "");
	add_option('biblerefs_verses_lang', "");
	add_option('biblerefs_show_fn', "");
	add_option('biblerefs_headers', "on");
	add_option('biblerefs_interpret', "on");
	add_option('biblerefs_parallel', "");
	add_option('biblerefs_norm_refs');
	add_option('biblerefs_show_verses', "on");
	
	add_option('biblerefs_dot', "on");
    add_option('biblerefs_romeh', "on");
    add_option('biblerefs_sepc', "on");
	add_option('biblerefs_strip_space');
	add_option('biblerefs_exceptions',"");
	
	add_option('biblerefs_curl', "on");
	add_option('biblerefs_fgc', "on");
	add_option('biblerefs_fopen', "on");
	// add_option('biblerefs_preload');
	// add_option('biblerefs_prereq');
	add_option('biblerefs_maxtime', "60");
	add_option('biblerefs_ajaxurl', "");
	add_option('biblerefs_content', "#content");
	add_option('biblerefs_class', "biblerefs");
	add_option('biblerefs_refs_file', "");
	add_option('biblerefs_debug', "");
	
	add_option('biblerefs_version', 0 );
	// add_option('biblerefs_folders', array('ru'));
}

// Очистка таблицы параметров при удалении плагина
function biblerefs_deinstall() {
	delete_option('biblerefs_site');
	delete_option('biblerefs_page');
	delete_option('biblerefs_verses_lang');
	delete_option('biblerefs_show_fn');
	delete_option('biblerefs_headers');
	delete_option('biblerefs_interpret');
	delete_option('biblerefs_parallel');
	delete_option('biblerefs_norm_refs');
	// delete_option('biblerefs_show_verses');
	
	delete_option('biblerefs_dot');
    delete_option('biblerefs_romeh');
    delete_option('biblerefs_sepc');
    delete_option('biblerefs_sepd');
    delete_option('biblerefs_seps');
    delete_option('biblerefs_separator');
	delete_option('biblerefs_strip_space');
	delete_option('biblerefs_exceptions');
	
	delete_option('biblerefs_curl');
	delete_option('biblerefs_fgc');
	delete_option('biblerefs_fopen');
	// delete_option('biblerefs_preload');
	// delete_option('biblerefs_prereq');
	delete_option('biblerefs_maxtime');
	delete_option('biblerefs_cashe');
	delete_option('biblerefs_ajaxurl');
	delete_option('biblerefs_content');
	delete_option('biblerefs_class');
	delete_option('biblerefs_refs_file');
	delete_option('biblerefs_debug');

	delete_option('biblerefs_submit_hidden');
	delete_option('biblerefs_options_udate');
	
	delete_option('biblerefs_version');
	// delete_option('biblerefs_folders');
}

function biblerefs_get_options () {
	global $biblerefs_option;

// Читаем существующие значения опций из базы данных
	$opt = "";
	// $c_lang_val = get_option( 'biblerefs_c_lang' );
   //  $r_lang_val = get_option( 'biblerefs_r_lang' );
   //  $g_lang_val = get_option( 'biblerefs_g_lang' );
   //  $l_lang_val = get_option( 'biblerefs_l_lang' );
   //  $i_lang_val = get_option( 'biblerefs_i_lang' );
	// $lang_val = $c_lang_val.$r_lang_val.$g_lang_val.$l_lang_val.$i_lang_val;
	// $font_val = get_option( 'biblerefs_c_font' );
	// if ($lang_val) $opt = "&".$lang_val;
	// if ($font_val && $c_lang_val) $opt = $opt."&".$font_val;
	// $biblerefs_option['azbyka'] = $opt;
	
// Общие параметры	отображения ссылок
	$biblerefs_option['site'] = get_option( 'biblerefs_site' );
    $biblerefsoption['page'] = get_option( 'biblerefs_page' );
    $biblerefs_option['target'] = get_option( 'biblerefs_target' );
    $biblerefs_option['content'] = get_option( 'biblerefs_content' );
	if ($biblerefs_option['content'] == "") $biblerefs_option['content'] = 'body';
    $biblerefs_option['class'] = get_option( 'biblerefs_class' );
	if ($biblerefs_option['class'] == "") $biblerefs_option['class'] = 'biblerefs';
	// $biblerefs_option['show_verses'] = get_option( 'biblerefs_show_verses' );	

    $biblerefs_option['verses_lang'] = get_option( 'biblerefs_verses_lang' );
    $biblerefs_option['show_fn'] = get_option( 'biblerefs_show_fn' );

    $biblerefs_option['headers'] = get_option( 'biblerefs_headers' );
    $biblerefs_option['interpret'] = get_option( 'biblerefs_interpret' );
    $biblerefs_option['parallel'] = get_option( 'biblerefs_parallel' );

    $biblerefs_option['norm_refs'] = get_option( 'biblerefs_norm_refs' );

	$biblerefs_option['dot'] = get_option( 'biblerefs_dot' );
	$biblerefs_option['romeh'] = get_option( 'biblerefs_romeh' );
	$biblerefs_option['sepc'] = get_option( 'biblerefs_sepc' );
    $biblerefs_option['strip_space'] = get_option( 'biblerefs_strip_space' );

    $biblerefs_option['curl'] = get_option( 'biblerefs_curl' );
    $biblerefs_option['fgc'] = get_option( 'biblerefs_fgc' );
    $biblerefs_option['fopen'] = get_option( 'biblerefs_fopen' );

   //  $biblerefs_option['pload'] = get_option('biblerefs_preload' );
   //  $biblerefs_option['preq'] = get_option('biblerefs_prereq' );
	
    $biblerefs_option['maxtime'] = (int) get_option( 'biblerefs_maxtime' );
	
    $biblerefs_option['refs_file'] = get_option( 'biblerefs_refs_file' );
	
    $biblerefs_option['debug'] = get_option('biblerefs_debug' );
}

// PLUGIN UPDATES
if (is_admin()) {
   require 'includes/plugin-update-checker/plugin-update-checker.php';
   $ai_blocks_updater = Puc_v4_Factory::buildUpdateChecker(
      'https://github.com/webdevs-pro/bible-references',
      __FILE__,
      'bible-references'
   );
}



add_action('wp_footer', function(){
	?>
		<div class="bible_references bible_references_theme_1">
			<div class="bible_references_popup">
				<div class="bible_loading_overlay"></div>
				<div class="bible_references_popup_header">
					<span><?php echo __('Bible:', 'biblerefs' ); ?></span>
					<select id="bible_books" autocomplete="off">
					<?php $bg_verses_lang_val = get_post_meta(get_the_ID(), 'bible_lang', 1); 
						error_log( print_r($bg_verses_lang_val, true) );
						foreach(get_bible_books() as $bible_book) {
							echo "<option ";
							if($bible_book['book_name'] == $bg_verses_lang_val) echo "selected";
							echo " value=".$bible_book['book_name'].">".$bible_book['book_title']."</option>";
						}
						?>
					</select>
					<div class="bible_references_popup_close"></div>
				</div>
				

				<div class="bible_references_popup_content">
					<div class="bible_references_popup_verses"></div>
				</div>
			</div>		
		</div>
	<?php
});