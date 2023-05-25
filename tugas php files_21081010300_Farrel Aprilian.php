<?php
// Fungsi untuk menyimpan data absensi ke file
function simpanAbsensi($data)
{
    $file = fopen("absensi.txt", "a"); // Membuka file dalam mode append

    // Menulis data absensi ke file
    fwrite($file, $data . PHP_EOL);

    fclose($file); // Menutup file
}

// Memeriksa apakah data absensi telah disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tanggal = date('Y-m-d');

    // Format data absensi yang akan disimpan
    $dataAbsensi = $nama . ',' . $tanggal;

    // Memanggil fungsi untuk menyimpan data absensi
    simpanAbsensi($dataAbsensi);
}

// Fungsi untuk membaca data absensi dari file
function bacaAbsensi()
{
    $file = fopen("absensi.txt", "r"); // Membuka file dalam mode read

    $absensi = array();

    // Membaca setiap baris data absensi
    while (!feof($file)) {
        $baris = fgets($file);
        $data = explode(',', $baris); // Memisahkan data dengan koma
        $absensi[] = array(
            'nama' => $data[0],
            'tanggal' => $data[1]
        );
    }

    fclose($file); // Menutup file

    return $absensi;
}

// Memanggil fungsi untuk membaca data absensi
$dataAbsensi = bacaAbsensi();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Absensi</title>
</head>

<body>
    <h1>Form Absensi</h1>

    <form method="post" action="">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <h2>Data Absensi:</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
        </tr>
        <?php foreach ($dataAbsensi as $absensi) : ?>
            <tr>
                <td><?php echo $absensi['nama']; ?></td>
                <td><?php echo $absensi['tanggal']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
