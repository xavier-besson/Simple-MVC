$(document).ready(function () {
	// Define jQuery Object

	var $form = $('#form');
	var $formLoader = $('#form-loader');
	var $formCancel = $('#form-cancel');

	var $userId = $('#id');
	var $userUsername = $('#username');
	var $userPassword = $('#password');
	var $userPasswordConfirm = $('#password-confirm');

	var $headerUsername = $('#header-username');

	var currentUser = null;

	$form.on('valid', function (event) {
		sendFormData();

		event.preventDefault();
		return false;
	});

	$formCancel.on('click', function (event) {
		resetForm();
	});

	initFormData();

	function sendFormData() {
		sendAjaxRequest({
			type: 'POST',
			url: '/user/save',
			data: $form.serialize(),
			before: function () {
				$formLoader.addClass('visible');
			},
			done: function (data) {
				if (data.success) {
					showModal('Good job', 'Your personnal data are up to date');
					$headerUsername.html($userUsername.val());
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

	function resetForm() {
		$form[0].reset(); // Reset abide
	}

	function initFormData() {
		sendAjaxRequest({
			type: 'GET',
			url: '/user',
			data: {
				id: window.user.id
			},
			before: function () {
				$formLoader.addClass('visible');
			},
			done: function (data) {
				currentUser = data;
				setFormData(data);
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$formLoader.removeClass('visible');
			}
		});
	}

	function setFormData(data) {
		if (data !== null) {
			$userId.val(data.id);
			$userUsername.val(data.username);
		}
	}

});