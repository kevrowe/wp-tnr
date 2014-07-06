/**
 * @author Kev Rowe - http://deathofcmyk.co.uk
 */
(function($) {
	var Slider = function(element, delay) {
		this.element = element;
		this.delay = delay;
	};

	Slider.prototype.element = null;
	Slider.prototype.delay = null;
	Slider.prototype.looping = null;
	Slider.prototype.animating = false;

	Slider.prototype.init = function() {
		this.element.on({
			mouseenter: this.mouseEnter,
			mouseleave: this.mouseExit
		}, { slider: this });

		var slider = this;
		this.element.find('.next a').on('click', function(){slider.next(slider); return false;});
		this.loop();
	};

	Slider.prototype.next = function(slider) {
		// Do not stack animations
		if (slider.animating) {return false;}
		slider.animating = true;

		var current = slider.element.children('.shown');
		var next = current.next('.slide');

		if (next.length == 0) {
			next = slider.element.children().first();
		}

		slider.exit(current, slider.delay);
		window.setTimeout(function(){slider.enter(next, slider.delay);}, slider.delay);
		window.setTimeout(function(){slider.animating = false;}, slider.delay*2);

		return false;
	};

	Slider.prototype.mouseEnter = function(e) {
		var slider = e.data.slider;
		window.clearInterval(slider.looping);
	}

	Slider.prototype.mouseExit = function(e) {
		var slider = e.data.slider;
		slider.loop();
	}

	Slider.prototype.loop = function() {
		var slider = this;
		this.looping = window.setInterval(function() { slider.next(slider); }, 5000);
	};

	Slider.prototype.exit = function(slide, duration) {
		// Elements
		var info = slide.children('.info');
		var heading = info.children('h2');
		var copy = info.children('p');
		var image = slide.find('img').first();

		// Motion Values
		var headingTop = 0 - parseInt(heading.height()) - parseInt(info.css('paddingTop'));
		var copyRight = 0 - parseInt(copy.width()) - parseInt(info.css('paddingRight'));
		var imageLeft = 0 - parseInt(image.width());

		// Animate
		window.setTimeout(function() {
			heading.css('position', 'relative').animate({
				top : headingTop
			}, {
				duration: duration,
				complete : function() {
					slide.removeClass('shown');
				}
			});
		}, 300);

		window.setTimeout(function() {
			copy.css('position', 'relative').animate({
				right : copyRight,
				opacity : 0
			}, duration);
		}, 150)

		image.css('position', 'relative').animate({
			left : imageLeft
		}, {
			duration : duration
		});
	};

	Slider.prototype.enter = function(slide, duration) {
		// Elements
		var info = slide.children('.info');
		var heading = info.children('h2');
		var copy = info.children('p');
		var image = slide.find('img').first();

		slide.addClass('shown');

		// Motion Values
		var headingTop = 0 - parseInt(heading.height()) - parseInt(info.css('paddingTop'));
		var copyRight = 0 - parseInt(copy.width()) - parseInt(info.css('paddingRight'));
		var imageLeft = 0 - parseInt(image.width());

		heading.css({
			'position' : 'relative',
			top : headingTop
		});

		copy.css({
			'position' : 'relative',
			right : copyRight
		});

		image.css({
			'position' : 'relative',
			left : imageLeft
		});

		// Animate
		heading.animate({
			top : 0
		}, duration);

		copy.css('position', 'relative').animate({
			right : 0,
			opacity : 1
		}, duration);

		image.css('position', 'relative').animate({
			left : 0
		}, duration);
	};

	$(document).ready(function() {
		var s = new Slider($('.thumb-carousel'), 500);
		s.init();
	});
})(jQuery)
