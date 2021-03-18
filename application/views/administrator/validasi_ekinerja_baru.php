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
                    <th style="text-align: center;">nama pjlp</th>
                    <th style="text-align: center;">Tanggal Kinerja</th>
                    <th style="text-align: center;">Waktu Awal</th>
                    <th style="text-align: center;">Waktu Akhir</th>
                    <th style="text-align: center;">Kegiatan id</th>
                    <th style="text-align: center;">Kegiatan</th>
                    <th style="text-align: center;">Deskripsi Kegiatan</th>
                    <th style="text-align: center;">Status Validasi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/JavaScript">
    var editor;
    $(document).ready(function() 
    {
        editor = new $.fn.dataTable.Editor({
            ajax: "<?php echo base_url('validasi/api')?>",
            table: "#data-tabel",
            fields: [
                {
                    label: "uid:",
                    name: "uid"
                },
                {
                    label: "nama pjlp:",
                    name: "emp_name"
                },
                {
                    label: "Tanggal Kinerja:",
                    name: "job_date"
                },
                {
                    label: "Waktu Awal:",
                    name: "job_start"
                },
                {
                    label: "Waktu Akhir:",
                    name: "job_end"
                },
                {
                    label: "Kegiatan id:",
                    name: "job_id"
                },
                {
                    label: "Kegiatan",
                    name: "job"
                },
                {
                    label: "Deskripsi Kegiatan",
                    name: "job_desc"
                },
                {
                    label: "Status Validasi",
                    name: "valid_status"
                }
            ]
        });

        // initialize data table & its necessary config
        var table = $("#data-tabel").DataTable({
            dom: "Blfrtip",
            ajax: {
                url: "<?php echo base_url('validasi/api') ?>",
                type: 'POST'
            },
            select: true,
            columns: [
                {data: "uid"},
                {data: "emp_name"},
                {data: "job_date"},
                {data: "job_start"},
                {data: "job_end"},
                {data: "job_id"},
                {data: "job"},
                {data: "job_desc"},
                {data: "valid_status"}
            ],
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
        /*
        table
        .buttons()
        .container()
        .appendTo($(".col-md-6:eq(0)", table.table().container()));
        */
    });
</script>
