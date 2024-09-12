<?php

// Fungsi untuk menghitung rata-rata
function hitung_rata($array) {
    $jumlah = array_sum($array); // Menjumlahkan semua nilai dalam array
    $total = count($array); // Menghitung jumlah elemen dalam array
    return $jumlah / $total; // Mengembalikan nilai rata-rata
}

// Fungsi untuk menampilkan tabel data mahasiswa
function print_mhs($array_mhs) {
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata2</th></tr>";
    
    // Loop untuk menampilkan setiap mahasiswa
    foreach($array_mhs as $mhs) {
        $nama = $mhs['nama'];
        $nilai1 = $mhs['nilai1'];
        $nilai2 = $mhs['nilai2'];
        $nilai3 = $mhs['nilai3'];
        
        // Menghitung rata-rata nilai dengan memanggil fungsi hitung_rata
        $rata2 = hitung_rata([$nilai1, $nilai2, $nilai3]);
        
        // Menampilkan data mahasiswa dalam bentuk tabel
        echo "<tr>";
        echo "<td>$nama</td>";
        echo "<td>$nilai1</td>";
        echo "<td>$nilai2</td>";
        echo "<td>$nilai3</td>";
        echo "<td>$rata2</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

// Contoh data mahasiswa
$array_mhs = [
    ['nama' => 'Abdul', 'nilai1' => 89, 'nilai2' => 90, 'nilai3' => 54],
    ['nama' => 'Budi', 'nilai1' => 98, 'nilai2' => 65, 'nilai3' => 74],
    ['nama' => 'Nina', 'nilai1' => 67, 'nilai2' => 56, 'nilai3' => 84]
];

// Memanggil fungsi untuk menampilkan tabel
print_mhs($array_mhs);

?>
