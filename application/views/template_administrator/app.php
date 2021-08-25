 <script src="<?php echo base_url() ?>assets/js/angular.js"></script>
        <script src="<?php echo base_url() ?>assets/js/dirPagination.js"></script>
   
                    <script type="text/javascript">
                    var app = angular.module('myApp',[]);

                    app.controller('appCtrl',function($scope,$http){
                        $scope.title = "oke"
                        $scope.isEmpty = false;
                         $scope.lists = [];

                    $scope.getdata = function(){
                        $http.get("<?php echo base_url('/administrator/perencanaan/lists') ?>").then(function(res){
                            console.log(res.data)
                            $scope.lists = res.data;
                            if (res.data.length == 0) {
                                 $scope.isEmpty = false;
                            }else{
                                 $scope.isEmpty = true;
                            }
                        },function errorCallBack(err){
                            console.log(err)
                        })
                    }
            $scope.getdata();

                     $scope.insert_list=      function(){

                        var data = $('#my-form').serialize();

                        $.ajax({
                            url:"<?php echo base_url('/administrator/perencanaan/insert_list') ?>",
                            type:"post",
                            data:data,
                            dataType:"json",
                            success:function(res){
                                console.log(res)
                                $scope.getdata();
                            },error:function(err){
                                console.log(err)
                            }
                        })
                    }

                    $scope.delete = function(x){
                        $http.get("<?php echo base_url('/administrator/perencanaan/delete_list/') ?>"+x).then(function(res){
                            console.log(res.data)
                             $scope.getdata();
                        },function errorCallBack(err){
                            console.log(err)
                        })
                    }


                    $scope.showmodal = function(name){
                        
                        $scope.getPerencanaan();

                        $('#'+name).modal({
                            backdrop:'static',
                            keyboard:false
                        });

                    }

                    $scope.getPerencanaan = function(){
                        $http.get("<?php echo base_url('/administrator/perencanaan/prev_data/') ?>").then(res=>{
                             
                            
                           $scope.prev_data = res.data;
                            
                        },function errorCallBack(err){
                            console.log(err)
                        })
                    }

                    $scope.edited = false;

                    $scope.setdata = function(id){
                         $scope.edited = true;
                        $http.get("<?php echo base_url('/administrator/perencanaan/setdata/') ?>"+id).then(res=>{
                            $('#modal-add').modal('hide')
                            $scope.lists = res.data;
                            if (res.data.length == 0) {
                                 $scope.isEmpty = false;
                            }else{
                                 $scope.isEmpty = true;
                            }

                           $scope.lists = res.data;
                           console.log(res.data)

                        },function errorCallBack(err){
                            console.log(err)
                        })
                    }


                    $scope.updatePr = function(row){
                        $http.post("<?php echo base_url('/administrator/perencanaan/updatepr/') ?>",row).then(res=>{
                              console.log(res.data)
                        },function errorCallBack(err){
                            console.log(err)
                        })

                    }
                    
                    $scope.updatePz = function(row){
                                        $http.post("<?php echo base_url('/administrator/perencanaan/updatepz/') ?>",row).then(res=>{
                                              console.log(res.data)
                                        },function errorCallBack(err){
                                            console.log(err)
                                        })

                                    }




                    });




                    //

                    function updatePr(id){
                       var val = $('#idx-'+id).val();
                       $.ajax({
                        url:"<?php echo base_url('/administrator/perencanaan/updatepx/') ?>"+id+"/"+val,
                        type:"get",
                        success:function(res){
                            console.log(res)
                        },error:function(err){
                            console.log(err)
                        }
                       })
                    }
                    
                     function updatePz(id){
                       let val = $('#idy-'+id).val();
                       let data = {id: id,keterangan: val} 
                       $.ajax({
                        url:"<?php echo base_url('/administrator/perencanaan/updatepy/') ?>",
                        type:"post",
                        data: data,
                        dataType: "json", 
                        success:function(res){
                            console.log(res)
                        },error:function(err){
                            console.log(err)
                        }
                       })
                    }





                   </script>
                   
