<?php
function hitungDiskon($harga, $persen) {
$potongan = $harga * ($persen / 100);
return $harga - $potongan;
}

function hitungLuasPersegiPanjang($panjang, $lebar) {
return $panjang * $lebar;
}

$hargaAkhir = hitungDiskon(150000, 10);
echo "Harga setelah diskon: Rp" . number_format($hargaAkhir, 0, ",", ".");

$luas = hitungLuasPersegiPanjang(10, 5);
echo "<br>Luas persegi panjang: " . $luas;
?>