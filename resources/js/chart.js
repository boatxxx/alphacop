// chart.js
const days = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'];
const workDaysLast7Days = [8, 7, 6, 5, 8, 9, 7];
const ctx = document.getElementById('last7DaysChart').getContext('2d');

const last7DaysChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: days,
    datasets: [{
      label: 'จำนวนวันที่มีการเข้างานใน 7 วันล่าสุด',
      data: workDaysLast7Days,
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
import L from 'leaflet';

var map = L.map('map').setView([0, 0], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

var markerIn = L.marker([0, 0]).addTo(map).bindPopup('ตำแหน่งเข้างาน');
var markerOut = L.marker([0, 0]).addTo(map).bindPopup('ตำแหน่งออกงาน');
