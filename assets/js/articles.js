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
		
	var listEditSelector = '[data-articles-edit]';
	var listDeleteSelector = '[data-articles-delete]';
	var listCancelSelector = '[data-articles-cancel]';
	var listStatusSelector = '[data-articles-status]';
	
	// Filter
	var $filterUser = $('#filter-user');
	var $filterStatus = $('#filter-status');

	// Define current data object
	var currentArticle = null;

	// Init event
	$addArticle.on('click', function (event) {
		showFormContainer();
		initForm(null);
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
	
	$filterUser.on('change', function (event) {
		updateList();
		event.preventDefault();
		return false;
	});
	
	$filterStatus.on('change', function (event) {
		updateList();
		event.preventDefault();
		return false;
	});
	
	$list.on('click', listEditSelector, function (event) {
		editArticle($(this).data('articles-edit'));
		event.preventDefault();
		return false;
	});
	
	$list.on('change', listStatusSelector, function (event) {
		updateArticleStatus($(this).data('articles-status'), $(this).val());
		event.preventDefault();
		return false;
	});

	$list.on('click', listDeleteSelector, function (event) {
		if (confirmDelete()) {
			deleteArticle($(this).data('articles-delete'));
		}
		event.preventDefault();
		return false;
	});
	
	$list.on('click', listCancelSelector, function (event) {
		if (confirmAction()) {
			cancelArticle($(this).data('articles-cancel'));
		}
		event.preventDefault();
		return false;
	});

	// Global init
	$listRefresh.trigger('click');

	// Form and list functions
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

	function updateList() {
		var data = {};
		
		if($filterStatus.val() !== '-1'){
			data['status'] = $filterStatus.val();
		}
		
		if($filterUser.val() !== '-1'){
			data['user'] = $filterUser.val();
		}
		
		sendAjaxRequest({
			type: 'GET',
			url: 'articles/list',
			data: data,
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

	function deleteArticle(id) {
		sendAjaxRequest({
			type: 'POST',
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
	
	function cancelArticle(id) {
		sendAjaxRequest({
			type: 'POST',
			url: 'article/cancel',
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
	
	function updateArticleStatus(id, status) {
		sendAjaxRequest({
			type: 'POST',
			url: 'article/status',
			data: {
				id: id,
				status: status
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


});