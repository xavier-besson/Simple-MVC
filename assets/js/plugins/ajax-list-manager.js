(function ($) {
	var settings = {
		loaderSelector: 'data-list-loader',
		load: function(){
			
		},
		actions: []
	};

	var methods = {
		init: function (options) {
			settings = $.extend(settings, options);
			return this.each(function (list) {
				$list = $(list);

				/*Init actions*/
				$.each(settings.actions, function (action) {
					$list.on(action.event, action.selector, action.fn);
				});
			});
		}
	};
	
	function appendContent(data){
		
	}

	$.fn.ajaxListManager = function (methodOrOptions) {
		if (methods[methodOrOptions]) {
			return methods[ methodOrOptions ].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof methodOrOptions === 'object' || !methodOrOptions) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + methodOrOptions + ' does not exist on jQuery.listManager');
		}
	};
}(jQuery));

