<div class="container-fluid">
    <?php echo $this->session->flashdata('pesan') ?>
    <form id="form-service-ab">
        <!-- Select Vehicle -->
        <div class="form-group">
            <label for="ab-id" class="col-form-label" aria-required="true" aria-invalid="false">Identitas Kendaraan</label>
            <select id="ab-id" name="ab-id" class="form-control" required>
            <?php 
                $category = "";
                $subcategory = "";
                foreach($ab as $d){
                    if($d->category != $category){
                        $category = $d->category;
                    }
                    if ($d->sub_category != $subcategory){
                        $subcategory = $d->sub_category;
                        if($category == $subcategory){
                            echo '<optgroup label="'.$category.'">';
                            echo '</optgroup>';
                        } else {
                            echo '<optgroup label="'.$category.' '.$subcategory.'">';
                            echo '</optgroup>';
                        }
                    }
                    if($d->plate_number){ echo "<option value=".$d->id.">".$d->plate_number."</option>";
                    } else {
                        echo "<option value=".$d->id.">".$d->serial_number."</option>";
                    }
                }
            ?>
            </select>
        </div>
        <!-- Services -->
        <div id="service-groups">
            <div 
            id="service-ab-0"
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

        <!-- Submit -->
        <button type="submit" 
            name="submit" 
            value="upload" 
            class="btn btn-primary mb-5 mt-3"
        >Simpan</button>
    </form>
</div>
<script>
    // keeping track of total number of service form groups
    let totalServices = 1;
    let serviceBuffer = [];
    let serviceInput = [];

    function searchSubServiceId(subservice_id,services){
        /*
        let left = 0;
        let right = services.length - 1;
        let mid = Math.floor((right+left)/2);
        for(;right>=left;){
            if(subservice_id < parseInt(services[mid].subservice_id)){
                right = mid-1;
                mid = Math.floor((right+left)/2);
                console.log(mid)
            } else if (subservice_id > parseInt(services[mid].subservice_id)){
                left = mid+1;
                mid = Math.floor((right+left)/2);
                console.log(mid)
            }
            if(subservice_id === parseInt(services[mid].subservice_id)){
                console.log(mid)
                return mid;
            }
        }
        return -1;
         */
        let found = services.filter(function(e,i){
            if(parseInt(e.subservice_id) == subservice_id){
                return e;
            }
        })
        return found;
    }

    // service subject
    function ServiceSubject(){
        this.serviceObservers = [];
    }

    ServiceSubject.prototype = {
        subscribe: function(cb){
            this.serviceObservers.push(cb);
        },
        unsubscribe: function(cb){
            this.serviceObservers = this.serviceObservers.filter(
                function(item){
                    if(item !== cb){
                        return item;
                    }
                }
            )
        },
        notify: function(o){

            this.serviceObservers.forEach(
                function(serviceObserver){
                    serviceObserver.populateSelectService(o);
                }
            )
        }
    }

    // service group
    function ServiceGroup(visId){
        this.visId = visId;
    }

    ServiceGroup.prototype = {
        emptySelectService: function(){
            $(`select#service-id-${this.visId}`).empty();
        },
        enableSelectService: function(){
            $(`select#service-id-${this.visId}`).prop("disabled",false);
        },
        prepSelectService: function(){
            this.emptySelectService();
            this.enableSelectService();
        },
        populateInput: function(input) {
            let abid = $('#ab-id').val()
            let seid = $('#service-id-'+this.visId).val();
            let suid = $('#subservice-id-'+this.visId).val();
            let sdate = $('#service-date-'+this.visId).val();
            let sprice = $('#service-price-unit-'+this.visId).val();
            let sunit = $('#service-total-unit-'+this.visId).val();
            let sdesc = $('#service-desc-'+this.visId).val();
            input[this.visId]={
                "ab_id":abid,
                "service_id":seid,
                "subservice_id":suid,
                "service_date":sdate,
                "service_desc":sdesc,
                "unit_price":sprice,
                "unit_total":sunit

            }
        },
        populateSelectService: function(services){
            this.prepSelectService();
            let first = true;
            let buffer;
            const selector = `select#service-id-${this.visId}`
            services.forEach(function(service){
                if(first){
                    first = false;
                    $(selector).append(
                        `<option value="${service.service_id}" selected>
                            ${service.service_name}
                        </option>`
                    )
                    buffer = service.service_id;
                } else if (service.service_id !== buffer){
                    $(selector).append(
                        `<option value="${service.service_id}">
                            ${service.service_name}
                        </option>`
                    )
                    buffer = service.service_id;
                }
            })
            this.populateInput(serviceInput)
            $(selector).trigger('change')
            this.populateSelectSubService($(selector).val(),services);
        },
        emptySelectSubService: function(){
            $(`select#subservice-id-${this.visId}`).empty();
        },
        enableSelectSubService: function(){
            $(`select#subservice-id-${this.visId}`).prop("disabled",false);
        },
        prepSelectSubService: function(){
            this.emptySelectSubService();
            this.enableSelectSubService();
        },
        populateSelectSubService: function(service_id,services){
            this.prepSelectSubService();
            let first = true;
            const selector = `select#subservice-id-${this.visId}`
            // change serviceInput subservice_id
            services.forEach(function(service){
                if(first && (service.service_id === service_id)){
                    first = false;

                    //populate select
                    $(selector).append(
                        `<option value="${service.subservice_id}" selected>
                            ${service.subservice_name}
                        </option>`
                    )

                    //populate label unit faster without searching
                    const labelUnit = `label#service-unit-${this.visId}`
                    $(labelUnit).html(service.unit_unit)
                } else if(service.service_id === service_id){
                    $(selector).append(
                        `<option value="${service.subservice_id}">
                            ${service.subservice_name}
                        </option>`
                    )
                }
            })
            serviceInput[this.visId].subservice_id = $(selector).val();
            $(selector).trigger('change')
            //populate label unit faster without searching
            const labelUnit = `label#service-unit-${this.visId}`
            $(labelUnit).html()
        },
        populateLabelUnit: function(subservice_id,services){
            const selector = `label#service-unit-${this.visId}`
            let found = searchSubServiceId(subservice_id,services)
            $(selector).html(found[0].unit_unit);
        },
    }

    let serviceSub = new ServiceSubject();
    
    // initial fetch services and subservices based on selected heavy duty vehicle
    function initGetServicesAndSubservices(){
        let ab_id = $("#ab-id").val();
        getServicesAndSubservices(ab_id);
    }


    // fetch services and subservices based on selected heavy duty vehicle
    function getServicesAndSubservices(ab_id){
        let services = [];
        $.ajax({
            type:'GET',
            url:'<?php echo base_url('administrator/abservicehistory/servicelistapi')?>'+'?ab_id='+ab_id,
            dataType: 'json',
            success: function(r){
                services = r;
                serviceBuffer = r;
                serviceSub.notify(services);

                //add-service-btn event listener
                $("#add-service-btn").prop("disabled",false)
                $("#add-service-btn").unbind("click",addServiceBtn)
                $("#add-service-btn").on("click",addServiceBtn)
            }
        })
    }


    // event listener for add button
    // add button will add more service form groups
    function addServiceBtn(){
        let child = 
            `<div 
                style="
                    border: 2px solid rgba(211,211,211,.5); 
                    -webkit-background-clip: padding-box;
                    bakground-clip: padding-box;
                    border-radius: 0.5rem; 
                    padding: 0.5vw;
                    margin-top: 1rem;
                "
                id="service-ab-${totalServices}">
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
                                    name="service-date-${totalServices}" 
                                    id="service-date-${totalServices}" 
                                    class="form-control"
                                    required
                                />
                                <select 
                                    id="service-id-${totalServices}" 
                                    name="service-id-${totalServices}" 
                                    class="form-control" 
                                    required 
                                    
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
                                        id="subservice-id-${totalServices}" 
                                        name="subservice-id-${totalServices}" 
                                        class="form-control" 
                                        required 
                                        
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
                                        name="service-price-unit-${totalServices}" 
                                        id="service-price-unit-${totalServices}" 
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
                                        name="service-total-unit-${totalServices}" 
                                        id="service-total-unit-${totalServices}" 
                                        class="form-control-inline"
                                        style="min-width:50px";
                                        required 
                                    />
                                    <label id="service-unit-${totalServices}">
                                        pcs
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="service-desc-${totalServices}" class="col-form-label">Keterangan</label>
                            <input name="service-desc-${totalServices}" id="service-desc-${totalServices}" class="form-control"/>
                        </div>
                        <div>
                            <button 
                                id="service-btn-delete-${totalServices}" 
                                type="button" 
                                onclick="event.preventDefault()"
                                class="btn btn-block btn-danger"
                            >
                                    <i class="fa fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
        $("#service-groups").append(child);

        let serviceGroup = new ServiceGroup(totalServices);
        serviceGroup.populateSelectService(serviceBuffer);
        serviceSub.subscribe(serviceGroup);

        //onchange
        $("#service-id-"+totalServices).on("change",{serviceGroup: serviceGroup},onServiceChange);
        $("#subservice-id-"+totalServices).on("change",{serviceGroup: serviceGroup},onSubServiceChange)
        $("#service-date-"+totalServices).on("change",{serviceGroup: serviceGroup},onServiceDateChange)
        $("#service-desc-"+totalServices).on("change",{serviceGroup: serviceGroup},onServiceDescChange)
        $("#service-price-unit-"+totalServices).on("change",{serviceGroup: serviceGroup},onUnitPriceChange)
        $("#service-total-unit-"+totalServices).on("change",{serviceGroup: serviceGroup},onUnitTotalChange)
        $("#service-btn-delete-"+totalServices).on("click",{serviceGroup: serviceGroup},onDelete)

        totalServices++;
    }

    // event listener for select heavy duty vehicle
    // select heavy duty vehicle will fetch services and subservices list
    // for its selected vehicle
    function onABIdChange(){
        let ab_id = $(this).val();
        getServicesAndSubservices(ab_id);
    }


    // event listener for select service 
    function onServiceChange(event){
        let service_id = $(this).val();
        event.data.serviceGroup.populateSelectSubService(service_id,serviceBuffer);
        serviceInput[event.data.serviceGroup.visId].service_id = service_id;
    }

    // event listener for select subservice 
    function onSubServiceChange(event){
        let subservice_id = $(this).val();
        event.data.serviceGroup.populateLabelUnit(subservice_id,serviceBuffer);
        serviceInput[event.data.serviceGroup.visId].subservice_id = subservice_id;
    }

    // event listener for unit total
    function onUnitTotalChange(event){
        let unitTotal = $(this).val()
        serviceInput[event.data.serviceGroup.visId].unit_total = unitTotal;
    }

    // event listener for unit price
    function onUnitPriceChange(event){
        let unitPrice = $(this).val()
        serviceInput[event.data.serviceGroup.visId].unit_price = unitPrice;
    }

    // event listener for service desc 
    function onServiceDescChange(event){
        let serviceDesc = $(this).val()
        serviceInput[event.data.serviceGroup.visId].service_desc = serviceDesc;
    }

    // event listener for service date 
    function onServiceDateChange(event){
        let serviceDate = $(this).val()
        serviceInput[event.data.serviceGroup.visId].service_date = serviceDate;
    }

    function onDelete(event){
        $("#service-ab-"+event.data.serviceGroup.visId).remove();
        serviceInput[event.data.serviceGroup.visId] = {};
        serviceSub.unsubscribe(event.data.serviceGroup)
    }

    $(document).ready(function() {

        let firstServiceGroup = new ServiceGroup(0);
        serviceSub.subscribe(firstServiceGroup);
         
        //ab-id event listener
        initGetServicesAndSubservices();
        $("#ab-id").on("change",onABIdChange);

        //onchange
        $("#service-id-0").on("change",{serviceGroup: firstServiceGroup},onServiceChange);
        $("#subservice-id-0").on("change",{serviceGroup: firstServiceGroup},onSubServiceChange)
        $("#service-date-0").on("change",{serviceGroup: firstServiceGroup},onServiceDateChange)
        $("#service-desc-0").on("change",{serviceGroup: firstServiceGroup},onServiceDescChange)
        $("#service-price-unit-0").on("change",{serviceGroup: firstServiceGroup},onUnitPriceChange)

        $("#service-total-unit-0").on("change",{serviceGroup: firstServiceGroup},onUnitTotalChange)
        $("#service-btn-delete-0").on("click",{serviceGroup: firstServiceGroup},onDelete)

        //onsubmit
        $("#form-service-ab").on("submit",function(event){
            event.preventDefault();
            $.post(
                '<?php 
                    echo base_url('administrator/abservicehistory/api') 
                ?>',
                JSON.stringify(serviceInput),
                function(){
                    window.location.href = "<?php echo base_url('administrator/abservicehistory') ?>";
                }
            );
        })

    })

</script>
