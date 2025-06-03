document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([-2.5489, 118.0149], 5); // Koordinat Indonesia

    // Tambah peta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Marker tujuan
    var markerJawaBarat = L.marker([-6.9175, 107.6191]).addTo(map);
    var markerJawaTengah = L.marker([-6.9939, 110.4203]).addTo(map);
    var markerJawaTimur = L.marker([-7.2504, 112.7688]).addTo(map);

    markerJawaBarat.bindPopup('<b>Jawa Barat</b><br><a href="interface.php?region=Jawa Barat">Lihat halaman Jawa Barat</a>');
    markerJawaTengah.bindPopup('<b>Jawa Tengah</b><br><a href="interface.php?region=Jawa Tengah">Lihat halaman Jawa Tengah</a>');
    markerJawaTimur.bindPopup('<b>Jawa Timur</b><br><a href="interface.php?region=Jawa Timur">Lihat halaman Jawa Timur</a>');
});
