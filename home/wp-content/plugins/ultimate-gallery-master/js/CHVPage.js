var pageMenu_do;
var menu_do;
var orientation_do;
var presets_do;
var controller_do;

var thumb;

var body_el;
var ugpHolder_el = null;
var whatIsMainText_el = null;
var apiMainText_el = null;

var randomNormalCollor_ar = ["#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428",
                             "#924432", "#864590","#328f92","#485c1a","#43311f","#790d0d","#4b0060","#4b0060","#0c5b4f","#cb6900",
                             "#8ba428","#4c007d","#8ba428","#0e4a88","#9a1b1b","#0d4a79","#787106","#cb6900","#711968","#8ba428"];

var randomIntensCollor_ar = ["#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000",
                             "#d12700", "#9200a8","#009fa5","#579a00","#cb9259","#a70101","#a70101","#8700ae","#00c5a7","#ffae00",
                             "#bdec00","#7500c0","#bdec00","#007eff","#c90000","#0090ff","#d8a800","#cb6900","#c900b4","#a6d000"];

var apiCheckerIntervalId_to;

var lastThumbnailBoxShadowId = true;
var lastupdateThumbnailsContentPositionId = 10;
var lastUpdateCurtainAnimationPositionId = 0;
var lastUpdateThumbnailsOverlayColorId = 0;
var lastUpdateThumbnailsBorderColorTypeId = 0;
var lastThumbnailOverlayOpacityId = 0.8;
var lastThumbnailBorderSizeId = 0;
var lastThumbnailBorderRadiusId = 0;
var lastThumbnailHorizotanlSpaceId = 0;
var lastThumbnailVerticalSpaceId = 0;
var lastThumbnailHorizontalOffsetId = 0;
var lastThumbnailVerticalOffsetId = 0;
var lastDisplayId = 0;
var lastUpdateThumbnailsTransitionTypeId = 0;
var lastMenuPositionId = 3;
var lastHorizontalOffsetId = 0;
var lastHorizontalSpaceId = 0;
var lastVerticalSpaceId = 0;
var lastSetButtonsClassId = 0;
var lastOffsetTopId = 0;
var lastOffsetBottomId = 0;
var orientationId = 0;
var presetId = 0;
var totalW = 0;
var maxWidth = 942;
var maxHeight = 827;
var byFWDImageWidth = 65;
var html5ImageWidth = 95;
var logoImageWidth = 393;
var productHolderWidth = 940;
var productHolderHeight = 550;
var whatIsImageWidth = 415;
var whyBuyImageWidth = 940;
var windowW = 0;
var windowH = 0;
var menuId;

var lastshowOrHideSearchBox = true;
var lastAddMouseWheelSupport = false;
var lastShowOrHideFullScreenButtonParam = true;
var lastHideMenuParam = true;
var lastHideTotalCategoriesParam = true;
var lastShowOrHideAllCategoriesButtonParam = true;
var lastShowSpacersParam = false;
var lastAllowMultipleMenuButtonSelection = true;
var resizeHandlerId_to;
var updateSizeId_to;
var updateBorderSizeAndRadius_to;

function init(mId, oId, pId){
	if(window.top != window && window.location.search.indexOf("RVPInstanceName") == -1){
		top.location.href = 'index.html';	
	}else{
		menuId = mId;	
		orientationId = oId;
		presetId = pId;
		mainInit();
	}
	
}

function mainInit(){
	body_el = document.getElementsByTagName("body")[0];
	
	whatIsMainText_el = document.getElementById("whatIsMainText");
	whatIsMainText2_el = document.getElementById("whatIsMainText2");
	ugpHolder_el = document.getElementById("myDiv");
	
	apiButtonsHolder_el = document.getElementById("apiButtonsHolder");
	
	apiLogger_el = document.getElementById("apiLoggerMainHolder");
	textApiLogger_el = document.getElementById("textApiLogger");
	
	if(presetId == 0 || presetId == 1){
		//lastshowOrHideSearchBox = false;
	}
	
	if(presetId == 11){
		lastupdateThumbnailsContentPositionId = 1;
	}else if(presetId == 12){
		lastThumbnailOverlayOpacityId = .5;
	}else if(presetId == 13){
		thumbnailOverlayOpacity = .85;
	}
	
	if(presetId == 16 || presetId == 17 || presetId == 18 || presetId == 19 || presetId == 20){
		lastAllowMultipleMenuButtonSelection = false;
	}
	
	
	
	if(orientationId == 0){
		ugpHolder_el.style.margin = "auto";	
		if(presetId == 23 || presetId == 24 ){
			lastMenuPositionId = 2;
		};
	}
	
	
	positionStuff();
	setTimeout( function(){
		positionStuff();
	}, 200);

	setTimeout( function(){
		setupUGP();
		positionStuff();
	}, 800);
	
	if(window.addEventListener){
		window.addEventListener("resize", onResizeHandler);
	}else if(window.attachEvent){
		window.attachEvent("onresize", onResizeHandler);
	}
}

//#####################################//
/* Resize handler */
//#####################################//
function onResizeHandler(){
	positionStuff();
	setTimeout(positionStuff, 50);
}

//#####################################//
/* Position stuff */
//#####################################//
function positionStuff(doNotCloseController){
	
	if(FWDRLUtils.isIEAndLessThen9){
		var ws = FWDRLUtils.getViewportSize();
		if(ws.w < 450){
			body_el.style.width = "450px";
		}else{
			body_el.style.width = "100%";
		}
	}
	
	self.scrollBarW = parseInt(window.innerWidth  - document.documentElement.offsetWidth);
	
	positionAll(doNotCloseController);
}

//#####################################//
/* positionAll */
//#####################################//

function positionAll(doNotHide){
	var whatIsMainTextWidth = Math.min(maxWidth - 20, windowW - 16);
	var whatIsMainTextX = parseInt((windowW - whatIsMainTextWidth)/2);
	
	//lastDisplayId == 0
	if(orientationId == 1){
		var viewportSize = FWDRLUtils.getViewportSize();
		var contWidth = viewportSize.w;
		var contHeight = viewportSize.h;
		var	scale = Math.min(contWidth/maxWidth, 1);
		contHeight = Math.min(parseInt(scale * maxHeight), maxHeight);
		
		
		if(lastDisplayId == 0){
			contWidth = viewportSize.w;
		}else if(lastDisplayId == 1){
			contWidth = Math.min(maxWidth + 100, viewportSize.w);
		}else if(lastDisplayId == 2){
			contWidth = maxWidth;
		}
		
		if(contHeight < 500) contHeight = 500;
		
		ugpHolder_el.style.width = contWidth + "px";
		ugpHolder_el.style.height = contHeight + "px";
		
	}
	
	if(controller_do && !doNotHide){
		controller_do.hide(false);
		controller_do.positionAndResize(false);
	}
}

//###########################################//
/* Controller API methods */
//###########################################//
function addMouseWheelSupport(param){
	if(!myUGP) return;
	if(lastAddMouseWheelSupport == param) return;
	lastAddMouseWheelSupport = param;
	
	if(param){
		myUGP.thumbnailManager_do.addMouseWheelSupport();
	}else{
		myUGP.thumbnailManager_do.removeMouseWheelSupport();
	}
	
};

function showHideFullScreenButton(param){
	if(!myUGP) return;
	if(lastShowOrHideFullScreenButtonParam == param) return;
	lastShowOrHideFullScreenButtonParam = param;
	
	myUGP.showFullScreenButton_bl = param;
	
	myUGP.positionFullScreenButton();	
};

function setDisplay(id){
	if(!myUGP) return;
	if(lastDisplayId == id) return;
	lastDisplayId = id;
	
	if(lastDisplayId == 0){
		body_el.style.width = "100%";
		body_el.style.margin = "0";
		ugpHolder_el.style.maxWidth =  "none";
	}else if(lastDisplayId == 1){
		body_el.style.width = "100%";
		body_el.style.margin = "0";
		ugpHolder_el.style.maxWidth =  (maxWidth + 100) + "px";
		ugpHolder_el.style.margin = "auto";
	}else if(lastDisplayId == 2){
		ugpHolder_el.style.width =  "100%";
		body_el.style.width = maxWidth + "px";
		body_el.style.margin = "auto";
	}
	
	setTimeout(function(){
		positionStuff(true);
		myUGP.updateSize();
	}, 10);
};

function updateCurtainAnimationPosition(id){
	
	if(!myUGP) return;
	if(lastUpdateCurtainAnimationPositionId == id) return;
	lastUpdateCurtainAnimationPositionId = id;
	var thumbnail;
	
	if(id == 0){
		myUGP.data.imageTransitionDirection_str = "top"; 
	}else if(id == 1){
		myUGP.data.imageTransitionDirection_str = "right";
	}else if(id == 2){
		myUGP.data.imageTransitionDirection_str = "bottom";
	}else if(id == 3){
		myUGP.data.imageTransitionDirection_str = "left";
	}
	
	for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
		thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
		if(thumbnail){
			thumbnail.setCurtainAnimationDirection(myUGP.data.imageTransitionDirection_str);
		}
	}
	
};

function updateThumbnailsContentPosition(id){
	
	if(!myUGP) return;
	if(lastupdateThumbnailsContentPositionId == id) return;
	lastupdateThumbnailsContentPositionId = id;
	var offsetY = 0;
	var buttonsOffestY = 0;
	
	var thumbnail;
	
	if(id == 0){
		
		myUGP.data.textVerticalAlign_str = "top";
		
		if(orientationId == 0){
			if(presetId == 0 || presetId == 1 || presetId == 5 || presetId == 7 || presetId == 12  
			   || presetId == 13 || presetId == 14 || presetId == 15 || presetId == 19
			   || presetId == 22){
				offsetY = 10;
				buttonsOffestY = 2;
			}else if( presetId == 3 || presetId == 4  || presetId == 5 || presetId == 6 
					 || presetId == 9 ||  presetId == 10 || presetId == 11 
					 || presetId == 17 || presetId == 18 || presetId == 19 || presetId == 23 
					 || presetId == 24  || presetId == 25 || presetId == 28){
				offsetY = 10;
				buttonsOffestY = 10;
			}else if(presetId == 6 || presetId == 8  ){
				offsetY = 12;
				buttonsOffestY = 4;
			}
		}else{
			if(presetId == 0 || presetId == 1 || presetId == 2 || presetId == 3 
			   || presetId == 4 || presetId == 5 || presetId == 18){
				offsetY = 10;
			}else if(presetId == 6 || presetId == 7 || presetId == 8 || presetId == 9 || presetId == 10 || presetId == 13){
				offsetY = 12;
			}else if(presetId == 14 || presetId == 15){
				buttonsOffestY = 10;
			}
		}
		
		myUGP.data.contentOffsetY = offsetY;
		myUGP.data.buttonsOffestY = buttonsOffestY;
		myUGP.data.textVerticalAlign_str = "top";
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail){
				thumbnail.setContentPosition("top", offsetY, buttonsOffestY);
				if(orientationId == 0){
					if(presetId == 19 || presetId == 20 || presetId == 21 || presetId == 22) thumbnail.resizeContent();
				}else{
					if(presetId == 10 || presetId == 11 || presetId == 13) thumbnail.resizeContent();
				}
			}
		}
		
	}else if(id == 1){
		myUGP.data.textVerticalAlign_str = "center";
		
		myUGP.data.contentOffsetY = offsetY;
		myUGP.data.buttonsOffestY = buttonsOffestY;
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail){
				if(orientationId == 0){
					if(presetId == 20 || presetId == 21){
						myUGP.data.textVerticalAlign_str = "bottom";
						thumbnail.setContentPosition("bottom", offsetY, buttonsOffestY);
					}else{
						thumbnail.setContentPosition("center", offsetY, buttonsOffestY);
					}
					if(presetId == 19 || presetId == 20 || presetId == 21 || presetId == 22) thumbnail.resizeContent();
				}else{
					if(presetId == 11 || presetId == 12){
						myUGP.data.textVerticalAlign_str = "bottom";
						thumbnail.setContentPosition("bottom", offsetY, buttonsOffestY);
					}else{
						thumbnail.setContentPosition("center", offsetY, buttonsOffestY);
					}
					
					if(presetId == 10 || presetId == 11 || presetId == 13) thumbnail.resizeContent();
				}
			}
		}
	}else if(id == 2){
		
		myUGP.data.textVerticalAlign_str = "bottom";
		
		if(orientationId == 0){
			if(presetId == 0 || presetId == 1  || presetId == 28){
				offsetY = -10;
			}else if(presetId == 2){
				offsetY = 0;
				buttonsOffestY = 0;
			}else if(presetId == 4 || presetId == 5 || presetId == 6 
					|| presetId == 7 || presetId == 8 || presetId == 17
					|| presetId == 18  || presetId == 22){
				offsetY = -2;
				buttonsOffestY = -10;
			}else if(presetId == 3 || presetId == 9 || presetId == 10 || presetId == 11 || presetId == 12 
					|| presetId == 13 || presetId == 14 || presetId == 15 || presetId == 19 || presetId == 23 
					|| presetId == 24 || presetId == 25){
				buttonsOffestY = -10;
			}
		}else{
			if(presetId == 0 || presetId == 1){
				offsetY = -10;
			}else if(presetId == 0 || presetId == 1 || presetId == 2 || presetId == 3 || presetId == 4 || presetId == 14 || presetId == 15){
				offsetY = 0;
				buttonsOffestY = -10;
			}else if(presetId == 5 || presetId == 6 || presetId == 7 || presetId == 8 || presetId == 9 || presetId == 10 || presetId == 13  ){
				offsetY = -2;
				buttonsOffestY = -10;
			}else if(presetId == 18){
				offsetY = -4;
				buttonsOffestY = -4;
			}
		}
		
		myUGP.data.contentOffsetY = offsetY;
		myUGP.data.buttonsOffestY = buttonsOffestY;
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail){
				thumbnail.setContentPosition("bottom", offsetY, buttonsOffestY);
				if(presetId == 19 || presetId == 22) thumbnail.resizeAndPosition();
				if(orientationId == 0){	
					if(presetId == 19 || presetId == 22) thumbnail.resizeContent();
				}else{
					if(presetId == 10 || presetId == 11 || presetId == 13) thumbnail.resizeContent();
				}
			}
		}
	}
	
};

function updateThumbnailsOverlayOpacity(id){
	if(!myUGP) return;
	
	if(lastThumbnailOverlayOpacityId == id) return;
	lastThumbnailOverlayOpacityId = id;
	
	myUGP.data.thumbnailOverlayOpacity = id;
	for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
		thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
		if(thumbnail){
			thumbnail.setOverlayOpacityValue(id);
			if(orientationId == 0){
				if(presetId != 0 && presetId != 1 && presetId != 2 && presetId != 3 && 
				   presetId != 4 && presetId != 14 && presetId != 15 && presetId != 16 
				   && presetId != 17 && presetId != 18 && presetId != 24 && presetId != 25 && presetId != 28){
					thumbnail.setOverlayOpacity();
				}
			}else{
				if(presetId != 0 && presetId != 1 && presetId != 8 && presetId != 9 && presetId != 12  && presetId != 15 && presetId != 16 && presetId != 19) thumbnail.setOverlayOpacity();
			}
			
		}
	}

	clearTimeout(updateSizeId_to);
	updateSizeId_to = setTimeout(myUGP.updateSize, 50);
};


function updateThumbnailsOverlayColor(id){
	if(!myUGP) return;
	if(lastUpdateThumbnailsOverlayColorId == id) return;
	lastUpdateThumbnailsOverlayColorId = id;
	var thumbnail;
	var overlayColor_str;
	
	if(id == 0){
		overlayColor_str = "#000000";
		if(orientationId == 0){
			if(presetId == 0 || presetId == 2 || presetId == 5 || presetId == 6 || presetId == 8 || presetId == 12 || presetId == 13 || presetId == 26){
				overlayColor_str = "#FFFFFF";
			}
		}else{
			if(presetId == 0 || presetId == 2 || presetId == 3 || presetId == 5 || presetId == 6 || presetId == 7 ||  presetId == 9 || presetId == 17 ){
				overlayColor_str = "#FFFFFF";
			}
		}
		
		myUGP.data.thumbnailOverlayColor_str = overlayColor_str;
		
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			myUGP.data.playlist_ar.playlistItems[i].thumbnailOverlayColor = overlayColor_str;
		}
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail) thumbnail.setOverlayColor(overlayColor_str);
		}
		
	}else if(id == 1){
		
		overlayColor_str = "#0099FF";
		
		
		myUGP.data.thumbnailOverlayColor_str = overlayColor_str;
		
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			myUGP.data.playlist_ar.playlistItems[i].thumbnailOverlayColor = overlayColor_str;
		}
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail) thumbnail.setOverlayColor(overlayColor_str);
		}
	}else if(id == 2){
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			myUGP.data.playlist_ar.playlistItems[i].thumbnailOverlayColor = randomNormalCollor_ar[i];
		}
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail) thumbnail.setOverlayColor(randomNormalCollor_ar[i]);
		}
	}
};

function updateThumbnailsBorderColor(id){
	if(!myUGP) return;
	if(lastUpdateThumbnailsBorderColorTypeId == id) return;
	lastUpdateThumbnailsBorderColorTypeId = id;
	
	var thumbnail;
	var normalBorderColor_str;
	var selectedBorderColor_str;
	if(id == 0){
		
		if(orientationId == 0){
			if(presetId == 2 || presetId == 9 || presetId == 16){
				normalBorderColor_str = "#333333";
				selectedBorderColor_str = "#999999";
			}else if(presetId == 3 || presetId == 4 || presetId == 5 || presetId == 10
					|| presetId == 11 || presetId == 17 || presetId == 18){
				normalBorderColor_str = "#BBBBBB";
				selectedBorderColor_str = "#FFFFFF";
			}else if(presetId == 25){
				normalBorderColor_str = "#FFFFFF";
				selectedBorderColor_str = "#FFFFFF";
			}else{
				normalBorderColor_str = "#FFFFFF";
				selectedBorderColor_str = "#c1c1c1";
			}
		}else{
			if(presetId == 17){
				normalBorderColor_str = "#FFFFFF";
				selectedBorderColor_str = "#333333";
			}else if(presetId == 18){
				normalBorderColor_str = "#FFFFFF";
				selectedBorderColor_str = "#FFFFFF";
			}else{
				normalBorderColor_str = "#FFFFFF";
				selectedBorderColor_str = "#c1c1c1";
			}
			
		}
	
		
		myUGP.data.thumbnailBorderNormalColor_str = normalBorderColor_str;
		myUGP.data.thumbnailBorderSelectedColor_str = selectedBorderColor_str;
		
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			myUGP.data.playlist_ar.playlistItems[i].thumbnailBorderNormalColor = normalBorderColor_str;
			myUGP.data.playlist_ar.playlistItems[i].thumbnailBorderSelectedColor = selectedBorderColor_str;
		}
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail) thumbnail.setBorderColor(normalBorderColor_str, selectedBorderColor_str);
		}
	}else if(id == 1){
		normalBorderColor_str = "#0099FF";
		selectedBorderColor_str = "#FFFFFF";
		
		myUGP.data.thumbnailBorderNormalColor_str = normalBorderColor_str;
		myUGP.data.thumbnailBorderSelectedColor_str = selectedBorderColor_str;
		
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			myUGP.data.playlist_ar.playlistItems[i].thumbnailBorderNormalColor = normalBorderColor_str;
			myUGP.data.playlist_ar.playlistItems[i].thumbnailBorderSelectedColor = selectedBorderColor_str;
		}
		
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail) thumbnail.setBorderColor(normalBorderColor_str, selectedBorderColor_str);
		}
	}else if(id == 2){
		
		for (var i=0; i<myUGP.data.playlist_ar.playlistItems.length; i++){
			myUGP.data.playlist_ar.playlistItems[i].thumbnailBorderNormalColor = randomIntensCollor_ar[i];
			myUGP.data.playlist_ar.playlistItems[i].thumbnailBorderSelectedColor = randomNormalCollor_ar[i];
		}
		
		for (var i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
			thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
			if(thumbnail) thumbnail.setBorderColor(randomIntensCollor_ar[i], randomNormalCollor_ar[i]);
		}
	}
};

function updateThumbnailsBoxShadow(param){
	if(!myUGP) return;
	
	//if(lastThumbnailBoxShadowId == param) return;
	lastThumbnailBoxShadowId = param;
	
	for (i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
		thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
		if(thumbnail){
			if(param){	
				if(orientationId == 0){
					if(presetId == 3 || presetId == 4 || presetId == 10 
					  || presetId == 11 || presetId == 16 || presetId == 17
					  || presetId == 18){
						thumbnail.setBorderBoxShadow("0px 0px 6px #999999"); 
					}else if(presetId == 25 || presetId == 27 || presetId == 28){
						thumbnail.setBorderBoxShadow("1px 1px 3px #BBBBBB"); 
					}else if(presetId == 26){
						thumbnail.setBorderBoxShadow("0px 0px 5px #DDDDDD"); 
					}else if(presetId == 29){
						thumbnail.setBorderBoxShadow("0px 0px 4px #EEEEEE"); 
					}else{
						thumbnail.setBorderBoxShadow("0px 0px 10px #CCCCCC"); 
					}
				}else if(orientationId == 1){
					if(presetId == 16 || presetId == 18 || presetId == 19){
						thumbnail.setBorderBoxShadow("1px 1px 3px #BBBBBB"); 
					}else if(presetId == 17){
						thumbnail.setBorderBoxShadow("0px 0px 5px #DDDDDD"); 
					}else if(presetId == 20){
						thumbnail.setBorderBoxShadow("0px 0px 4px #EEEEEE"); 
					}else{
						thumbnail.setBorderBoxShadow("0px 0px 10px #CCCCCC"); 
					}
				}else{
					thumbnail.setBorderBoxShadow("0px 0px 10px #CCCCCC"); 
				}
			}else{
				 thumbnail.setBorderBoxShadow("none");
			}
		}
	}
	
	if(param){
		myUGP.data.thumbanilBoxShadow_str = "0px 0px 12px #CCCCCC";
	}else{
		myUGP.data.thumbanilBoxShadow_str = "none";
	}
};


function updateThumbnailsHorizontalOffset(id){
	if(!myUGP) return;
	
	if(lastThumbnailHorizontalOffsetId == id) return;
	lastThumbnailHorizontalOffsetId = id;
	
	myUGP.thumbnailManager_do.thumbsHOffset = id;

	myUGP.updateSize();
};

function updateThumbnailsVerticalOffset(id){
	if(!myUGP) return;
	
	if(lastThumbnailVerticalOffsetId == id) return;
	lastThumbnailVerticalOffsetId = id;
	
	myUGP.thumbnailManager_do.thumbsVOffset = id;

	myUGP.updateSize();
};

function updateVerticalSpaceBetweenThumbnails(id){
	if(!myUGP) return;
	
	if(lastThumbnailVerticalSpaceId == id) return;
	lastThumbnailVerticalSpaceId = id;
	
	myUGP.thumbnailManager_do.thumbsVSpace = id;

	myUGP.updateSize();
};

function updateHorizontalSpaceBetweenThumbnails(id){
	if(!myUGP) return;
	
	if(lastThumbnailHorizotanlSpaceId == id) return;
	lastThumbnailHorizotanlSpaceId = id;
	
	myUGP.thumbnailManager_do.thumbsHSpace = id;

	myUGP.updateSize();
};

function updateThumbnailsBorderSize(id){
	if(!myUGP) return;
	
	if(lastThumbnailBorderSizeId == id) return;
	
	if(orientationId == 0){
		lastThumbnailBorderSizeId = controller_do.thumbnailsSlider_do.menuButtons_ar[6].value;	
		lastThumbnailBorderRadiusId = controller_do.thumbnailsSlider_do.menuButtons_ar[7].value;	
	}else{
		lastThumbnailBorderSizeId = controller_do.thumbnailsSlider_do.menuButtons_ar[7].value;
		lastThumbnailBorderRadiusId = controller_do.thumbnailsSlider_do.menuButtons_ar[8].value;	
	}
	
	if(lastThumbnailBorderSizeId < lastThumbnailBorderRadiusId){
		lastThumbnailBorderRadiusId = lastThumbnailBorderSizeId;
		if(orientationId == 0){
			controller_do.thumbnailsSlider_do.menuButtons_ar[7].setValue(lastThumbnailBorderRadiusId);	
		}else{
			controller_do.thumbnailsSlider_do.menuButtons_ar[8].setValue(lastThumbnailBorderRadiusId);	
		}
	}

	clearTimeout(updateBorderSizeAndRadius_to);
	updateBorderSizeAndRadius_to = setTimeout(setFinalBorderSizeAndRadius, 50);
	
};

function updateThumbnailsBorderRadius(id){
	if(!myUGP) return;
	
	if(lastThumbnailBorderRadiusId == id) return;
	
	if(orientationId == 0){
		lastThumbnailBorderSizeId = controller_do.thumbnailsSlider_do.menuButtons_ar[6].value;	
		lastThumbnailBorderRadiusId = controller_do.thumbnailsSlider_do.menuButtons_ar[7].value;	
	}else{
		lastThumbnailBorderSizeId = controller_do.thumbnailsSlider_do.menuButtons_ar[7].value;
		lastThumbnailBorderRadiusId = controller_do.thumbnailsSlider_do.menuButtons_ar[8].value;	
	}
	
	if(lastThumbnailBorderRadiusId > lastThumbnailBorderSizeId){
		lastThumbnailBorderSizeId = lastThumbnailBorderRadiusId;
		if(orientationId == 0){
			controller_do.thumbnailsSlider_do.menuButtons_ar[6].setValue(lastThumbnailBorderRadiusId);	
		}else{
			controller_do.thumbnailsSlider_do.menuButtons_ar[7].setValue(lastThumbnailBorderRadiusId);	
		}
	}
	
	clearTimeout(updateBorderSizeAndRadius_to);
	updateBorderSizeAndRadius_to = setTimeout(setFinalBorderSizeAndRadius, 50);
	
};

function setFinalBorderSizeAndRadius(){
	
	myUGP.data.thumbnailBorderRadius = lastThumbnailBorderRadiusId;
	myUGP.thumbnailManager_do.thumbnailBorderRadius = lastThumbnailBorderRadiusId;
	
	myUGP.data.thumbnailBorderSize = lastThumbnailBorderSizeId;
	myUGP.thumbnailManager_do.borderSize = lastThumbnailBorderSizeId;

	for (i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
		thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
		if(thumbnail){
			thumbnail.setBorderRadius(lastThumbnailBorderRadiusId);
		 	thumbnail.setBorderSize(lastThumbnailBorderSizeId);
		}
	}
	
	clearTimeout(updateSizeId_to);
	updateSizeId_to = setTimeout(myUGP.updateSize, 50);
}

function updateThumbnailsTransitionType(id){
	if(!myUGP) return;
	if(lastUpdateThumbnailsTransitionTypeId == id) return;
	lastUpdateThumbnailsTransitionTypeId = id;
	var thumbnail;
	if(id == 0){
		id = "scale";
	}else if(id == 1){
		id = "rotation";
	}else if(id == 2){
		id = "opacity";
	}
	
	myUGP.data.hideAndShowTransitionType_str = id;
	
	for (i=0; i<myUGP.thumbnailManager_do.dataThumbnails_ar.length; i++){
		thumbnail = myUGP.thumbnailManager_do.dataThumbnails_ar[i].thumbnail;
		if(thumbnail) thumbnail.setTransitionType(id);
	}
};

function updateMenuPositon(id){
	if(!myUGP) return;
	if(lastMenuPositionId == id) return;
	lastMenuPositionId = id;
	
	if(myUGP.menu_do && myUGP.menu_do){
    	if(id == 0){
			myUGP.menu_do.menuPosition_str = "left";
			myUGP.menu_do.menuMaxWidth = 8000;
    	}else if(id == 1){
			myUGP.menu_do.menuPosition_str = "right";
			myUGP.menu_do.menuMaxWidth = 8000;
    	}else if(id == 2){
			myUGP.menu_do.menuPosition_str = "center";
			myUGP.menu_do.menuMaxWidth = myUGP.data.menuMaxWidth;
    	}else if(id == 3){
			myUGP.menu_do.menuPosition_str = "left";
			myUGP.menu_do.menuMaxWidth = myUGP.data.menuMaxWidth;
    	}else if(id == 4){
			myUGP.menu_do.menuPosition_str = "right";
			myUGP.menu_do.menuMaxWidth = myUGP.data.menuMaxWidth;
    	}

    	clearTimeout(self.resizeHandlerId_to);
		self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
	}
};

function updateMenuHorizontalOffset(id){
	if(!myUGP) return;
	
	if(lastHorizontalOffsetId == id) return;
	lastHorizontalOffsetId = id;
	
	myUGP.menu_do.menuButtonsSapcerLeftAndRight = id;
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

function updateHorizontalSpaceBetweenButtons(id){
	if(!myUGP) return;
	
	if(lastHorizontalSpaceId == id) return;
	lastHorizontalSpaceId = id;
	
	myUGP.menu_do.horizontalSpaceBetweenMenuButtons = id;
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

function updateVerticalSpaceBetweenButtons(id){
	if(!myUGP) return;
	
	if(lastVerticalSpaceId == id) return;
	lastVerticalSpaceId = id;
	
	myUGP.menu_do.verticalSpaceBetweenMenuButtons = id;
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

function updateMenuOffsetTop(id){
	if(!myUGP) return;
	
	if(lastOffsetTopId == id) return;
	lastOffsetTopId = id;
	
	myUGP.menu_do.menuOffsetTop = id;
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
}

function updateMenuOffsetBottom(id){
	if(!myUGP) return;
	
	if(lastOffsetBottomId == id) return;
	lastOffsetBottomId = id;

	myUGP.menu_do.menuOffsetBottom = id;
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
}


function showOrHideMenuSpacers(param){
	if(!myUGP) return;
	if(lastShowSpacersParam == param) return;
	lastShowSpacersParam = param;
	
	if(param){
		myUGP.menu_do.showOrHideSpacers(true);
	}else{
		myUGP.menu_do.showOrHideSpacers(false);
	}
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

function showOrHideMenu(param){
	if(!myUGP) return;
	if(lastHideMenuParam == param) return;
	lastHideMenuParam = param;
	
	if(param){
    	myUGP.menu_do.isShowed_bl = true;
    	myUGP.menu_do.setY(0);
	}else{
		myUGP.menu_do.isShowed_bl = false;
		myUGP.menu_do.setY(-5000);
    	
	}
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};


function showOrHideTotalCategoriesNumber(param){
	if(!myUGP) return;
	if(lastHideTotalCategoriesParam == param) return;
	lastHideTotalCategoriesParam = param;
	
	myUGP.menu_do.setButtonsLabels(param);

	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};


function showOrHideSearchBox(param){
	if(!myUGP) return;
	
	
	if(lastshowOrHideSearchBox == param) return;
	lastshowOrHideSearchBox = param;
	
	myUGP.menu_do.showOrHideSearchBox(param);

	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

function showOrAllCategoriesButton(param){
	
	if(!myUGP) return;
	if(lastShowOrHideAllCategoriesButtonParam == param) return;
	lastShowOrHideAllCategoriesButtonParam = param;

	if(param){
		if(FWDRLUtils.indexOfArray(myUGP.menu_do.buttons_ar, myUGP.menu_do.allCategoriesButton_do) == -1){
			myUGP.thumbnailManager_do.showAllCategories_bl = true;
			
			myUGP.menu_do.showAllCategories_bl = true;
			myUGP.menu_do.buttons_ar.splice(0,0, myUGP.menu_do.allCategoriesButton_do);
			myUGP.menu_do.totalButtons ++;
		}
	}else{
		if(FWDRLUtils.indexOfArray(myUGP.menu_do.buttons_ar, myUGP.menu_do.allCategoriesButton_do) != -1){
			myUGP.thumbnailManager_do.showAllCategories_bl = false;
			
			myUGP.menu_do.showAllCategories_bl = false;
			myUGP.menu_do.buttons_ar.splice(0,1);
			myUGP.menu_do.totalButtons --;
			myUGP.menu_do.allCategoriesButton_do.setX(-400);
		}	
	}
	
	myUGP.menu_do.resetButtonsState();
	myUGP.menu_do.buttonOnMouseUpHandler();
	
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

function allowMultipleMenuButtonSelection(param){
	if(!myUGP) return;
	if(lastAllowMultipleMenuButtonSelection == param) return;
	lastAllowMultipleMenuButtonSelection = param;

	if(param){
		myUGP.menu_do.multipleCategorySelection_bl = true;
		myUGP.menu_do.resetButtonsState();
	}else{
		myUGP.menu_do.multipleCategorySelection_bl = false;
		myUGP.menu_do.resetButtonsState();
	}

	myUGP.menu_do.buttonOnMouseUpHandler();
	clearTimeout(self.resizeHandlerId_to);
	self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
}

this.updateMenuType = function(id){
	if(id == 0){
		myUGP.menu_do.menuType_str =  "list";
		controller_do.menuSliderMenu_do.enableSlidersWhenTypeIsCombobox();
	}else{
		myUGP.menu_do.menuType_str =  "combobox";
		controller_do.menuSliderMenu_do.disableSlidersWhenTypeIsCombobox();
	}
	myUGP.menu_do.updateMenuStyle();
};

this.updateMenuButtonsClass = function(id){
	if(lastSetButtonsClassId == id) return;
	lastSetButtonsClassId = id;

	if(id == 0){
		if(orientationId == 0 && (presetId == 3 || presetId == 4 || presetId == 10 || presetId == 11 || presetId == 17 
				|| presetId == 18 || presetId == 25 || presetId == 27 || presetId == 28)){
			myUGP.menu_do.setButtonsClass(
				"UGPMenuButtonBackgroundNormal",
				"UGPMenuButtonBackgroundSelected",
				"UGPMenuButtonTextNormal",
				"UGPMenuButtonTextSelected",
				"UGPMenuButtonBackgroundNormal",
				"UGPMenuButtonBackgroundSelected",
				"UGPMenuButtonTextNormal",
				"UGPMenuButtonTextSelected",
				"UGPMenuButtonsSpacers",
				"searchClassName",
				"#FFFFFF",
				"#000000"
			);
		}else{
			myUGP.menu_do.setButtonsClass(
				"UGPMenuButtonBackgroundNormal",
				"UGPMenuButtonBackgroundSelected",
				"UGPMenuButtonTextNormal",
				"UGPMenuButtonTextSelected",
				"UGPMenuButtonBackgroundNormal",
				"UGPMenuButtonBackgroundSelected",
				"UGPMenuButtonTextNormal",
				"UGPMenuButtonTextSelected",
				"UGPMenuButtonsSpacers",
				"searchClassName",
				"#FFFFFF",
				"#000000"
			);
		}
		myUGP.thumbnailManager_do.loadMoreButton_do.setClass(
			"UGPMenuButtonBackgroundNormal",
			"UGPMenuButtonBackgroundSelected",
			"UGPMenuButtonTextNormal",
			"UGPMenuButtonTextSelected",
			"UGPMenuButtonsSpacers"
		);
		
		
	}else if(id == 1){
		if((orientationId == 0 && (presetId == 3 || presetId == 4 || presetId == 10 || presetId == 11 || presetId == 17 
			|| presetId == 18 || presetId == 25 || presetId == 27 || presetId == 28))
			|| (orientationId == 1 && (presetId == 16 || presetId == 18 || presetId == 19))){
			myUGP.menu_do.setButtonsClass(
				"UGPWhiteMenuButtonBackgroundNormal2",
				"UGPWhiteMenuButtonBackgroundSelected2",
				"UGPWhiteMenuButtonTextNormal2",
				"UGPWhiteMenuButtonTextSelected2",
				"UGPWhiteMenuSelectorckgroundNormal2",
				"UGPWhiteMenuSelectorBackgroundSelected2",
				"UGPWhiteMenuSelectorTextNormal2",
				"UGPWhiteMenuSelectorTextSelected2",
				"UGPMenuButtonsSpacers2",
				"whiteSearchClassName2",
				"#000000",
				"#000000"
				);
			myUGP.thumbnailManager_do.loadMoreButton_do.setClass(
				"UGPWhiteMenuButtonBackgroundNormal2",
				"UGPWhiteMenuButtonBackgroundSelected2",
				"UGPWhiteMenuButtonTextNormal2",
				"UGPWhiteMenuButtonTextSelected2",
				"UGPMenuButtonsSpacers2"
			);
		
		}else{
			myUGP.menu_do.setButtonsClass(
				"UGPMenuButtonBackgroundNormal2",
				"UGPMenuButtonBackgroundSelected2",
				"UGPMenuButtonTextNormal2",
				"UGPMenuButtonTextSelected2",
				"UGPMenuSelectorckgroundNormal2",
				"UGPMenuSelectorBackgroundSelected2",
				"UGPMenuSelectorTextNormal2",
				"UGPMenuSelectorTextSelected2",
				"UGPMenuButtonsSpacers2",
				"UGPSearchClassName2",
				"#999999",
				"#FFFFFF"
				);
			myUGP.thumbnailManager_do.loadMoreButton_do.setClass(
				"UGPMenuButtonBackgroundNormal2",
				"UGPMenuButtonBackgroundSelected2",
				"UGPMenuButtonTextNormal2",
				"UGPMenuButtonTextSelected2",
				"UGPMenuButtonsSpacers2"
			);
		}
	}else if(id == 2){
		if((orientationId == 0 && (presetId == 3 || presetId == 4 || presetId == 10 || presetId == 11 || presetId == 17 
				|| presetId == 18 || presetId == 25 || presetId == 27 || presetId == 28))
				|| (orientationId == 1 && (presetId == 16 || presetId == 18 || presetId == 19))){
			myUGP.menu_do.setButtonsClass(
				"UGPWhiteMenuButtonBackgroundNormal3",
				"UGPWhiteMenuButtonBackgroundSelected3",
				"UGPWhiteMenuButtonTextNormal3",
				"UGPWhiteMenuButtonTextSelected3",
				"UGPWhiteMenuSelectorBackgroundNormal3",
				"UGPWhiteMenuSelectorBackgroundSelected3",
				"UGPWhiteMenuSelectorTextNormal3",
				"UGPWhiteMenuSelectorTextSelected3",
				"UGPMenuButtonsSpacers3",
				"UGPWhiteSearchClassName3",
				"#333333",
				"#0099FF"
				);
			myUGP.thumbnailManager_do.loadMoreButton_do.setClass(
				"UGPWhiteMenuButtonBackgroundNormal3",
				"UGPWhiteMenuButtonBackgroundSelected3",
				"UGPWhiteMenuButtonTextNormal3",
				"UGPWhiteMenuButtonTextSelected3",
				"UGPMenuButtonsSpacers3"
			);
		}else{
			myUGP.menu_do.setButtonsClass(
				"UGPMenuButtonBackgroundNormal3",
				"UGPMenuButtonBackgroundSelected3",
				"UGPMenuButtonTextNormal3",
				"UGPMenuButtonTextSelected3",
				"UGPMenuSelectorBackgroundNormal3",
				"UGPMenuSelectorBackgroundSelected3",
				"UGPMenuSelectorTextNormal3",
				"UGPMenuSelectorTextSelected3",
				"UGPMenuButtonsSpacers3",
				"UGPSearchClassName3",
				"#EEEEEE",
				"#FFFFFF"
			);
			myUGP.thumbnailManager_do.loadMoreButton_do.setClass(
				"UGPMenuButtonBackgroundNormal3",
				"UGPMenuButtonBackgroundSelected3",
				"UGPMenuButtonTextNormal3",
				"UGPMenuButtonTextSelected3",
				"UGPMenuButtonsSpacers3"
			);
		}
		
	}else if(id == 3){
		
		if((orientationId == 0 && (presetId == 3 || presetId == 4 || presetId == 10 || presetId == 11 || presetId == 17 
				|| presetId == 18 || presetId == 25 || presetId == 27 || presetId == 28))
				|| (orientationId == 1 && (presetId == 16 || presetId == 18 || presetId == 19))){
			myUGP.menu_do.setButtonsClass(
				"UGPMenuButtonBackgroundNormal4",
				"UGPMenuButtonBackgroundSelected4",
				"UGPMenuButtonTextNormal4",
				"UGPMenuButtonTextSelected4",
				"UGPMenuSelectorBackgroundNormal4",
				"UGPMenuSelectorBackgroundSelected4",
				"UGPMenuSelectorTextNormal4",
				"UGPMenuSelectorTextSelected4",
				"UGPMenuButtonsSpacers4",
				"UGPWhiteSearchClassName4",
				"#000000",
				"#FFFFFF"
			);
		}else{
			myUGP.menu_do.setButtonsClass(
				"UGPMenuButtonBackgroundNormal4",
				"UGPMenuButtonBackgroundSelected4",
				"UGPMenuButtonTextNormal4",
				"UGPMenuButtonTextSelected4",
				"UGPMenuSelectorBackgroundNormal4",
				"UGPMenuSelectorBackgroundSelected4",
				"UGPMenuSelectorTextNormal4",
				"UGPMenuSelectorTextSelected4",
				"UGPMenuButtonsSpacers4",
				"UGPSearchClassName4",
				"#000000",
				"#FFFFFF"
			);
		}
		
		myUGP.thumbnailManager_do.loadMoreButton_do.setClass(
			"UGPMenuButtonBackgroundNormal4",
			"UGPMenuButtonBackgroundSelected4",
			"UGPMenuButtonTextNormal4",
			"UGPMenuButtonTextSelected4",
			"UGPMenuButtonsSpacers4"
		);
	}
	
	
		clearTimeout(self.resizeHandlerId_to);
		self.resizeHandlerId_to = setTimeout(myUGP.resizeHandler, 72);
};

//Lightbox stuff
var rlobj_modernSkin = {
	playlistItems:[
	{
		url:"graphics/skin-example.jpg"
	}]
};

var modernSkinProps_obj = {
		showSlideShowButton:"no",
		showFacebookButton:"no"
};