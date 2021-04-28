<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <?php echo 
        form_open(
            base_URL('administrator/dtservicehistory/input_aksi')); 
    ?>
        <div class="form-group">
            <label for="dt_id" class="col-form-label" aria-required="true" aria-invalid="false">Nomer Polisi</label>
            <select id="dt_id" name="dt_id" class="form-control">
            <?php foreach($dt as $d):?>
                <option value=<?php echo $d->id?>><?php echo $d->plate_number ?></option>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('dt_id', '<div class="text-danger small" ml-3>','</div>') ?>
        </div>

        <div 
        style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        "
        >
            <div class="form-group">
                <div style="
                    display: grid;
                    grid-template-rows: auto auto 1fr;
                    grid-gap: 0.75vw;
                ">
                    <div>
                        <label>Tanggal/Jenis Servis :</label>
                        <div style="
                            display: grid;
                            grid-template-columns: min(150px,20%) auto;
                            grid-gap: 0.75vw;
                        ">
                            <input 
                                type="date" 
                                name="service-date-0" 
                                id="service-date-0" 
                                class="form-control"
                            />
                            <select 
                                id="service-id-0" 
                                name="service-id-0" 
                                class="form-control" 
                                disabled
                            >
                            </select>
                        </div>
                    </div>
                        <div>
                        <label>Part/Unit :</label>
                        <div style="
                            display: grid;
                            grid-template-columns: auto min(150px,20%);
                            grid-gap: 0.75vw;
                        ">
                            <select 
                                id="subservice-id-0" 
                                name="subservice-id-0" 
                                class="form-control" 
                                disabled
                            >
                            </select>
                            <input 
                                type="number" 
                                name="service-total-unit-0" 
                                id="service-total-unit-0" 
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div>
                        <label for="service-desc-0" class="col-form-label">Keterangan</label>
                        <input name="service-desc-0" id="service-desc-0" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Input -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Simpan</button>
    <?php
        echo "</form>"
    ?>
</div>
<script>
    $(document).ready( function () {
        function Subject() {
            this.observers = [];
        }

        Subject.prototype = {
            subscribe: function(fn){
                this.observers.push(fn)
            },
            fire: function(fn){
                this.observers.forEach(fn => {
                    fn.call();
                })
            }
        }

        function ObserverTest() {
            console.log("observer test")
        }

        function AnotherObserverTest() {
            console.log("another observer test")
        }

        const subject = new Subject();
        subject.subscribe(ObserverTest);
        subject.subscribe(AnotherObserverTest);
        subject.fire();
    });
    /*
    let dt_id;
    let subservice = [];
    let service_id;

    // array to be sent to the server
    let service_dt= [];

    // counter for service
    let service_counter = 0;

    function onServiceIdChange(id) {
        return $('#service-id-'+id).change(function(){
            service_id = $(this).val();    
            getSubserviceList(service_id);
        })
    }

    function initDTId() {
        dt_id = $('#dt_id').val();
    }

    function getDTId() {
        return $('#dt_id').change( function () {
            dt_id = $(this).val();    
            getServiceList(dt_id)
        });
    }

    function getServiceId() {
        return $('#service_id').change( function () {
            service_id = $(this).val();    
            getSubserviceList(service_id);
        });
    }

    function populateServiceList(serviceList,listId) {
        let buffer;

        // check if serviceList array is exist and not empty
        if(Array.isArray(serviceList) || !serviceList.length){
            for(let i=0;i<serviceList.length;i++){
                if(i == 0){
                    buffer = serviceList[i].id;

                    // init global service_id
                    service_id = buffer;
                    subservice[buffer] = [
                        {
                            "subservice_id":serviceList[i].subservice_id.toString(),
                            "subservice_name":serviceList[i].subservice_name
                        }
                    ];
                    $("#service-id-"+listId)
                        .append(
                            "<option value="+serviceList[i].id+" selected>"+
                                serviceList[i].service_name+
                            "</option>"
                        );
                } else if(serviceList[i].id !== buffer){
                    buffer = serviceList[i].id;
                    subservice[buffer] = [
                        {
                            "subservice_id":serviceList[i].subservice_id.toString(),
                            "subservice_name":serviceList[i].subservice_name
                        }
                    ];
                    $("#service-id-"+listId)
                        .append(
                            "<option value="+serviceList[i].id+">"+
                                serviceList[i].service_name+
                            "</option>"
                        );
                } else {
                    subservice[buffer]
                        .push(
                            {
                                "subservice_id":serviceList[i].subservice_id.toString(),
                                "subservice_name":serviceList[i].subservice_name
                            }
                        );
                }
            }
        } else {
            console.error("either array doesn't exist or empty");
        }
    }

    function populateSubserviceList(id,subListId){
        // check if subservice array is exist and not empty
        if(Array.isArray(subservice) || !subservice.length){
            for(let i=0;i<subservice[id].length;i++){
                if(i == 0){
                    $("#subservice-id-"+subListId).append(
                        '<option value="'+subservice[id][i].subservice_id+'" selected>'+
                            subservice[id][i].subservice_name+
                        '</option>'
                    );
                }
                $("#subservice-id-"+subListId).append(
                    '<option value="'+
                        subservice[id][i].subservice_id+
                    '" >'+
                        subservice[id][i].subservice_name+
                    '</option>');
            }
        }
    }

    function getSubserviceList(id){
        // clear list before populating it
        $("#subservice-id-0").prop('disabled',false);
        $("#subservice-id-0").empty();

        //populate subservice list
        populateSubserviceList(id,(0).toString())
    }

    function getServiceList(id){
        return $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/servicelistapi') ?>'+'?dt_id='+id,
            dataType: 'json',
            success: function (r){
                $("#service-id-0").prop('disabled',false);
                $("#service-id-0").empty();
                const service = r;
                populateServiceList(service,(0).toString());
                onServiceIdChange((0).toString());
                getSubserviceList(service_id);
            }
        });
    }

    $(document).ready(function () {
        initDTId();
        getDTId();
        getServiceList(dt_id);
    });
     */
</script>
