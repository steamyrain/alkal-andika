<div class="container-fluid">
    <h5 style="text-align: center;">DETAIL HEAVY SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas" action="<?php echo base_URL('administrator/surattugas/input_aksi')?>">

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
    var total_heavy;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_heavy;

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

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_heavy;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> { 
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
            }
        }
        xhttp_heavy.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_ab')?>");
        xhttp_heavy.send();
        /*
        // override submit for debug purposes
        document.getElementById("submit").addEventListener('click',(event)=>{
            event.preventDefault();
            var suratDate = document.getElementById("form-surat-tugas__date").value;
            var suratLocation = document.getElementById("form-surat-tugas__location").value;
            var subjectOperator = Object.values(selected_operator);
            var subjectDriver = Object.values(selected_driver);
            var subjectLabour = Object.values(selected_labour);
            var suratSubject = subjectOperator.concat(subjectDriver,subjectLabour);
            var suratHeavy = Object.values(selected_heavy);
            var suratDT = Object.values(selected_dt);
            var suratTugas = {
                date: suratDate,
                location: suratLocation,
                subject: suratSubject,
                heavy: suratHeavy,
                dt: suratDT
            };
            var xhrSuratTugas = new XMLHttpRequest();
            xhrSuratTugas.open("POST","<?php echo base_URL('administrator/surattugas/input_aksi'); ?>");
            xhrSuratTugas.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhrSuratTugas.send(JSON.stringify(suratTugas));
            xhrSuratTugas.onreadystatechange = function() {
                if((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)){
                    var jsonResponse = JSON.parse(xhrSuratTugas.responseText);
                    window.location.href = jsonResponse['redirect_url'];
                }
                if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                    console.log('redirect');
                    var jsonResponse = JSON.parse(xhrSuratTugas.responseText);
                    window.location.href = jsonResponse['Location'];
                }
                if((this.readyState === XMLHttpRequest.DONE) && (this.status === 400)){
                    // scroll to top just to have the same ux with other pages
                    window.scrollTo(0,0);

                    // initiate support variables
                    var jsonResponse = JSON.parse(xhrSuratTugas.responseText);
                    var message = jsonResponse['message'];

                    // setup proper error messages
                    if(message['date']){
                        var divErrorDate = document.getElementById('date-error-message');
                        divErrorDate.style.display = 'block';
                        divErrorDate.innerHTML = message['date'];
                    }

                    if(message['location']){
                        var divErrorLocation = document.getElementById('location-error-message');
                        divErrorLocation.style.display = 'block';
                        divErrorLocation.innerHTML = message['location'];
                    }

                    if(message['subject']){
                        var divErrorOperator = document.getElementById('operator-error-message');
                        var divErrorDriver = document.getElementById('driver-error-message');
                        var divErrorLabour = document.getElementById('labour-error-message');
                        divErrorOperator.style.display = 'block';
                        divErrorDriver.style.display = 'block';
                        divErrorLabour.style.display = 'block';
                        divErrorOperator.innerHTML = message['subject'];
                        divErrorDriver.innerHTML = message['subject'];
                        divErrorLabour.innerHTML = message['subject'];
                    }

                    if(message['heavy']){
                        var divErrorHeavy = document.getElementById('heavy-error-message');
                        divErrorHeavy.style.display = 'block';
                        divErrorHeavy.innerHTML = message['heavy'];
                    }

                    if(message['dt']){
                        var divErrorDT = document.getElementById('dt-error-message');
                        divErrorDT.style.display = 'block';
                        divErrorDT.innerHTML = message['dt'];
                    }
                }
            }
        },false);

        /*

        // add button
        addVehicleHeavyButton = document.getElementById("vehicle-container--add-heavy-button")

        // total variable (don't use this variable as total counter!
        // use it for select element's unique id)
        total_heavy = 1;

        // initialize object, we use this cause we need the random access through object's keys/properties
        // could use the linked list cause insertion and deletion cost O(1)
        selected_operator = new Object();
        selected_driver = new Object();
        selected_labour = new Object();
        selected_heavy = new Object();
        selected_dt = new Object();

        // populate select's option with vehicle
        //function initVehicle(vehicle,vehicleSelect,)

        // populateOperator populates operator form field
        populateOperators();

        // populateDrivers populates driver form field
        populateDrivers();

        // populateLabours populates labour form field
        populateLabours();

        xhttp_heavy = new XMLHttpRequest();
        xhttp_heavy.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
                var obj = JSON.parse(this.responseText);
                vehicle_heavy = obj.vehicle_heavy;
                len_heavy = Object.keys(vehicle_heavy).length;

                // populate vehicleHeavySelect fields
                var heavyCategory="";
                var heavySubcategory="";
                var option;
                var optgroup;
                for(i=0;i<len_heavy;i++){
                    option = document.createElement("option");
                    optgroup = document.createElement("optgroup");
                    if (heavyCategory != vehicle_heavy[i].category){
                        heavyCategory = vehicle_heavy[i].category;
                    }
                    if (heavySubcategory != vehicle_heavy[i].sub_category){
                        heavySubcategory = vehicle_heavy[i].sub_category;
                        if (heavyCategory == heavySubcategory) {
                            optgroup.label =  heavyCategory;
                        } else {
                            optgroup.label =  heavyCategory+" "+vehicle_heavy[i].sub_category;
                        }
                        vehicleHeavySelect.appendChild(optgroup);
                    }
                    option.value=vehicle_heavy[i].id;
                    if(vehicle_heavy[i].plate_number)
                    {
                        option.innerHTML=vehicle_heavy[i].plate_number+' / '+vehicle_heavy[i].type;
                    } else {
                        option.innerHTML=vehicle_heavy[i].serial_number+' / '+vehicle_heavy[i].type;
                    }
                    vehicleHeavySelect.appendChild(option);
                }

                selected_heavy['div-vehicle-heavy-0'] = {
                    "vehicle-heavy-0": vehicleHeavySelect.value, 
                    "fuel-vehicle-heavy-0": 0
                }; 
                
                vehicleHeavySelect.addEventListener('change',(event)=>{
                    selected_heavy['div-vehicle-heavy-0']["vehicle-heavy-0"]=vehicleHeavySelect.value;
                });

                document.getElementById('fuel-vehicle-heavy-0').addEventListener('change',(event)=>{
                    selected_heavy['div-vehicle-heavy-0']['fuel-vehicle-heavy-0']=document.getElementById('fuel-vehicle-heavy-0').value;
                });

                deleteVehicleHeavyButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var div = document.getElementById('div-vehicle-heavy-0');
                    div.remove();
                    delete selected_heavy['div-vehicle-heavy-0'];
                });

                // logic for addVehicleButton
                addVehicleHeavyButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var selectId = `vehicle-heavy-${total_heavy}`;
                    var div = document.createElement("div");
                    var select = document.createElement("select");
                    var input = document.createElement("input");
                    var deleteButton = document.createElement("button");
                    var divGrid = document.createElement("div");
                    div.className = "form-group";
                    div.id = `div-${selectId}`;
                    select.className="form-control";
                    select.id=selectId;
                    input.type="number";
                    input.id=`fuel-${selectId}`;
                    input.className="form-control";
                    input.placeholder="Liter"
                    deleteButton.innerHTML="hapus";
                    deleteButton.className="form-control btn btn-danger"

                    var heavyCategory="";
                    var heavySubcategory="";
                    var option;
                    var optgroup;
                    for(i=0;i<len_heavy;i++){
                        option = document.createElement("option");
                        optgroup = document.createElement("optgroup");
                        if (heavyCategory != vehicle_heavy[i].category){
                            heavyCategory = vehicle_heavy[i].category;
                        }
                        if (heavySubcategory != vehicle_heavy[i].sub_category){
                            heavySubcategory = vehicle_heavy[i].sub_category;
                            if (heavyCategory == heavySubcategory) {
                                optgroup.label =  heavyCategory;
                            } else {
                                optgroup.label =  heavyCategory+" "+vehicle_heavy[i].sub_category;
                            }
                            select.appendChild(optgroup);
                        }
                        option.value=vehicle_heavy[i].id;
                        if(vehicle_heavy[i].plate_number)
                        {
                            option.innerHTML=vehicle_heavy[i].plate_number+' / '+vehicle_heavy[i].type;
                        } else {
                            option.innerHTML=vehicle_heavy[i].serial_number+' / '+vehicle_heavy[i].type;
                        }
                        select.appendChild(option);
                    } 

                    divGrid.style="display: grid; grid-template-columns: 3fr 1fr 1fr; grid-gap: 0.75vw;";
                    deleteButton.addEventListener('click',(event)=>{event.preventDefault();});
                    divGrid.appendChild(select);
                    divGrid.appendChild(input);
                    divGrid.appendChild(deleteButton);
                    div.appendChild(divGrid);
                    vehicleHeavyContainer.appendChild(div);

                    select.addEventListener('change',(event)=>{
                        selected_heavy[div.id][select.id]=select.value;
                    });
                    input.addEventListener('change',(event)=>{
                        selected_heavy[div.id][input.id]=input.value;
                    });
                    deleteButton.addEventListener('click',(event)=>{
                        event.preventDefault();
                        divGrid.remove();
                        delete selected_heavy[div.id];
                    });
                    var dataHeavy = new Object();
                    dataHeavy[selectId] = select.value;
                    dataHeavy[input.id] = 0;
                    selected_heavy[div.id]=dataHeavy;
                    total_heavy++;
                });
            } 
        }

        xhttp_heavy.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_ab')?>");
        xhttp_heavy.send();

        xhttp_dt = new XMLHttpRequest();
        xhttp_dt.open("GET","<?php echo base_URL('administrator/surattugas/vehicle_dt')?>"); 
        xhttp_dt.send();
        // use function instead of arrow function for assigning callback outside parameter 
        xhttp_dt.onreadystatechange = function() {
            if((this.readyState === XMLHttpRequest.DONE) && (this.status === 307)){
                var jsonResponse = JSON.parse(this.responseText);
                window.location.href = jsonResponse['Location'];
            }
            if ((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)){
                var obj = JSON.parse(this.responseText);
                vehicle_dt = obj.vehicle_dt;
                len_dt = Object.keys(vehicle_dt).length; 

                // populate options for select dt
                var option;
                var optgroup;
                var category = "";
                for (i=0;i<len_dt;i++) {
                    optgroup = document.createElement("optgroup");
                    option = document.createElement("option"); 
                    option.value = vehicle_dt[i].id;
                    option.innerHTML = vehicle_dt[i].plate_number;
                    if (category != vehicle_dt[i].category){
                        optgroup.label = vehicle_dt[i].category;
                        category = vehicle_dt[i].category;
                        vehicleDTSelect.appendChild(optgroup);
                    }
                    vehicleDTSelect.appendChild(option);
                }

                selected_dt['div-vehicle-dt-0']={
                    'vehicle-dt-0': vehicleDTSelect.value,
                    'fuel-vehicle-dt-0': 0
                };

                vehicleDTSelect.addEventListener('change',(event)=>{
                    selected_dt['div-vehicle-dt-0']["vehicle-dt-0"]=vehicleDTSelect.value;
                });

                document.getElementById('fuel-vehicle-dt-0').addEventListener('change',(event)=>{
                    selected_dt['div-vehicle-dt-0']['fuel-vehicle-dt-0']=document.getElementById('fuel-vehicle-dt-0').value;
                });

                deleteVehicleDTButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var div = document.getElementById('div-vehicle-dt-0');
                    div.remove();
                    delete selected_heavy['div-vehicle-dt-0'];
                });

                // logic for addVehicleButton
                addVehicleDTButton.addEventListener('click',(event)=>{
                    event.preventDefault();
                    var selectId = `vehicle-dt-${total_dt}`;
                    var div = document.createElement("div");
                    var select = document.createElement("select");
                    var input = document.createElement("input");
                    var deleteButton = document.createElement("button");
                    var divGrid = document.createElement("div");
                    div.className = "form-group";
                    div.id = `div-${selectId}`;
                    select.className="form-control";
                    select.id=selectId;
                    input.type="number";
                    input.id=`fuel-${selectId}`;
                    input.className="form-control";
                    input.placeholder="Liter"
                    deleteButton.innerHTML="hapus";
                    deleteButton.className="form-control btn btn-danger"

                    var option;
                    var optgroup;
                    var category="";
                    for (i=0;i<len_dt;i++){
                        option= document.createElement("option");
                        optgroup = document.createElement("optgroup");
                        option.value = vehicle_dt[i].id;
                        option.innerHTML = vehicle_dt[i].plate_number;
                        if (category != vehicle_dt[i].category) {
                            optgroup.label = vehicle_dt[i].category;
                            select.appendChild(optgroup);
                            category = vehicle_dt[i].category;
                        } 
                        select.appendChild(option);
                    }
                    var dataDT = new Object();
                    dataDT[select.id] = select.value;
                    dataDT[input.id]=0;
                    selected_dt[div.id] = dataDT;

                    total_dt++;

                    select.addEventListener('change',(event)=>{
                        selected_dt[div.id][select.id]=select.value;
                    });

                    input.addEventListener('change',(event)=>{
                        selected_dt[div.id][input.id]=input.value;
                    });

                    deleteButton.addEventListener('click',(event)=>{
                        event.preventDefault();
                        div.remove();
                        delete selected_heavy[div.id];
                    });

                    divGrid.style="display: grid; grid-template-columns: 3fr 1fr 1fr; grid-gap: 0.75vw;";
                    deleteButton.addEventListener('click',(event)=>{event.preventDefault();});
                    divGrid.appendChild(select);
                    divGrid.appendChild(input);
                    divGrid.appendChild(deleteButton);
                    div.appendChild(divGrid);
                    vehicleDTContainer.appendChild(div);
                }); 
            }
        };
     */
    });
</script>
