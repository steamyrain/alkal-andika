<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Perenanaan</title>
	
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #fff;
            color: black;
        }

    </style>
</head>


<body>
	<div style="text-align:center">
		<?php foreach ($laphar as $v): ?><?php endforeach ?>
		<h3>Perencanaan Kegiatan Prakerja Tanggal :  <?= date('d F Y', strtotime( $v->tanggal));?> </h3>

	</div>
	<table border="1">
		<thead>
			<tr>
				<th class="text-center" rowspan="2">No</th>
		        <th class="text-center" colspan="5" style="background: red; color: #fff">Perencanaan</th>
		      
			</tr>

			<tr>
				<th class="text-center">Lokasi</th>
		        <th class="text-center">Alat Kendaraan</th>
		        <th class="text-center">No Indentitas</th>
		        <th class="text-center">Pengguna</th>
		        <th class="text-center">Perencanaan BBM</th>
						
			</tr>
		</thead>
		<tbody>
			<?php $no =1; foreach ($laphar as $value): ?>
			<tr>
				<td scope="row"><?= $no++ ?></td>
				<td><?= $value->lokasi; ?></td>
				<td><?= $value->kendaraan; ?></td>
				<td><?= $value->serial; ?></td>
				<td><?= $value->operator; ?></td>
				<td><?= $value->pr_bbm; ?></td>
			</tr>
		<?php $no; endforeach; ?>
	</tbody>
	</table>
</body>
</html>