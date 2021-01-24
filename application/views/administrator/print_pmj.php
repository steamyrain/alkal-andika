<!DOCTYPE Html>
<html>
<head>
	<title>Coba</title>
	<style>
	h5 {text-align: center;}
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table,th,td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h5>KINERJA PJLP BIDANG PETUGAS PEMELIHARAAN JALAN DAN JEMBATAN</h5>
    <h5>UNIT PERALATAN DAN PERBEKALAN DINAS BINA MARGA PROVINSI DKI JAKARTA</h5>
    <p>Nama     :</p>
    <p>Jabatan  :</p>
    <p>Bulan    :</p>
		<table>
		<tr>
			<th>Tanggal</th>
			<th colspan="2">Jam Kerja</th>
			<th>Uraian Kegiatan</th>
			<th>lokasi</th>
			<th>Keterangan</th>
		</tr>

		<?php
		$no= 1;
		foreach ($pmj as $k): ?>
		<tr>
			<td><?php echo $k->tanggal ?></td>
			<td><?php echo $k->waktu ?></td>
			<td><?php echo $k->pulang ?></td>
			<td><?php echo $k->kegiatan ?></td>
			<td><?php echo $k->lokasi ?></td>
			<td></td>
		</tr>

	<?php endforeach ?>
	</table>

	<script type="text/javascript">
		window.print();
	</script>

</body>
<footer>
    
</footer>
</html>