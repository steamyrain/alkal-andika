<div class="container-fluid">
    <h5 style="text-align: center;">DETAIL DUMPTRUCK SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas">

        <!-- kdo -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
            <div id="vehicle-kdo-container">
                <div class="form-group">
                    <label>Dumptruck & BBM (Liter) :</label>
                    <?php 
                        $kdoBuff=json_decode($st_kdo_og); 
                        $i = 0;
                        foreach($kdoBuff as $kdo) {
                    ?>
                        <div 
                            id= "div-vehicle-kdo-<?php echo $i; ?>" 
                            style="display: grid; grid-template-columns: 3fr 1fr 1fr; grid-gap: 0.75vw;"
                            class="form-group"
                        >
                            <select 
                                name="vehicle-kdo-<?php echo $i; ?>" 
                                id="vehicle-kdo-<?php echo $i; ?>" 
                                class="form-control" 
                                placeholder="Masukkan Dumptruck" 
                            >
                            </select>
                            <input 
                                type="number" 
                                id="fuel-vehicle-kdo-<?php echo $i; ?>"
                                name="fuel-vehicle-kdo-<?php echo $i; ?>"
                                class="form-control"
                                placeholder = "Liter"
                            />
                            <button 
                                class="btn btn-danger form-control" 
                                id="vehicle-container--delete-kdo-button-<?php echo $i; ?>" 
                                onclick="event.preventDefault();"
                            >
                                hapus
                            </button>
                        </div>
                    <?php 
                            $i++;
                        } 
                    ?>
                </div>
            </div>
            <div style="display: none" class="text-danger small ml-3" id="kdo-error-message"></div>
                <div class="form-group">
                    <button class="btn btn-secondary" id="vehicle-container--add-kdo-button" onclick="event.preventDefault();">
                        tambah
                    </button>
                </div>
        </div>

        <!-- Submit -->
        <button 
            type="submit" 
            name="submit" 
            id="submit"
            class="btn btn-primary mb-5 mt-3"
            onclick="event.preventDefault();"
        >
            Simpan
        </button>
    </form>
</div>
<script>

    // initialize st og variables;
    var stId = <?php echo $st_id; ?>;
    var st_kdo = <?php echo $st_kdo_og; ?>;    
    var len_st_kdo = st_kdo.length; 

    // Get Elements from dom
    var vehicleKDOContainer;

    // add button
    var addVehicleKDOButton;

    // select element
    var vehicleKDOSelect;

    // select og element
    var vehicleOGKDOSelect;

    // support variables
    var vehicle_kdo;
    var len_kdo;

    // total variable (don't use this variable as total counter!
    // use it for select element's unique id)
    var total_kdo=len_st_kdo;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_kdo = new Object();

    // initialize object for og list
    var selected_og_kdo = new Object();
    var deleted_og = new Array();

    // populate select's option with vehicle
    function initOGKDO(kdoSelect,fuelInput,kdo,len,ogKDOId,ogKDOFuel){
        var kdoCategory="";
        var option;
        var optgroup;
        for(i=0;i<len;i++){
            option = document.createElement("option");
            optgroup = document.createElement("optgroup");
            if (kdoCategory != kdo[i].category){
                kdoCategory = kdo[i].category;
                optgroup.label =  kdoCategory;
            }
            kdoSelect.appendChild(optgroup);
            option.value=kdo[i].id;
            if (kdo[i].id == ogKDOId) {
                option.selected = "true";
            }
            option.innerHTML=kdo[i].plate_number+' / '+kdo[i].type;
            kdoSelect.appendChild(option);
        }
        fuelInput.value=ogKDOFuel;
    }

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_kdo;
    var xhttp_surat;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> {

        vehicleKDOContainer = document.getElementById("vehicle-kdo-container");
        addVehicleKDOButton = document.getElementById("vehicle-container--add-kdo-button");

        // populate the already initiated form fields from the server 
        // by sending ajax to api noun 
        populateOGKDO(); 


        document.getElementById('submit').addEventListener('click',(event)=>{
            event.preventDefault();

            var og_stDt_id = Object.keys(selected_og_kdo);
            var og_kdo_dat = Object.values(selected_og_kdo);        
            var og_dKeys = deleted_og;
            var new_kdo_dat = Object.values(selected_kdo);
            var st_kdo_buffer = new Array();
            var og_kdo_id = new Array();

            for (var i=0;i<og_kdo_dat.length;i++){
                if (og_kdo_dat[i].hasOwnProperty('kdo_id')){
                    st_kdo_buffer = st_kdo_buffer.concat(og_kdo_dat[i].kdo_id);
                }
            }

            for (var i=0;i<new_kdo_dat.length;i++){
                if (new_kdo_dat[i].hasOwnProperty('kdo_id')){
                    st_kdo_buffer = st_kdo_buffer.concat(new_kdo_dat[i].kdo_id);
                }
            }
            
            for (var i=0;i<len_st_kdo;i++){
                if (!og_stDt_id.includes(st_kdo[i].stKDOId) && !deleted_og.includes(st_kdo[i].stKDOId)){
                    st_kdo_buffer = st_kdo_buffer.concat(st_kdo[i].kdo_id);
                }
            }

            var data = {
                "og_sId": stId,
                "og_keys": og_stDt_id,
                "og_dat": og_kdo_dat,
                "og_dKeys":deleted_og,
                "new_dat":new_kdo_dat,
                "st_kdo_buffer": st_kdo_buffer
            }

            xhttp_surat = new XMLHttpRequest();
            xhttp_surat.onload = function() {
                var jsonResponse = JSON.parse(this.responseText);
                if (this.status == 200) {
                    window.location.assign(jsonResponse.redirect_url);
                }
                if (this.status == 400) {
                    var message = jsonResponse['message'];
                    
                    // scroll to top just to have the same ux with other pages
                    window.scrollTo(0,0);

                    // if error message for operator fields exist
                    if(message['kdo']){
                        var divErrorKDO = document.getElementById('kdo-error-message');
                        divErrorKDO.style.display = 'block';
                        divErrorKDO.innerHTML = message['kdo'];
                    }
                }
            }
            xhttp_surat.open("POST","<?php echo base_URL('administrator/surattugas/edit_kdo')?>")
            xhttp_surat.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp_surat.send(JSON.stringify(data));
        });

    });

    function populateOGKDO(){
        xhttp_kdo = new XMLHttpRequest();

        xhttp_kdo.onload = function() {
            var obj = JSON.parse(this.responseText);
            vehicle_kdo = obj.vehicle_kdo;
            len_kdo = Object.keys(vehicle_kdo).length;
            var id;
            var i = 0;
            for(;i<len_st_kdo;i++){
                id = `vehicle-kdo-${i}`;
                vehicleKDOSelect = document.getElementById(id);
                vehicleFuelInput = document.getElementById('fuel-'+id);
                initOGKDO(vehicleKDOSelect,vehicleFuelInput,vehicle_kdo,len_kdo,st_kdo[i].kdo_id,st_kdo[i].kdo_fuel); 
                listenOGKDO(id,'fuel-'+id,selected_og_kdo,st_kdo[i].stKDOId);
                buttonId=`vehicle-container--delete-kdo-button-${i}`;
                deleteOG(id,buttonId,selected_og_kdo,deleted_og,st_kdo[i].stKDOId);
            }
            
            addVehicleKDOButton.addEventListener('click',(event)=>{ 
                event.preventDefault();
                var select_id = `vehicle-kdo-${total_kdo}`;
                addVehicle(event,vehicleKDOContainer,vehicle_kdo,len_kdo,select_id,selected_kdo);
                total_kdo++;
            });
        }

        xhttp_kdo.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_kdo')?>");
        xhttp_kdo.send();
    }
    
    // event listener for og fields
    function listenOGKDO(selectId,fuelId,selectedOG,st_kdo_id) {

        document.getElementById(selectId).addEventListener('change',(event)=>{
            var idValue = document.getElementById(selectId).value;
            var fuelValue = document.getElementById(fuelId).value;
            if (selectedOG.hasOwnProperty(st_kdo_id)){
                selectedOG[st_kdo_id].kdo_id = idValue;
            } else {
                selectedOG[st_kdo_id] = {'kdo_id':idValue,'kdo_fuel':fuelValue}
            }
        });

        document.getElementById(fuelId).addEventListener('change',(event)=>{
            var idValue = document.getElementById(selectId).value;
            var fuelValue = document.getElementById(fuelId).value;
            if (selectedOG.hasOwnProperty(st_kdo_id)){
                selectedOG[st_kdo_id].kdo_fuel = fuelValue;
            } else {
                selectedOG[st_kdo_id]={'kdo_fuel':fuelValue,'kdo_id':idValue};
            }
        });

    }

    function deleteOG(selectId,buttonId,selectedOG,deletedOG,st_kdo_id) {
        document.getElementById(buttonId).addEventListener('click',(event)=>{
            event.preventDefault();
            document.getElementById('div-'+selectId).style="display:none";
            deletedOG.push(st_kdo_id);
            if (selectedOG.hasOwnProperty(st_kdo_id)){
                delete selectedOG[st_kdo_id];
            }
        });
    }

    var addVehicle = function (event,container,kdo,len,select_id,selected) {

        event.preventDefault();

        var div = document.createElement("div");
        var select = document.createElement("select");
        var input = document.createElement("input");
        var deleteButton = document.createElement("button");
        var divGrid = document.createElement("div");

        div.className = "form-group";
        div.id = `div-${select_id}`;
        select.className="form-control";
        select.id=select_id;
        input.type="number";
        input.id=`fuel-${select_id}`;
        input.className="form-control";
        input.placeholder="Liter"
        deleteButton.innerHTML="hapus";
        deleteButton.className="form-control btn btn-danger"

        var kdoCategory="";
        var kdoSubcategory="";
        var option;
        var optgroup;

        for(i=0;i<len;i++){
            option = document.createElement("option");
            optgroup = document.createElement("optgroup");
            if (kdoCategory != kdo[i].category){
                kdoCategory = kdo[i].category;
            }
            if (kdoSubcategory != kdo[i].sub_category){
                kdoSubcategory = kdo[i].sub_category;
                if (kdoCategory == kdoSubcategory) {
                    optgroup.label =  kdoCategory;
                } else {
                    optgroup.label =  kdoCategory+" "+kdo[i].sub_category;
                }
                select.appendChild(optgroup);
            }
            option.value=kdo[i].id;
            if(kdo[i].plate_number)
            {
                option.innerHTML=kdo[i].plate_number+' / '+kdo[i].type;
            } else {
                option.innerHTML=kdo[i].serial_number+' / '+kdo[i].type;
            }
            select.appendChild(option);
        } 


        divGrid.style="display: grid; grid-template-columns: 3fr 1fr 1fr; grid-gap: 0.75vw;";
        deleteButton.addEventListener('click',(event)=>{event.preventDefault();});
        divGrid.appendChild(select);
        divGrid.appendChild(input);
        divGrid.appendChild(deleteButton);
        div.appendChild(divGrid);
        container.appendChild(div);

        selected[div.id]={
            'kdo_id': select.value,
            'kdo_fuel': 0,
            'surat_id': stId
        };

        select.addEventListener('change',(event)=>{
            selected[div.id].kdo_id=select.value;
        });

        input.addEventListener('change',(event)=>{
            selected[div.id].kdo_fuel=input.value;
        });

        deleteButton.addEventListener('click',(event)=>{
            event.preventDefault();
            divGrid.remove();
            delete selected[div.id];
        });
    }
    
</script>
