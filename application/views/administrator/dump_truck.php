<div class="container-fluid">

	<div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> Dump Truck 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <?php 
    echo anchor(
        base_URL('administrator/dumptruck/input'),
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>

    <div style="overflow-x: auto;">
        <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Nomor Polisi</th>
                    <th class="text-center">Nomor Pintu</th>
                    <th class="text-center">Tipe</th>
                    <th class="text-center">Kategori/Kapasitas</th>
                    <th class="text-center">Merek</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Nomer Rangka</th>
                    <th class="text-center">Nomer Mesin</th>
                    <th class="text-center">Aktif</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Lokasi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($dumpTruck as $dt) : ?>
                <tr>
                    <td>
                        <div class="aksi" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;">
                            <form style="display: none;" id="form-hapus-<?php echo $dt->id; ?>" method="post" action=<?php echo base_URL('administrator/dumptruck/hapus_aksi') ?>>
                                <input type="text" name="id" value="<?php echo $dt->id; ?>">
                            </form>
                            <a 
                                onclick="
                                    if(confirm('Yakin Hapus?')){
                                        document.getElementById('form-hapus-<?php echo $dt->id; ?>').submit()
                                    }
                                "
                            >
                                <div class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </div>
                            </a>
                            <a 
                                href="<?php echo base_URL('administrator/dumptruck/edit/'.$dt->id)?>"
                            >
                                <div class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </div>
                            </a>
                        </div>
                    </td>
                    <td width="20px"><?php echo $dt->plate_number ?></td>
                    <td width="20px"><?php echo $dt->door_number ?></td> 
                    <td><?php echo $dt->type ?></td>
                    <td><?php echo $dt->category ?></td>
                    <td><?php echo $dt->brand ?></td>
                    <td><?php echo $dt->year ?></td>
                    <td><?php echo $dt->chassis_number ?></td>
                    <td><?php echo $dt->engine_number ?></td>
                    <td><?php echo $dt->active ?></td>
                    <td><?php echo $dt->condition_info ?></td>
                    <td><?php echo $dt->location ?></td>
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

        order: [[1, "desc"]],
        dom: "lBfrtip",
        buttons: [
            {
                extend: "collection",
                text: "Print",
                buttons: [
                    {
                        extend: "print",
                        text: "Print Table",
                        //title: "<h4 style="text-align:center;">Kinerja PJLP</h4>",
                        messageTop: 'UNIT ALKAL BINA MARGA PROVINSI DKI JAKARTA',
                        exportOptions: {
                          columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                        }
                    }
                ]
            },
            {
                extend: "collection",
                text: "Export",
                buttons: [
                    {
                        extend: "csvHtml5",
                        text: "As CSV",
                        exportOptions: {
                          columns: [1, 2, 3, 4, 5,6,7,8,9,10,11]
                        }
                    }
                ]
            }
        ]
    });

    // append data table's button container for button collection
    table
    .buttons()
    .container()
    .appendTo($(".col-md-6:eq(0)", table.table().container()));
});
</script>
