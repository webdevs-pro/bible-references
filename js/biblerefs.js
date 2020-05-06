
jQuery(document).ready(function($){


	var verses_query_string = '';
	// open popup
	$('span.bg_data_title').click(function(){

		// get verses query string
		verses_query_string = $(this).attr('data-title');
		console.log(verses_query_string);

		// open popup
		$('.bible_references').addClass('br_popup_visible');
		$('#bible_books').val(getQueryStringParameter(verses_query_string, 'lang'));

		// print verses 
		$('.bible_references_popup_verses').html(getBibleVerses(verses_query_string));

	});




	// select translation
	$('#bible_books').on('change', function(e){
		console.log($(this).val());
		var new_verses_query_string = updateQueryStringParameter(verses_query_string, 'lang', $(this).val());
		$('.bible_references_popup_verses').html(getBibleVerses(new_verses_query_string));
	});






	// close popup
	$('.bible_references').click(function(e){
		console.log(e.target.className);
		if(e.target.className == 'bible_references br_popup_visible' || e.target.className == 'bible_references_popup_close') {
			$(this).removeClass('br_popup_visible');
			$('.bible_references_popup_verses').html('');
		}
	});







	// get bible verses (AJAX)
	function getBibleVerses(queryString) {
		var return_verses = '';
		$.ajax({
			type: 'GET',
			cache: false,
			async: false,									// Асинхронный запрос
			dataType: 'text',
			url: bg_bibrefs.ajaxurl + queryString,	// Запрос стихов Библии
			data: {
				action: 'bg_bibrefs'
			},
			success: function (verses, textStatus) {		// Если что-то пришло с сервера 
				if (verses) {
					return_verses =  verses;
				} 
			},
			error: function () {
				// Если ошибка, то восстанавливаем стандартную подсказку
			}
			
		}); 
		return return_verses;
	}	






	// update query string parameter
	function updateQueryStringParameter(uri, key, value) {
		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
		var separator = uri.indexOf('?') !== -1 ? "&" : "?";
		if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
		return uri + separator + key + "=" + value;
		}
	}





	
	// get query string parameter
	function getQueryStringParameter(uri, key) {
		var re = new RegExp('[\?&]' + key + '=([^&#]*)');
		if(uri.match(re)) {
			return uri.match(re)[1]
		} else {
			return '';
		}
	}
  
 
























 });
