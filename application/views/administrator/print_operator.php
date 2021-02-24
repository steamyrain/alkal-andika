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
        bottomleft {
  position: absolute;
  text-align: center;
  bottom: 200px;
  left: 16px;
  width: 300px;
  font-size: 15px;
}
    bottom1 {
  position: absolute;
  text-align: center;
  bottom: 175px;
  left: 16px;
  width: 300px;
  font-size: 15px;
}
bottom2 {
  position: absolute;
  text-align: center;
  bottom: 150px;
  left: 16px;
  width: 300px;
  font-size: 15px;
}
bottom3 {
  position: absolute;
  text-align: center;
  bottom: 80px;
  left: 16px;
  width: 300px;
  font-size: 15px;
}
bottom4 {
  position: absolute;
  text-align: center;
  bottom: 60px;
  left: 16px;
  width: 300px;
  font-size: 15px;
}
center {
  position: absolute;
  top: 70%;
  width: 100%;
  text-align: center;
  font-size: 15px;
}
center1 {
  position: absolute;
  top: 73%;
  width: 100%;
  text-align: center;
  font-size: 15px;
}
center2 {
  position: absolute;
  top: 87%;
  width: 100%;
  text-align: center;
  font-size: 15px;
}
center3 {
  position: absolute;
  top: 90%;
  width: 100%;
  text-align: center;
  font-size: 15px;
}
bottomright {
  position: absolute;
  text-align: center;
  bottom: 200px;
  right: 16px;
  width: 300px;
  font-size: 15px;
}
bottomright1 {
  position: absolute;
  text-align: center;
  bottom: 80px;
  right: 16px;
  width: 300px;
  font-size: 15px;
}
    </style>
</head>
<body>
    <h5>KINERJA PJLP BIDANG PENGEMUDI KENDARAAN OPERASIONAL LAPANGAN</h5>
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
		foreach ($operator as $k): ?>
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
<bottomleft>Mengetahui</bottomleft>
<bottom1>Kepala Unit Alkal Dinas Bina Marga</bottom1>
<bottom2>Provinsi DKI Jakarta</bottom2>
<bottom3>Taufik Hendayana</bottom3>
<bottom4>NIP. 19750710199903100</bottom4>
<center>Kepala Sub Bagian Tata Usaha Unit Alkal</center>
<center1>Dinas Bina Marga Provinsi DKI Jakarta</center1>
<center2>Sidiq Bonatenra K</center2>
<center3>NIP. 198110102010011030</center3>
<bottomright>Jakarta,             2021</bottomright>
<bottomright1>Nama</bottomright1>
</body>
</html>