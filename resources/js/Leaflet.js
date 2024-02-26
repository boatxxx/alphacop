import L from 'leaflet';

var map = L.map('map').setView([0, 0], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

var markerIn = L.marker([0, 0]).addTo(map).bindPopup('ตำแหน่งเข้างาน');
var markerOut = L.marker([0, 0]).addTo(map).bindPopup('ตำแหน่งออกงาน');
