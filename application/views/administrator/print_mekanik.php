<!DOCTYPE Html>
<html>
<head>
	<title></title>
</head>
<body>

	<table>
		<tr>
			<th>Tanggal</th>
			<th>No</th>
			<th>Waktu</th>
			<th>Nama</th>
			<th>Bidang</th>
			<th>Kegiatan</th>
			<th>lokasi</th>
			<th>Dokumentasi</th>
		</tr>

		<?php
		$no= 1;
		foreach ($mekanik as $k): ?>
		<tr>
			<td><?php echo $k->tanggal ?></td>
			<td><?php echo $no++ ?></td>
			<td><?php echo $k->waktu ?></td>
			<td><?php echo $k->nama ?></td>
			<td><?php echo $k->bidang ?></td>
			<td><?php echo $k->kegiatan ?></td>
			<td><?php echo $k->lokasi ?></td>
			<td><?php echo $k->dokumentasi ?>
            </td>
		</tr>

	<?php endforeach ?>
	</table>

	<script type="text/javascript">
		window.print();
	</script>

</body>
</html>