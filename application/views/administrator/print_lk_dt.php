<!DOCTYPE Html>
<html>
<head>
	<title></title>
    <style>
        table {
            border-collapse: collapse;
        }
        table,th,td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

		<table> 
		<tr>
			<th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Lokasi Kerja</th>
            <th>Nomer Polisi</th>
            <th>KM Awal</th>
            <th>KM Akhir</th>
            <th>KM Total</th>
            <th>BBM</th>
		</tr>

		<?php
		$no= 1;
		foreach ($laporan as $l): ?>
		<tr>
			<td><?php echo $no++ ?></td>
            <td><?php echo $l->created_at; ?></td>
            <td><?php echo $l->username; ?></td>
            <td><?php echo $l->project_location; ?></td>
            <td><?php echo $l->plate_number; ?></td>
            <td><?php echo $l->km_onStart; ?></td>
            <td><?php echo $l->km_onFinish; ?></td>
            <td><?php echo $l->km_total; ?></td>
            <td><?php echo $l->gasoline; ?></td>
		</tr>

	<?php endforeach ?>
	</table>

	<script type="text/javascript">
		window.print();
	</script>

</body>
</html>
