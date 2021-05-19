<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Riwayat Servis Alat Berat 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <?php 
        echo anchor(
        'administrator/abservicehistory/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
        ) 
    ?>
    <div style="overflow-x: auto;">
        <table 
            id="data-tabel" 
            class="table table-bordered table-striped" 
            style="width:100%"
        >
            <thead>
                <tr>
                    <th style="text-align: center;">ab_id</th>
                    <th style="text-align: center;">service_id</th>
                    <th style="text-align: center;">subservice_id</th>
                    <th style="text-align: center;">Identitas Kendaraan</th>
                    <th style="text-align: center;">Tanggal Servis</th>
                    <th style="text-align: center;">Kategori Servis</th>
                    <th style="text-align: center;">Unit Servis</th>
                    <th style="text-align: center;">Harga unit</th>
                    <th style="text-align: center;">Jumlah Unit</th>
                    <th style="text-align: center;">Keterangan Servis</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script>

    let table;

    function getDTServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/api')."?dt_id=$dt_id"."&service_id=$service_id" ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    $(document).ready(function () {
        //getDTServiceHistories();
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
        });
        /*
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"dt_id","visible":false},
                    {"data":"service_id","visible":false},
                    {"data":"subservice_id","visible":false},
                    {"data":"plate_number"},
                    {"data":"service_date"},
                    {"data":"service_name"},
                    {"data":"subservice_name"},
                    {"data":"unit_price"},
                    {"data":"unit_total"},
                    {"data":"service_desc"}
            ]
        });
        */
    });
</script>
