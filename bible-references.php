<?php
/* 
   Plugin Name: Bible References 
   Plugin URI: http://wp-bible.info
   Description: The plugin will highlight the Bible references with hyperlinks to the Bible text and interpretation by the Holy Fathers.
   Version: 0.2
   Author: VBog
   Author URI: https://bogaiskov.ru 
	License:     GPL2
	Text Domain: bg_bibrefs
	Domain Path: /languages
*/

/*  Copyright 2013-2020  Vadim Bogaiskov  (email: vadim.bogaiskov@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*****************************************************************************************
	Блок загрузки плагина
	
******************************************************************************************/

// Запрет прямого запуска скрипта
if ( !defined('ABSPATH') ) {
	die( 'Sorry, you are not allowed to access this page directly.' ); 
}

if( ! function_exists('get_plugin_data') ) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
define('BG_BIBREFS_VERSION', get_plugin_data( __FILE__ )['Version']);

define('GITHUB_BOOKS_REPOSITORY', "webdevs-pro/bible-books"); // github user/repository
define('BIBREFS_DIR_NAME', plugin_basename(__FILE__));


$upload_dir = wp_upload_dir();
define('BIBREFS_UPLOAD_DIR', $upload_dir['basedir']);

$bg_bibrefs_start_time = microtime(true);


// Таблица стилей для плагина
function bg_enqueue_frontend_styles () {
	wp_enqueue_style( "bg_bibrefs_styles", plugins_url( '/css/styles.css', plugin_basename(__FILE__) ), array() , BG_BIBREFS_VERSION  );
}
add_action( 'wp_enqueue_scripts' , 'bg_enqueue_frontend_styles' );
add_action( 'admin_enqueue_scripts' , 'bg_enqueue_frontend_styles' );

// JS скрипт 
function bg_enqueue_frontend_scripts () {
    $bg_preq_val = get_option( 'bg_bibrefs_prereq' );
	if ($bg_preq_val == 'on') $preq = 1;
	else $preq = 0;
	$content=get_option( "bg_bibrefs_content" );
    $ajaxurl = trim(get_option( 'bg_bibrefs_ajaxurl' ));
	if (!$ajaxurl) $ajaxurl=admin_url('admin-ajax.php');
	wp_enqueue_script( 'bg_bibrefs_proc', plugins_url( 'js/bg_bibrefs.js', __FILE__ ), false, BG_BIBREFS_VERSION, true );
	wp_localize_script( 'bg_bibrefs_proc', 'bg_bibrefs', array( 'ajaxurl' => $ajaxurl, 'content' => $content, 'preq' => $preq ) );
}	 
if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts' , 'bg_enqueue_frontend_scripts' ); 
}

// Загрузка интернационализации
add_action( 'plugins_loaded', 'bg_bibrefs_load_textdomain' );
function bg_bibrefs_load_textdomain() {
  load_plugin_textdomain( 'bg_bibrefs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

// Подключаем дополнительные модули
include_once('includes/settings.php');
include_once('includes/references.php');
include_once('includes/quotes.php');
// include_once('includes/search.php');
 
if ( defined('ABSPATH') && defined('WPINC') ) {
// Регистрируем крючок для обработки контента при его загрузке
	add_filter( 'the_content', 'bg_bibrefs' );

// Регистрируем крючок для добавления меню администратора
	add_action('admin_menu', 'bg_bibrefs_add_pages');
	
// Регистрируем крючок на удаление плагина
	if (function_exists('register_uninstall_hook')) {
		register_uninstall_hook(__FILE__, 'bg_bibrefs_deinstall');
	}


// Инициализируем значения параметров настройки плагина по умолчанию

	bg_bibrefs_options_ini ();	
	bg_bibrefs_get_options ();
}

// Функция, исполняемая при активации плагина.
function  bg_bibrefs_activate() {
	$folders=array("ru");
	$bible_lang = get_bloginfo('language');	
	$bible_lang = substr($bible_lang,0, 2);
	$xml = @file_get_contents(BG_BIBREFS_SOURCE_URL."filelist.xml");
	if ($xml) {
		$files = json_decode(json_encode((array)simplexml_load_string($xml)),1);
		$file = $files['file'];
		foreach ($file as $f){
			$lang = basename($f['filename'], ".zip");
			if ($lang == $bible_lang) {
				$folders=array($lang);
				break;
			}
		}
	}
	foreach ($folders as $book) {
		bg_bibrefs_addFolder($book.'.zip');
	}
	update_option( 'bg_bibrefs_version', BG_BIBREFS_VERSION );
}

register_activation_hook( __FILE__, 'bg_bibrefs_activate' );

// Проверяем текущую версию плагина и обновляем папки с книгами Библии
function bg_bibrefs_upload_folders() {
	$version = get_option('bg_bibrefs_version');
	if (!$version) {
		$folders=array('be','cu','en','ru','uk');
		update_option( 'bg_bibrefs_folders', $folders );
	}
	if ( version_compare( $version, BG_BIBREFS_VERSION, '<' ) ) {
		$folders=get_option('bg_bibrefs_folders');
		if (!$folders) $folders = array("ru");			// Если нет папок, то по умолчанию русский язык
		foreach ($folders as $book) bg_bibrefs_addFolder($book.'.zip');

		update_option( 'bg_bibrefs_version', BG_BIBREFS_VERSION );
	}
}
add_action( 'plugins_loaded', 'bg_bibrefs_upload_folders' );

/** ************************************************************************
 * Добавить папку с Библией на сайт
 **************************************************************************/
function bg_bibrefs_addFolder($book) {

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
		$folders = bg_bibrefs_getFolders();
		update_option( 'bg_bibrefs_folders', $folders );
	}
}
/** ************************************************************************
 * Удалить папку с Библией с сайта
 **************************************************************************/
function bg_bibrefs_removeFolder($book) {
	$path = BIBREFS_UPLOAD_DIR.'/bible/';
	$dir=$path.basename($book, ".zip"); 
	if ($objs = glob($dir."/*")) {
		foreach($objs as $obj) {
			is_dir($obj) ? bg_bibrefs_removeFolder($obj) : unlink($obj);
		}
	}
	@rmdir($dir);
	$folders = bg_bibrefs_getFolders();
	update_option( 'bg_bibrefs_folders', $folders );
}
/** ************************************************************************
 * Получить список папок с Библией на сайте
 **************************************************************************/
function bg_bibrefs_getFolders() {
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

	$bg_verses_lang_val = get_option( 'bg_bibrefs_verses_lang' );
	if ($bg_verses_lang_val) 													// Если задан язык Библии в настройках плагина,
		$bible_lang = $bg_verses_lang_val;										// то язык из настроек (3)
	
	$bible_lang_posts_val = ($post)?get_post_meta($post->ID, 'bible_lang', true):"";	
	if ($bible_lang_posts_val) 													// Если задан язык Библии для поста,
		$bible_lang = $bible_lang_posts_val;									// то язык из поста (4)
	
	$file_books = dirname( __FILE__ ).'/bible/'.$bible_lang.'/books.php';		// Если для установеннного языка отсутствует каталог с Библией,
	$file_books_uploaded = BIBREFS_UPLOAD_DIR.'/bible/'.$bible_lang.'/books.php';	
	if (!file_exists($file_books) && 
		!file_exists($file_books_uploaded)) {
			$bible_lang = 'ru';	 				// то по умолчанию русский язык (5)
			$file_books = dirname( __FILE__ ).'/bible/'.$bible_lang.'/books.php';		// Если для русского языка отсутствует каталог с Библией,
			if (!file_exists($file_books)) $bible_lang = '';							// то язык не установлен
		}
	return $bible_lang;
}

/*****************************************************************************************
	Функции подключения языкового файла списка книг Библии 
	
******************************************************************************************/
function include_books($lang) {
	global $bg_bibrefs_lang_name, $bg_bibrefs_book_letters, $bg_bibrefs_book_length;
	global $bg_bibrefs_chapter, $bg_bibrefs_ch, $bg_bibrefs_psalm, $bg_bibrefs_ps;
	global $bg_bibrefs_url, $bg_bibrefs_bookTitle, $bg_bibrefs_shortTitle, $bg_bibrefs_bookFile;
	
	$file_books = dirname( __FILE__ ).'/bible/'.$lang.'/books.php';
	if (!file_exists($file_books)) // Если нет в папке плагина, то ищем в /wp-content/uploads
		$file_books = BIBREFS_UPLOAD_DIR.'/bible/'.$lang.'/books.php';
	if (!file_exists($file_books)) {
		$lang = set_bible_lang(); // Если язык задан неверно, устанавливаем язык системы
		$file_books = dirname( __FILE__ ).'/bible/'.$lang.'/books.php';
	}
	if ($lang) include($file_books);
	return $lang;
}

/*****************************************************************************************
	Функции запуска плагина
	
******************************************************************************************/
 
// Функция обработки ссылок на Библию 
function bg_bibrefs($content) {
	$content = bg_bibrefs_bible_proc($content);
	return $content;
}

// Функция действия перед крючком добавления меню
function bg_bibrefs_add_pages() {
    // Добавим новое подменю в раздел Параметры 
    add_options_page( __('Bible References', 'bg_bibrefs' ), __('Bible References', 'bg_bibrefs' ), 'manage_options', __FILE__, 'bg_bibrefs_options_page');
}


/*****************************************************************************************
	Формирует список книг Библии на заданном языке в виде объекта
	
******************************************************************************************/
function bg_bibrefs_booklist ($lang) {
	global $bg_bibrefs_bookTitle;
	$lang = include_books($lang);
	$num_books = count($bg_bibrefs_bookTitle);
	$books = array_keys ( $bg_bibrefs_bookTitle);
	$booklist = array();
	for ($i = 0; $i< $num_books; $i++) { 
		$booklist[$i]['value']=$books[$i];
		$booklist[$i]['name']=$bg_bibrefs_bookTitle[$books[$i]];
	} 
	echo json_encode ($booklist);
}
/*****************************************************************************************
	Генератор ответа AJAX
	
******************************************************************************************/
add_action ('wp_ajax_bg_bibrefs', 'bg_bibrefs_callback');
add_action ('wp_ajax_nopriv_bg_bibrefs', 'bg_bibrefs_callback');

function bg_bibrefs_callback() {
	
	if ( isset($_GET["blang"]) ) bg_bibrefs_booklist ($_GET["blang"]);		
	else {
		$title = $_GET["title"];
		$chapter = $_GET["chapter"];
		if (!$chapter) $chapter = '1-999';
		$lang = $_GET["lang"];
		$type = $_GET["type"];
		if (!$type) $type = 'verses';
		$verses = bg_bibrefs_getQuotes($title, $chapter, $type, $lang);
		if ($verses) {
			$expand_button = '<img src="'.plugins_url( '/js/expand.png' , __FILE__ ).'" style="cursor:pointer; margin-right: 8px;" align="left" width=16 height=16 title1="'.(__('Expand', 'bg_bibrefs' )).'" title2="'.(__('Hide', 'bg_bibrefs' )).'" />';
			echo $expand_button. $verses;
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
add_action('admin_init', 'bg_bibrefs_extra_fields', 1);
// Создание блока
function bg_bibrefs_extra_fields() {
    add_meta_box( 'bg_bibrefs_extra_fields', __('Bible References', 'bg_bibrefs'), 'bg_bibrefs_extra_fields_box_func', 'post', 'normal', 'high'  );
}
// Добавление полей
function bg_bibrefs_extra_fields_box_func( $post ){
?>
	<label for="bg_verses_lang"><?php _e('Language of references and tooltips', 'bg_bibrefs' ); ?></label>
		<select id="bg_verses_lang" name="bg_bibrefs_extra[bible_lang]">
		<?php $bg_verses_lang_val = get_post_meta($post->ID, 'bible_lang', 1); ?>
			<option <?php if($bg_verses_lang_val=="") echo "selected" ?> value=""><?php _e('Default', 'bg_bibrefs' ); ?></option>
			<?php 
			$path = dirname( __FILE__ ).'/bible/';
			if (is_dir($path) && $handle = opendir($path)) {
				while (false !== ($dir = readdir($handle))) { 
					if (is_dir ( $path.$dir ) && $dir != '.' && $dir != '..') {
						include ($path.$dir.'/books.php');
						echo "<option ";
						if($bg_verses_lang_val==$dir) echo "selected";
						echo " value=".$dir.">".$bg_bibrefs_lang_name."</option>\n";
					}
				}
				closedir($handle); 
			} 
			?>
		</select>
	&nbsp;
	<label for="bg_norefs"><?php _e('Ban to highlight references', 'bg_bibrefs' ); ?></label>
		<select id="bg_norefs" name="bg_bibrefs_extra[norefs]">
		<?php $bg_norefs_val = get_post_meta($post->ID, 'norefs', 1); ?>
			<option <?php if($bg_norefs_val=="") echo "selected" ?> value=""><?php _e('Off', 'bg_bibrefs' ); ?></option>
			<option <?php if($bg_norefs_val) echo "selected" ?> value="on"><?php _e('On', 'bg_bibrefs' ); ?></option>
		</select>
	
    <input type="hidden" name="bg_bibrefs_extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}
// Сохранение значений произвольных полей при автосохранении поста
add_action('save_post', 'bg_bibrefs_extra_fields_update', 0);

// Сохранение значений произвольных полей при сохранении поста
function bg_bibrefs_extra_fields_update( $post_id ){

	if (!isset ($_POST['bg_bibrefs_extra_fields_nonce']) ) return false;
    if ( !wp_verify_nonce($_POST['bg_bibrefs_extra_fields_nonce'], __FILE__) ) return false;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
    if ( !current_user_can('edit_post', $post_id) ) return false;

    if( !isset($_POST['bg_bibrefs_extra']) ) return false; 

    $_POST['bg_bibrefs_extra'] = array_map('trim', $_POST['bg_bibrefs_extra']);
    foreach( $_POST['bg_bibrefs_extra'] as $key=>$value ){
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
function bg_bibrefs_options_ini () {
	add_option('bg_bibrefs_site', "azbyka");
	add_option('bg_bibrefs_c_lang', "c");
	add_option('bg_bibrefs_r_lang', "r");
	add_option('bg_bibrefs_g_lang');
	add_option('bg_bibrefs_l_lang');
	add_option('bg_bibrefs_i_lang');
	add_option('bg_bibrefs_c_font', "ucs");
	add_option('bg_bibrefs_page', "");
	add_option('bg_bibrefs_verses_lang', "");
	add_option('bg_bibrefs_show_fn', "");
	add_option('bg_bibrefs_target', "_blank");
	add_option('bg_bibrefs_headers', "on");
	add_option('bg_bibrefs_interpret', "on");
	add_option('bg_bibrefs_parallel', "");
	add_option('bg_bibrefs_norm_refs');
	add_option('bg_bibrefs_show_verses', "on");
	
	add_option('bg_bibrefs_dot', "on");
    add_option('bg_bibrefs_romeh', "on");
    add_option('bg_bibrefs_sepc', "on");
	add_option('bg_bibrefs_strip_space');
	add_option('bg_bibrefs_exceptions',"");
	
	add_option('bg_bibrefs_curl', "on");
	add_option('bg_bibrefs_fgc', "on");
	add_option('bg_bibrefs_fopen', "on");
	add_option('bg_bibrefs_preload');
	add_option('bg_bibrefs_prereq');
	add_option('bg_bibrefs_maxtime', "60");
	add_option('bg_bibrefs_ajaxurl', "");
	add_option('bg_bibrefs_content', "#content");
	add_option('bg_bibrefs_class', "bg_bibrefs");
	add_option('bg_bibrefs_refs_file', "");
	add_option('bg_bibrefs_debug', "");
	
	add_option('bg_bibrefs_version', 0 );
	add_option('bg_bibrefs_folders', array('ru'));
}

// Очистка таблицы параметров при удалении плагина
function bg_bibrefs_deinstall() {
	delete_option('bg_bibrefs_site');
	delete_option('bg_bibrefs_c_lang');
	delete_option('bg_bibrefs_r_lang');
	delete_option('bg_bibrefs_g_lang');
	delete_option('bg_bibrefs_l_lang');
	delete_option('bg_bibrefs_i_lang');
	delete_option('bg_bibrefs_c_font');
	delete_option('bg_bibrefs_page');
	delete_option('bg_bibrefs_verses_lang');
	delete_option('bg_bibrefs_show_fn');
	delete_option('bg_bibrefs_target');
	delete_option('bg_bibrefs_headers');
	delete_option('bg_bibrefs_interpret');
	delete_option('bg_bibrefs_parallel');
	delete_option('bg_bibrefs_norm_refs');
	delete_option('bg_bibrefs_show_verses');
	
	delete_option('bg_bibrefs_dot');
    delete_option('bg_bibrefs_romeh');
    delete_option('bg_bibrefs_sepc');
    delete_option('bg_bibrefs_sepd');
    delete_option('bg_bibrefs_seps');
    delete_option('bg_bibrefs_separator');
	delete_option('bg_bibrefs_strip_space');
	delete_option('bg_bibrefs_exceptions');
	
	delete_option('bg_bibrefs_curl');
	delete_option('bg_bibrefs_fgc');
	delete_option('bg_bibrefs_fopen');
	delete_option('bg_bibrefs_preload');
	delete_option('bg_bibrefs_prereq');
	delete_option('bg_bibrefs_maxtime');
	delete_option('bg_bibrefs_cashe');
	delete_option('bg_bibrefs_ajaxurl');
	delete_option('bg_bibrefs_content');
	delete_option('bg_bibrefs_class');
	delete_option('bg_bibrefs_refs_file');
	delete_option('bg_bibrefs_debug');

	delete_option('bg_bibrefs_submit_hidden');
	delete_option('bg_bibrefs_options_udate');
	
	delete_option('bg_bibrefs_version');
	delete_option('bg_bibrefs_folders');
}

function bg_bibrefs_get_options () {
	global $bg_bibrefs_option;

// Читаем существующие значения опций из базы данных
	$opt = "";
	$c_lang_val = get_option( 'bg_bibrefs_c_lang' );
    $r_lang_val = get_option( 'bg_bibrefs_r_lang' );
    $g_lang_val = get_option( 'bg_bibrefs_g_lang' );
    $l_lang_val = get_option( 'bg_bibrefs_l_lang' );
    $i_lang_val = get_option( 'bg_bibrefs_i_lang' );
	$lang_val = $c_lang_val.$r_lang_val.$g_lang_val.$l_lang_val.$i_lang_val;
	$font_val = get_option( 'bg_bibrefs_c_font' );
	if ($lang_val) $opt = "&".$lang_val;
	if ($font_val && $c_lang_val) $opt = $opt."&".$font_val;
	$bg_bibrefs_option['azbyka'] = $opt;
	
// Общие параметры	отображения ссылок
	$bg_bibrefs_option['site'] = get_option( 'bg_bibrefs_site' );
    $bg_bibrefs_option['page'] = get_option( 'bg_bibrefs_page' );
    $bg_bibrefs_option['target'] = get_option( 'bg_bibrefs_target' );
    $bg_bibrefs_option['content'] = get_option( 'bg_bibrefs_content' );
	if ($bg_bibrefs_option['content'] == "") $bg_bibrefs_option['content'] = 'body';
    $bg_bibrefs_option['class'] = get_option( 'bg_bibrefs_class' );
	if ($bg_bibrefs_option['class'] == "") $bg_bibrefs_option['class'] = 'bg_bibrefs';
	$bg_bibrefs_option['show_verses'] = get_option( 'bg_bibrefs_show_verses' );	

    $bg_bibrefs_option['verses_lang'] = get_option( 'bg_bibrefs_verses_lang' );
    $bg_bibrefs_option['show_fn'] = get_option( 'bg_bibrefs_show_fn' );

    $bg_bibrefs_option['headers'] = get_option( 'bg_bibrefs_headers' );
    $bg_bibrefs_option['interpret'] = get_option( 'bg_bibrefs_interpret' );
    $bg_bibrefs_option['parallel'] = get_option( 'bg_bibrefs_parallel' );

    $bg_bibrefs_option['norm_refs'] = get_option( 'bg_bibrefs_norm_refs' );

	$bg_bibrefs_option['dot'] = get_option( 'bg_bibrefs_dot' );
	$bg_bibrefs_option['romeh'] = get_option( 'bg_bibrefs_romeh' );
	$bg_bibrefs_option['sepc'] = get_option( 'bg_bibrefs_sepc' );
    $bg_bibrefs_option['strip_space'] = get_option( 'bg_bibrefs_strip_space' );

    $bg_bibrefs_option['curl'] = get_option( 'bg_bibrefs_curl' );
    $bg_bibrefs_option['fgc'] = get_option( 'bg_bibrefs_fgc' );
    $bg_bibrefs_option['fopen'] = get_option( 'bg_bibrefs_fopen' );

    $bg_bibrefs_option['pload'] = get_option('bg_bibrefs_preload' );
    $bg_bibrefs_option['preq'] = get_option('bg_bibrefs_prereq' );
	
    $bg_bibrefs_option['maxtime'] = (int) get_option( 'bg_bibrefs_maxtime' );
	
    $bg_bibrefs_option['refs_file'] = get_option( 'bg_bibrefs_refs_file' );
	
    $bg_bibrefs_option['debug'] = get_option('bg_bibrefs_debug' );
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