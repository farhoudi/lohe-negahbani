"use strict";
function initialize() {
    var e = document.getElementById("map-canvas"), t = new google.maps.LatLng(35.699721, 51.338087), a = {
        center: t,
        zoom: 14,
        styles: [{featureType: "water", stylers: [{visibility: "on"}, {color: "#b5cbe4"}]}, {
            featureType: "landscape",
            stylers: [{color: "#efefef"}]
        }, {
            featureType: "road.highway",
            elementType: "geometry",
            stylers: [{color: "#83a5b0"}]
        }, {
            featureType: "road.arterial",
            elementType: "geometry",
            stylers: [{color: "#bdcdd3"}]
        }, {
            featureType: "road.local",
            elementType: "geometry",
            stylers: [{color: "#ffffff"}]
        }, {
            featureType: "poi.park",
            elementType: "geometry",
            stylers: [{color: "#e3eed3"}]
        }, {
            featureType: "administrative",
            stylers: [{visibility: "on"}, {lightness: 33}]
        }, {featureType: "road"}, {
            featureType: "poi.park",
            elementType: "labels",
            stylers: [{visibility: "on"}, {lightness: 20}]
        }, {}, {featureType: "road", stylers: [{lightness: 20}]}],
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }, o = new google.maps.Map(e, a);
    new google.maps.Marker({position: t, map: o, icon: image})
}
var image = "dist/images/map-sign.png";
google.maps.event.addDomListener(window, "load", initialize);