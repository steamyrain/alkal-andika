<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Validasi Kinerja PJLP 
    </div>
    <?php echo $this->session->flashdata('pesan'); ?>
    <div style="overflow-x: auto;">
        <table id="data-tabel" class="table table-bordered table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center;">uid</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center">Bidang</th>
                    <th style="text-align: center">Detail</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/JavaScript">
    let table;
    function getData() {
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/validasi/list_pjlp') ?>',
            dataType: 'json',
            success: function (r){
                table.clear();
                table.rows.add(r).draw();
            }
        });
    }

    $(document).ready(function() 
    {
        getData();

        table = $("#data-tabel").DataTable({
            "dom": "Blfrtip",
            "responsive": true,
            "select": true,
            "columns": [
                    {"data":"pjlpUID","visible":false},
                    {"data":"pjlpName"},
                    {"data":"pjlpRole"},
                    {"data": null}
            ],
            "columnDefs": [{
                "targets": -1,
                "defaultContent": '<button class="btn btn-primary btn-sm">Kinerja</button>'
            }]
        });
        
        $("#data-tabel tbody").on('click','button', function() {
            var data = table.row($(this).parents('tr')).data();
            location.assign("<?php echo base_url('administrator/validasi/validasi_kinerja') ?>"+"?uid="+data["pjlpUID"]);
        })

        // append data table's button container for button collection
        table
        .buttons()
        .container()
        .appendTo($(".col-md-6:eq(0)", table.table().container()));
    });
</script>
