document.addEventListener('DOMContentLoaded', function() {
var map = L.map('map').setView([-0.7893, 113.9213], 5); // Koordinat tengah Indonesia

// iki nambah peta e
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

// Pengertian nak map e
var markerJawaBarat = L.marker([-6.9175, 107.6191]).addTo(map) 
    .bindPopup('<b>Jawa Barat</b><br><a href="jabar.html" target="_blank">Klik disini...</a>')
    .openPopup();

    var markerJawaTengah = L.marker([-6.9939, 110.4203]).addTo(map) 
    .bindPopup('<b>Jawa Tengah</b><br><a href="jateng.html" target="_blank">Klik disini...</a>')
    .openPopup();

    var markerJawaTimur = L.marker([-7.2504, 112.7688]).addTo(map) 
    .bindPopup('<b>Jawa Timur</b><br><a href="jatim.html" target="_blank">Klik disini...</a>')
    .openPopup();
});

function openPopup() {
    document.getElementById("loginPopup").style.display = "block";
} //iki open login e

function closePopup() {
    document.getElementById("loginPopup").style.display = "none";
}//iki gae tutup

document.querySelector('.login-button').addEventListener('click', function(event) {
    event.preventDefault(); 
    openPopup();
});

// gae nutup lak user nge klik liane
window.onclick = function(event) {
    const popup = document.getElementById("loginPopup");
    if (event.target == popup) {
        closePopup();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const profileContainer = document.querySelector('.profile-container');
    profileContainer.classList.add('fade-in'); 
});