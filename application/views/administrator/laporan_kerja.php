<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Laporan Kerja Alat Berat
    </div>
    <?php 
        echo anchor(
            base_url('administrator/laporan/input'),
            '<button class="btn btn-sm btn-primary mb-3">
                <i class="fas fa-plus fa-sm"></i> 
                Tambah Data
            </button>'
        ) 
    ?>

    <?php
    echo anchor(
        '',
        '<button class="btn btn-sm btn-info mb-3">
            <i class="fa fa-print"></i> 
            Print
        </button>'
    ) 
    ?>

    <div style="overflow-x:auto;">
    <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">Aksi</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Lokasi Kerja</th>
            <th class="text-center">Nomer Polisi</th>
            <th class="text-center">Nomer Seri</th>
            <th class="text-center">KM Awal</th>
            <th class="text-center">KM Akhir</th>
            <th class="text-center">KM Total</th>
            <th class="text-center">BBM</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($laporan as $l):?>
    <tr>
        <td>
            <div 
                class="aksi" 
                style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;"
            >
                <form 
                    style="display: none;" 
                    id="form-hapus-<?php echo $l->id; ?>" 
                    method="post" 
                    action="<?php echo base_URL('administrator/laporan/hapus_aksi')?>"
                >
                    <input type="text" name="id" value="<?php echo $l->id; ?>">
                </form>
                <a 
                onclick="document.getElementById('form-hapus-<?php echo $l->id; ?>').submit()"
                >
                    <div 
                        class="btn btn-danger btn-sm" 
                        onclick="javascript: return confirm('Yakin Hapus?')"
                    >
                        <i class="fa fa-trash"></i>
                    </div>
                </a>
                <a 
                    href="<?php echo base_URL('administrator/laporan/edit/'.$l->id); ?>"
                >
                    <div class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </div>
                </a>
            </div>
        </td>
        <td class="text-center"><?php echo $l->created_at; ?></td>
        <td class="text-center"><?php echo $l->username; ?></td>
        <td class="text-center"><?php echo $l->project_location; ?></td>
        <td class="text-center"><?php echo $l->plate_number; ?></td>
        <td class="text-center"><?php echo $l->serial_number; ?></td>
        <td class="text-center"><?php echo $l->km_onStart; ?></td>
        <td class="text-center"><?php echo $l->km_onFinish; ?></td>
        <td class="text-center"><?php echo $l->km_total; ?></td>
        <td class="text-center"><?php echo $l->gasoline; ?></td>
    </tr>
    <?php endforeach;?>
        </tbody>
  </table>
</div>
</div>
