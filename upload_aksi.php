<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['file']['name']) ;
move_uploaded_file($_FILES['file']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['file']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$id_pengguna     = $data->val($i, 1);
	$id_siswa   = $data->val($i, 2);
	$nama_siswa  = $data->val($i, 3);
	$tempat_lahir  = $data->val($i, 4);
	$tanggal_lahir  = $data->val($i, 5);
	$nisn  = $data->val($i, 6);
	$npsn  = $data->val($i, 7);
	$npun  = $data->val($i, 8);
	$program_studi  = $data->val($i, 9);
	$kopetensi  = $data->val($i, 10);
	$sekolah_asal  = $data->val($i, 11);
	$file2  = $data->val($i, 12);
	$foto2  = $data->val($i, 13);

	$foto = $foto2.'.jpg';
	$file = $file2.'.pdf';

	if($id_pengguna != "" && $id_siswa != "" && $nama_siswa != ""){
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi,"INSERT INTO `siswa` (`id_pengguna`, `id_siswa`, `nama_siswa`, `tempat_lahir`, `tanggal_lahir`, `nisn`, `npsn`, `npun`, `program_studi`, `kopetensi`, `sekolah_asal`, `file`, `foto`) VALUES ('$id_pengguna', 'id_siswa', '$nama_siswa', '$tempat_lahir', '$tanggal_lahir', '$nisn', '$npsn', '$npun', '$program_studi', '$kopetensi', '$sekolah_asal', '$file', '$foto');");

		mysqli_query($koneksi,"INSERT INTO `pengguna` (`id_pengguna`, `kode_pendaftar`, `username`, `password`, `level`, `nama_pengguna`, `foto_pengguna`, `terakhir_login`, `status_login`) VALUES ('$id_pengguna', NULL, '$nisn', '$nisn', 'Siswa', '$nama_siswa', '$foto', NULL, 'Offline');");
		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['file']['name']);

// alihkan halaman ke index.php
header("location:index.php?berhasil=$berhasil");
?>