// html request. My standard.
$(function() {
  /* Prepare Search
   * ============== */
	$('#search_term').keypress(function (e) {
		if(e.which == 13) {
			e.preventDefault();
			doSearch();
			$('#search_term').val('');
		}
	});
  /* Initial Gets
   * ============ */
	emerge.ajax_get('views/show_data.php', 'main_container');
});
function showForm() {
	emerge.ajax_get('views/suggest_form.php', 'main_container');
	emerge.ajax_get('views/help/suggest_help.html', 'left_container');
	// Init tinyMCE
	tinymce.init({
		menubar: false,
		statusbar: false,
		rows: '5',
		cols: '2',
		selector: "textarea"
	});
}

function doSearch() {
	var search_term = $('#search_term').val();
	emerge.ajax_get('views/show_data.php?search=' + search_term, 'main_container');
}

// Utility Dialog
function genericDialog(title, url) {
	var formBody = $('<div>', {
		title: title,
		id: 'utilDialog'
	});

  var data = emerge.ajax_get(url);
	formBody.html(data);
	formBody.dialog({
		height: 400,
		width: 750,
		show: 'fade',
		close: function() {
			$(this).remove();
		},
		buttons: {
			'Close': function() {
				$(this).effect('fade', function() {
					$(this).remove();
				});
			}
		}
	});
}
