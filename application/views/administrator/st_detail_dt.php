<div class="container-fluid">
    <h5 style="text-align: center;">DETAIL DUMPTRUCK SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas" action="<?php echo base_URL('administrator/surattugas/input_aksi')?>">

        <!-- dumptruck -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            bakground-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
            <div id="vehicle-dt-container">
                <div class="form-group">
                    <label>Dumptruck & BBM (Liter) :</label>
                    <?php 
                        $dtBuff=json_decode($st_dt_og); 
                        $i = 0;
                        foreach($dtBuff as $dt) {
                    ?>
                        <div 
                            id= "div-vehicle-dt-<?php echo $i; ?>" 
                            style="display: grid; grid-template-columns: 3fr 1fr 1fr; grid-gap: 0.75vw;"
                            class="form-group"
                        >
                            <select 
                                name="vehicle-dt-<?php echo $i; ?>" 
                                id="vehicle-dt-<?php echo $i; ?>" 
                                class="form-control" 
                                placeholder="Masukkan Dumptruck" 
                            >
                            </select>
                            <input 
                                type="number" 
                                id="fuel-vehicle-dt-<?php echo $i; ?>"
                                name="fuel-vehicle-dt-<?php echo $i; ?>"
                                class="form-control"
                                placeholder = "Liter"
                            />
                            <button 
                                class="btn btn-danger form-control" 
                                id="vehicle-container--delete-dt-button-<?php echo $i; ?>" 
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
            <div style="display: none" class="text-danger small ml-3" id="dt-error-message"></div>
                <div class="form-group">
                    <button class="btn btn-secondary" id="vehicle-container--add-dt-button" onclick="event.preventDefault();">
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
    var st_dt = <?php echo $st_dt_og; ?>;    
    var len_st_dt = st_dt.length; 

    // Get Elements from dom
    var vehicleDTContainer;

    // add button
    var addVehicleDTButton;

    // select element
    var vehicleDTSelect;

    // select og element
    var vehicleOGDTSelect;

    // support variables
    var vehicle_dt;
    var len_dt;

    // total variable (don't use this variable as total counter!
    // use it for select element's unique id)
    var total_dt=len_st_dt;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_dt = new Object();

    // initialize object for og list
    var selected_og_dt = new Object();
    var deleted_og = new Array();

    // populate select's option with vehicle
    function initOGDT(dtSelect,fuelInput,dt,len,ogDTId,ogDTFuel){
        var dtCategory="";
        var option;
        var optgroup;
        for(i=0;i<len;i++){
            option = document.createElement("option");
            optgroup = document.createElement("optgroup");
            if (dtCategory != dt[i].category){
                dtCategory = dt[i].category;
                optgroup.label =  dtCategory;
            }
            dtSelect.appendChild(optgroup);
            option.value=dt[i].id;
            if (dt[i].id == ogDTId) {
                option.selected = "true";
            }
            option.innerHTML=dt[i].plate_number+' / '+dt[i].type;
            dtSelect.appendChild(option);
        }
        fuelInput.value=ogDTFuel;
    }

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_dt;
    var xhttp_surat;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> {

        vehicleDTContainer = document.getElementById("vehicle-dt-container");
        addVehicleDTButton = document.getElementById("vehicle-container--add-dt-button");

        // populate the already initiated form fields from the server 
        // by sending ajax to api noun 
        populateOGDT(); 


        document.getElementById('submit').addEventListener('click',(event)=>{
            event.preventDefault();

            var og_stDt_id = Object.keys(selected_og_dt);
            var og_dt_dat = Object.values(selected_og_dt);        
            var og_dKeys = deleted_og;
            var new_dt_dat = Object.values(selected_dt);
            var st_dt_buffer = new Array();
            var og_dt_id = new Array();

            for (var i=0;i<og_dt_dat.length;i++){
                if (og_dt_dat[i].hasOwnProperty('dt_id')){
                    st_dt_buffer = st_dt_buffer.concat(og_dt_dat[i].dt_id);
                }
            }

            for (var i=0;i<new_dt_dat.length;i++){
                if (new_dt_dat[i].hasOwnProperty('dt_id')){
                    st_dt_buffer = st_dt_buffer.concat(new_dt_dat[i].dt_id);
                }
            }
            
            for (var i=0;i<len_st_dt;i++){
                if (!og_stDt_id.includes(st_dt[i].stDTId) && !deleted_og.includes(st_dt[i].stDTId)){
                    st_dt_buffer = st_dt_buffer.concat(st_dt[i].dt_id);
                }
            }

            var data = {
                "og_sId": stId,
                "og_keys": og_stDt_id,
                "og_dat": og_dt_dat,
                "og_dKeys":deleted_og,
                "new_dat":new_dt_dat,
                "st_dt_buffer": st_dt_buffer
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
                    if(message['dt']){
                        var divErrorDT = document.getElementById('dt-error-message');
                        divErrorDT.style.display = 'block';
                        divErrorDT.innerHTML = message['dt'];
                    }
                }
            }
            xhttp_surat.open("POST","<?php echo base_URL('administrator/surattugas/edit_dt')?>")
            xhttp_surat.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp_surat.send(JSON.stringify(data));
        });

    });

    function populateOGDT(){
        xhttp_dt = new XMLHttpRequest();

        xhttp_dt.onload = function() {
            var obj = JSON.parse(this.responseText);
            vehicle_dt = obj.vehicle_dt;
            len_dt = Object.keys(vehicle_dt).length;
            var id;
            var i = 0;
            for(;i<len_st_dt;i++){
                id = `vehicle-dt-${i}`;
                vehicleDTSelect = document.getElementById(id);
                vehicleFuelInput = document.getElementById('fuel-'+id);
                initOGDT(vehicleDTSelect,vehicleFuelInput,vehicle_dt,len_dt,st_dt[i].dt_id,st_dt[i].dt_fuel); 
                listenOGDT(id,'fuel-'+id,selected_og_dt,st_dt[i].stDTId);
                buttonId=`vehicle-container--delete-dt-button-${i}`;
                deleteOG(id,buttonId,selected_og_dt,deleted_og,st_dt[i].stDTId);
            }
            
            addVehicleDTButton.addEventListener('click',(event)=>{ 
                event.preventDefault();
                var select_id = `vehicle-dt-${total_dt}`;
                addVehicle(event,vehicleDTContainer,vehicle_dt,len_dt,select_id,selected_dt);
                total_dt++;
            });
        }

        xhttp_dt.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_dt')?>");
        xhttp_dt.send();
    }
    
    // event listener for og fields
    function listenOGDT(selectId,fuelId,selectedOG,st_dt_id) {

        document.getElementById(selectId).addEventListener('change',(event)=>{
            var idValue = document.getElementById(selectId).value;
            var fuelValue = document.getElementById(fuelId).value;
            if (selectedOG.hasOwnProperty(st_dt_id)){
                selectedOG[st_dt_id].dt_id = idValue;
            } else {
                selectedOG[st_dt_id] = {'dt_id':idValue,'dt_fuel':fuelValue}
            }
        });

        document.getElementById(fuelId).addEventListener('change',(event)=>{
            var idValue = document.getElementById(selectId).value;
            var fuelValue = document.getElementById(fuelId).value;
            if (selectedOG.hasOwnProperty(st_dt_id)){
                selectedOG[st_dt_id].dt_fuel = fuelValue;
            } else {
                selectedOG[st_dt_id]={'dt_fuel':fuelValue,'dt_id':idValue};
            }
        });

    }

    function deleteOG(selectId,buttonId,selectedOG,deletedOG,st_dt_id) {
        document.getElementById(buttonId).addEventListener('click',(event)=>{
            event.preventDefault();
            document.getElementById('div-'+selectId).style="display:none";
            deletedOG.push(st_dt_id);
            if (selectedOG.hasOwnProperty(st_dt_id)){
                delete selectedOG[st_dt_id];
            }
        });
    }

    var addVehicle = function (event,container,dt,len,select_id,selected) {

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

        var dtCategory="";
        var dtSubcategory="";
        var option;
        var optgroup;

        for(i=0;i<len;i++){
            option = document.createElement("option");
            optgroup = document.createElement("optgroup");
            if (dtCategory != dt[i].category){
                dtCategory = dt[i].category;
            }
            if (dtSubcategory != dt[i].sub_category){
                dtSubcategory = dt[i].sub_category;
                if (dtCategory == dtSubcategory) {
                    optgroup.label =  dtCategory;
                } else {
                    optgroup.label =  dtCategory+" "+dt[i].sub_category;
                }
                select.appendChild(optgroup);
            }
            option.value=dt[i].id;
            if(dt[i].plate_number)
            {
                option.innerHTML=dt[i].plate_number+' / '+dt[i].type;
            } else {
                option.innerHTML=dt[i].serial_number+' / '+dt[i].type;
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
            'dt_id': select.value,
            'dt_fuel': 0,
            'surat_id': stId
        };

        select.addEventListener('change',(event)=>{
            selected[div.id].dt_id=select.value;
        });

        input.addEventListener('change',(event)=>{
            selected[div.id].dt_fuel=input.value;
        });

        deleteButton.addEventListener('click',(event)=>{
            event.preventDefault();
            divGrid.remove();
            delete selected[div.id];
        });
    }
    
</script>
