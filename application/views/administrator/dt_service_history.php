<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Riwayat Servis Dump Truck 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <?php 
        echo anchor(
        'administrator/dtservicehistory/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
        ) 
    ?>
    <table 
        id="data-tabel" 
        class="table table-bordered table-striped" 
        style="width:100%"
    >
        <thead>
            <tr>
                <th style="text-align: center;">Nopol</th>
                <th style="text-align: center;">dt_id</th>
                <th style="text-align: center;">service_id</th>
                <th style="text-align: center;">Tanggal Servis</th>
                <th style="text-align: center;">Jenis Servis</th>
                <th style="text-align: center;">Keterangan Servis</th>
            </tr>
        </thead>
    </table>
</div>
<script>

    let table;

    function getDTServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/api') ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    $(document).ready(function () {
        getDTServiceHistories();
        table = $("#data-tabel").DataTable({
            dom: "Blfrtip",
            columns: [
                    {"data":"plate_number"},
                    {"data":"dt_id","visible":false},
                    {"data":"service_id","visible":false},
                    {"data":"service_date"},
                    {"data":"service_name"},
                    {"data":"serviced_by"}
            ]
        });
    });
</script>
