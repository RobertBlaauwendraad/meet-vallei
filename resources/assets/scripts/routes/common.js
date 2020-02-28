/*eslint no-undef: 0*/ //added because of undefined autocomplete var (see app/meetvallei/functions/autocomplete)

export default {
	init() {
// JavaScript to be fired on all pages
	},
	finalize() {
// JavaScript to be fired on all pages, after page specific JS is fired

/*
	 ** Search autocomplete
	 */
	$('#autocomplete').autocomplete({
		serviceUrl: autocomplete.url,
		appendTo: '#search .results',
		deferRequestBy: 0,
		lookupLimit: 20,
		maxHeight: false,
		minChars: 1,
		showNoSuggestionNotice: true,
		noSuggestionNotice: $(this).data('no-result'),
		type: 'GET',
		width: 'auto',
		params: {
			action: 's7_autocomplete',
		},
		//onSearchStart: function (query) {},
		//onSearchComplete: function (query, suggestions) {},
		formatResult: function (suggestion) {
			//console.log(suggestion);

			var html = `
	<div class="suggestion">
					<a href="${suggestion.data.permalink}">'${suggestion.value}
				<span class="type">${suggestion.data.post_type}</span>
			</a>
			</div>`;

			return html;
		},
		onSelect: function (suggestion) {
			window.location = suggestion.data.permalink;
		},
	});

// Change modal content when opening modal
$('#modal').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget);
		var title = button.data('title') ? button.data('title') : '';
		var content = JSON.parse(button.data('content'));
		var modal = $(this);
		modal.find('.modal-header').prepend('<h5 class="modal-title" id="modalLabel">' + title + '</h5>');
		modal.find('.modal-body').html(content)
});

// Remove modal content after its hidden
$('#modal').on('hidden.bs.modal', function() {
		var modal = $(this);
		modal.find('.modal-title').remove();
		modal.find('.modal-body').html('');
});

	/*
	 ** Show results if keywords are provided
	 */
	$('#autocomplete').on('keyup', function () {
		if($(this).val().length === 0) {
			$('div.foil').css('display', 'none');
		} else {
			$('div.foil').css('display', 'block');
		}
	});

	$('#eetstoornis').change(function() {
		$.ajax({
			// $(this).val()
			url: my_ajax_object.ajax_url,
			fail: function() {
				console.log('Fail');
			},
			success: function() {
				console.log('succes');
				var html = '<div><input type="range" class="custom-range" id="customRange1"></div>';
				$('.input-group').parent().append(html);
			},
		});
	});

	// $(document).on('click', '.btn-selecteren', function(){
	// 	var html = '<div><input type="range" class="custom-range" id="customRange1"></div>';
	// 	$('.input-group').parent().append(html);
	// })
	// Get the modal

	var modal = document.getElementById('modal');

	// Get the button that opens the modal
	var btn = document.getElementById('settings');

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName('close')[0];

	// When the user clicks on the button, open the modal
	btn.onclick = function() {
	modal.style.display = 'block';
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	modal.style.display = 'none';
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = 'none';
	}
	}
	},
};
