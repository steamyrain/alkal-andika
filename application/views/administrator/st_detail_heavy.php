<div class="container-fluid">
    <h5 style="text-align: center;">DETAIL ALAT BERAT SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas"> 

        <!-- alat berat -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
            <div id="vehicle-heavy-container">
                <div class="form-group">
                    <label>Alat Berat & BBM (Liter) :</label>
                    <?php 
                        $heBuff=json_decode($st_heavy_og); 
                        $i = 0;
                        foreach($heBuff as $he) {
                    ?>
                        <div 
                            id= "div-vehicle-heavy-<?php echo $i; ?>" 
                            style="display: grid; grid-template-columns: 3fr 1fr 1fr; grid-gap: 0.75vw;"
                            class="form-group"
                        >
                            <select 
                                name="vehicle-heavy-<?php echo $i; ?>" 
                                id="vehicle-heavy-<?php echo $i; ?>" 
                                class="form-control" 
                                placeholder="Masukkan Alat Berat" 
                            >
                            </select>
                            <input 
                                type="number" 
                                id="fuel-vehicle-heavy-<?php echo $i; ?>"
                                name="fuel-vehicle-heavy-<?php echo $i; ?>"
                                class="form-control"
                                placeholder = "Liter"
                            />
                            <button 
                                class="btn btn-danger form-control" 
                                id="vehicle-container--delete-heavy-button-<?php echo $i; ?>" 
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
            <div style="display: none" class="text-danger small ml-3" id="heavy-error-message"></div>
                <div class="form-group">
                    <button class="btn btn-secondary" id="vehicle-container--add-heavy-button" onclick="event.preventDefault();">
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
    var st_heavy = <?php echo $st_heavy_og; ?>;    
    var len_st_heavy = st_heavy.length; 

    // Get Elements from dom
    var vehicleHeavyContainer;

    // add button
    var addVehicleHeavyButton;

    // select element
    var vehicleHeavySelect;

    // select og element
    var vehicleOGHeavySelect;

    // support variables
    var vehicle_heavy;
    var len_heavy;

    // total variable (don't use this variable as total counter!
    // use it for select element's unique id)
    var total_heavy=len_st_heavy;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_heavy = new Object();

    // initialize object for og list
    var selected_og_heavy = new Object();
    var deleted_og = new Array();

    function deleteOG(selectId,buttonId,selectedOG,deletedOG,st_heavy_id) {
        document.getElementById(buttonId).addEventListener('click',(event)=>{
            event.preventDefault();
            document.getElementById('div-'+selectId).style="display:none";
            deletedOG.push(st_heavy_id);
            if (selectedOG.hasOwnProperty(st_heavy_id)){
                delete selectedOG[st_heavy_id];
            }
        });
    }

    // event listener for og fields
    function listenOGHeavy(selectId,fuelId,selectedOG,st_heavy_id) {

        document.getElementById(selectId).addEventListener('change',(event)=>{
            var idValue = document.getElementById(selectId).value;
            var fuelValue = document.getElementById(fuelId).value;
            if (selectedOG.hasOwnProperty(st_heavy_id)){
                selectedOG[st_heavy_id].heavy_id = idValue;
            } else {
                selectedOG[st_heavy_id] = {'heavy_id':idValue,'heavy_fuel':fuelValue}
            }
        });

        document.getElementById(fuelId).addEventListener('change',(event)=>{
            var idValue = document.getElementById(selectId).value;
            var fuelValue = document.getElementById(fuelId).value;
            if (selectedOG.hasOwnProperty(st_heavy_id)){
                selectedOG[st_heavy_id].heavy_fuel = fuelValue;
            } else {
                selectedOG[st_heavy_id] = {'heavy_id':idValue,'heavy_fuel':fuelValue}
            }
        });

    }

    // populate select's option with vehicle
    //function initVehicle(vehicle,vehicleSelect,)
    function initOGHeavy(heavySelect,fuelInput,heavy,len,ogHeavyId,ogHeavyFuel){
        var heavyCategory="";
        var heavySubcategory="";
        var option;
        var optgroup;
        for(i=0;i<len;i++){
            option = document.createElement("option");
            optgroup = document.createElement("optgroup");
            if (heavyCategory != heavy[i].category){
                heavyCategory = heavy[i].category;
            }
            if (heavySubcategory != heavy[i].sub_category){
                heavySubcategory = heavy[i].sub_category;
                if (heavyCategory == heavySubcategory) {
                    optgroup.label =  heavyCategory;
                } else {
                    optgroup.label =  heavyCategory+" "+heavy[i].sub_category;
                }
                heavySelect.appendChild(optgroup);
            }
            option.value=heavy[i].id;
            if (heavy[i].id == ogHeavyId) {
                option.selected = "true";
            }
            if(heavy[i].plate_number)
            {
                option.innerHTML=heavy[i].plate_number+' / '+heavy[i].type;
            } else {
                option.innerHTML=heavy[i].serial_number+' / '+heavy[i].type;
            }
            heavySelect.appendChild(option);
        }
        fuelInput.value=ogHeavyFuel;
    }

    var addVehicle = function (event,container,heavy,len,select_id,selected) {

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

        var heavyCategory="";
        var heavySubcategory="";
        var option;
        var optgroup;

        for(i=0;i<len;i++){
            option = document.createElement("option");
            optgroup = document.createElement("optgroup");
            if (heavyCategory != heavy[i].category){
                heavyCategory = heavy[i].category;
            }
            if (heavySubcategory != heavy[i].sub_category){
                heavySubcategory = heavy[i].sub_category;
                if (heavyCategory == heavySubcategory) {
                    optgroup.label =  heavyCategory;
                } else {
                    optgroup.label =  heavyCategory+" "+heavy[i].sub_category;
                }
                select.appendChild(optgroup);
            }
            option.value=heavy[i].id;
            if(heavy[i].plate_number)
            {
                option.innerHTML=heavy[i].plate_number+' / '+heavy[i].type;
            } else {
                option.innerHTML=heavy[i].serial_number+' / '+heavy[i].type;
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
            'heavy_id': select.value,
            'heavy_fuel': 0,
            'surat_id': stId
        };

        select.addEventListener('change',(event)=>{
            selected[div.id].heavy_id=select.value;
        });

        input.addEventListener('change',(event)=>{
            selected[div.id].heavy_fuel=input.value;
        });

        deleteButton.addEventListener('click',(event)=>{
            event.preventDefault();
            divGrid.remove();
            delete selected[div.id];
        });
    }

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_heavy;
    var xhttp_surat;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> { 

        vehicleHeavyContainer = document.getElementById("vehicle-heavy-container");
        addVehicleHeavyButton = document.getElementById("vehicle-container--add-heavy-button");

        populateOGHeavy();

        document.getElementById('submit').addEventListener('click',(event)=>{
            event.preventDefault();            

            var og_stHe_id = Object.keys(selected_og_heavy);
            var og_he_dat = Object.values(selected_og_heavy);        
            var og_dKeys = deleted_og;
            var new_he_dat = Object.values(selected_heavy);
            var st_he_buffer = new Array();
            var og_he_id = new Array();

            for (var i=0;i<og_he_dat.length;i++){
                if (og_he_dat[i].hasOwnProperty('heavy_id')){
                    st_he_buffer = st_he_buffer.concat(og_he_dat[i].heavy_id);
                }
            }

            for (var i=0;i<new_he_dat.length;i++){
                if (new_he_dat[i].hasOwnProperty('heavy_id')){
                    st_he_buffer = st_he_buffer.concat(new_he_dat[i].heavy_id);
                }
            }
            
            for (var i=0;i<len_st_heavy;i++){
                if (!og_stHe_id.includes(st_heavy[i].stHeId) && !deleted_og.includes(st_heavy[i].stHeId)){
                    st_he_buffer = st_he_buffer.concat(st_heavy[i].heavy_id);
                }
            }

            var data = {
                "og_sId": stId,
                "og_keys": og_stHe_id,
                "og_dat": og_he_dat,
                "og_dKeys":deleted_og,
                "new_dat":new_he_dat,
                "st_he_buffer": st_he_buffer
            }

            xhttp_surat = new XMLHttpRequest();
            xhttp_surat.onload = function () {
                var jsonResponse = JSON.parse(this.responseText);
                if (this.status == 200) {
                    window.location.assign(jsonResponse.redirect_url);
                }
                if (this.status == 400) {
                    var message = jsonResponse['message'];
                    
                    // scroll to top just to have the same ux with other pages
                    window.scrollTo(0,0);

                    // if error message for operator fields exist
                    if(message['heavy']){
                        var divErrorHeavy = document.getElementById('heavy-error-message');
                        divErrorHeavy.style.display = 'block';
                        divErrorHeavy.innerHTML = message['heavy'];
                    }
                }
            };
            xhttp_surat.open("POST","<?php echo base_URL('administrator/surattugas/edit_heavy')?>");
            xhttp_surat.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp_surat.send(JSON.stringify(data));
        });
    });

    // populate og heavy fields 
    function populateOGHeavy(){
        xhttp_heavy = new XMLHttpRequest();
        xhttp_heavy.onload = function() {
            var obj = JSON.parse(this.responseText);
            vehicle_heavy = obj.vehicle_heavy;
            len_heavy = Object.keys(vehicle_heavy).length;
            var id;
            var i = 0;
            for(;i<len_st_heavy;i++){
                id = `vehicle-heavy-${i}`;
                vehicleHeavySelect = document.getElementById(id);
                vehicleFuelInput = document.getElementById('fuel-'+id);
                initOGHeavy(vehicleHeavySelect,vehicleFuelInput,vehicle_heavy,len_heavy,st_heavy[i].heavy_id,st_heavy[i].heavy_fuel);
                listenOGHeavy(id,'fuel-'+id,selected_og_heavy,st_heavy[i].stHeId);
                buttonId=`vehicle-container--delete-heavy-button-${i}`;
                deleteOG(id,buttonId,selected_og_heavy,deleted_og,st_heavy[i].stHeId);
            }

            addVehicleHeavyButton.addEventListener('click',(event)=> {    
                event.preventDefault();
                var select_id = `vehicle-heavy-${total_heavy}`;
                addVehicle(event,vehicleHeavyContainer,vehicle_heavy,len_heavy,select_id,selected_heavy);
                total_heavy++;
            });
        }
        xhttp_heavy.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_ab')?>");
        xhttp_heavy.send();
    }
</script>
