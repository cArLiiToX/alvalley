/**
 * EMThemes
 *
 * @license commercial software
 * @copyright (c) 2012 Codespot Software JSC - EMThemes.com. (http://www.emthemes.com)
 */
var timeout = null;
(function($) {

EM_Theme = {
};



if (typeof EM == 'undefined') EM = {};
if (typeof EM.tools == 'undefined') EM.tools = {};


var isMobile = /iPhone|iPod|iPad|Phone|Mobile|Android|hpwos/i.test(navigator.userAgent);
var isPhone = /iPhone|iPod|Phone|Android/i.test(navigator.userAgent);

var checkPhone = /iPhone|iPod|Phone|Android/i.test(navigator.userAgent);
var product_zoom = null;

var domLoaded = false, 
		windowLoaded = false, 
		last_adapt_i, 
		last_adapt_width;


/**
 * Auto positioning product items in products-grid
 *
 * @param (selector/element) productsGridEl products grid element
 * @param (object) options
 * - (integer) width: width of product item
 * - (integer) spacing: spacing between 2 product items
 */
EM.tools.decorateProductsGrid = function (productsGridEl, options) {

}

/**
 * Decorate Product Tab
 */ 
EM.tools.decorateProductCollateralTabs = function() {
	$(document).ready(function() {
		if($('.box-collateral').length > 1){
			$('.product-collateral').each(function(i) {
				$(this).wrap('<div class="tabs_wrapper_detail collateral_wrapper" />');
				$(this).prepend('<ul class="tabs_control"></ul>');
				$(this).children(".product-collateral-item").addClass("ui-slider-tabs-content-container");
					$('.box-collateral', this).addClass('tab-item').each(function(j) {
						var id = 'box_collateral_'+i+'_'+j;
						$(this).addClass('content_'+id);
						$(this).attr('id',id);
						$('.tabs_wrapper_detail ul.tabs_control').append('<li><a href="#'+id+'">'+$('h2', this).html()+'</a></li>');
					});
				$("div.tabs_wrapper_detail .product-collateral").sliderTabs({
					autoplay: false,
					indicators: true,
					mousewheel: false,
					panelArrows: true,
					tabHeight: 39,
					panelArrowsShowOnHover: true
				});
			});
			
		}
	});
};

/**
 * Fix iPhone/iPod auto zoom-in when text fields, select boxes are focus
 */
function fixIPhoneAutoZoomWhenFocus() {
		var viewport = $('head meta[name=viewport]');
		if (viewport.length == 0) {
				$('head').append('<meta name="viewport" content="width=device-width, initial-scale=1.0"/>');
				viewport = $('head meta[name=viewport]');
		}
		
		var old_content = viewport.attr('content');
		
		function zoomDisable(){
				viewport.attr('content', old_content + ', user-scalable=0');
		}
		function zoomEnable(){
				viewport.attr('content', old_content);
		}
		
		$("input[type=text], textarea, select").mouseover(zoomDisable).mousedown(zoomEnable);
}

/**
 * Adjust elements to make it responsive
 *
 * Adjusted elements:
 * - Image of product items in products-grid scale to 100% width
 */
function responsive() {
		
		// resize products-grid's product image to full width 100% {{{
		var position = $('.products-grid .item').css('position');
		if (position != 'absolute' && position != 'fixed' && position != 'relative')
				$('.products-grid .item').css('position', 'relative');
				
		var img = $('.products-grid .item .product-image img');
		if (!(img.parent().parent().parent().parent().hasClass("category-products"))){
				img.each(function() {
						img.data({
								'width': $(this).width(),
								'height': $(this).height()
						})
				});
				img.removeAttr('width').removeAttr('height').css('width', '100%');
		};
		$('.custom-logo').each(function() {
				$(this).css({
						'max-width': $(this).width(),
						'width': '100%'
				});
		});
}

window.onresize = function(){
		if (typeof em_slider!=='undefined')
        	em_slider = new EM_Slider(em_slider.config);
		if (($('#image')!=null)&& (product_zoom != null)){
				$('#image').width(product_zoom.imageDim.width);
		Event.stopObserving($('#zoom_in'), 'mousedown', product_zoom.startZoomIn.bind(product_zoom));
		Event.stopObserving($('#zoom_in'), 'mouseup', product_zoom.stopZooming.bind(product_zoom));
		Event.stopObserving($('#zoom_in'), 'mouseout', product_zoom.stopZooming.bind(product_zoom));

		Event.stopObserving($('#zoom_out'), 'mousedown', product_zoom.startZoomOut.bind(product_zoom));
		Event.stopObserving($('#zoom_out'), 'mouseup', product_zoom.stopZooming.bind(product_zoom));
		Event.stopObserving($('#zoom_out'), 'mouseout', product_zoom.stopZooming.bind(product_zoom));

				//$('#image').height(product_zoom.imageDim.height);
				product_zoom = new Product.Zoom('image', 'track', 'handle', 'zoom_in', 'zoom_out', 'track_hint');;
		}       
}

function persistentMenu(){

		$(function () {
			$(window).scroll(function () {
				window.freezedTopMenu = ($( window ).width() > 760 && isPhone!=1 && FREEZED_TOP_MENU) ? 1: 0;
				if ($(this).scrollTop() > 145 && window.freezedTopMenu) {
					if($('.hnav').parent().parent().parent().hasClass('container_menu')){
						$(".container_menu").addClass('fixed-top');
					}else {
						$('.hnav').parent(".em_nav").addClass('fixed-top');
					}
				} else {
					if($('.hnav').parent().parent().parent().hasClass('container_menu')){
						$(".container_menu").removeClass('fixed-top');
					} else {
						$('.hnav').parent(".em_nav").removeClass('fixed-top');
					}
				}
			});
		});
}
/**
 * Function called when layout size changed by adapt.js
 */
function whenAdapt(i, width) {		
	//disable freezed top menu when in iphone
	window.freezedTopMenu = ($( window ).width() > 760 && isMobile!=1 && FREEZED_TOP_MENU) ? 1: 0;
	if (window.freezedTopMenu && $(window).scrollTop() > 145) { 
		if($('.hnav').parent().parent().parent().hasClass('container_menu')){
			$(".container_menu").addClass('fixed-top');
		} else {
			$('.hnav').parent(".em_nav").addClass('fixed-top');
		}
	} else {
		if($('.hnav').parent().parent().parent().hasClass('container_menu')){
			$(".container_menu").removeClass('fixed-top');
		} else {
			$('.hnav').parent(".em_nav").removeClass('fixed-top');
		}   
	} 		
}


// Back to top
function backToTop(){
	// hide #back-top first
		$("#back-top").hide();
		
		// fade in #back-top
		
		$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
						$('#back-top').fadeIn();
				} else {
						$('#back-top').fadeOut();
				}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
				$('body,html').animate({
						scrollTop: 0
				}, 800);
				return false;
		});

}

function toolbarSearch(){

	$('.cat-search').each(function(){
			$(this).insertUlCategorySearch();
			$(this).selectUlCategorySearch();
	});
	$('#select-language').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});
	$('.currency').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});
	$('#select-store').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});

}

/**
*   Add class mobile
**/
function addClassMobile(){
	if(isMobile == true){
		jQuery('body').addClass('mobile-view');
	}
}

var calHeightFea = false;
function setHeightFeaturedProducts()
{
	if(calHeightFea == true){
		var $ = jQuery;
		$('.home_block .left-block').removeClass('top-height-block').height('');
		$('.align-border ul.products-grid').removeClass('top-height').height('');
		if($( window ).width() > 760){
			$('.align-border ul.products-grid').each(function(){
				$(this).height($(this).height());
				$(this).addClass('top-height');
				//ul.height(max_height);
			});
			
			$('.home_block .left-block').each(function(){
				var leftHeight = $(this).height();
				if(typeof $(this).parent().children('.right-block') != 'undefined'){
					leftHeight = Math.max(leftHeight,$(this).parent().children('.right-block').height());
				}
				$(this).height(leftHeight);
				$(this).addClass('top-height-block');
			});
		}
	}
}

var calTopSeller = false;
function setHeightTopSeller(){
	if(calTopSeller == true){
		var $ = jQuery;
		var wrapItem = $('.top_seller .wrap_item');
		wrapItem.removeClass('top-height').height('');
		var height = wrapItem.height();
		wrapItem.height(height);
		wrapItem.addClass('top-height');
	}	
}

function hoverTopCart(){
	$(function($) {         
		$('.dropdown-cart').each(function(){
			if(isMobile==true){
				$('.dropdown-cart').find('.amount').attr('href','javascript:void(0);'); 
				$(this).unbind('click');
				var divWrapper = $(this);
				$(this).find('.icon.cart,.summary').click(function (e) {
					e.preventDefault();
					divWrapper.find('.cart-popup').slideToggle();
				});
			} else{
				var tm;
				function show(el) {
					clearTimeout(tm);
					tm = setTimeout(function() {
						el.slideDown();
					}, 200);
				}
				function hide(el) {
					clearTimeout(tm);
					tm = setTimeout(function() {
						el.slideUp();
					}, 200);
				}
				$(this)
					.bind('mouseenter', show.curry($('.cart-popup', this)))
					.bind('mouseleave', hide.curry($('.cart-popup', this)))
					.find('.cart-popup').slideUp();
			}
		});
			
	});
}


$(document).ready(function() {
	domLoaded = true;  
	isMobile && fixIPhoneAutoZoomWhenFocus();
	alternativeProductImage();
	setupReviewLink();
	
	// safari hack: remove bold in h5, .h5
	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
			$('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6').css('font-weight', 'normal');
	}
	
	hoverTopCart();
	if($('.wrapper').hasClass('em-box-custom')){
		if($( window ).width() <= 760){
			$('.wrapper').removeClass('em-box-custom');
		}
		$(window).resize(function(){
			if($( window ).width() <= 760){
				$('.wrapper').removeClass('em-box-custom');
			} else {
				$('.wrapper').addClass('em-box-custom');
			}
		});
	}
	if (FREEZED_TOP_MENU) persistentMenu();        
	backToTop();
	if($(this).viewPC()){
		toogleStore();
	}
	if(isMobile || isPhone)
   	{
    	$('.top-quickshop .item').find('.actions').css({
   		'position':'static',
   		'display':'block',
   		'clear': 'both',
   		'margin': '0 auto',
   		'text-align':'center'
   	});           
   	$('.top-quickshop li.item div.actions').find('button.btn-cart').css({'display':'inline-block'});
   }
      
});

$(window).bind('load', function() {
		windowLoaded = true;
		setTimeout(function(){
			calHeightFea = true;
			setHeightFeaturedProducts();
			calTopSeller = true;
			setHeightTopSeller();           
		},300);
		
		responsive();
		toogleFooter();
		//whenAdapt(last_adapt_i, last_adapt_width);
		em0113();
		if(jQuery('body').viewPC()){
			toolbarSearch();
			toolbar();
		}		
		
});

/*$(window).bind("emadaptchange orientationchange", function(){
		
	setTimeout(function(){
		setHeightFeaturedProducts();
		setHeightTopSeller();
	},300);

		toogleFooter();
	if (typeof em_slider!=='undefined')
		em_slider.reinit();
});*/
$(window).resize(function(){
	setTimeout(function(){
		setHeightFeaturedProducts();
		setHeightTopSeller();
	},300);

		toogleFooter();
	if (typeof em_slider!=='undefined')
		em_slider.reinit();
});

})(jQuery);

/**
 * Change the alternative product image when hover
 */
function alternativeProductImage() {
 	var $=jQuery;
	var tm;
	function swap() {
		clearTimeout(tm);
		setTimeout(function() {
			el = $(this).find('img[data-alt-src]');
			var newImg = $(el).data('alt-src');
			var oldImg = $(el).attr('src');
			$(el).attr('src', newImg).data('alt-src', oldImg);
			$(el).fadeIn(300, "easeInCubic");

		}.bind(this), 400);
	}	
	$('.item .product-image img[data-alt-src]').parents('.product-image').bind('mouseenter', swap).bind('mouseleave', swap);
}

function showAgreementPopup(e) {
		
		//jQuery('#checkout-agreements .agreement-content').show();
		//$('agreement-content-popup').show();
				
		jQuery('#checkout-agreements label.a-click').parent().parent().children('.agreement-content').show()
				.css({
						'left': (parseInt(document.viewport.getWidth()) - jQuery('#checkout-agreements label.a-click').parent().parent().children('.agreement-content').width())/2 +'px',
						'top': (parseInt(document.viewport.getHeight()) - jQuery('#checkout-agreements label.a-click').parent().parent().children('.agreement-content').height())/2 + 'px'
				});
		
};

/**
 *   After Layer Update
 **/
window.afterLayerUpdate = function () {
	var $=jQuery;
	if($('body').viewPC()){
		toolbar();
	}
	alternativeProductImage();
	//initIsotope();
	qs({
		itemClass: '.products-grid li.item, .products-list li.item, li.item .cate_product, .product-upsell-slideshow li.item, .mini-products-list li.item, #crosssell-products-list li.item', //selector for each items in catalog product list,use to insert quickshop image
		aClass: 'a.product-image', //selector for each a tag in product items,give us href for one product
		imgClass: '.product-image img' //class for quickshop href
	});
	if(!$('body').viewPC())
   	{
    	$('.top-quickshop .item').find('.actions').css({
   		'position':'static',
   		'display':'block',
   		'clear': 'both',
   		'margin': '0 auto',
   		'text-align':'center'
   	});           
   	$('.top-quickshop li.item div.actions').find('button.btn-cart').css({'display':'inline-block'});       
   }
   //if (typeof em_slider!=='undefined')
		//em_slider.reinit();
}


function hideAgreementPopup(e) {
		//$('opc-agreement-popup-overlay').hide();
		jQuery('#checkout-agreements .agreement-content').hide();
		
};

function initSlider(e,verticals) {
		var $ = jQuery;
	var wraps;
		if (verticals == null){
				verticals=false;
	}
		
		var widthcss = $( e + ' li.item').width();
		var rightcss = $( e + ' li.item').outerWidth(true)- $( e + ' li.item').outerWidth();
		$(e).addClass('jcarousel-skin-tango');
		$(e).parent().append('<div class="slide_css">');
		$(e).parent().find('.slide_css').html('<style type="text/css">'+e+' .jcarousel-item {width:' + widthcss + 'px;margin-right:'+ rightcss +'px;}</style>');
		//jQuery('#<?php echo $idJs;?>_css').html('<style type="text/css">#<?php echo $idJs;?> .jcarousel-skin-tango .jcarousel-item {width:' + width_<?php echo $idJs;?> + 'px;}</style>');
		//$('.jcarousel-skin-tango .jcarousel-item').css('width',  width>');
		$(e).jcarousel({
			buttonNextHTML:'<a class="next" href="javascript:void(0);" title="Next"></a>',
			buttonPrevHTML:'<a class="previous" href="javascript:void(0);" title="Previous"></a>',
			scroll: 1,
			animation:'slow',
			vertical:verticals,
			initCallback: function (carousel) {
				var context = carousel.container.context;
				$(context).touchwipe({
					wipeLeft: function() { 
							carousel.next();
					},
					wipeRight: function() { 
							carousel.prev();
					},
					preventDefaultEvents: false
				});
				/*jQuery(window).bind('emadaptchange orientationchange', function() {
					setTimeout(function(){
							carousel.reload();
							carousel.scroll(1,true);
							carousel.funcResize();
					},300); 
				});*/
				jQuery(window).resize(function(){
					setTimeout(function(){
							carousel.reload();
					},300); 
				}); 
			}
		});
		

}

/**
*   showReviewTab
**/
function showReviewTab() {
		var $ = jQuery;
		function getReviewTabHandle() {
		var currentId = $('.box-reviews').attr('id');
		
		var classes = $('#'+currentId).attr('class').split(' ');
		var href = '';
		$(classes).each(function (i, e) {
			if (/content_box_collateral/.test(e)) {
				href = e.replace('content_', '');
			}
		});
		return $('[href="#'+href+'"]');
	}
	var hasTab = $('.product-collateral').children().hasClass('ui-slider-tabs-content-container');
	var tabReview = $('.ui-slider-tabs-content-container').children().hasClass('box-reviews');	
	//var reviewTab = getReviewTabHandle();//$('.tabs_control li:contains(Review)');
	
	if ((hasTab) && (tabReview)) {
		// scroll to review tab
		$('html, body').animate({
			 scrollTop: reviewTab.offset().top
		}, 500);
		 
		 // show review tab
		reviewTab.click();
	} else if ($('#customer-reviews').size()) {
		// scroll to customer review
		$('html, body').animate({ scrollTop: $('#customer-reviews').offset().top }, 500);
	} else {
		return false;
	}
	return true;
};

/**
*   setupReviewLink
**/
function setupReviewLink() {    
	jQuery('.product-essential .r-lnk').click(function (e) {
		if (showReviewTab())
			e.preventDefault();
	});
}

function toolbar(){
	var $=jQuery;

	$('.show').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});
	$('.sortby').each(function(){
		//$(this).insertTitle();
		$(this).insertUl();
		$(this).selectUl();
	});
}

/* js for theme */
function em0113(){
		var $ = jQuery;
		var tagul = $(".widget-home ul.products-grid");
		tagul.each(function(){
				var tagli = $(this).find("li.item");
				var heightli = 0;
				tagli.each(function(){
						if (heightli < $(this).height())
								heightli = $(this).height();
				})
				tagli.css("min-height",heightli+"px");
		})
}

function toogleStore(){
	var $=jQuery;
   
	$('.storediv').hide(); 
	$(".btn_storeview").click(function() {
		store_show();        
	});
	
	$(".btn_storeclose").click(function() {
		store_hide();
	});
	
	function store_show(){            
		var bg  = $("#bg_fade_color");
		bg.css("opacity",0.5);
		bg.css("display","block");              
		var top =( $(window).height() - $(".storediv").height() ) / 2;
		var left = ( $(window).width() - $(".storediv").width() ) / 2;
			$(".storediv").show();
		$(".storediv").css('top', top+'px');
		$(".storediv").css('left', left+'px');
	}
	
	function store_hide(){
		var bg  = $("#bg_fade_color");
		$(".storediv").hide();
		bg.css("opacity",0);
		bg.css("display","none");
	}
};

/**
*   Toogle Footer Information Mobile View
**/
function toogleFooter(){
    if(jQuery( window ).width() <= 760){
        jQuery('.footer_links > div > .content_links').css('display','none');
        jQuery('.footer_links > div > .line-title').css('display','none');
        jQuery('.footer_links > div > .title').addClass('toogle-icon');
        jQuery('.footer_links > div > .title').unbind('click');
		jQuery('.footer_links > div > .title').on('click', function(){
			jQuery(this).toggleClass("active").parent().find(".content_links").slideToggle();
			jQuery(this).toggleClass("active").parent().find(".line-title").slideToggle();
		});		
    }else{
        jQuery('.footer_links > div > .title').removeClass('toogle-icon');
        jQuery('.footer_links > div > .title').removeClass('active');
        jQuery('.footer_links > div > .content_links').css('display','block');
        jQuery('.footer_links > div > .line-title').css('display','block');
    }
};
/* Isotope */
function initIsotope(){
		if(!checkPhone){        
		var itemwidth = jQuery('.category-products ul.products-grid li').first().width();
		
		jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
			var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
				containerWidth = this.element.width();
		  
			this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
						  // or use the size of the first item
						  this.$filteredAtoms.outerWidth(true) ||
						  // if there's no items, use size of container
						  containerWidth;

			this.masonry.columnWidth += gutter;

			this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
			this.masonry.cols = Math.max( this.masonry.cols, 1 );
		  };

		  jQuery.Isotope.prototype._masonryReset = function() {
			// layout-specific props
			this.masonry = {};
			// FIXME shouldn't have to call this again
			this._getMasonryGutterColumns();
			var i = this.masonry.cols;
			this.masonry.colYs = [];
			while (i--) {
			  this.masonry.colYs.push( 0 );
			}
		  };

		  jQuery.Isotope.prototype._masonryResizeChanged = function() {
			var prevSegments = this.masonry.cols;
			// update cols/rows
			this._getMasonryGutterColumns();
			// return if updated cols/rows is not equal to previous
			return ( this.masonry.cols !== prevSegments );
		  };
		jQuery('.category-products ul.products-grid').isotope({
				itemSelector : '.item',
				masonry : {
			  },
					layoutMode : PRODUCTSGRID_POSITION_ABSOLUTE
		});

		}
		
}
