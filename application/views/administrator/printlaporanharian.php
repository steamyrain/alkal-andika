<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Report E-Ceklist</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div style="text-align:center">
		<h4>Laporan Pemeriksaan Kendaraan dan Peralatan</h4>
		<h4>Dinas Bina Marga Provinsi Dki Jakarta</h4>
		<hr>

	</div>
	<div style="text-align:left">
		<?php foreach ($laphar as $v): ?><?php endforeach ?>
		
		<ul>
		<li>Tanggal : <?= $v->tanggal; ?> </li> 
		<li> Jam : <?= $v->waktu; ?> </li>
		<li>Alat / Kendaraan : <?= $v->kendaraan; ?></li>
		<li>No Identitas : <?= $v->serial; ?></li>
		</ul>	
		  <!--<table border="1" align="center">-->
    <!--    <tr>-->
    <!--        <td>Tanggal </td>-->
    <!--        <td> <?= $v->tanggal; ?></td>-->
    <!--    </tr>-->
    <!--    <tr>-->
    <!--        <td>Jam </td>-->
    <!--        <td> <?= $v->waktu; ?></td>-->
    <!--    </tr>-->
    <!--    <tr>-->
    <!--        <td>Kendaraan/Peralatan </td>-->
    <!--        <td> <?= $v->kendaraan; ?></td>-->
    <!--    </tr>-->
    <!--      <tr>-->
    <!--        <td>No Indentitas </td>-->
    <!--        <td> <?= $v->serial; ?></td>-->
    <!--    </tr>-->
    <!--</table>-->


		
		
		<!--<p>Tanggal : <?= $v->tanggal; ?></p>-->
		<!--<p>Alat / Kendaraan : <?= $v->kendaraan; ?></p>-->
		<!--<p>No Identitas : <?= $v->serial; ?></p>-->
	</div>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center" rowspan="2">No</th>
				<th class="text-center" rowspan="2">Nama Kategori</th>
				<th class="text-center" rowspan="2">Item Ceklist</th>
				<th class="text-center" colspan="2">Kondisi</th>
				<th class="text-center" rowspan="2">Keterangan</th>
			</tr>

			<tr>
				<th class="text-center">Baik</th>
				<th class="text-center">Tidak</th>
			</tr>
		</thead>
		<tbody>
			<?php $no =1;foreach ($laphar as $value): ?>
			<tr>
				<td scope="row"><?= $no++ ?></td>
				<td><?= $value->nama_category; ?></td>
				<td><?= $value->nama_item; ?></td>
				<?php if ($value->kondisi == 'baik'): ?>
					<td style="text-align: center;"><span><i class="fa fa-check" aria-hidden="true"></i></span></td>
					<td></td>
				<?php else: ?>
					<td></td>
					<td style="text-align: center;"><span><i class="fa fa-check" aria-hidden="true"></i></span></td>
				<?php endif ?>
				<td><?= $value->keterangan; ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	</table>

	<div style="text-align:right;">
		<p>Jakarta, <?= date("Y-m-d"); ?></p>
		<p >Pemeriksaan oleh : <?= $value->nama_mekanik ?> </p>
		<p>------------------------------------------</p>
		<!--<p><img src="<?= base_url('assets/img/ac.png'); ?>" style="width: 70px;height: 70px;"></p>-->
		<!--<p><?= $value->nama_mekanik ?></p>-->
	</div>

</body>
</html>