jQuery.parseString = function(str){
	var args = {};
	str = str.split(/&/g);
	for(var i=0;i<str.length;i++){
		if(/^([^=]+)(?:=(.*))?$/.test(str[i])) args[RegExp.$1] = decodeURIComponent(RegExp.$2);
	}
	return args;
};
jQuery(function($) {
	var code = null;

	$('.search .sub-category').change(function(){
		var $this = $(this), url = this.value, text = $this.find('>option').eq(this.selectedIndex).text(),issibling = $this.find('>option').eq(this.selectedIndex).hasClass('sibling');
		if(url) loadPage(url);
		
        if (issibling)
		    $('ul.breadcrumbs').find('.last').remove();
		$('ul.breadcrumbs').append('<li class="last">/ <a href="'+url+'">'+text+'</a></li>');
	});

	$('.price-range').change(function(){
		var range = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(range != '-1'){
			args.p = range;
		} else {
			delete args.p;
		}
		if(query = $.param(args)) url += '?'+'p='+range;
		loadPage(url);
	});

	$('.search .color-filter').change(function(){
		var color = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(color){
			args.c = color;
		} else {
			delete args.c;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});
    
    $('.search .sort-by-price').change(function(){
		var sort_by_price = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(sort_by_price){
			args.sort_by_price = sort_by_price;
		} else {
			delete args.sort_by_price;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});
	
    $('.search .relationship').change(function(){
		var relationship = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(relationship){
			args.rel = relationship;
		} else {
			delete args.rel;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});

	$('.search .se-gender').change(function(){
		var gender = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(gender){
			args.sg = gender;
		} else {
			delete args.sg;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});

	$('.search .re-gender').change(function(){
		var gender = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(gender){
			args.rg = gender;
		} else {
			delete args.rg;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});
    $('#immediateShipping').change(function(){
        var v = this.value, url = location.pathname, args = $.extend({}, location.args), query;

        if ($(this).closest('label').hasClass('on')) {
            delete args.is;
            $(this).closest('label').removeClass('on');
        } else {
            args.is = v;
            $(this).closest('label').addClass('on');
        }

        if(query = $.param(args)) url += '?'+query;
       loadPage(url);
    });


	function loadPage(url, skipSaveHistory){
		var $win     = $(window),
			$stream  = $('#content #results'),
			$lis     = $stream.find('>li'),
			scTop    = $win.scrollTop(),
			stTop    = $stream.offset().top,
			winH     = $win.innerHeight(),
			headerH  = $('#header-new').height(),
			useCSS3  = '',
			firstTop = -1,
			maxDelay = 0,
			begin    = Date.now();

		if(useCSS3){
			$stream.addClass('use-css3').removeClass('fadein');

			$lis.each(function(i,v){
				if(!inViewport(v)) return;
				if(firstTop < 0) firstTop = v.offsetTop;

				var delay = Math.round(Math.sqrt(Math.pow(v.offsetTop - firstTop, 2)+Math.pow(v.offsetLeft, 2)));

				v.className += ' anim';
				setTimeout(function(){ v.className += ' fadeout'; }, delay+10);

				if(delay > maxDelay) maxDelay = delay;
			});
		}

		if(!skipSaveHistory && window.history && history.pushState){
			history.pushState({url:url}, document.title, url);
		}
		location.args = $.parseString(location.search.substr(1));
						
		$.ajax({
			type : 'GET',
			url  : url,
			dataType : 'html',
			success  : function(html){
				var $html = $($.trim(html));
				$stream.html( $html.find('#results').html());
				}
			
		});

		function inViewport(el){
			return (stTop + el.offsetTop + el.offsetHeight > scTop + headerH) && (stTop + el.offsetTop < scTop + winH);
		};
	};
    var tooltip = function(target) {
        var $target = $(target);
        if (!$('#tooltip').length) {
            $('<span>').attr('id','tooltip').appendTo(document.body);
        }
        var $tooltip = $('#tooltip').show();

        $tooltip.text($target.text());
        var o = $target.offset();
        o.left = Math.round(o.left - ($tooltip.width() + 16 - $target.width()) / 2); //16:#tooltip's padding
        o.top = Math.round(o.top - ($tooltip.height() + 9));
        $('#tooltip').offset(o);
    };

    $('.tooltip').hover(function() {
        tooltip(this);
    }, function() {
        $('#tooltip').hide();
    })
	function attachHotkey(){
		$(document).on('keydown.shop', function(event){
			var key = event.which, tid, $li;
			if(!dlg_detail.showing() || (key != 37 /* LEFT */ && key != 39 /* RIGHT */)) return;

			event.preventDefault();

			dlg_detail.$obj.find(key==37?'>.btn-prev':'>.btn-next').click();
		});
	};

	function detachHotkey(){
		$(document).off('keydown.shop');
	};

	(function(){
		var $cate_sel = $('.shop-select.sub-category')
		if($cate_sel.attr('edge')){
			$('ul.sub-category-selectBox-dropdown-menu > li').removeClass('subcategory');
		} else {
			$('ul.sub-category-selectBox-dropdown-menu > li:not(:first-child)').addClass('subcategory');
		}
	})();

	$(window).on('popstate', function(event){
		var e = event.originalEvent;
		if(!e || !e.state) return;

		loadPage(event.originalEvent.state.url, true);
	});

	if(window.history && history.pushState){
		history.pushState({url:location.href}, document.title, location.href);
	}
});
