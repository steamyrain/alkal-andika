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
    <?php 
        echo anchor(
        'administrator/abservicehistory/rekap',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-book fa-sm"></i> 
            Rekap Data
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
                    <th style="text-align: center;">plate_number</th>
                    <th style="text-align: center;">serial_number</th>
                    <th style="text-align: center;">Identitas Kendaraan</th>
                    <th style="text-align: center;">Kategori Kendaraan</th>
                    <th style="text-align: center;">Subkategori Kendaraan</th>
                    <th style="text-align: center;">Kategori Servis</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script>

    let table;

    function getABServiceHistories() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/alatberat/api') ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    $(document).ready(function () {
        getABServiceHistories();
        table = $("#data-tabel").DataTable({
            responsive: true,
            dom: "lfrtip",
            columns: [
                    {"data":"id","visible":false,"searchable":false},
                    {"data":"plate_number","visible":false,"searchable":false},
                    {"data":"serial_number","visible":false,"searchable":false},
                    {
                        "data":"",
                        "render": function(data,type,row){
                            if(row.plate_number)return row.plate_number;
                            return row.serial_number
                        }
                    },
                    {"data":"category"},
                    {"data":"sub_category"},
                    {
                        "data":"",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data,type,row){
                            return "<button class='btn btn-primary btn-sm'>Kategori</button>"
                        }
                    }
            ]
        });
        $("#data-tabel tbody").on('click','button',function(){
            const data = table.row($(this).parents('tr')).data();
            location.assign("<?php echo base_url('administrator/abservicehistory/selectcategory') ?>"+"?ab_id="+data["id"]);
        });
    });
</script>
