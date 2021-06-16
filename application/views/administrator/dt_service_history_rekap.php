<div class="container-fluid">
    <?php 
        echo anchor(
        'administrator/dtservicehistory/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
        ) 
    ?>
    <button class="btn btn-sm btn-primary mb-3" id="printBtn">
        <i class="fas fa-print fa-sm"></i> 
        Print Rekap
    </button>
    <table 
        id="tableRekap"
        class="table table-bordered table-striped" 
        style="width:100%"
    >
        <thead>
            <tr>
                <th style="text-align: center;">Identitas Kendaraan</th>
                <th style="text-align: center;">Kategori Servis</th>
                <th style="text-align: center;">Tanggal Servis</th>
                <th style="text-align: center;">Part yang diservis</th>
                <th style="text-align: center;">Jumlah Part</th>
            </tr>
        </thead>
    </table>
</div>
<div 
    class="modal fade" 
    id="rekapModal" 
    tabindex="-1" 
    role="dialog"
    aria-labelledby="rekapModalLabel"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 
                    class="modal-title" 
                    id="rekapModalLabel"
                >
                    Rekap Data Servis DT 
                </h5>
                <button 
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rekapDT">
                    <div class="form-group">
                        <label for="dt_id" class="col-form-label">Nomor Identitas</label>
                        <select id="dt_id" name="dt_id" class="form-control" required>
                        <?php 
                        foreach($dt as $d){
                            echo "<option value=".$d->id.">".$d->plate_number."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rekap_start" class="col-form-label" aria-required="true" aria-invalid=false>Tahun Awal Rekap</label>
                        <input type="number" name="rekap_start" id="rekap_start" class="form-control" required/> 
                    </div>
                    <div class="form-group">
                        <label for="rekap_end" class="col-form-label" aria-required="true" aria-invalid=false>Tahun Akhir Rekap</label>
                        <input type="number" name="rekap_end" id="rekap_end" class="form-control" required/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button 
                    type="button" 
                    class="btn btn-secondary" 
                    data-dismiss="modal"
                >
                    Tutup
                </button>
                <button 
                    type="submit" 
                    class="btn btn-primary"
                    id="previewButton"
                >
                    Tampilkan Tabel
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    let table;
    let dt_id;
    let rekap_start;
    let rekap_end;

    function base64ToArrayBuffer(base64){
        let binaryString = window.atob(base64);
        let binaryLen = binaryString.length;
        let bytes = new Uint8Array(binaryLen);
        for (var i = 0; i < binaryLen; i++) {
            var ascii = binaryString.charCodeAt(i);
            bytes[i] = ascii;
        }
        return bytes;
    }

    $(document).ready(function(){
        //declare outside so it wont be added as new event listener everytime
        $('#previewButton').click(function(){
            dt_id = $("#dt_id").val();
            rekap_start = $("#rekap_start").val();
            rekap_end = $("#rekap_end").val();
            $.ajax({
                dataType: 'json',
                url: '<?php echo base_url('administrator/dtservicehistory/rekapapi') ?>',
                data: $('form#rekapDT').serialize(),
                statusCode: {
                    200: function(r) {
                        $('#rekapModal').modal('hide');
                        table.clear();
                        table.rows.add(r).draw();
                    }
                }
            });
        })

        //define data table
        table = $("#tableRekap").DataTable({
            responsive: true,
            dom: "Blfrtip",
            columns: [
                {"data":"plate_number"},
                {"data":"service_name"},
                {"data":"service_date"},
                {"data":"service_unit"},
                {"data":"unit_total"}
            ],
            buttons: [
                {
                    text: 'Rekap',
                    action: function (e,dt,node,config) {
                        $('#rekapModal').modal('show');
                    }
                }
            ]
        });

        $('#printBtn').on('click',function(){
            if(dt_id !== undefined && rekap_start !== undefined && rekap_end !== undefined){
                $.ajax({
                    url: '<?php echo base_url('administrator/dtservicehistory/printapi') ?>'+`?dt_id=${dt_id}&rekap_start=${rekap_start}&rekap_end=${rekap_end}`,
                    statusCode: {
                        200: function(r) {
                            let b = base64ToArrayBuffer(r);
                            let blob = new Blob([b],{type: "application/pdf"})
                            let link=document.createElement('a');
                            link.href=window.URL.createObjectURL(blob);
                            link.download=`service-dt-${dt_id}-${rekap_start}-${rekap_end}.pdf`;
                            link.click();
                        }
                    }
                });
            }
        })
    })
</script>
