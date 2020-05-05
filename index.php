<!DOCTYPE html>
<html>
<head>
	<title>Import Excel Ke MySQL dengan PHP</title>
</head>
<body>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}

		p{
			color: green;
		}
	</style>
	<h2>IMPORT EXCEL KE MYSQL DENGAN PHP</h2>

	<?php 
	if(isset($_GET['berhasil'])){
		echo "<p>".$_GET['berhasil']." Data berhasil di import.</p>";
	}
	?>

	<a href="upload.php">IMPORT DATA</a>
	<table border="1">
		<tr>
                  <th>No</th>
                  <th>id_pengguna</th>
                  <th>id_siswa</th>
                  <th>nama_siswa</th>
                  <th>tempat_lahir</th>
                  <th>tanggal_lahir</th>
                  <th>nisn</th>
                  <th>npsn</th>
                  <th>npun</th>
                  <th>program_studi</th>
                  <th>kopetensi</th>
                  <th>sekolah_asal</th>
                  <th>file</th>
                  <th>foto</th>
            </tr>
		<?php 
      		include 'koneksi.php';
      		$no=1;
      		$sql = mysqli_query($koneksi,"SELECT * FROM `siswa` ORDER BY `id_siswa` DESC");
      		while($data = mysqli_fetch_array($sql)){
		?>
			<tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['id_pengguna'] ?></td>
                  <td><?php echo $data['id_siswa'] ?></td>
                  <td><?php echo $data['nama_siswa'] ?></td>
                  <td><?php echo $data['tempat_lahir'] ?></td>
                  <td><?php echo $data['tanggal_lahir'] ?></td>
                  <td><?php echo $data['nisn'] ?></td>
                  <td><?php echo $data['npsn'] ?></td>
                  <td><?php echo $data['npun'] ?></td>
                  <td><?php echo $data['program_studi'] ?></td>
                  <td><?php echo $data['kopetensi'] ?></td>
                  <td><?php echo $data['sekolah_asal'] ?></td>
                  <td><?php echo $data['file'] ?></td>
                  <td><?php echo $data['foto'] ?></td>          
                </tr>
		<?php }?>
	</table>
</body>
</html>