<?php
$errorMsg = '';
$conn = new mysqli("localhost", "root", "", "cv_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? '');
    $nama = trim($_POST["nama"] ?? '');
    $komentar = trim($_POST["komentar"] ?? '');
    if (empty($email) || empty($nama) || empty($komentar)) {
        $errorMsg = "Semua kolom (email, nama, komentar) wajib diisi!";
    } else {
        $email = $conn->real_escape_string($email);
        $nama = $conn->real_escape_string($nama);
        $komentar = $conn->real_escape_string($komentar);
        $sql = "INSERT INTO komentar (email, nama, komentar) VALUES ('$email', '$nama', '$komentar')";
        $conn->query($sql);
        header("Location: " . strtok($_SERVER["REQUEST_URI"], "?") . "#comment-section");
        $conn->close();
        exit();
    }
}
$result = $conn->query("SELECT email, nama, komentar, tanggal FROM komentar ORDER BY id DESC");
$comments = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mochamad Adam Miftah Faridl</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./styles/main.css">
        <link rel="stylesheet" href="./styles/theme-switcher.css">
    </head>
    <body>
        <div id="container--main">

            <section id="wrapper--hero" class="section--page">
                <img id="profile-pic" src="./assets/images/profile_pic.png">

                <div>
                    <h1 id="user-name">Mochamad Adam Miftah Faridl</h1>
                    <p id="bio">Mahasiswa Sistem Informasi di Universitas Ma'soem yang berfokus di bidang cybersecurity, dengan minat pada pengujian keamanan sistem, analisis kerentanan, dan perlindungan jaringan.</p>
                    <p id="email">👉 adamisneckdeep@gmail.com</p>
                </div>  
            </section>

            <section class="section--page">
        
<div id="socials--list">
    <a href="https://www.youtube.com/@thermality_win" target="_blank">Youtube</a>
    <a href="https://www.linkedin.com/in/adamisneckdeep/" target="_blank">Linkedin</a>
    <a href="https://github.com/pincode8485" target="_blank">Github</a>
    <a href="produk.php" target="_blank">Produk</a>
</div>

            </section>

            <section class="section--page">
                <h2>🛠️ Keahlian & Kualifikasi</h2>
                <ul id="qualifications--list">
                    <li>✔️ Pengujian penetrasi (manual & berbasis tools)</li>
                    <li>✔️ Analisis kerentanan sistem & aplikasi</li>
                    <li>✔️ Pemahaman dasar rekayasa balik & malware</li>
                    <li>✔️ Konfigurasi firewall, IDS/IPS</li>
                    <li>✔️ Peserta aktif Bug Bounty (tingkat pemula-menengah)</li>                                        
                </ul>
            </section>

            <section class="section--page">
                <h2>Tech stack</h2>

                <div id="wrapper--techstack__items">
                    <div class="card--techstack"><span>Python, JavaScript, NodeJS, Lua</span></div>
                    <div class="card--techstack"><span>Django, Express, FastAPI, Inngest, Cloudinary, Clerk</span></div>
                    <div class="card--techstack"><span>React, Next JS</span></div>
                    <div class="card--techstack"><span>Postgres, MongoDB, MySQL</span></div>
                </div>
            </section>

            <section id="work-history-wrapper" class="section--page">
                <h2>Work History</h2>

                <div class="card--work-history">
                    <strong>🚧 MAGANG CYBERSECURITY | Universitas Padjajaran Jatinangor</strong>
                    <p>3/2023 - 7/2023</p>
                    <p><strong>[Divisi IT]</strong> saya terlibat langsung dalam berbagai aktivitas yang berkaitan dengan pengamanan sistem informasi kampus. Fokus utama kegiatan magang adalah analisis keamanan jaringan, pengujian terhadap kerentanan situs internal, serta pemberian rekomendasi terhadap risiko keamanan yang ditemukan.</p>
                    <strong>[Tanggung Jawab dan Pencapaian]</strong>
                    <ul>
                        <li>Melakukan pengujian keamanan pada sistem informasi akademik dan web fakultas.</li>
                        <li>Mengidentifikasi potensi kerentanan seperti XSS dan SQL Injection.</li>
                        <li>Membantu tim IT dalam memperkuat sistem autentikasi dan manajemen akses.</li>
                        <li>Menyusun laporan hasil pengujian dan memberikan solusi mitigasi teknis.</li>
                    </ul>
                </div>

                <div class="line-break"></div>

                <div class="card--work-history">
                    <strong>🚧 KEAMANAN SERVER | POLYGUNS – Roblox </strong>
                    <p>11/2021 - 1/2023</p>
                    <p>Sebagai kontributor backend pada game Phantom Forces di platform Roblox, saya berfokus pada peningkatan keamanan sistem server dan validasi sisi backend untuk mencegah eksploitasi oleh pemain.</p>
                    <ul>
                        <li>Mengembangkan dan memperkuat sistem validasi data server-side untuk mencegah penggunaan exploit tools.</li>
                        <li>Menyusun logika server untuk menghindari client-side trust, seperti anti-speedhack, anti-teleport, dan stat validation.</li>
                        <li>Berkolaborasi dengan komunitas pengembang untuk mempatch celah keamanan dan menguji keandalannya melalui simulasi exploit.</li>
                    </ul>
                </div>

                <div class="line-break"></div>

                <div class="card--work-history">
                    <strong>🚧 INDEPENDENT BUG BOUNTY HUNTER | Roblox</strong>
                    <p>2/2024 - Present</p>
                    <p>Saya melakukan pengujian keamanan terhadap beberapa game di platform Roblox secara independen dan bertanggung jawab, dengan pendekatan seperti bug bounty — bertujuan untuk menemukan serta melaporkan celah keamanan kepada developer game secara etis.</p>
                    <ul>
                        <li>Melakukan pengujian client-side dan server-side pada game Roblox, fokus pada sistem ekonomi, inventory, dan teleport exploit.</li>
                        <li>Menemukan celah remote event abuse dan stat manipulation pada game multiplayer tertentu.</li>
                        <li>Mematuhi etika pengujian white-hat dan tidak mengeksploitasi bug di luar pengujian terbatas.</li>
                    </ul>
                </div>
            </section>

            <section class="section--page">
                <h2>Projects & Accomplishments</h2>

                <div class="card--project">
                    <a href="https://www.unpad.ac.id/"><span>🏆 </span>Penguji Keamanan Sistem Informasi Kampus (2023)</a>
                </div>

                <div class="card--project">
                    <a href="https://www.roblox.com/games/388599755/POLYGUNS" ><span>🏆 </span>Developer Security - Head Security pada platform game roblox POLYGUNS (2021)</a>
                </div>

                <div class="card--project">
                    <a href="https://www.roblox.com/users/111507118/profile" ><span>🏆 </span>Independent Bounty Hunter dalam platform game Roblox (2024)</a>
                </div>

                <div class="card--project">
                    <a href="https://github.com/pincode8485/winstore8485"><span>🏆 </span>Website E-Commerce Full Stack Winstore8485 (2025)</a>
                </div>

            </section>

<section class="section--page" id="comment-section">
    <h2>Komentar</h2>
        <div class="line-break"></div>
    <?php if (!empty($errorMsg)): ?>
        <div style="color:red;margin-bottom:10px;"><?= $errorMsg ?></div>
    <?php endif; ?>
    <form method="post" action="#comment-section" class="comment-form">
        <input type="email" name="email" placeholder="Email Anda" required>
        <input type="text" name="nama" placeholder="Nama Anda" required>
        <textarea name="komentar" placeholder="Tulis komentar..." required rows="4"></textarea>
        <button type="submit">Kirim</button>
    </form>
    <div id="comments-list" style="margin-top:20px;">
        <?php if (count($comments) > 0): ?>
            <?php foreach($comments as $row): ?>
                <div class="comment-item">
                    <b><?= htmlspecialchars($row["nama"]) ?></b>
                    <span style="color:#888;font-size:12px;"><?= htmlspecialchars($row["email"]) ?></span>
                    <span style="color:#888;font-size:12px;">(<?= $row["tanggal"] ?>)</span><br>
                    <?= nl2br(htmlspecialchars($row["komentar"])) ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <i>Belum ada komentar.</i>
        <?php endif; ?>
    </div>
</section>

        <div id="theme-switcher">
            <div class="theme" id="theme-light" data-theme="light"></div>
            <div class="theme" id="theme-dark" data-theme="dark"></div>
        </div>

        

    <script src="js/theme-switcher.js"></script>

<script src="https://formspree.io/js/formbutton-v1.min.js" defer></script>

<script>
  window.formbutton=window.formbutton||function(){(formbutton.q=formbutton.q||[]).push(arguments)};

formbutton("create", {
  action: "https://formspree.io/f/xvgrrvea",
  title: "Kirim Pesan ke Adam",
  fields: [
    { 
      type: "email", 
      label: "Email Anda", 
      name: "email",
      required: true,
      placeholder: "contoh@email.com"
    },
    {
      type: "text",
      label: "Nama Lengkap",
      name: "name",
      required: true,
      placeholder: "Nama Anda"
    },
    {
      type: "textarea",
      label: "Pesan",
      name: "message",
      placeholder: "Tulis pesan Anda di sini...",
    },
    { type: "submit", label: "Kirim" }      
  ],
  styles: {
    title: {
      backgroundColor: "#444"
    },
    button: {
      backgroundColor: "#444"
    }
  }
});
</script>
</body>
</html>

