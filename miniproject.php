<?php
$data = null;
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email = trim($_POST["email"] ?? "");

    if ($nama === "") $error[] = "Nama wajib diisi.";
    if ($nim === "") $error[] = "NIM wajib diisi.";
    if ($prodi === "") $error[] = "Program studi wajib diisi.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }
    if (
        !ctype_digit((string)$semesterInput) ||
        (int)$semesterInput < 1 ||
        (int)$semesterInput > 14
    ) {
        $error[] = "Semester harus berupa angka 1–14.";
    }

    if (!$error) {
        $data = compact("nama", "nim", "prodi", "email");
        $data["semester"] = (int)$semesterInput;
    }
}

$old = $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST : [];
$escape = static function ($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
};
?>

<h1>Form Data Mahasiswa</h1>
<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= $escape($old["nama"] ?? "") ?>" required>
    </div>
    <div>
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" value="<?= $escape($old["nim"] ?? "") ?>" required>
    </div>
    <div>
        <label for="prodi">Program Studi</label>
        <input type="text" id="prodi" name="prodi" value="<?= $escape($old["prodi"] ?? "") ?>" required>
    </div>
    <div>
        <label for="semester">Semester (1–14)</label>
        <input type="number" id="semester" name="semester" min="1" max="14" step="1" value="<?= $escape($old["semester"] ?? "") ?>" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $escape($old["email"] ?? "") ?>" required>
    </div>
    <button type="submit">Kirim</button>
</form>

<?php if ($error): ?>
    <h2>Terjadi kesalahan</h2>
    <ul>
        <?php foreach ($error as $message): ?>
            <li><?= $escape($message) ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($data !== null): ?>
    <h2>Ringkasan Data Mahasiswa</h2>
    <ul>
        <li>Nama: <?= $escape($data["nama"]) ?></li>
        <li>NIM: <?= $escape($data["nim"]) ?></li>
        <li>Program Studi: <?= $escape($data["prodi"]) ?></li>
        <li>Semester: <?= $escape($data["semester"]) ?></li>
        <li>Email: <?= $escape($data["email"]) ?></li>
    </ul>
<?php endif; ?>