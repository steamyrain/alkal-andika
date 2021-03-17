<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Validasi Kinerja PJLP 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <div style="overflow-x: auto;">
        <table id="data-tabel" class="table table-bordered table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Tanggal Input</th>
                    <th style="text-align: center;">Tanggal Kinerja</th>
                    <th style="text-align: center">Bidang</th>
                    <th style="text-align: center;">Waktu Awal</th>
                    <th style="text-align: center;">Waktu Akhir</th>
                    <th style="text-align: center;">Kegiatan</th>
                    <th style="text-align: center;">Deskripsi Kegiatan</th>
                    <th style="text-align: center;">Status Validasi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($kinerja as $k) : ?>
                <tr>
                    <td><?php echo $k->emp_name; ?></td>
                    <td><?php echo $k->created_at; ?></td>
                    <td><?php echo $k->job_date; ?></td>
                    <td><?php echo $k->job_rolename; ?></td>
                    <td><?php echo $k->job_start; ?></td>
                    <td><?php echo $k->job_end; ?></td>
                    <td><?php echo $k->job; ?></td>
                    <td><?php echo $k->job_desc; ?></td>
                    <td><?php echo $k->valid_status; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/JavaScript">
    $(document).ready(function() 
    {
        // initialize data table & its necessary config
        var table = $("#data-tabel").DataTable({
            dom: "Blfrtip",
            select: true,
            buttons: [
                {
                    text: 'Select all',
                    action: function() {
                        table.rows().select();
                    }
                },
                {
                    text: 'Select none',
                    action: function() {
                        table.rows().deselect();
                    }
                },
            ],
        });

        // append data table's button container for button collection
        table
        .buttons()
        .container()
        .appendTo($(".col-md-6:eq(0)", table.table().container()));
    });
</script>
