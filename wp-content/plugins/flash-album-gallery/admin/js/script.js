var metaViewport;
jQuery(function() {
	metaViewport = jQuery('meta[name=viewport]','head').attr('content');
});

function FlAGClass(ExtendVar, skin_id, pic_id, slideshow) {
	jQuery(function() {
		if(pic_id !== false){
			var skin_function = flagFind(skin_id);
			if(pic_id !== 0 ) {
				jQuery.fancybox(
				{
					'showNavArrows'	: false,
					'overlayShow'	: true,
					'overlayOpacity': '0.9',
					'overlayColor'	: '#000',
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'titlePosition'	: 'over',
					'titleFormat'	: function(title, currentArray, currentIndex, currentOpts) {
						var descr = jQuery('<div />').html(jQuery("#flag_pic_"+pic_id, window[skin_id]).find('.flag_pic_desc > span').html()).text();
						title = jQuery('<div />').html(jQuery("#flag_pic_"+pic_id, window[skin_id]).find('.flag_pic_desc > strong').html()).text();
						if(title.length || descr.length)
							return '<div class="grand_controls" rel="'+skin_id+'"><span rel="prev" class="g_prev">prev</span><span rel="show" class="g_slideshow '+slideshow+'">play/pause</span><span rel="next" class="g_next">next</span></div><div id="fancybox-title-over">'+(title.length? '<strong class="title">'+title+'</strong>' : '')+(descr.length? '<div class="descr">'+descr+'</div>' : '')+'</div>';
						else
							return '<div class="grand_controls" rel="'+skin_id+'"><span rel="prev" class="g_prev">prev</span><span rel="show" class="g_slideshow '+slideshow+'">play/pause</span><span rel="next" class="g_next">next</span></div>';
					},
					'href'			: jQuery("#flag_pic_"+pic_id, window[skin_id]).attr('href'),
					'onStart' 		: function(){
						//if(skin_function && jQuery.isFunction(skin_function[skin_id+'_fb'])) {
							skin_function[skin_id+'_fb']('active');
						//}
						jQuery('#fancybox-wrap').addClass('grand');
					},
					'onClosed' 		: function(currentArray, currentIndex){
						//if(skin_function && jQuery.isFunction(skin_function[skin_id+'_fb'])) {
							skin_function[skin_id+'_fb']('close');
						//}
						jQuery('#fancybox-wrap').removeClass('grand');
					},
					'onComplete'	: function(currentArray, currentIndex) {
					}
				});
			}
			jQuery('#fancybox-wrap').off('click', '.grand_controls span').on('click', '.grand_controls span', function(){
				skin_function[skin_id+'_fb'](jQuery(this).attr('rel'));
					if(jQuery(this).hasClass('g_slideshow')){
					jQuery(this).toggleClass('play stop');
				}
			});
		} else {
			if((('undefined' == metaViewport) || !metaViewport) && ExtendVar == 'photoswipe'){
				jQuery('head').append('<meta content="width=device-width, initial-scale=1.0;" name="viewport" />');
			}
			jQuery('.flashalbum').css('height','auto');
			jQuery('body#fullwindow').css('overflow','auto');
			jQuery('#'+skin_id+'_jq').each(function(i){
				jQuery(this).css({display: 'block'});
				var catMeta = jQuery('.flagCatMeta',this).hide().get();
				for(j=0; j<catMeta.length; j++) {
					var catName = jQuery(catMeta[j]).find('h4').text();
					var catDescr = jQuery(catMeta[j]).find('p').text();
					var catId = jQuery(catMeta[j]).next('.flagcategory').attr('id');
					var act = '';
					if(j==0) act = ' active';
					jQuery('.flagcatlinks',this).append('<a class="flagcat'+act+'" href="#'+catId+'" title="'+catDescr+'">'+catName+'</a>');
				}
				jQuery('a#backlink').appendTo('.flagcatlinks',this);
				jQuery('.flagcategory', this).each(function(){
					var flagcatid = jQuery(this).attr('id');
					jQuery('a.flag_pic_alt', this).attr('rel',flagcatid);
				});
			});
			jQuery('#'+skin_id+'_jq .flagcat').click(function(){
				if(!jQuery(this).hasClass('active')) {
					var catId = jQuery(this).attr('href');
					jQuery(this).addClass('active').siblings().removeClass('active');
					jQuery('#'+skin_id+'_jq '+catId).css({display: 'block'}).siblings('.flagcategory').hide();
					alternate_flag_e(skin_id, catId, ExtendVar);
				}
				return false;
			});
			alternate_flag_e(skin_id, '.flagcategory:first', ExtendVar);
		}
	});
}

function alternate_flag_e(skin_id, t, ExtendVar){
	jQuery('#'+skin_id+'_jq').find(t).not('.loaded').each(function(){
		var d = jQuery(this).html();
		if(d) {
			d = d.replace(/>\[/g, '><');
			d = d.replace(/src=/g, 'src="');
			d = d.replace(/\]</g, '" /><');
			jQuery(this).addClass('loaded').html(d);
		}
		jQuery(this).css({display: 'block'});
		if(ExtendVar == 'photoswipe') {
			var
				showDescr, longDescription, imgdescr, psImgCaption, curel,
				options = {
					allowUserZoom:false,
					captionAndToolbarAutoHideDelay:0,
					captionAndToolbarHide:false,
					captionAndToolbarShowEmptyCaptions:true,
					zIndex:10000,
					getToolbar: function(){
						flagToolbar = window.Code.PhotoSwipe.Toolbar.getToolbar();
						flagToolbar = flagToolbar + '<div class="ps-toolbar-descr"><div class="ps-toolbar-content"></div></div>';
						return flagToolbar;
						// NB. Calling PhotoSwipe.Toolbar.getToolbar() wil return the default toolbar HTML
					},
					getImageCaption: function(el){
						psImgCaption = jQuery('<strong></strong>').addClass('ps-title').append(jQuery(el).attr('title'));
						return psImgCaption;
					},
					getImageMetaData: function(el){
						imgdescr = jQuery(el).find('span.flag_pic_desc > span:first').html();
						if(imgdescr.length){
							imgdescr = jQuery('<div></div>').append(imgdescr);
						}
						return {
							longDescription: imgdescr
						}

					}
				},
				instance = jQuery('a.flag_pic_alt',this).photoSwipe(options);

			// onBeforeShow - store a reference to our "say hi" button
		  	instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onBeforeShow, function(e){
		  		jQuery(window).scrollLeft(0).scrollTop(0);
				jQuery('meta[name=viewport]').attr('content','width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0');
				//window.location.hash = '#OpenGallery';
			});
			// onShow - store a reference to our "say hi" button
		  	instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onShow, function(e){
				showDescr = window.document.querySelectorAll('.ps-toolbar-descr')[0];
			});
			// onBeforeHide - clean up
			instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onBeforeHide, function(e){
				showDescr = null;
			});
			// onHide - clean up
			instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onHide, function(e){
				if(('undefined' == metaViewport) || !metaViewport){
					jQuery('meta[name=viewport]').attr('content','width=device-width, initial-scale=1.0, minimum-scale=0.25, maximum-scale=1.6, user-scalable=1');
					jQuery('meta[name=viewport]').remove();
				} else {
					jQuery('meta[name=viewport]').attr('content',metaViewport);
				}
				//window.location.hash = '#CloseGallery';
			});
			// onDisplayImage
			instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onDisplayImage, function(e){
				curel = instance.getCurrentImage();
				var curid = curel.refObj.id;
				curid = curid.replace('flag_pic_','');
				jQuery.post(hitajax, { hit: curid }, function(r){ console.log(r); });
				if(curel.metaData.longDescription){
					jQuery('.ps-caption-content').append(jQuery('<div></div>').addClass('ps-long-description').html(jQuery(curel.metaData.longDescription).text()).hide());
					jQuery('.ps-toolbar-descr').removeClass('disabled active').addClass('enabled');
				} else {
					jQuery('.ps-toolbar-descr').removeClass('enabled active').addClass('disabled');
				}
			});
			// onSlideshowStart
			instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onCaptionAndToolbarShow, function(e){
				curel = instance.getCurrentImage();
				if(curel.metaData.longDescription){
					jQuery('.ps-caption-content').append(jQuery('<div></div>').addClass('ps-long-description').html(jQuery(curel.metaData.longDescription).text()).hide());
					jQuery('.ps-toolbar-descr').removeClass('disabled active').addClass('enabled');
				} else {
					jQuery('.ps-toolbar-descr').removeClass('enabled active').addClass('disabled');
				}
			});
			// onToolbarTap - listen out for when the toolbar is tapped
			instance.addEventHandler(window.Code.PhotoSwipe.EventTypes.onToolbarTap, function(e){
				if (e.toolbarAction === window.Code.PhotoSwipe.Toolbar.ToolbarAction.none){
					if (e.tapTarget === showDescr || window.Code.Util.DOM.isChildOf(e.tapTarget, showDescr)){
						if(jQuery(showDescr).hasClass('enabled')){
							jQuery('.ps-toolbar-descr').toggleClass('active');
							jQuery('.ps-long-description').slideToggle(400);
						}
					}
				}
			});
		} else if(ExtendVar == 'fancybox'){
			jQuery('a.flag_pic_alt',this).fancybox({
				'overlayShow'	: true,
				'overlayOpacity': '0.5',
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'titlePosition'	: 'over',
				'titleFormat'	: function(title, currentArray, currentIndex, currentOpts) {
					var descr = jQuery('<div />').html(jQuery('.flag_pic_desc > span', currentArray[currentIndex]).html()).text();
					title = jQuery('<div />').html(jQuery('.flag_pic_desc > strong', currentArray[currentIndex]).html()).text();
					return '<div id="fancybox-title-over"><em>'+(currentIndex + 1)+' / '+currentArray.length+' &nbsp; </em>'+(title.length? '<strong class="title">'+title+'</strong>' : '')+(descr.length? '<div class="descr">'+descr+'</div>' : '')+'</div>';
				},
				'onClosed' 		: function(currentArray, currentIndex){
					jQuery(currentArray[currentIndex]).removeClass('current').addClass('last');
				},
				'onComplete'	: function(currentArray, currentIndex) {
					jQuery(currentArray).removeClass('current last');
					jQuery(currentArray[currentIndex]).addClass('current');
					var curid = jQuery(currentArray[currentIndex]).attr('id');
					curid = curid.replace('flag_pic_','');
					jQuery.post(hitajax, { hit: curid }, function(r){ console.log(r); });
				}
			});
		}

	});
}

function thumb_cl(skin_id, pic_id, slideshow){
  	pic_id = parseInt(pic_id);
	new FlAGClass(ExtendVar, skin_id, pic_id, slideshow);
}

/*jQuery(document).ready(function() {
	jQuery('div.flashalbum').dblclick(function(e){
		if(e.target.tagName == 'IMG' || e.target.tagName == 'A') return;
		if(jQuery('body').hasClass('FlAG')){
			unhideSite(this, jQuery(this).attr('data-height'), jQuery(this).attr('data-scrolltop'));
		} else {
			jQuery(this).attr('data-height',jQuery(this).height()).attr('data-scrolltop',jQuery(window).scrollTop());
			hideSite(this);
		}
	});
});*/
function enlargeFlAG(t){
		var pleft = jQuery(t).offset().left - jQuery(window).scrollLeft();
		var pheight = jQuery(window).height();
		jQuery(t).css({left:-pleft,top:0,width:'100%',height:pheight+'px'});
}
function unlargeFlAG(t, hFA, sst){
		jQuery(t).css({left:0,top:0,width:'100%',height:hFA+'px'});
		jQuery(window).scrollTop(sst);
}
function hideSite(t){
	jQuery('body').addClass('FlAG');
	jQuery(t).parents('div').addClass('FlAGz').each(function(){
		if(jQuery(this).attr('style')){
			jQuery(this).attr('data-elstyle',jQuery(this).attr('style')).css({zIndex:100,width:'100%',maxWidth:'100%',height:'auto',padding:0,margin:0,border:'none'});
		} else {
			jQuery(this).css({zIndex:100,width:'100%',maxWidth:'100%',height:'auto',padding:0,margin:0,border:'none'});
		}
	});
	jQuery(t).siblings().not('script, link, style, head').addClass('FlAGd').each(function(){
		if(jQuery(this).attr('style')){
			jQuery(this).attr('data-elstyle',jQuery(this).attr('style')).css({visibility:'hidden',height:0,minHeight:0,padding:0,margin:'0 0 0 -10000px',border:'none',fontSize:0,lineHeight:0});
		} else {
			jQuery(this).css({visibility:'hidden',height:0,minHeight:0,padding:0,margin:'0 0 0 -10000px',border:'none',fontSize:0,lineHeight:0});
		}
	});
	jQuery(t).parents().siblings().not('script, link, style, head').addClass('FlAGd').each(function(){
		if(jQuery(this).attr('style')){
			jQuery(this).attr('data-elstyle',jQuery(this).attr('style')).css({visibility:'hidden',height:0,minHeight:0,maxHeight:0,padding:0,margin:'0 0 0 -10000px',border:'none',fontSize:0,lineHeight:0});
		} else {
			jQuery(this).css({visibility:'hidden',height:0,minHeight:0,maxHeight:0,padding:0,margin:'0 0 0 -10000px',border:'none',fontSize:0,lineHeight:0});
		}
	});
	enlargeFlAG(t);
}
function unhideSite(t, hFA, sst){
	jQuery('body').removeClass('FlAG');
	jQuery(t).parents('div').removeClass('FlAGz').each(function(i){
		if(jQuery(this).attr('data-elstyle')){
			jQuery(this).attr('style',jQuery(this).attr('data-elstyle')).removeAttr('data-elstyle');
		} else {
			jQuery(this).removeAttr('style');
		}
	});
	jQuery('.FlAGd').each(function(){
		if(jQuery(this).attr('data-elstyle')){
			jQuery(this).attr('style',jQuery(this).attr('data-elstyle')).removeAttr('data-elstyle').removeClass('FlAGd');
		} else {
			jQuery(this).removeAttr('style').removeClass('FlAGd');
		}
	});
	unlargeFlAG(t, hFA, sst);
}
