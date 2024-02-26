<!DOCTYPE html>
<html>
<head>
  <title>แสดงแผนที่</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" integrity="" crossorigin=""/>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js" integrity="" crossorigin=""></script>

</head>
<body>
  <div id="map" style="height: 150px; width: 150px; "></div>
  <script>
    var map = L.map('map').setView([13.7563, 100.5018], 10); // เปลี่ยนตำแหน่งเริ่มต้นเป็นตำแหน่งในกรุงเทพฯ

    // เพิ่ม Tile Layer สำหรับแผนที่ OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // เพิ่ม Marker เข้างาน
    var markerIn = L.marker([13.7563, 100.5018]).addTo(map).bindPopup('ตำแหน่งเข้างาน');

    // เพิ่ม Marker ออกงาน
    var markerOut = L.marker([13.7563, 100.5018]).addTo(map).bindPopup('ตำแหน่งออกงาน');
  </script>
</body>
</html>
