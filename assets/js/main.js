var $modal, $modalClose, $modalTitle, $modalContent;

$(document).ready(function () {

	// Init foundation
	$(document).foundation({
		abide: {
			timeout: 1
		}
	});

	$logout = $('#logout');

	$modal = $('#modal');
	$modalClose = $('#modal-close');
	$modalTitle = $('#modal-title');
	$modalContent = $('#modal-content');

	$modalClose.on('click', function (event) {
		closeModal();

		event.preventDefault();
		return false;
	});

	$logout.on('click', function (event) {
		logout();

		event.preventDefault();
		return false;
	});

	function logout() {
		sendAjaxRequest({
			type: 'DELETE',
			url: '/login',
			data: {},
			before: function () {

			},
			done: function (data) {
				window.location.href = '/login';
			},
			fail: function (jqXHR, textStatus) {
				showModal('Error', 'An error occured');
			},
			always: function () {
			}
		});
	}
});

function sendAjaxRequest(args) {
	if (!_.isUndefined(args.before)) {
		args.before();
	}

	request = $.ajax({
		type: args.type,
		url: args.url,
		data: args.data
	});

	if (!_.isUndefined(args.done)) {
		request.done(args.done);
	}

	if (!_.isUndefined(args.fail)) {
		request.fail(args.fail);
	}

	if (!_.isUndefined(args.always)) {
		request.always(args.always);
	}
}

function showModal(title, content) {
	$modalTitle.html(title);
	$modalContent.html(content);
	$modal.foundation('reveal', 'open');
}

function closeModal() {
	$modal.foundation('reveal', 'close');
}