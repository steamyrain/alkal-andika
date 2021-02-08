<div class="container-fluid">

	<div class="alert alert-success" role="alert">
        <i class="fas fa-clipboard"></i> KDO Roda Dua / Roda Empat 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <?php 
    echo anchor(
        base_URL('administrator/kdo/input'),
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
                    <th class="text-center">Tipe</th>
                    <th class="text-center">Kategori</th>
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
            <?php foreach($kdo as $k) : ?>
                <tr>
                    <td>
                        <div class="aksi" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;">
                            <form style="display: none;" id="form-hapus-<?php echo $k->id; ?>" method="post" action=<?php echo base_URL('administrator/kdo/hapus_aksi') ?>>
                                <input type="text" name="id" value="<?php echo $k->id; ?>">
                            </form>
                            <a 
                            onclick="document.getElementById('form-hapus-<?php echo $k->id; ?>').submit()"
                            >
                                <div class="btn btn-danger btn-sm" onclick="javascript: return confirm('Yakin Hapus?')">
                                    <i class="fa fa-trash"></i>
                                </div>
                            </a>
                            <a 
                                href="<?php echo base_URL('administrator/kdo/edit/'.$k->id)?>"
                            >
                                <div class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </div>
                            </a>
                        </div>
                    </td>
                    <td width="20px"><?php echo $k->plate_number ?></td>
                    <td><?php echo $k->type ?></td>
                    <td><?php echo $k->category ?></td>
                    <td><?php echo $k->brand ?></td>
                    <td><?php echo $k->year ?></td>
                    <td><?php echo $k->chassis_number ?></td>
                    <td><?php echo $k->engine_number ?></td>
                    <td><?php echo $k->active ?></td>
                    <td><?php echo $k->condition_info ?></td>
                    <td><?php echo $k->location ?></td>
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
                        messageTop: 'UNIT ALKAL BINA MARGA PROVINSI DKI JAKARTA',
                        exportOptions: {
                          columns: [1, 2, 3, 4, 5,6,7,8,9,10]
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
                          columns: [1, 2, 3, 4, 5,6,7,8,9,10]
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
