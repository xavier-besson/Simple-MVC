$(document).ready(function () {
	// Define jQuery Object

	// Global
	var $addUser = $('#add-user');

	// Form
	var $form = $('#form');
	var $formLoader = $('#form-loader');
	var $formTitle = $('#form-title');
	var $formCancel = $('#form-cancel');
	var $userId = $('#id');
	var $userUsername = $('#username');
	var $userPassword = $('#password');
	var $userPasswordConfirm = $('#password-confirm');
	var $userRole = $('#role');
	var $formClose = $('#form-close');
	var $formContainer = $('#form-container');
	var $formDefaultContainer = $('#form-default-container');
	var $formPasswordContainer = $('#form-password-container');

	// List
	var $list = $('#list');
	var $listLoader = $('#list-loader');
	var $listRefresh = $('#list-refresh');

	var listEditSelector = '[data-user-edit]';
	var listDeleteSelector = '[data-user-delete]';
	var listPasswordSelector = '[data-user-password]';

	// Define current data object
	var currentUser = null;

	// Init event
	$addUser.on('click', function (event) {
		addUser();
		event.preventDefault();
		return false;
	});

	$formClose.on('click', function (event) {
		hideFormContainer();
		event.preventDefault();
		return false;
	});

	$form.on('valid', function (event) {
		sendFormData();
		event.preventDefault();
		return false;
	});

	$formCancel.on('click', function (event) {
		resetForm();
		event.preventDefault();
		return false;
	});

	$listRefresh.on('click', function (event) {
		updateList();
		event.preventDefault();
		return false;
	});
	
	$list.on('click', listPasswordSelector, function (event) {
		editUserPassword($(this).data('user-password'));
		event.preventDefault();
		return false;
	});

	$list.on('click', listEditSelector, function (event) {
		editUser($(this).data('user-edit'));
		event.preventDefault();
		return false;
	});

	$list.on('click', listDeleteSelector, function (event) {
		if (confirmDelete()) {
			deleteUser($(this).data('user-delete'));
		}
		event.preventDefault();
		return false;
	});

	// Global init
	$listRefresh.trigger('click');

	function updateList() {
		sendAjaxRequest({
			type: 'GET',
			url: 'users/list',
			data: {},
			before: function () {
				$listLoader.addClass('visible');
			},
			done: function (data) {
				appendList(data);
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$listLoader.removeClass('visible');
			}
		});
	}

	// Form and list functions
	function sendFormData() {

		sendAjaxRequest({
			type: 'POST',
			url: '/user/save',
			data: $form.serialize(),
			before: function () {
				$formLoader.addClass('visible');
			},
			done: function (data) {
				updateList();
				initForm(null);
				hideFormContainer();
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$formLoader.removeClass('visible');
			}
		});
	}

	function addUser() {
		$formDefaultContainer.removeClass('hide');
		$userUsername.attr('required', '');
		$userRole.attr('required', '');
		
		$formPasswordContainer.removeClass('hide');
		$userPassword.attr('required', '');
		$userPasswordConfirm.attr('required', '');
		
		showFormContainer();
		initForm(null);
	}

	function deleteUser(id) {
		sendAjaxRequest({
			type: 'POST',
			url: 'user/delete',
			data: {
				id: id
			},
			before: function () {
				$listLoader.addClass('visible');
			},
			done: function (data) {
				updateList();
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$listLoader.removeClass('visible');
			}
		});
	}

	function editUser(id) {
		$formDefaultContainer.removeClass('hide');
		$userUsername.attr('required', '');
		$userRole.attr('required', '');
		
		$formPasswordContainer.addClass('hide');
		$userPassword.removeAttr('required');
		$userPasswordConfirm.removeAttr('required');

		sendAjaxRequest({
			type: 'GET',
			url: 'user',
			data: {
				id: id
			},
			before: function () {
				showFormContainer();
				$formLoader.addClass('visible');
			},
			done: function (data) {
				currentUser = data;
				initForm(data);
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$formLoader.removeClass('visible');
			}
		});
	}
	
	function editUserPassword(id) {
		$formDefaultContainer.addClass('hide');
		$userUsername.removeAttr('required');
		$userRole.removeAttr('required');
		
		$formPasswordContainer.removeClass('hide');
		$userPassword.attr('required', '');
		$userPasswordConfirm.attr('required', '');

		sendAjaxRequest({
			type: 'GET',
			url: 'user',
			data: {
				id: id
			},
			before: function () {
				showFormContainer();
				$formLoader.addClass('visible');
			},
			done: function (data) {
				currentUser = data;
				initForm(data);
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$formLoader.removeClass('visible');
			}
		});
	}

	function appendList(data) {
		$list.empty().append(data);
	}

	function showFormContainer() {
		$formContainer.removeClass('hide');
	}

	function hideFormContainer() {
		$formContainer.addClass('hide');
	}

	function initForm(data) {
		if (data === null) {
			$formTitle.html('Add a new user');
			$userId.val(0);
			$userUsername.val('');
			$userRole.val('');
			$userPassword.val('');
			$userPasswordConfirm.val('');
		}
		else {
			$formTitle.html('Edit an user');
			$userId.val(data.id);
			$userUsername.val(data.username);
			$userRole.val(data.role);
		}
	}

	function resetForm() {

		var id = parseInt($userId.val(), 10);

		$form[0].reset(); // Reset abide

		if (id === 0) {
			$userId.val(0);
			$userUsername.val('');
			$userRole.val('');
			$userPassword.val('');
			$userPasswordConfirm.val('');
		}
		else {
			$userId.val(id);
			$userUsername.val(currentUser.name);
			$userRole.val(currentUser.role);
			$userPassword.val('');
			$userPasswordConfirm.val('');
		}
	}


});