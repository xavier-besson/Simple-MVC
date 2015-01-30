$(document).ready(function () {
	// Define jQuery Object

	var $form = $('#form');
	var $formLoader = $('#form-loader');
	var $formCancel = $('#form-cancel');

	$form.on('valid', function (event) {
		sendFormData();
		
		event.preventDefault();
		return false;
	});

	$formCancel.on('click', function (event) {
		resetForm();
	});

	function sendFormData() {
		sendAjaxRequest({
			type: 'POST',
			url: '/login',
			data: $form.serialize(),
			before: function () {
				$formLoader.addClass('visible');
			},
			done: function (data) {
				if(data.success){
					window.location.reload();
				}
				else{
					showModal(data.title, data.message);
				}

			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$formLoader.removeClass('visible');
			}
		});
	}

	function resetForm() {
		$form[0].reset(); // Reset abide
	}

});