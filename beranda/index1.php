<?php
    session_start();
    include 'connect.php';

    $loggedInUser = isset($_SESSION['user']) ? $_SESSION['user']['username'] : null;
    $detailAcara = null;
    if (isset($_GET['id_acara'])) {
        $id_acara = intval($_GET['id_acara']);
        $detailQuery = "SELECT * FROM acara WHERE id_acara = $id_acara LIMIT 1;";
        $detailResult = mysqli_query($conn, $detailQuery);
        if ($detailResult && mysqli_num_rows($detailResult) > 0) {
            $detailAcara = mysqli_fetch_assoc($detailResult);
        }
    } 
    $query = "SELECT * FROM acara;";
    $sql = mysqli_query($conn, $query);
?>  

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Nusantara</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="hero">
        <div class="hero-content">
            <h2>Selamat Datang di My Nusantara</h2>
            <p class="p1">Jelajahi kekayaan budaya dari seluruh daerah di Indonesia</p>
        </div>
    </section>

    <main>
        <h3 style="font-size:37px;">Eksplorasi Budaya</h3>
        <p class="p">Dengan map di bawah ini!</p>
        <section class="map-container">
            <div id="map" alt="Peta Budaya" class="responsive-image"></div>
        </section>

        <section class="content-section" id="penjelasan">
            <h3 style="font-size:37px;">Budaya Indonesia</h3>
            <p>
                <b style="font-size:20px;">Budaya Indonesia</b> adalah sebuah sistem kompleks yang mencakup beragam aspek kehidupan, mulai dari adat istiadat, seni, bahasa, hingga kepercayaan masyarakat yang tersebar di seluruh Nusantara. Keberagaman budaya ini menjadi ciri khas Indonesia, mencerminkan sejarah panjang dan interaksi antara berbagai suku bangsa, pengaruh budaya asing, dan perkembangan lokal. <br>
                <br><strong style="font-size:20px;">Aspek-Aspek Budaya Indonesia:</strong> 
                <br><b>1. Adat Istiadat:</b>
                Setiap daerah memiliki adat istiadat yang khas, seperti upacara pernikahan, upacara kematian, dan ritual keagamaan. 
                <br><b>2. Seni dan Kesenian: </b>
                Seni tradisional Indonesia sangat beragam, mulai dari tarian daerah (Tari Saman, Tari Kecak, Tari Reog Ponorogo), alat musik tradisional (Angklung), hingga kerajinan tangan (batik, tenun ikat). 
                <br><b>3. Bahasa:</b>
                Indonesia memiliki lebih dari 700 bahasa daerah, masing-masing dengan ciri khas dan logat yang berbeda.
                <br><b>4. Pakaian Adat:</b>
                Pakaian adat setiap daerah memiliki makna dan filosofi tersendiri, seperti kebaya, baju bodo Bugis, dan pakaian adat Madura. 
                <br><b>5. Kuliner:</b>
                Indonesia kaya akan kuliner khas yang mencerminkan keberagaman budaya, seperti rendang, gudeg, pempek, dan papeda. 
                <br><b>6. Kepercayaan:</b>
                Masyarakat Indonesia memiliki berbagai kepercayaan, baik agama mayoritas (Islam, Kristen, Hindu, Budha) maupun kepercayaan tradisional (animisme, dinamisme).
            </p>
        </section>

        <div class="tab-container">
            <button class="tab-button active" data-tab="belanja">Belanja</button>
            <button class="tab-button" data-tab="acara">Event</button>
        </div>

        <div class="tab-content-container">
            <section class="shopping-section" id="belanja">
                <h3>Barang tradisional yang tersedia...</h3>

                <div class="item-container">
                    <?php
                    $barangQuery = "SELECT id_barang, nama_barang, gambar_barang, harga_barang FROM barang_tradisional";
                    $barangResult = mysqli_query($conn, $barangQuery);
                    if ($barangResult && mysqli_num_rows($barangResult) > 0) {
                        while ($barang = mysqli_fetch_assoc($barangResult)) {
                            echo '<div class="item-box">';
                            echo '<img src="/MY_NUSANTARA/admin/uploads/' . htmlspecialchars($barang["gambar_barang"]) . '" alt="' . htmlspecialchars($barang["nama_barang"]) . '" class="item-image">';
                            echo '<p class="item-title">' . htmlspecialchars($barang["nama_barang"]) . '</p>';
                            echo '<p class="item-price">Harga: Rp ' . number_format($barang["harga_barang"], 0, ",", ".") . '</p>';
                            echo '<button class="buy-button" onclick="addToCart(\'barang\', ' . $barang["id_barang"] . ')">Beli</button>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Tidak ada barang tersedia saat ini.</p>';
                    }
                    ?>
                </div>
            </section>

            <section class="event-section" id="acara" style="display:none;">
                
                <h3>Tiket acara kebudayaan yang tersedia...</h3> 
                <div class="event-cards-container">
                    <?php
                    if ($sql && mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            echo '<div class="event-card">';
                            if (!empty($row["gambar_acara"])) {
                                echo '<img src="/MY_NUSANTARA/admin/uploads/' . htmlspecialchars($row["gambar_acara"]) . '" alt="' . htmlspecialchars($row["nama_acara"]) . '" class="event-image">';
                            }
                            echo '<div class="event-content">';
                            echo '<h3 class="judulacara">' . htmlspecialchars($row["nama_acara"]) . '</h3>';
                            echo '<div class="event-details">';
                            echo '<div style="display: flex; align-items: center; margin-bottom: 6px;">
                                <img src="https://indonesiakaya.com/wp-content/themes/indonesiakaya-X2/images/svg/purple/Lokasi.svg" alt="Tempat" style="width:22px; height:20px; margin-right:8px;">
                                <span>' . htmlspecialchars($row["tempat_acara"]) . '</span>
                                </div>';
                            echo '<div style="display: flex; align-items: center; margin-bottom: 6px;">
                                <img src="https://indonesiakaya.com/wp-content/themes/indonesiakaya-X2/images/svg/purple/Harga.svg" alt="Harga" style="width:22px; height:20px; margin-right:8px;">
                                <span>Rp ' . number_format($row["harga"], 0, ",", ".") . '</span>
                                </div>';
                            echo '<div style="display: flex; align-items: center;">
                                <img src="https://indonesiakaya.com/wp-content/themes/indonesiakaya-X2/images/svg/purple/Tanggal.svg" alt="Tanggal" style="width:22px; height:20px; margin-right:8px;">
                                <span>' . htmlspecialchars($row["tanggal_acara"]) . '</span>
                                </div>';
                            echo '<a href="detail_acara.php?id_acara=' . urlencode($row["id_acara"]) . '" class="buy-button">Lihat Detail</a> ';
                            echo '<button class="buy-button" onclick="addToCart(\'acara\', ' . $row["id_acara"] . ')">Beli</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Tidak ada acara yang tersedia saat ini.</p>';
                    }
                    ?>
                </div>
            </section>
        </div>

        <br><br>
        <script>
            function addToCart(type, id) {
                fetch('keranjang.php?add_' + type + '=' + id)//gae nambah nak keranjang js
                    .then(response => {
                        if (response.ok) {
                            alert('Item berhasil ditambahkan ke keranjang.');
                        } else {
                            alert('Gagal menambahkan item ke keranjang.');
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan saat menambahkan item ke keranjang.');
                    });
            }

            //tab event ambek shoping
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('.tab-button');
                const shoppingSection = document.getElementById('belanja');
                const eventSection = document.getElementById('acara');

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');

                        if (button.dataset.tab === 'belanja') {
                            shoppingSection.style.display = 'block';
                            eventSection.style.display = 'none';
                        } else if (button.dataset.tab === 'acara') {
                            shoppingSection.style.display = 'none';
                            eventSection.style.display = 'block';
                        }
                    });
                });
            });
        </script>
    </main>
<?php include 'footer.php'; ?>
<script src="map.js"></script>
</body>
</html>