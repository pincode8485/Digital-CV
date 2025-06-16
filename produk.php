
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jasa & Layanan Cybersecurity - Mochamad Adam Miftah Faridl</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/theme-switcher.css">
</head>
<body>
    <div id="container--main">

        <section id="wrapper--hero" class="section--page">
            <img id="profile-pic" src="./assets/images/profile_pic.png">
            <div>
                <h1 id="user-name">Jasa & Layanan Cybersecurity</h1>
                <p id="bio">Berpengalaman dalam pengujian keamanan sistem, analisis kerentanan, dan perlindungan jaringan. Siap membantu Anda mengamankan aplikasi, website, maupun infrastruktur digital.</p>
                <a href="index.php" style="color:gray;text-decoration:underline;">← Kembali ke CV</a>
            </div>
        </section>

        <section class="section--page">
            <h2>🛡️ Layanan yang Ditawarkan</h2>
            
<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "cv_db");

// Tambah produk
if (isset($_POST['tambah'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }

    $stmt = $conn->prepare("INSERT INTO produk (image, title, description, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $image, $title, $description, $price);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Hapus produk
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM produk WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Ambil data produk
$result = $conn->query("SELECT * FROM produk ORDER BY id DESC");
?>

<!-- Form tambah produk -->
<form method="post" enctype="multipart/form-data" class="produk-form">
    <h3>Tambah Produk</h3>
    <input type="text" name="title" placeholder="Judul Produk" required class="produk-input"><br>
    <textarea name="description" placeholder="Deskripsi Produk" required class="produk-input"></textarea><br>
    <input type="number" name="price" placeholder="Harga Produk" step="0.01" required class="produk-input"><br>
    <input type="file" name="image" accept="image/*" required class="produk-input"><br>
    <button type="submit" name="tambah" class="produk-btn">Tambah Produk</button>
</form>

<h3 style="margin-bottom:16px;">Produk :</h3>

<!-- Card/Grid Produk -->
<div style="display: flex; flex-wrap: wrap; gap: 20px;">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="produk-card">
        <?php if($row['image']): ?>
            <img src="<?php echo htmlspecialchars($row['image']); ?>" class="produk-img">
        <?php endif; ?>
        <h4 class="produk-title"><?php echo htmlspecialchars($row['title']); ?></h4>
        <div class="produk-desc"><?php echo htmlspecialchars($row['description']); ?></div>
        <div class="produk-price">Rp <?php echo number_format($row['price'],0,',','.'); ?></div>
        <form method="post" class="produk-hapus-form">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="hapus" onclick="return confirm('Hapus produk ini?')" class="produk-hapus-btn">Hapus</button>
        </form>
    </div>
<?php endwhile; ?>
</div>
<?php $conn->close(); ?>

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
  title: "Hubungi saya!",
  fields: [
    { 
      type: "email", 
      label: "Email:", 
      name: "email",
      required: true,
      placeholder: "your@email.com"
    },
    {
      type: "text",
      label: "Nama:",
      name: "name",
      required: true,
      placeholder: "Nama Anda"
    },
    {
      type: "textarea",
      label: "Pesan:",
      name: "message",
      placeholder: "Apa yang ingin Anda sampaikan?",
    },
    { type: "submit" }      
  ],
  styles: {
    title: {
      backgroundColor: "gray"
    },
    button: {
      backgroundColor: "gray"
    }
  }
});
</script>

            
</body>
</html>