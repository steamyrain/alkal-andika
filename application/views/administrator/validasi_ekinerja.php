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
                    <!-- 
                    <th style="text-align: center;">uid</th>
                    <th style="text-align: center;">jobid</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Tanggal Input</th>
                    <th style="text-align: center;">Tanggal Kinerja</th>
                    <th style="text-align: center">Bidang</th>
                    <th style="text-align: center;">Waktu Awal</th>
                    <th style="text-align: center;">Waktu Akhir</th>
                    <th style="text-align: center;">Kegiatan</th>
                    <th style="text-align: center;">Deskripsi Kegiatan</th>
                    <th style="text-align: center;">Status Validasi</th>
                    <th style="text-align: center;">Status Validasi</th>
                    -->
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
            dom: "Blfrtip",
            select: true,
            columns: [
                    {"data":"pjlpUID","visible":false},
                    {"data":"pjlpName"},
                    {"data":"pjlpRole"}
            ]
        });
    /*
    $(document).ready(function() 
    {
        getData();

        // initialize data table & its necessary config
        table = $("#data-tabel").DataTable({
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
                {
                    text: 'validasi',
                    action: function() {
                        let data = table.rows({selected: true}).data();
                        let length = table.rows({selected: true}).count();
                        let response = [];
                        for(let i=0;i<length;i++){
                            data[i].valid_status = 'valid';
                            response.push(data[i]);
                        }
                        response = JSON.stringify(response);
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('administrator/validasi/api') ?>',
                            data: response,
                            dataType: 'json',
                            statusCode: {
                                200: function() {
                                    getData();
                                }
                            }
                        });
                    }
                },
                {
                    text: 'tolak',
                    action: function() {
                        let data = table.rows({selected: true}).data();
                        let length = table.rows({selected: true}).count();
                        let response = [];
                        for(let i=0;i<length;i++){
                            data[i]['valid_status'] = 'rejected';
                            response.push(data[i]);
                        }
                        response = JSON.stringify(response);
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('administrator/validasi/api') ?>',
                            data: response,
                            dataType: 'json',
                            statusCode: {
                                200: function() {
                                    getData();
                                }
                            }
                        });
                    }
                }
            ],
            columns: [
                    {"data":"uid","visible":false},
                    {"data":"jobid","visible":false},
                    {"data":"emp_name"},
                    {"data":"created_at"},
                    {"data":"job_date"},
                    {"data":"job_rolename"},
                    {"data":"job_start"},
                    {"data":"job_end"},
                    {"data":"job"},
                    {"data":"job_desc"},
                    {"data":"valid_status","visible":false},
                    {
                        "data":"",
                        "orderable":false,
                        "searchable":false,
                        "className":"text-center",
                        "render":function(data,type,row){
                            if(row.valid_status === 'valid'){
                                return '<div class="btn btn-success btn-sm"><i class="fas fa-check"></i></div>';
                            } else if(row.valid_status === 'pending'){
                                return '<div class="btn btn-warning btn-sm"><i class="fas fa-exclamation"></i></div>';
                            } else if(row.valid_status === 'rejected'){
                                return '<div class="btn btn-danger btn-sm"><i class="fas fa-times"></i></div>';
                            }
                        }
                    }
            ]
        });
    */

        // append data table's button container for button collection
        table
        .buttons()
        .container()
        .appendTo($(".col-md-6:eq(0)", table.table().container()));
    });
</script>
