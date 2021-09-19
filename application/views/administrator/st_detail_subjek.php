<div class="container-fluid">
    <h5 style="text-align: center;">DETAIL SUBJEK SURAT TUGAS</h5>
    <br>
    <form id="form-surat-tugas">

        <!-- operator -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-operator-container">
            <div class="form-group">
                <label>Operator :</label>
                <?php 
                    $opBuff=json_decode($st_operator_og); 
                    $i = 0;
                    foreach($opBuff as $op) {
                ?>
                    <div 
                        id="div-subject-operator-<?php echo $i; ?>" 
                        style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw;"
                        class="form-group"
                    >
                        <select 
                            name="subject-operator-<?php echo $i; ?>" 
                            id="subject-operator-<?php echo $i; ?>" 
                            class="form-control" 
                            placeholder="Masukkan Nama Operator"
                        > 
                        </select>
                        <button 
                            class="btn btn-danger form-control" 
                            id="subject-container--delete-operator-button-<?php echo $i; ?>"
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
        <div style="display: none" class="text-danger small ml-3" id="operator-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="subject-container--add-operator-button" onclick="event.preventDefault();">
                tambah
            </button>
        </div>
        </div>

        <!-- pengemudi -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-driver-container">
            <div class="form-group">
                <label>Pengemudi :</label>
                <?php 
                    $drBuff=json_decode($st_driver_og); 
                    $i = 0;
                    foreach($drBuff as $dr) {
                ?>
                    <div
                        id="div-subject-driver-<?php echo $i;?>" 
                        style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw;"
                        class="form-group"
                    >
                        <select 
                            name="subject-driver-<?php echo $i;?>" 
                            id="subject-driver-<?php echo $i;?>" 
                            class="form-control" 
                            placeholder="Masukkan Nama Pengemudi"
                        > 
                        </select>
                        <button 
                            class="btn btn-danger form-control" 
                            id="subject-container--delete-driver-button-<?php echo $i;?>"
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
        <div style="display: none" class="text-danger small ml-3" id="driver-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="subject-container--add-driver-button" onclick="event.preventDefault();">
                tambah
            </button>
        </div>
        </div>

        <!-- TK -->
        <div style="
            border: 2px solid rgba(211,211,211,.5); 
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border-radius: 0.5rem; 
            padding: 0.5vw;
            margin-top: 1rem;
        ">
        <div id="subject-labour-container">
            <div class="form-group">
                <label>Tenaga Kerja :</label>
                <?php 
                    $laBuff=json_decode($st_labour_og); 
                    $i = 0;
                    foreach($laBuff as $la) {
                ?>
                    <div 
                        id="div-subject-labour-<?php echo $i; ?>" 
                        style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw;"
                        class="form-group"
                    >
                        <select 
                            name="subject-labour-<?php echo $i; ?>" 
                            id="subject-labour-<?php echo $i; ?>" 
                            class="form-control" 
                            placeholder="Masukkan Nama Tenaga Kerja"
                        > 
                        </select>
                        <button 
                            class="btn btn-danger form-control" 
                            id="subject-container--delete-labour-button-<?php echo $i; ?>" 
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
        <div style="display: none" class="text-danger small ml-3" id="labour-error-message"></div>
        <div class="form-group">
            <button class="btn btn-secondary" id="subject-container--add-labour-button" onclick="event.preventDefault();">
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
    var st_operator = <?php echo $st_operator_og; ?>;    
    var st_driver = <?php echo $st_driver_og; ?>;    
    var st_labour = <?php echo $st_labour_og; ?>;    
    var len_st_operator = st_operator.length; 
    var len_st_driver = st_driver.length; 
    var len_st_labour = st_labour.length; 
    
    // Get Elements from dom
    var subjectDriverContainer; 
    var subjectOperatorContainer;
    var subjectLabourContainer;

    // add button
    var addSubjectDriverButton;
    var addSubjectOperatorButton;
    var addSubjectLabourButton;

    // delete button
    var deleteSubjectLabourButton;
    var deleteSubjectOperatorButton;
    var deleteSubjectDriverButton;

    // select element
    var subjectDriverSelect;
    var subjectOperatorSelect;
    var subjectLabourSelect;

    // support variables
    var subject_operator;
    var len_operator;
    var subject_driver;
    var len_driver;
    var subject_labour;
    var len_labour;

    // total variable (don't use this variable as total counter!
    // use it for select element's unique id)
    var total_operator;
    var total_driver;
    var total_labour;

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_og_operator=new Object();
    var selected_og_driver=new Object();
    var selected_og_labour=new Object();
    var deleted_og=new Array();

    // initialize object, we use this cause we need the random access through object's keys/properties
    // could use the linked list cause insertion and deletion cost O(1)
    var selected_operator=new Object();
    var selected_driver=new Object();
    var selected_labour=new Object();

    // populate select's option with vehicle
    //function initVehicle(vehicle,vehicleSelect,)

    // send xhttp request (could use fetch but not supported by older browser)
    var xhttp_operator;
    var xhttp_driver;
    var xhttp_labour;
    var xhttp_surat;
        
    // All operations will be done when Dom finally loaded
    window.addEventListener("DOMContentLoaded", ()=> { 

        // initialize add button
        addSubjectOperatorButton = document.getElementById('subject-container--add-operator-button');
        addSubjectDriverButton = document.getElementById('subject-container--add-driver-button');
        addSubjectLabourButton = document.getElementById('subject-container--add-labour-button');

        // initialize the container to place new element
        subjectOperatorContainer = document.getElementById("subject-operator-container");
        subjectDriverContainer = document.getElementById("subject-driver-container");
        subjectLabourContainer = document.getElementById("subject-labour-container");

        // total variable (don't use this variable as total counter!
        // use it for select element's unique id)
        total_operator = len_st_operator;
        total_driver = len_st_driver;
        total_labour = len_st_labour;

        // initialize object, we use this cause we need the random access through object's keys/properties
        // could use the linked list cause insertion and deletion cost O(1)
        selected_operator = new Object();
        selected_driver = new Object();
        selected_labour = new Object();

        // populateOGOperators populates original operator form fields
        populateOGOperators();
        
        // populateOGDrivers populates original driver form fields
        populateOGDrivers();
        
        // populateOGLabours populates original labour form fields
        populateOGLabours();

        // override submit 
        document.getElementById("submit").addEventListener('click',(event)=>{

            event.preventDefault();

            var og_stOp_id = Object.keys(selected_og_operator);
            var og_stDr_id = Object.keys(selected_og_driver);
            var og_stLa_id = Object.keys(selected_og_labour);
            var og_op_uId = Object.values(selected_og_operator);
            var og_dr_uId = Object.values(selected_og_driver);
            var og_la_uId = Object.values(selected_og_labour);
            var new_op_uId = Object.values(selected_operator);
            var new_dr_uId = Object.values(selected_driver);
            var new_la_uId = Object.values(selected_labour);
            
            // Send this buffer arrays along with the other data to server,
            // so we can check the uniqueness of these arrays serverside
            // instead of client side, because javascript compatibility
            var stOperatorBuffer = new Array();
            var stDriverBuffer = new Array();
            var stLabourBuffer = new Array();

            // Only concat the og one that hasn't change nor deleted
            for(var i=0;i<len_st_operator;i++){
                if((!og_stOp_id.includes(st_operator[i].stOpId)) && (!deleted_og.includes(st_operator[i].stOpId))){
                    stOperatorBuffer = stOperatorBuffer.concat(st_operator[i].id);
                }
            }

            for(var i=0;i<len_st_driver;i++){
                if((!og_stDr_id.includes(st_driver[i].stDrId)) && (!deleted_og.includes(st_driver[i].stDrId))){
                    stDriverBuffer = stDriverBuffer.concat(st_driver[i].id);
                }
            }

            for(var i=0;i<len_st_labour;i++){
                if((!og_stLa_id.includes(st_labour[i].stLaId)) && (!deleted_og.includes(st_labour[i].stLaId))){
                    stLabourBuffer = stLabourBuffer.concat(st_labour[i].id);
                }
            }

            // concat with new and changed og, so we can check the uniqueness
            stOperatorBuffer = stOperatorBuffer.concat(og_op_uId,new_op_uId);
            stDriverBuffer = stDriverBuffer.concat(og_dr_uId,new_dr_uId);
            stLabourBuffer = stLabourBuffer.concat(og_la_uId,new_la_uId);

            var data = {
                "og_sId": stId,
                "og_keys":og_stOp_id.concat(og_stDr_id,og_stLa_id),
                "og_uId":og_op_uId.concat(og_dr_uId,og_la_uId),
                "new_uId":new_op_uId.concat(new_dr_uId,new_la_uId),
                "og_dKeys":deleted_og,
                "st_op_buffer":stOperatorBuffer,
                "st_dr_buffer":stDriverBuffer,
                "st_la_buffer":stLabourBuffer
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
                    if(message['operator']){
                        var divErrorOperator = document.getElementById('operator-error-message');
                        divErrorOperator.style.display = 'block';
                        divErrorOperator.innerHTML = message['operator'];
                    }

                    if(message['driver']){
                        var divErrorDriver = document.getElementById('driver-error-message');
                        divErrorDriver.style.display = 'block';
                        divErrorDriver.innerHTML = message['driver'];
                    }

                    if(message['labour']){
                        var divErrorLabour = document.getElementById('labour-error-message');
                        divErrorLabour.style.display = 'block';
                        divErrorLabour.innerHTML = message['labour'];
                    }
                }
            };
            xhttp_surat.open("POST","<?php echo base_URL('administrator/surattugas/edit_subject'); ?>");
            xhttp_surat.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp_surat.send(JSON.stringify(data));
        },false);
    });

    // populate select's option with subject 
    function initOGSubject(subjectSelect,subject,len,ogSubjectId) {
        var option;
        for (i=0;i<len;i++){
            option = document.createElement("option");
            option.value=subject[i].id;
            option.innerHTML=subject[i].username;
            if (subject[i].id == ogSubjectId) {
                option.selected = "true";
            }
            subjectSelect.appendChild(option);
        }
    }

    // addSubject function add new form group for selecting surat tugas subject to a container
    var addSubject = function (event,container,subject,len,select_id,selected){

        event.preventDefault();

        var div = document.createElement("div");
        var select = document.createElement("select");
        var divGrid = document.createElement("div");
        var deleteButton = document.createElement("button");
        var option;
                
        div.className = "form-group";
        div.id = `div-${select_id}`
        select.className="form-control";
        select.id=select_id;
        divGrid.style="display: grid; grid-template-columns: 3fr 1fr; grid-gap: 0.75vw";
        deleteButton.innerHTML="hapus";
        deleteButton.className="btn btn-danger form-control"

        for (i=0;i<len;i++){
           option = document.createElement("option");
           option.value=subject[i].id;
           option.innerHTML=subject[i].username;
           select.appendChild(option);
        }

        select.addEventListener('change',(event)=>{
            selected[select_id] = select.value; 
        });

        deleteButton.addEventListener('click',(event)=>{
            event.preventDefault();
            var divSelect = document.getElementById(`div-${select_id}`);
            divSelect.remove();
            delete selected[select_id];
        })

        divGrid.appendChild(select);
        divGrid.appendChild(deleteButton);
        div.appendChild(divGrid);
        container.appendChild(div);

        selected[select_id] = select.value;
    };

    function listenOG(selectId,selectedOG,subject_id) {
        document.getElementById(selectId).addEventListener('change',(event)=>{
            selectedOG[subject_id]=document.getElementById(selectId).value;
        });
    }

    function deleteOG(selectId,buttonId,selectedOG,deletedOG,subject_id) {
        document.getElementById(buttonId).addEventListener('click',(event)=>{
            event.preventDefault();
            document.getElementById('div-'+selectId).style="display:none";
            deletedOG.push(subject_id);
            if (selectedOG.hasOwnProperty(subject_id)){
                delete selectedOG[subject_id];
            }
        });
    }

    function populateOGOperators() {
        xhttp_operator = new XMLHttpRequest();
        xhttp_operator.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_operator = obj.subject_operator;
            len_operator = Object.keys(obj.subject_operator).length;

            // populate og select subject fields
            var i = 0;
            var operatorBuffer;
            var buttonId;
            for (;i<len_st_operator;i++) {
                operatorBuffer = `subject-operator-${i}`;
                subjectOperatorSelect = document.getElementById(operatorBuffer);
                initOGSubject(subjectOperatorSelect,subject_operator,len_operator,st_operator[i].id);
                listenOG(operatorBuffer,selected_og_operator,st_operator[i].stOpId);
                buttonId=`subject-container--delete-operator-button-${i}`;
                deleteOG(operatorBuffer,buttonId,selected_og_operator,deleted_og,st_operator[i].stOpId);
            }

            // add event listener for add button click
            addSubjectOperatorButton.addEventListener('click',(event)=>{
                event.preventDefault();
                var select_id = `subject-operator-${total_operator}`;
                addSubject(event,subjectOperatorContainer,subject_operator,len_operator,select_id,selected_operator);
                total_operator++;
            });

        }; 
        xhttp_operator.open("GET","<?php echo base_URL('administrator/surattugas/subject_operator')?>");
        xhttp_operator.send();
    }

    function populateOGDrivers() {
        xhttp_driver = new XMLHttpRequest();
        xhttp_driver.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_driver = obj.subject_driver;
            len_driver = Object.keys(obj.subject_driver).length;

            // populate og select subject fields
            var i = 0;
            var driverBuffer;
            var buttonId;
            for (;i<len_st_driver;i++) {
                driverBuffer = `subject-driver-${i}`;
                subjectDriverSelect = document.getElementById(driverBuffer);
                initOGSubject(subjectDriverSelect,subject_driver,len_driver,st_driver[i].id);
                listenOG(driverBuffer,selected_og_driver,st_driver[i].stDrId);
                buttonId=`subject-container--delete-driver-button-${i}`;
                deleteOG(driverBuffer,buttonId,selected_og_driver,deleted_og,st_driver[i].stDrId);
            }

            // add event listener for add button click
            addSubjectDriverButton.addEventListener('click',(event)=>{
                event.preventDefault();
                var select_id = `subject-driver-${total_driver}`;
                addSubject(event,subjectDriverContainer,subject_driver,len_driver,select_id,selected_driver);
                total_driver++;
            });

        }; 
        xhttp_driver.open("GET","<?php echo base_URL('administrator/surattugas/subject_driver')?>");
        xhttp_driver.send();
    }

    function populateOGLabours() {
        xhttp_labour = new XMLHttpRequest();
        xhttp_labour.onload = function() {
            var obj = JSON.parse(this.responseText);
            subject_labour = obj.subject_labour;
            len_labour = Object.keys(obj.subject_labour).length;

            // populate og select subject fields
            var i = 0;
            var labourBuffer;
            var buttonId;
            for (;i<len_st_labour;i++) {
                labourBuffer = `subject-labour-${i}`;
                subjectLabourSelect = document.getElementById(labourBuffer);
                initOGSubject(subjectLabourSelect,subject_labour,len_labour,st_labour[i].id);
                listenOG(labourBuffer,selected_og_labour,st_labour[i].stLaId);
                buttonId=`subject-container--delete-labour-button-${i}`;
                deleteOG(labourBuffer,buttonId,selected_og_labour,deleted_og,st_labour[i].stLaId);
            }

            // add event listener for add button click
            addSubjectLabourButton.addEventListener('click',(event)=>{
                event.preventDefault();
                var select_id = `subject-labour-${total_labour}`;
                addSubject(event,subjectLabourContainer,subject_labour,len_labour,select_id,selected_labour);
                total_labour++;
            });


        }; 
        xhttp_labour.open("GET","<?php echo base_URL('administrator/surattugas/subject_labour')?>");
        xhttp_labour.send();
    }

</script>
