function initMenus() {
	$('ul.menu ul').hide();
	$('ul.menu ul li ul').hide();
	$.each($('ul.menu'), function(){
		$('#' + this.id + '.expandfirst ul:first').show();
	});
	
	
	$('ul.menu li ul li span').click(
		function() {
			var checkElement = $(this).next();
			
			var parent = this.parentNode.parentNode.parentNode.id;
			alert(parentNode);

			if($('#' + parent).hasClass('noaccordion')) {
				$(this).next().slideToggle('normal');
				return false;
			}
			if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
				if($('#' + parent).hasClass('collapsible')) {
					$('#' + parent + ' ul:visible').slideUp('normal');
				}
				return false;
			}
			if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
				$('#' + parent + ' ul:visible').slideUp('normal');
				checkElement.slideDown('normal');
				return false;
			}
		}
	);
	
	$('ul.menu li a').click(
		function() {
			var checkElement = $(this).next();
			var parent = this.parentNode.parentNode.id;

			if($('#' + parent).hasClass('noaccordion')) {
				$(this).next().slideToggle('normal');
				return false;
			}
			if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
				if($('#' + parent).hasClass('collapsible')) {
					$('#' + parent + ' ul:visible').slideUp('normal');
				}
				return false;
			}
			if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
				$('#' + parent + ' ul:visible').slideUp('normal');
				checkElement.slideDown('normal');
				return false;
			}
		}
	);
	
	
	
	
	
}
$(document).ready(function() {initMenus();});