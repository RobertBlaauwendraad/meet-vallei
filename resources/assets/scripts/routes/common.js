/*eslint no-undef: 0*/ //added because of undefined autocomplete var (see app/meetvallei/functions/autocomplete)

export default {
	init() {
// JavaScript to be fired on all pages
	},
	finalize() {

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
