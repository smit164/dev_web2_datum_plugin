if($('#propertymap').length != 0){
var Maps 		= null;
var gmarkers 	= [];
var bounds 		= new google.maps.LatLngBounds();
var mcluster 	= null;
var drawingManager 	= null;
var nkf_circle  = null;
var circle_point  = true;
var panoramaOptions = {
    addressControlOptions : { position : google.maps.ControlPosition.TOP_LEFT},
    zoomControlOptions : { position : google.maps.ControlPosition.RIGHT_TOP},
    panControlOptions: {position: google.maps.ControlPosition.RIGHT_BOTTOM},
    enableCloseButton : true,
    visible: false //set to false so streetview is not triggered on the initial map load
};
var panorama = new google.maps.StreetViewPanorama(document.getElementById("propertymap"), panoramaOptions);
var propertymap 	= {
	setup   : function(config) {

		this.init();
		//this.setMarkers(config.marker);
	},

	init : function() {
		
		var mapOptions = {
	        zoom: parseInt(zoom),
	        center: new google.maps.LatLng(latitude,longitude),
	        mapTypeControl:false,
	        mapTypeControlOptions: {
		      mapTypeIds: [
		        google.maps.MapTypeId.ROADMAP,
		        google.maps.MapTypeId.SATELLITE
		      ],
		      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		    },
	        scrollwheel: false,
	        scaleControl:true,
		    zoomControlOptions: { position: google.maps.ControlPosition.RIGHT_TOP },
		    streetViewControl:true,
		    streetViewControlOptions: { position: google.maps.ControlPosition.LEFT_TOP },
		    overviewMapControl:true,
		    rotateControl:true,
		    streetView : panorama,
	    }
		Maps = new google.maps.Map(document.getElementById('propertymap'), mapOptions);
		

		drawingManager = new google.maps.drawing.DrawingManager({
		    drawingMode: null,
		    drawingControl: false,
		    drawingControlOptions: {
		      	position: google.maps.ControlPosition.TOP_CENTER,
		      	 drawingModes : [ google.maps.drawing.OverlayType.CIRCLE ]
		    },
	    	circleOptions: {
	      		fillColor: '#000F9F',
		      	strokeWeight: 1,
		      	clickable: false,
		      	editable: false,
	    	}
	  	});
	  	drawingManager.setMap(Maps);

		const customDrawFunctionDiv = document.createElement("div");
		this.SatelliteMap(customDrawFunctionDiv, Maps,drawingManager);
		Maps.controls[google.maps.ControlPosition.TOP_RIGHT].push(customDrawFunctionDiv);
		
		google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
			if (event.type == google.maps.drawing.OverlayType.CIRCLE) {
	            if(nkf_circle != null)
	                nkf_circle.setMap(null);
	            nkf_circle = event.overlay;
	            
	            drawingManager.setDrawingMode(null);
	        }
	    });

		google.maps.event.addListener(drawingManager, 'circlecomplete', function (circle) {
	 	 	
	 	 	nkf_radius = circle.radius/1000;
		  	nkf_radius_km = nkf_radius.toFixed(2);
		  	
			current_lat = circle.center.lat();
			current_long = circle.center.lng();
			
		  	drawingManager.setDrawingMode(null);
		  	
			var propertytype, propertystatus, propertysearch;
		
			propertystatus = $('#oepl_status').val();
			propertytype = $('.propertytype_li.active').children('a').attr('fil_name');
			propertysearch = $('#search_property').val();
			
			
			$('#current_lat').val(current_lat);
			$('#nkf_radius_km').val(nkf_radius_km);
			$('#current_long').val(current_long);
			ajaxCall('',current_lat,current_long,nkf_radius_km);
			
			/*var markerBounds = new google.maps.LatLngBounds();
	    	markerBounds.union(circle.getBounds());
			Maps.fitBounds(markerBounds);*/
			circle_point = false;
	    	
		});
	},
	setMarkers : function(markers,reset = '') {
		if(reset){
			this.resetMarkers();
		}
	  	var _this 	= this;
	  	var infoWindow = new google.maps.InfoWindow();
	  	bounds 		= new google.maps.LatLngBounds();
	    for(var i = 0; i < Object.keys(markers).length; i++) {
	    	if(!markers[i]) continue;

	    	var content = '<div class="card oeplCard" style="width: 250px;">'+
	    	'<a href="'+markers[i].properyurl+'" target="_blank">'+
	    	'<img class="card-img-top" src="'+markers[i].featured_image+'" alt="'+markers[i].img_alt+'" style="width:250px">'+
	    	'</a><div class="card-body" style="padding:0px 8px !important;">'+
	    	'<div style="font-weight:400;font-size:13px;line-height:32px;">'+
	    	'<h4 style="font-size: 16px;padding-top: 10px;margin-bottom: 5px;">'+markers[i].title+'</h4>'+
	    	'<p style="font-size: 13px;margin-bottom: 5px;line-height: 17px;">'+markers[i].addr+'</p></div>'+
	    	'<div style="font-weight:400;font-size:13px;display:flex;align-items: center;flex-wrap: wrap;">'+
	    	'<p style="margin-right: 8px;margin-bottom:0;font-size:13px;">'+markers[i].p_type+'</p>'+
	    	'<p style="margin-bottom:0;background: #878787;color:#fff;border-radius: 20px;font-size:12px;height: 20px; line-height: 20px;padding: 0 10px;">'+markers[i].p_status+'</p></div>'+
	    	'<div style="font-weight: 600;font-size: 17px;line-height: 32px;color: #000F9F;">'+markers[i].p_price+'</div></div></div></div>';

	    	var myLatLng  = new google.maps.LatLng(markers[i].lat,markers[i].log);
		    var marker = new google.maps.Marker({  
		    	id 		: markers[i].id,
               	 map 	: Maps,
               	 //icon 	: baseUrl + '/zmembership/assets/img/sale.png',
	        	icon: {url: plugins_url+'/images/general/pin.png', scaledSize: new google.maps.Size(30,30)},
                title 	: markers[i].title, 
                position: myLatLng, 
                content : content ,
                closeBoxURL: plugins_url+'/images/general/close.svg'
            });

			gmarkers.push(marker);
		    bounds.extend(marker.getPosition());

		    google.maps.event.addListener(marker,'click', (function(_marker){ 
				return function() {
                   	infoWindow.setContent(_marker.content);
                   	infoWindow.open(Map, this);
                   	Maps.setCenter(this.position);
                };
            })(marker));

            google.maps.event.addListener(infoWindow, 'domready', function() {
				$(".gm-style .gm-style-iw-c").css("padding", "0px");
		    	$(".gm-ui-hover-effect img").attr("src", plugins_url+'/images/general/close.svg');
		    	$(".gm-ui-hover-effect").css("right", "0");
		    	$(".gm-ui-hover-effect img").css({"width": "20px", "height": "20px"});
		    	$(".oeplCard").parent().parent().css("overflow", "auto");
		  	});
	    }
	    if(circle_point){
		    if(markers.length == 1) {
	            Maps.setCenter(new google.maps.LatLng(markers[0].lat,markers[0].log));
	            Maps.setZoom(10);
	        } else {
	            if(markers.length > 1) {
	                Maps.fitBounds(bounds); 
	                var myLatLng = new google.maps.LatLng(markers[0].lat,markers[0].log);  
					Maps.setCenter(myLatLng);
	            }
	        }
	    }
	   	
        	
	},
	idles : function(){

		
	},

	mapBound : function(){
		
		
	},
	SatelliteMap : function(controlDiv,map){

		const controlUI = document.createElement("div");
		controlUI.style.cursor = "pointer";
		controlUI.title = "Draw Radius";
		controlUI.style.padding = "5px";
		controlUI.innerHTML = "<div class='oeplDrawCircle'><img src='"+plugins_url+"/img/draw.svg'/></div>";
		controlDiv.appendChild(controlUI);
		this.CenterControl(controlDiv, map, drawingManager);
		controlUI.addEventListener("click", () => {
			drawingManager.setDrawingMode(google.maps.drawing.OverlayType.CIRCLE);
			
			google.maps.event.addListener(drawingManager, 'circlecomplete', function (circle) {
				$(".oeplDrawCircle").hide();
				$("#CLEARCIRCLE").show();
				set_drw = '';
				circle_point = false;
			});
		});

	  // Setup the click event listeners: simply set the map to Chicago.
	  /*controlUI.addEventListener("click", () => {
	    map.setCenter(chicago);
	  });*/
	  	//Maps.constontrols[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);
	},

	CenterControl: function(controlDiv, map, drawingManager){
		const controlUI = document.createElement("div");
		controlUI.style.cursor = "pointer";
	  	controlUI.title = "Remove Radius";
	  	controlUI.style.padding = "5px";
	  	controlUI.innerHTML = "<div id='CLEARCIRCLE' class='mapCancelButton' style='display: none;'><img src='"+plugins_url+"/img/quit.svg'/></div>";
	  	controlDiv.appendChild(controlUI);
	  	controlUI.addEventListener("click", () => {
	    	$('#current_lat').val('');
	    	$('#current_long').val('');
	    	$('#nkf_radius_km').val('');
	    	$("#CLEARCIRCLE").hide();
			$(".oeplDrawCircle").show();
			nkf_circle.setMap(null);
			set_drw = 1;
			circle_point = true;
			ajaxCall();

	  	});
	},

	resetMarkers : function() {
		if(gmarkers) {
			for (var i = 0; i < gmarkers.length; i++) {
				gmarkers[i].setMap(null);
			}
		}

		gmarkers 		= [];
	},
}
;
}