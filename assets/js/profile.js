$(document).ready(function () {
	// Define jQuery Object

	var $form = $('#form');
	var $formPassword = $('#form-password');
	var $formLoader = $('#form-loader');
	var $formCancel = $('#form-cancel');
	var $formPasswordCancel = $('#form-password-cancel');
	var $headerUsername = $('#header-username');
	
	var $userUsername = $('#username');
	var $userPasswordCurrent = $('#password-current');
	var $userPassword = $('#password');
	var $userPasswordConfirm = $('#password-confirm');

	$form.on('valid', function (event) {
		profileUpdate();

		event.preventDefault();
		return false;
	});

	$formPassword.on('valid', function (event) {
		passwordUpdate();

		event.preventDefault();
		return false;
	});

	$formCancel.on('click', function (event) {
		resetForm($form);
	});

	$formPasswordCancel.on('click', function (event) {
		resetForm($formPassword);
	});

	function profileUpdate() {
		sendAjaxRequest({
			type: 'POST',
			url: '/profile/save',
			data: $form.serialize(),
			before: function () {
				$formLoader.addClass('visible');
			},
			done: function (data) {
				if (data.success) {
					showModal('Your personnal data are up to date');
					$headerUsername.html($userUsername.val());
				}
				else {
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

	function passwordUpdate() {
		sendAjaxRequest({
			type: 'POST',
			url: '/profile/password',
			data: $formPassword.serialize(),
			before: function () {
				$formLoader.addClass('visible');
			},
			done: function (data) {
				if (data.success) {
					showModal('Your personnal password is up to date');
					$userPasswordCurrent.val('');
					$userPassword.val('');
					$userPasswordConfirm.val('');
				}
				else {
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

	function resetForm($elt) {
		$elt[0].reset(); // Reset abide
	}

});