<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>


    <div class="card" style="width: 90%;">
        <div class="card-body">

            <form id="my-form" method="POST"
                action="<?php echo base_url('administrator/perencanaan/tambah_data_aksi') ?>">

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control tanggal-indv">
                    <?php echo form_error('tanggal','<div class="text-small text danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control lokasi-indv">
                    <?php echo form_error('lokasi','<div class="text-small text danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label>Alat Kendaraan</label>
                    <select type="text" name="kendaraan" class="kendaraan-indv select2">
                        <option value="">Pilih</option>
                        <?php foreach ($kendaraan as $k) : ?>
                        <option value="<?php echo $k->category ?> <?php echo $k->type ?>"><?php echo $k->category ?>
                            <?php echo $k->type ?></option>

                        <?php endforeach; ?>
                        <hr>

                        <option value="">--- Dump Truck ---</strong></option>
                        <?php foreach ($dump_truck as $d) : ?>
                        <option value="Dump Truck <?php echo $d->category ?>"> Dump Truck <?php echo $d->category ?>
                        </option>
                        
                         <option value="">--- KDOL ---</strong></option>
                         <option value="Panther">Panther</option>
                         <option value="Pregio">Pregio</option>
                         <option value="Strada">Strada</option>

                        <?php endforeach; ?>
                        
                        
                    </select>

                    <label>No Indentitas</label>
                    <select type="text" name="serial" class="serial-indv select2">
                        <option value="">Pilih No</option>
                        <?php foreach ($serial as $s) : ?>

                          <?php 
                    
                          if($s->serial_number == ''){
                            echo '<option value="'.$s->plate_number.'">'.$s->plate_number.'</option>';
                          }else if($s->plate_number == ''){
                            echo '<option value="'.$s->serial_number.'">'.$s->serial_number.'</option>';
                          }else {
                    
                          }
                          
                         ?>
                        <?php endforeach; ?>
                        <option value="">-- No Dump Truck --</option>
                        <?php foreach ($no_dt as $dt) : ?>
                        <option value="<?php echo $dt->plate_number ?>"><?php echo $dt->plate_number ?></option>
                        <?php endforeach; ?>
                        
                        <option value="">-- KDOL --</option>
                        <option value="B9830PQV">B 9830 PQV</option>
                        <option value="B 1262 VQ">B 1262 VQ</option>
                        <option value="B 9541 PQU">B 9541 PQU</option>
                        <option value="B 9540 PQU">B 9540 PQU</option>
                        <option value="B 9913 PSC">B 9913 PSC</option>
                        <option value="B 9420 OQ">B 9420 OQ</option>
                        <option value="B 9942 PQ">B 9942 PQ</option>
                        <option value="B 1841 PQN">B 1841 PQN</option>
                        <option value="B 9432 BQ">B 9432 BQ</option>
                    </select>

                    <label>Pengguna &nbsp&nbsp&nbsp </label>
                    <select type="text" name="operator" class="operator-indv select2">
                        <option value="">Pilih Pengguna</option>
                        <option value="PMJ">PMJ</option>
                        <?php foreach ($operator as $o) : ?>
                        <option value="<?php echo $o->username ?>"><?php echo $o->username ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <hr>

                <!--
                    <div class="form-group">
                    <label>Dump Truck</label>
                    <select type="text" name="kendaraan">
                        <option value="">Pilih</option>
                        <?php foreach ($dump_truck as $d) : ?>
                        <option value="Dump Truck <?php echo $d->category ?>"> Dump Truck <?php echo $d->category ?></option>

                        <?php endforeach; ?>
                    </select>
                    &nbsp&nbsp&nbsp

                    <label>No Indentitas</label>
                    <select type="text" name="serial">
                        <option value="">Pilih No</option>
                        <?php foreach ($no_dt as $dt) : ?>
                        <option value="<?php echo $dt->plate_number ?>"><?php echo $dt->plate_number ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                    <hr>
                -->



                <div class="form-group">
                    <label>Perencanaan BBM</label>
                    <input type="text" name="pr_bbm" class="form-control pr-bmm-indv">
                    <?php echo form_error('pr_bbm','<div class="text-small text danger"></div>') ?>
                </div>

                <div style="margin-bottom: 10px">
                    <button type="button" onclick="addRow()" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-primary btn-data" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Data Sebelumnya
                    </button>
            </form>
        <div class="modal fade modal-fullscreen" id="modal-data">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Data Sebelumnya</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p>Date: <input type="date" id="datepicker"></p>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="data" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                            <th>Alat Kendaraan</th>
                                            <th>No Identitas</th>
                                            <th>Pengguna</th>
                                            <th>Perencanaan BBM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <button type="button" class="btn btn-sm btn-info get-data-y">Get Data</button>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="<?php echo base_url('administrator/perencanaan/save_batch') ?>"
            enctype="multipart/form-data">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">

                            <th>Tanggal</th>
                            <th style="width:150px;" >Lokasi</th>
                            <th style="width:250px;">Alat Kendaraan</th>
                            <th>No Identitas</th>
                            <th style="width:200px;">Pengguna</th>
                            <th>Perencanaan BBM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="itemlist">
                    </tbody>
                </table>
            </div>
            <button style="display:none" type="submit" class="btn btn-success btn-submit">Simpan Semua</button>
        </form>

    </div>

</div>
</div>


<script>
    $(document).ready(function () {
        var tgl;
        var table;
        $(document).on('change', '#datepicker', function () {
            tgl = this.value;
            table.ajax.reload(null, false);
        });
        $(document).on('click','.btn-data', function(){
            $('#modal-data').modal('show');
        });
        //datatables
        table = $('#data').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?php echo site_url('administrator/perencanaan/ajax_list')?>",
                "type": "POST",
                data: function (data) {
                    data.tanggal = tgl;
                    return data;
                },
            },
            select: true,
            columns: [{
                    data: "tanggal",
                    className: "text-left",
                    "render": function (data, type, row, meta) {
                        return '<input class="tanggal_awal tgl" type="date" value="' + data +
                            '" />';
                    }
                },
                {
                    data: "lokasi",
                    className: "text-left"
                },
                {
                    data: "kendaraan",
                    className: "text-left"
                },
                {
                    data: "serial",
                    className: "text-left"
                },
                {
                    data: "operator",
                    className: "text-left"
                },

                {
                    data: "pr_bbm",
                    className: "text-left"
                },
            ],
            "drawCallback": function (settings) {
              
                $(document).on('change', '.tanggal_awal', function () {
                    $('.tanggal_awal').val(this.value);
                });

            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }],

        });

        $('.select2').select2({
            allowClear:true,
        });
        $(document).on('click', '.btn-hapus', function () {
            var whichtr = $(this).closest("tr");
            whichtr.remove();
        })
        $(document).on('click', '.get-data-y', function () {
                    var tgl = $('.tgl').val();
                    $("#modal-data").modal('hide');
                    $(".btn-submit").show();
                    var data = table.rows().data();
                        console.log(data);
                    table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                        var data = this.data();
                        var itemlist = document.getElementById('itemlist');
                        var row = document.createElement('tr');
                        var tanggal = document.createElement('td');
                        var lokasi = document.createElement('td');
                        var kendaraan = document.createElement('td');
                        var serial = document.createElement('td');
                        var operator = document.createElement('td');
                        var perencanaan = document.createElement('td');


                        var aksi = document.createElement('td');

                        itemlist.appendChild(row);
                        row.appendChild(tanggal);
                        row.appendChild(lokasi);
                        row.appendChild(kendaraan);
                        row.appendChild(serial);
                        row.appendChild(operator);
                        row.appendChild(perencanaan);
                        row.appendChild(aksi);

                        var row_tanggal = document.createElement('input');
                        row_tanggal.setAttribute('name', 'tanggal[]');
                        row_tanggal.setAttribute('class',
                            'form-control namabarang');
                        row_tanggal.setAttribute('type', 'date');
                        row_tanggal.setAttribute('value', tgl);

                        var row_lokasi = document.createElement('input');
                        row_lokasi.setAttribute('name', 'lokasi[]');
                        row_lokasi.setAttribute('class', 'form-control text-right');
                        row_lokasi.setAttribute('id', 'diskon');
                        row_lokasi.setAttribute('value', data.lokasi);

                        var row_kendaraan = document.createElement('input');
                        row_kendaraan.setAttribute('name', 'kendaraan[]');
                        row_kendaraan.setAttribute('class', 'form-control ');
                        row_kendaraan.setAttribute('value', data.kendaraan);

                        var row_serial = document.createElement('input');
                        row_serial.setAttribute('name', 'serial[]');
                        row_serial.setAttribute('class', 'form-control ');
                        row_serial.setAttribute('value', data.serial);

                        var row_operator = document.createElement('select');
                        row_operator.setAttribute('name', 'operator[]');
                        row_operator.setAttribute('class', 'form-control selUser');

                        $('.selUser').select2('data', {
                            id: data.operator,
                            a_key: data.operator
                        });

                        var row_perencanaan = document.createElement('input');
                        row_perencanaan.setAttribute('name', 'pr_bmm[]');
                        row_perencanaan.setAttribute('class',
                            'form-control rupiah harga ai');
                        row_perencanaan.setAttribute('value', data.pr_bbm);


                        var hapus = document.createElement('span');
                        hapus.innerHTML =
                            '<button type="button" class="btn btn-hapus btn-small btn-default"><i class="fa fa-trash"></i></button>';

                        tanggal.appendChild(row_tanggal);
                        lokasi.appendChild(row_lokasi);
                        kendaraan.appendChild(row_kendaraan);
                        serial.appendChild(row_serial);
                        operator.appendChild(row_operator);
                        perencanaan.appendChild(row_perencanaan);
                        aksi.appendChild(hapus);

                        select2user();
                        var newOption = new Option(data.operator, data.operator,
                            false,
                            false);
                        $('.selUser').append(newOption).trigger('change');
                    });

                });

    });

    function addRow() {
        var row = document.createElement('tr');
        var tanggal = document.createElement('td');
        var lokasi = document.createElement('td');
        var kendaraan = document.createElement('td');
        var serial = document.createElement('td');
        var operator = document.createElement('td');
        var perencanaan = document.createElement('td');


        var aksi = document.createElement('td');

        itemlist.appendChild(row);
        row.appendChild(tanggal);
        row.appendChild(lokasi);
        row.appendChild(kendaraan);
        row.appendChild(serial);
        row.appendChild(operator);
        row.appendChild(perencanaan);
        row.appendChild(aksi);

        var row_tanggal = document.createElement('input');
        row_tanggal.setAttribute('name', 'tanggal[]');
        row_tanggal.setAttribute('class', 'form-control namabarang');
        row_tanggal.setAttribute('type', 'date');
        row_tanggal.setAttribute('value', $('.tanggal-indv').val());

        var row_lokasi = document.createElement('input');
        row_lokasi.setAttribute('name', 'lokasi[]');
        row_lokasi.setAttribute('class', 'form-control text-right');
        row_lokasi.setAttribute('id', 'diskon');
        row_lokasi.setAttribute('value', $('.lokasi-indv').val());

        var row_kendaraan = document.createElement('input');
        row_kendaraan.setAttribute('name', 'kendaraan[]');
        row_kendaraan.setAttribute('class', 'form-control rupiah harga ai');
        row_kendaraan.setAttribute('value', $('.kendaraan-indv').val());

        var row_serial = document.createElement('input');
        row_serial.setAttribute('name', 'serial[]');
        row_serial.setAttribute('class', 'form-control rupiah harga ai');
        row_serial.setAttribute('value', $('.serial-indv').val());

        var row_operator = document.createElement('select');
        row_operator.setAttribute('name', 'operator[]');
        row_operator.setAttribute('class', 'form-control as selUser');

        var row_perencanaan = document.createElement('input');
        row_perencanaan.setAttribute('name', 'pr_bmm[]');
        row_perencanaan.setAttribute('class', 'form-control');
        row_perencanaan.setAttribute('value', $('.pr-bmm-indv').val());


        var hapus = document.createElement('span');
        hapus.innerHTML =
            '<button type="button" class="btn btn-hapus btn-small btn-default"><i class="fa fa-trash"></i></button>';

        tanggal.appendChild(row_tanggal);
        lokasi.appendChild(row_lokasi);
        kendaraan.appendChild(row_kendaraan);
        serial.appendChild(row_serial);
        operator.appendChild(row_operator);
        perencanaan.appendChild(row_perencanaan);
        aksi.appendChild(hapus);

        select2user();
        var newOption = new Option($('.operator-indv').val(), $('.operator-indv').val(), false, false);
        $('.selUser').append(newOption).trigger('change');
        $(".btn-submit").show();
    }
    function select2user(){
        $(".selUser").select2({
            placeholder: "Select a state",
            allowClear: true,
                ajax: { 
                url: '<?php echo site_url('administrator/perencanaan/get_user')?>',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
                }
            });
    }

</script>
