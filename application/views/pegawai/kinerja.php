<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Kinerja PJLP
    </div>

    <?php 
        echo $this->session->flashdata('pesan');
    ?>

    <?php 
        echo anchor(
            base_url('pegawai/kinerja/input_form'),
            '<button class="btn btn-sm btn-primary mb-3">
                <i class="fas fa-plus fa-sm"></i> 
                Tambah Data
            </button>'
        ) 
    ?>

    <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="text-align: center">Tanggal Kinerja</th>
                <th style="text-align: center">Bidang</th>
                <th style="text-align: center" colspan="2">Waktu</th>
                <th style="text-align: center">Kegiatan</th>
                <th style="text-align: center">Deskripsi Kegiatan</th>
                <th style="text-align: center">Status Validasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach((array) $kinerja as $k) : ?>
            <tr>
                <td style="text-align: center"><?php echo $k->job_date ?></td>
                <td style="text-align: center"><?php echo $k->job_rolename ?></td>
                <td style="text-align: center"><?php echo $k->job_start ?></td>
                <td style="text-align: center"><?php echo $k->job_end ?></td>
                <td style="text-align: center"><?php echo $k->job ?></td>
                <td style="text-align: center"><?php echo $k->job_desc ?></td>
                <td style="text-align: center"><?php echo $k->valid_status ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
