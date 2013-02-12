/*
 * jQuery Page Carousel
 * @author admin@catchmyfame.com - http://www.catchmyfame.com
 * @version 1.0.0
 * @date August 6, 2011
 * @category jQuery plugin
 * @copyright (c) 2011 admin@catchmyfame.com (www.catchmyfame.com)
 * @license - Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) http://creativecommons.org/licenses/by-sa/3.0/
 */

(function($){
	$.fn.extend({ 
		pageCarousel: function(options)
		{
			var defaults = 
			{
				transitionSpeed: 800,
				showLinks: true,
				showArrows: true,
				links: 'both', // left, right, both
				linkPosition: 'under', // under, top, bottom
				navWidth: '60px',
				navHeight: '20px',
				pageWidth: $(document).width(),
				easeLeft: 'linear',
				easeRight: 'linear',
				nextPrevImagePath: '/js/pagecarousel/images/nextprev.png',
				nextPrevImageSize: {'width':96,'height':48},
				padding: '0px',
				peekAmount: '0px',
				scrollContainer: false,
				onSlideStart: function(){},
				onSlideEnd: function(){}
			};
			
			var options = $.extend(defaults, options);

    		return this.each(function() {

    		var randID = Math.round(Math.random()*100000000);
			var o=options;
			var obj = $(this);
			var pageHeight = 0;
			$(obj).width(o.pageWidth);

			if(parseInt(o.peekAmount) != 0) $(obj).css({'padding-left':o.peekAmount,'padding-right':o.peekAmount});
			if(o.showArrows) if( $(obj).width()+(o.nextPrevImageSize.width+4)+(2*parseInt(o.peekAmount)) >= $(window).width() ) $(obj).width( $(window).width() - (o.nextPrevImageSize.width+4) - (2*parseInt(o.peekAmount)) ); // arrow width + (2px padding * 2)
			if(o.showLinks) if( $(obj).width()+24+(2*parseInt(o.navWidth))+(2*parseInt(o.peekAmount)) >= $(window).width() ) $(obj).width( $(window).width() - (2*parseInt(o.navWidth)) - (2*parseInt(o.peekAmount)) - 24); // 24 = (8px body pad + 4px nav border)*2
			
			var pageWidth = $(obj).width();
			var id_array = new Array();
			var viewable = [], unviewable = [];

			$('> ul > li',this).addClass('page').each(function(index){ $(this).attr('id','page-'+(index+1)); id_array.push($(this).attr('id').substr(5)); });
			var numPages = $('li.page', obj).length; // Number of pages

			// Build the height of the carousel to be as tall as the tallest page item
			$('li.page', obj).each(function(){
				pageHeight = ( $(this).height() > pageHeight) ? $(this).height():pageHeight ;
			}).width( pageWidth-(2*parseInt(o.padding)) );

			$(obj).css({'position':'relative','overflow':'hidden','padding-top':o.padding,'padding-bottom':o.padding});
			$('ul.master', obj).css({'list-style':'none','margin':'0','padding':'0','position':'relative'}).width(pageWidth*numPages);
			$('li.page', obj).css({'display':'inline','float':'left','padding':o.padding});

			// Move rightmost page over to the left
			$('li.page:last', obj).prependTo($('ul.master', obj));
			$('ul.master', obj).css('left',-pageWidth+'px').width(99999);

			// the next line puts the scroll bar on the content instead of the browser.
			if(o.scrollContainer)
			{
				wrapID = $(obj).attr('id')+'Wrapper';
				$(obj).wrap('<div id="'+wrapID+'" style="left:'+($(document).width()/2 - ($(obj).width())/2 - parseInt(o.peekAmount) )+'px;bottom:0;overflow-x:hidden;overflow-y:auto;position:absolute;top:0;width:'+( $(obj).width()+(2*parseInt(o.peekAmount)) )+'px;">');
			}
			
			function navLinkClick(page)
			{
				// viewable[0] is what we're leaving (from), target_num[1] is where we're going (to)
				adjFrom = 0;

				if(viewable[0] != page) $('#nav'+randID+' div').css({'cursor':'default'}).unbind('click'); // Unbind the thumbnail click event until the transition has ended

				if(page > viewable[0])
				{
					adjFrom = parseInt(viewable[0])+parseInt(numPages);
					right = page - viewable[0];
					left = adjFrom - page;

					diff = page - viewable[0];
					if(right<left || right==left) moveLeft(right);
					if(left<right) moveRight(left);
				}
				if(page < viewable[0])
				{
					adjFrom = parseInt(page)+parseInt(numPages);
					right = adjFrom - viewable[0];
					left = viewable[0] - page;

					diff = viewable[0]- page;
					if(right<left || right==left) moveLeft(right);
					if(left<right) moveRight(left);
				}
			}
			
			for(i=0;i<=numPages-1;i++) unviewable.push(i+1);
			viewable.push(unviewable.shift()); // Initialize viewable/unviewable arrays. Takes first element off unviewable and pushes it onto viewable

			$(document).keydown(function(event){
				if(event.keyCode == 39 && !$('ul',obj).is(':animated') ) moveLeft();
				if(event.keyCode == 37 && !$('ul',obj).is(':animated') ) moveRight();
			});				

			if(o.showLinks)
			{
				// Build navigation links
				if (o.linkPosition	== 'top') navPos = 'top:10';
				if (o.linkPosition	== 'bottom') navPos = 'bottom:10';
				if (o.linkPosition	== 'under') navPos = 'top:' + ((($(window).height())/2)-15+parseInt(o.padding) + 40);
			
				// Build left and right side thumbnail nav
				if(o.links == 'left' || o.links == 'both') $('body').append('<div id="nav'+randID+'" style="position:fixed;overflow:auto;clear:left;text-align:left;'+navPos+'px;left:4px"></div>');
				if(o.links == 'right' || o.links == 'both') $('body').append('<div id="nav2'+randID+'" style="position:fixed;overflow:auto;clear:left;text-align:left;'+navPos+'px;right:4px"></div>');
				for(i=0;i<=numPages-1;i++)
				{
					title = $('li.page:eq('+(i+1)+')', obj).attr('title');
					$('#nav'+randID).append('<div class="link" id="nav'+randID+'_'+(i+1)+'" style="cursor:pointer;display:inline;float:left;clear:left;width:'+o.navWidth+';height:'+o.navHeight+';padding:0;overflow:hidden;">'+title+'</div>');
					$('#nav2'+randID).append('<div class="link" id="nav2'+randID+'_'+(i+1)+'" style="cursor:pointer;display:inline;float:left;clear:left;width:'+o.navWidth+';height:'+o.navHeight+';padding:0;overflow:hidden;">'+title+'</div>');
					if(i<=1) $('#nav'+randID+'_'+i+',#nav2'+randID+'_'+i).css({'border-color':'#ff0000'});
				}

				// Next two lines are a special case to handle the first list element which was originally the last
				// Earlier we have already moved the last <li> to the first position
				title = $('li.page:first', obj).attr('title');
				$('#nav'+randID+'_'+numPages+',#nav2'+randID+'_'+numPages).text(title);

				$('#nav'+randID+' div.link:not(":first"),#nav2'+randID+' div.link:not(:first)').css({opacity:.5}); // makes all nav 65% opaque except the first one
				$('#nav'+randID+' div.link,#nav2'+randID+' div.link').hover(function(){$(this).stop().animate({'opacity':1},150)},function(){if(viewable[0]!=this.id.split('_')[1]) $(this).stop().animate({'opacity':.5},250)}); // add hover to nav

				// Assign click handler for the thumbnails. Normally the format $('.nav') would work but since it's outside of our object (obj) it would get called multiple times
				$('#nav'+randID+' div,#nav2'+randID+' div').bind('click', function(){
					page_num = $(this).attr("id").split('_');
					navLinkClick(page_num[1]);
				});
			}

			if(o.showArrows)
			{			
				// Prev/next button(img)
				arrowsTop = (($(window).height())/2)-(o.nextPrevImageSize.height/2)+parseInt(o.padding);
				html = '<div id="btn_lt'+randID+'" style="position:fixed;right:2px;top:'+arrowsTop+'px;cursor:pointer;border:none;width:'+o.nextPrevImageSize.width/2+'px;height:'+o.nextPrevImageSize.height+'px;background:url('+o.nextPrevImagePath+') no-repeat 0 0"></div>';
				html += '<div id="btn_rt'+randID+'" style="position:fixed;left:2px;top:'+arrowsTop+'px;cursor:pointer;border:none;width:'+o.nextPrevImageSize.width/2+'px;height:'+o.nextPrevImageSize.height+'px;background:url('+o.nextPrevImagePath+') no-repeat -'+o.nextPrevImageSize.width/2+'px 0"></div>';
				$(obj).after(html);

				$('#btn_rt'+randID).css('opacity',.5).click(function(){
					forcePrevNext('prev');
				}).hover(function(){$(this).animate({opacity:'1'},250)},function(){$(this).animate({opacity:'.5'},250)});
				$('#btn_lt'+randID).css('opacity',.5).click(function(){
					forcePrevNext('next');
				}).hover(function(){$(this).animate({opacity:'1'},250)},function(){$(this).animate({opacity:'.5'},250)});
			}

			function forcePrevNext(dir)
			{
				$('#btn_rt'+randID+',#btn_lt'+randID).unbind('click');
				(dir=='prev') ? moveRight():moveLeft();
				setTimeout(function(){
						$('#btn_rt'+randID).bind('click',function(){forcePrevNext('prev')});
						$('#btn_lt'+randID).bind('click',function(){forcePrevNext('next')});
					},o.transitionSpeed);
			}

			function preMove()
			{
				if(o.showLinks) for(i=1;i<=numPages;i++) $('#nav'+randID+'_'+i+',#nav2'+randID+'_'+i).css({'border-color':'#ccc'}).animate({'opacity': .65},500);
			}

			function postMove()
			{
				if(o.showLinks) for(i=0;i<viewable.length;i++) $('#nav'+randID+'_'+viewable[i]+', #nav2'+randID+'_'+viewable[i]).css({'border-color':'#ff0000'}).animate({'opacity': 1},500);
				if(o.showLinks) $('#nav'+randID+' div,#nav2'+randID+' div').unbind('click').bind('click', function(){
					page_num = $(this).attr("id").split('_');
					navLinkClick(page_num[1]);
				}).css({'cursor':'pointer'});
				o.onSlideEnd.call(this);
				window.location.hash = viewable;
				$('.page').removeClass('pc_inview');
				$('#page-'+viewable).addClass('pc_inview');
				// use the code below to test for a vert scroll bar.			
				//var docHeight = $(document).height();
				//var scroll    = $(window).height() + $(window).scrollTop();
				//console.log(docHeight == scroll);
			}

			function moveLeft(dist)
			{
				if(dist==null) dist=1;
				preMove();
				for(i=1;i<=dist;i++){
					viewable.push(unviewable.shift());
					unviewable.push(viewable.shift());
				}
				$('li.page:lt('+dist+')', obj).clone(true).insertAfter($('li.page:last', obj)); // Copy the first image (offscreen to the left) to the end of the list (offscreen to the right)
				o.onSlideStart.call(this,viewable,'left');
				setTimeout(function(){ $(obj).height($('#page-'+viewable[0]).height())},o.transitionSpeed/2);
//				setTimeout(function(){ $(obj).animate({height:$('#page-'+viewable[0]).height()+parseInt(o.padding)*2}) },o.transitionSpeed/2);
				$('ul.master', obj).animate({left:-pageWidth*(dist+1)},o.transitionSpeed,o.easeLeft,function(){ // Animate the entire list to the left
					$('li.page:lt('+dist+')', obj).remove(); // When the animation finishes, remove the first image (on the left). It has already been copied to the end of the list (right)
					$(this).css({'left':-pageWidth});
					postMove();
				});
			}
			function moveRight(dist)
			{
				if(dist==null) dist=1;
				preMove();
				for(i=1;i<=dist;i++){
					viewable.unshift(unviewable.pop());
					unviewable.unshift(viewable.pop());
				}
				$('li.page:gt('+(numPages-(dist+1))+')', obj).clone(true).insertBefore($('li.page:first', obj)); // Copy rightmost (last) li and insert it after the first li
				o.onSlideStart.call(this,viewable,'right');
				setTimeout(function(){ $(obj).height($('#page-'+viewable[0]).height()) },o.transitionSpeed/2);
//				setTimeout(function(){ $(obj).animate({height:$('#page-'+viewable[0]).height()+parseInt(o.padding)*2}) },o.transitionSpeed/2);
				$('ul.master', obj).css('left',-(pageWidth*(dist+1)))
					.animate({left:-pageWidth},o.transitionSpeed,o.easeRight,function(){
						$('li.page:gt('+(numPages-1)+')', obj).remove();
						postMove();
					});
			}

			$(window).resize(function() {
				arrowsTop = (($(window).height())/2)-15+parseInt(o.padding);
				$('#btn_rt'+randID+',#btn_lt'+randID).css('top',arrowsTop+'px');
				
				if(o.showArrows) if( $(obj).width()+(o.nextPrevImageSize.width+4)+(2*parseInt(o.peekAmount)) >= $(window).width() || $(obj).width()<parseInt(o.pageWidth) ) $(obj).width( $(window).width() - (o.nextPrevImageSize.width+4) - (2*parseInt(o.peekAmount)) ); // arrow width + (2px padding * 2)
				if(o.showLinks) if( $(obj).width()+24+(2*parseInt(o.navWidth))+(2*parseInt(o.peekAmount)) >= $(window).width() || $(obj).width()<parseInt(o.pageWidth) ) $(obj).width( $(window).width() - (2*parseInt(o.navWidth)) - (2*parseInt(o.peekAmount)) - 24); // 24 = (8px body pad + 4px nav border)*2
				
				$('li.page', obj).width( $(obj).width()-(2*parseInt(o.padding)) ); // also need to factor in the ul width and possible padding
				$('ul',obj).css('left','-'+$(obj).width()+'px');
				pageWidth=$(obj).width();

				// when ie adds or removes a scrollbar, even if the window isnt being resized, it fires this event
				if(!$.browser.msie) $(obj).height($('li.page:eq(1)', obj).height()); // when we resize smaller, make the container bigger if the text pushes it down
			});

			if( $.inArray(window.location.hash.substr(1), id_array) >= 0 ) navLinkClick(window.location.hash.substr(1));

			$(obj).height($('#page-1').addClass('pc_inview').height());
 		});
	}
	});
})(jQuery);

/*
Possible to-do:

touch events?
after every page change (in addition to resizing) we may need to check the doc.width to account for scroll bars appearing/disappearing
turn nav link resize code from static to based on styling (52/267)
*/