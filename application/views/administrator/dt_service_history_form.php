<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <form id="form-service-dt">
        <div class="form-group">
            <label for="dt-id" class="col-form-label" aria-required="true" aria-invalid="false">Nomer Polisi</label>
            <select id="dt-id" name="dt-id" class="form-control" required>
            <?php foreach($dt as $d):?>
                <option value=<?php echo $d->id?>><?php echo $d->plate_number ?></option>
            <?php endforeach; ?>
            </select>
			<?php echo form_error('dt_id', '<div class="text-danger small" ml-3>','</div>') ?>
        </div>

        <div id="service-list-dt">
            <div 
            id="service-dt-0"
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
                        grid-template-rows: auto auto 1fr auto;
                        grid-gap: 0.75vw;
                    ">
                        <div>
                            <label>Tanggal Servis / Kategori Servis :</label>
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
                                    required
                                />
                                <select 
                                    id="service-id-0" 
                                    name="service-id-0" 
                                    class="form-control" 
                                    required 
                                    disabled
                                >
                                </select>
                            </div>
                        </div>
                        <div>
                            <label>Unit Servis / Harga Per-unit / Jumlah Unit :</label>
                            <div style="
                                display: grid;
                                grid-template-columns: auto min(150px,20%) min(150px,20%);
                                grid-gap: 0.75vw;
                            ">
                                <div>
                                    <select 
                                        id="subservice-id-0" 
                                        name="subservice-id-0" 
                                        class="form-control" 
                                        required 
                                        disabled
                                    >
                                    </select>
                                </div>
                                <div style="
                                        display: flex;
                                        justify-content: center;
                                        align-items:center;"
                                > 
                                    <label>Rp</label>
                                    <input 
                                        type="number" 
                                        step=0.001 
                                        name="service-price-unit-0" 
                                        id="service-price-unit-0" 
                                        class="form-control-inline" 
                                        style="min-width:50px;"
                                        required 
                                    />
                                </div>
                                <div style="
                                        display: flex;
                                        justify-content: center;
                                        align-items:center;"
                                > 
                                    <input 
                                        type="number" 
                                        step=0.001 
                                        name="service-total-unit-0" 
                                        id="service-total-unit-0" 
                                        class="form-control-inline"
                                        style="min-width:50px";
                                        required 
                                    />
                                    <label id="service-unit-0">
                                        pcs
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="service-desc-0" class="col-form-label">Keterangan</label>
                            <input name="service-desc-0" id="service-desc-0" class="form-control"/>
                        </div>
                        <div>
                            <button 
                                id="service-btn-delete-0" 
                                type="button" 
                                onclick="event.preventDefault()"
                                class="btn btn-block btn-danger"
                            >
                                    <i class="fa fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div 
            class="form-group" 
            style="
                margin-top: 1rem;
            "
        >
            <button 
                class="btn btn-secondary" 
                id="add-service-btn" 
                onclick="event.preventDefault();"
                disabled
            >
                tambah
            </button>
        </div>

        <!-- Input -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Simpan</button>
    </form>
</div>
<script>
    "use strict";

    let serviceList;
    let serviceCounter = 1;
    let serviceInput = [];

    function ServiceSubject() {
        this.observers = [];
        this.objectObservers = [];
    }

    ServiceSubject.prototype = {
        subscribe: function(fn){
            this.observers.push(fn);
        },
        objectSubscribe: function(o){
            this.objectObservers.push(o);
        },
        unsubscribe: function(fn){
            this.observers = this.observers.filter(
                itemFunction => {
                    if(itemFunction !== fn){
                        return itemFunction;
                    }
                }
            );
        },
        notify: function(fn){
            this.observers.forEach(fn => {
                fn.call();
            })
            this.objectObservers.forEach(o => {
                o.clearIt();
                o.doIt();
            })
        }
    }

    // global variable
    let subject = new ServiceSubject();

    /* for initial service form element */
    function initDTId() {
        const dt_id = $('#dt-id').val();
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('administrator/dtservicehistory/servicelistapi') ?>'+'?dt_id='+dt_id,
            dataType: 'json',
            success: function (r){
                serviceList = r;
                subject.notify();
            }
        });
    }

    function initClearServiceList(){
        $("#service-id-0").prop('disabled',false);
        $("#service-id-0").empty();
    }

    function initPopulateServiceList(){
        // visual id or # of the service input visually
        const visId = 0;
        let buffer = serviceList[0].id;
        $("#service-id-0")
        .append(
            "<option value="+buffer+" selected>"+
                serviceList[0].service_name+
            "</option>"
        );
        serviceList.forEach(service => {
            if(buffer !== service.id){
                buffer = service.id;
                $("#service-id-0")
                .append(
                    "<option value="+service.id+">"+
                        service.service_name+
                    "</option>"
                );
            }
        })
        // init 
        const dt_id = $('#dt-id').val();
        const service_id = $('#service-id-'+visId.toString()).val();
        const subservice_id = $('#subservice-id-'+visId.toString()).val();
        const service_date = $('#service-date-'+visId.toString()).val();
        const unit_total = $('#service-total-unit-'+visId.toString()).val();
        const unit_price = $('#service-price-unit-'+visId.toString()).val();
        const service_desc = $('#service-desc-'+visId.toString()).val();
        serviceInput[visId]={"dt_id":dt_id,"service_id":service_id,"subservice_id":subservice_id,"service_date":service_date,"unit_total":unit_total,"unit_price":unit_price,"service_desc":service_desc};
        clearSubServiceList(visId);
        populateSubServiceList(visId);
        onDeleteService(visId);
    }

    /* for populating service form element with add button*/
    function clearServiceList(visId){
        $("#service-id-"+visId.toString()).prop('disabled',false);
        $("#service-id-"+visId.toString()).empty();
    }

    function PopulateServiceList(id){
        // visual id or # of the service input visually
        this.visId = id;
    }

    PopulateServiceList.prototype = {
        clearIt: function() {
            $("#service-id-"+this.visId.toString()).prop('disabled',false);
            $("#service-id-"+this.visId.toString()).empty();
        },
        doIt: function() {
            let buffer = serviceList[0].id;
            $("#service-id-"+this.visId.toString())
            .append(
                "<option value="+buffer+" selected>"+
                    serviceList[0].service_name+
                "</option>"
            );
            serviceList.forEach(service => {
                if(buffer !== service.id){
                    buffer = service.id;
                    $("#service-id-"+this.visId.toString())
                    .append(
                        "<option value="+service.id+">"+
                            service.service_name+
                        "</option>"
                    );
                }
            })
            const dt_id = $('#dt-id').val();
            const service_id = $('#service-id-'+this.visId.toString()).val();
            const subservice_id = $('#subservice-id-'+this.visId.toString()).val();
            const service_date = $('#service-date-'+this.visId.toString()).val();
            const unit_total = $('#service-total-unit-'+this.visId.toString()).val();
            const unit_price = $('#service-price-unit-'+this.visId.toString()).val();
            const service_desc = $('#service-desc-'+this.visId.toString()).val();
            serviceInput[this.visId]={"dt_id":dt_id,"service_id":service_id,"subservice_id":subservice_id,"service_date":service_date,"unit_total":unit_total,"unit_price":unit_price,"service_desc":service_desc};
            clearSubServiceList(this.visId);
            populateSubServiceList(this.visId);
        }
    }

    /* delete button */
    function onDeleteService(visId){
        $("#service-btn-delete-"+visId.toString()).click(function(){
            $("#service-dt-"+visId.toString()).remove();
            serviceInput[visId] = {};
        })
    }

    /* on change form elements */
    function onServiceIdChange(visId){
        $("#service-id-"+visId.toString()).change(function(){
            const service_id = $('#service-id-'+visId.toString()).val();
            serviceInput[visId].service_id = service_id;
            clearSubServiceList(visId);
            populateSubServiceList(visId);
        })
    }

    function onSubServiceIdChange(visId){
        const subservice_visId = ["#subservice-id-",visId.toString()].join("");
        $(subservice_visId).change(function(){
            const subservice_id = $(this).val();
            serviceInput[visId].subservice_id = subservice_id;
            const unit_unit = serviceList.filter(service => {
                if(service["subservice_id"] === subservice_id){
                    return service.unit;
                }
            });
            $("#service-unit-"+visId.toString()).html(unit_unit[0].unit);
        })
    }

    function onDTIdChange(){
        $("#dt-id").change(function() {
            const dt_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('administrator/dtservicehistory/servicelistapi') ?>'+'?dt_id='+dt_id,
                dataType: 'json',
                success: function (r){
                    serviceList = r;
                    subject.notify();
                }
            });
        })
    }
    
    function onServiceDateChange(visId){
        $('#service-date-'+visId.toString()).change(function(){
            serviceInput[visId].service_date = $(this).val();
        })
    }

    function onPriceUnitChange(visId){
        $('#service-price-unit-'+visId.toString()).change(function(){
            serviceInput[visId].unit_price = $(this).val();
        })
    }

    function onTotalUnitChange(visId){
        $('#service-total-unit-'+visId.toString()).change(function(){
            serviceInput[visId].unit_total = $(this).val();
        })
    }

    function onServiceDescChange(visId){
        $('#service-desc-'+visId.toString()).on('input',function(){
            serviceInput[visId].service_desc = $(this).val();
        })
    }

    /* add service form elements */

    function enableAddServiceBtn(){
        $("#add-service-btn").prop('disabled',false);
        $("#add-service-btn").unbind("click")
        $("#add-service-btn").click(fn=>{addServiceBtn.call()})
    }

    function addServiceBtn(){
        const item = 
            [
                "<div id='service-dt-"+serviceCounter+"'style='border: 2px solid rgba(211,211,211,.5); -webkit-background-clip: padding-box; background-clip: padding-box; border-radius: 0.5rem; padding: 0.5vw; margin-top: 1rem;'>",
                "<div class='form-group'>",
                "<div style='display: grid; grid-template-rows: auto auto 1fr; grid-gap: 0.75vw;'>",
                "<div><label>Tanggal Servis / Kategori Servis :</label><div style='display: grid; grid-template-columns: min(150px,20%) auto; grid-gap: 0.75vw;'>",
                "<input type='date' name='service-date-"+serviceCounter+"' id='service-date-"+serviceCounter+"' class='form-control' required/>",
                "<select id='service-id-"+serviceCounter+"' name='service-id-"+serviceCounter+"' class='form-control' required disabled></select>",
                "</div>",
                "</div>",
                "<div>",
                "<label>Unit Servis/ Harga Per-unit / Jumlah Unit :</label>",
                "<div style='display: grid; grid-template-columns: auto min(150px,20%) min(150px,20%); grid-gap: 0.75vw;'>",
                "<select id='subservice-id-"+serviceCounter+"' name='subservice-id-"+serviceCounter+"' class='form-control' required disabled></select>",
                "<div style='display: flex; justify-content: center; align-items: center;'>",
                "<label>Rp</label>",
                "<input type='number' step=0.001 name='service-price-unit-"+serviceCounter+"' id='service-price-unit-"+serviceCounter+"' class='form-control-inline' style='min-width:50px' required/>",
                "</div>",
                "<div style='display: flex; justify-content: center; align-items: center;'>",
                "<input type='number' step=0.001 name='service-total-unit-"+serviceCounter+"' id='service-total-unit-"+serviceCounter+"' class='form-control-inline' style='min-width:50px' required/>",
                "<label id='service-unit-"+serviceCounter+"'>pcs</label>",
                "</div>",
                "</div>",
                "</div>",
                "<div>",
                "<label for='service-desc-"+serviceCounter+"' class='col-form-label'>Keterangan</label>",
                "<input name='service-desc-"+serviceCounter+"' id='service-desc-"+serviceCounter+"' class='form-control'/>",
                "</div>",
                "<div>",
                "<button id='service-btn-delete-"+serviceCounter+"' type='button' onclick='event.preventDefault()' class='btn btn-block btn-danger'>",
                "<i class='fa fa-trash'></i> Hapus",
                "</button>",
                "</div>",
                "</div>",
                "</div>",
                "</div>",
                "</div>"
            ].join('');
        /* append the service form box to dt form */
        $("#service-list-dt").append(
            item
        );
        /* populate the service select options */
        clearServiceList(serviceCounter);
        let psl = new PopulateServiceList(serviceCounter);
        psl.doIt();
        /* init object for serviceList */
        const dt_id = $('#dt-id').val();
        const service_id = $('#service-id-'+serviceCounter.toString()).val();
        const subservice_id = $('#subservice-id-'+serviceCounter.toString()).val();
        const service_date = $('#service-date-'+serviceCounter.toString()).val();
        serviceInput[serviceCounter]={"dt_id":dt_id,"service_id":service_id,"subservice_id":subservice_id,"service_date":service_date};
        /* event listeners */
        onServiceIdChange(serviceCounter);
        onSubServiceIdChange(serviceCounter);
        onServiceDateChange(serviceCounter);
        onPriceUnitChange(serviceCounter);
        onTotalUnitChange(serviceCounter);
        onServiceDescChange(serviceCounter);
        onDeleteService(serviceCounter);
        /* subscribe for changes */
        subject.objectSubscribe(psl);
        /* add counter */
        serviceCounter++;
    }

    /* for populating subservice form elements */
    function clearSubServiceList(visId){
        $("#subservice-id-"+visId.toString()).prop('disabled',false);
        $("#subservice-id-"+visId.toString()).empty();
    }

    function populateSubServiceList(visId){
        const subservice_visId = ["#subservice-id-",visId.toString()].join("");
        const service_id = $(["#service-id-",visId.toString()].join("")).val();
        let first = true;
        serviceList.forEach(service => {
            if(service_id == service.id){
                if(first){
                    $(subservice_visId)
                    .append(
                        "<option value="+service.subservice_id+">"+
                            service.subservice_name+
                        "</option>"
                    );
                    $(subservice_visId).val(service.subservice_id).change();
                    first = false;
                } else {
                    $(subservice_visId)
                    .append(
                        "<option value="+service.subservice_id+">"+
                            service.subservice_name+
                        "</option>"
                    );
                }
            }
        })
    }

    /* client code after dom is ready */
    $(document).ready( function () {
        initDTId();
        onDTIdChange();
        subject.subscribe(initClearServiceList);
        subject.subscribe(initPopulateServiceList);
        // onChange for initService
        onServiceIdChange(0);
        onSubServiceIdChange(0);
        onServiceDateChange(0)
        onPriceUnitChange(0);
        onTotalUnitChange(0);
        onServiceDescChange(0);
        //
        subject.subscribe(enableAddServiceBtn);
        $('#form-service-dt').submit(function(event){
            event.preventDefault();
            $.post(
                '<?php 
                    echo base_url('administrator/dtservicehistory/servicelistapi') 
                ?>',
                JSON.stringify(serviceInput),
                function(){
                    window.location.href = "<?php echo base_url('administrator/dtservicehistory') ?>";
                }
            );
        }) 
    });
</script>
