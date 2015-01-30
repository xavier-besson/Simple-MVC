$(document).ready(function () {
	// Define jQuery Object

	// Global
	var $addArticle = $('#add-article');

	// Form
	var $form = $('#form');
	var $formLoader = $('#form-loader');
	var $formTitle = $('#form-title');
	var $formCancel = $('#form-cancel');
	var $articleId = $('#id');
	var $articleName = $('#name');
	var $articleLink = $('#link');
	var $articleQuantity = $('#quantity');
	var $articleUnitPrice = $('#unit_price');
	var $articleContent = $('#content');
	var $formClose = $('#form-close');
	var $formContainer = $('#form-container');

	// List
	var $list = $('#list');
	var $listLoader = $('#list-loader');
	var $listRefresh = $('#list-refresh');

	// Define data object
	var currentArticle = null;

	// Init event
	$addArticle.on('click', function (event) {
		// Show the form container and init the form
		showFormContainer();
		initForm(null);

		// Cancel default event propagation
		event.preventDefault();
		return false;
	});

	$formClose.on('click', function (event) {
		// Hide the form container
		hideFormContainer();

		// Cancel default event propagation
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
	});

	$listRefresh.on('click', function (event) {
		updateList();

		event.preventDefault();
		return false;
	});

	// Global init
	$listRefresh.trigger('click');


// Form functions
	function showFormContainer() {
		$formContainer.removeClass('hide');
	}

	function hideFormContainer() {
		$formContainer.addClass('hide');
	}

	function initForm(data) {
		if (data === null) {
			$formTitle.html('Add a new article');
			$articleId.val(0);
			$articleName.val('');
			$articleLink.val('');
			$articleQuantity.val('');
			$articleUnitPrice.val('');
			$articleContent.val('');
		}
		else {
			$formTitle.html('Edit article');
			$articleId.val(data.id);
			$articleName.val(data.name);
			$articleLink.val(data.link);
			$articleQuantity.val(data.quantity);
			$articleUnitPrice.val(data.unit_price);
			$articleContent.val(data.content);
		}
	}

	function resetForm() {

		var id = parseInt($articleId.val(), 10);

		$form[0].reset(); // Reset abide

		if (id === 0) {
			$articleId.val(0);
			$articleName.val('');
			$articleLink.val('');
			$articleQuantity.val('');
			$articleUnitPrice.val('');
			$articleContent.val('');
		}
		else {
			$articleId.val(id);
			$articleName.val(currentArticle.name);
			$articleLink.val(currentArticle.link);
			$articleQuantity.val(currentArticle.quantity);
			$articleUnitPrice.val(currentArticle.unit_price);
			$articleContent.val(currentArticle.content);
		}
	}

	function sendFormData() {

		sendAjaxRequest({
			type: 'POST',
			url: '/article/save',
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

	function showList(data) {

		$list.empty();
		var $tr, $td, $a, total, owner;
		var admin = window.user.role == 1;

		$.each(data, function (key, item) {

			total = parseInt(item.quantity, 10) * parseFloat(item.unit_price, 10);

			$tr = $('<tr></tr>');
			$list.append($tr);

			$tr.append('<td>' + item.id + '</td>');
			$tr.append('<td>' + (_.isNull(item.user) ? '-' : item.user.username) + '</td>');
			
			$td = $('<td></td>');
			
			$tr.append($td);
			if (item.link !== '') {
				$td.append('<a href="' + item.link + '" target="_blank">' + item.name + '</a>');
			}
			else {
				$td.append(item.name);
			}
			$td.append('<br><small>' + String(item.content).replace(/\n/g, "<br>") + '</small>');

			$tr.append('<td class="text-right">' + item.quantity + '</td>');
			$tr.append('<td class="text-right">' + (item.unit_price === '' ? '-' : item.unit_price) + '</td>');
			$tr.append('<td class="text-right">' + (isNaN(total) ? '-' : total) + '</td>');

			$td = $('<td></td>');
			$tr.append($td);

			// Check if the logged user is the line owner
			owner = false;
			if (!_.isNull(item.user)) {
				if (item.user.id == window.user.id) {
					owner = true;
				}
			}

			if (owner || admin) {
				$a = $('<a href="#">Edit</a>');
				addEditEvent($a, item.id);
				$td.append($a);

				$td.append('&nbsp;/&nbsp;');

				$a = $('<a href="#">Delete</a>');
				addDeleteEvent($a, item.id);
				$td.append($a);
			}
		});
	}

	function addEditEvent($item, id) {
		$item.on('click', function (event) {
			editArticle(id);

			event.preventDefault();
			return false;
		});
	}

	function addDeleteEvent($item, id) {
		$item.on('click', function (event) {
			deleteArticle(id);

			event.preventDefault();
			return false;
		});
	}

	function updateList() {
		sendAjaxRequest({
			type: 'GET',
			url: 'article/list',
			data: {},
			before: function () {
				$listLoader.addClass('visible');
			},
			done: function (data) {
				showList(data);
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
				$listLoader.removeClass('visible');
			}
		});
	}

	function deleteArticle(id) {
		sendAjaxRequest({
			type: 'GET',
			url: 'article/delete',
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

	function editArticle(id) {

		sendAjaxRequest({
			type: 'GET',
			url: 'article',
			data: {
				id: id
			},
			before: function () {
				showFormContainer();
				$formLoader.addClass('visible');
			},
			done: function (data) {
				currentArticle = data;
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

});