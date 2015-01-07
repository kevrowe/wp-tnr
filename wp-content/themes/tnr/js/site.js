(function($, TNRContact) {
	TNRContact.formSendSuccess = function () {
		var completeMessage = TNRContact.completeMessage || 'Thank you for getting in touch, we will respond as soon as possible.';
		var container = $('.feature-block');
		var thankYouElem = $('<h1 style="display:none;">'+completeMessage+'</h1>');

		container
			.children()
			.slideUp();
		container
			.append(thankYouElem);
		thankYouElem
			.slideDown();
	}
})(jQuery, window.TNRContactOverride = window.TNRContactOverride || {});