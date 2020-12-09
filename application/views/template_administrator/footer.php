     <!-- Footer -->
            <footer class="sticky-footer bg-transparent">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto bigger">
                        <span class="bigger-120">
              <strong>Copyright &copy; 2020 Unit Peralatan Dan Perbekalan Dinas Bina Marga Provinsi DKI Jakarta</strong>
            </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

      
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/JavaScript">
    $(document).ready(function() {
    $('#data-tabel').DataTable();
} );
  </script>
    <script type="text/JavaScript">
    $(document).ready(function() {
        if ($('#lk__vin_pn').is(':checked')){ 
            $("div[name='lk__pn_group']").css('display','block');
            $("div[name='lk__sn_group']").css('display','none');
            $("div[name='lk__sn_group'] > select[name='serial_number']").val('NULL').change()
        } else if ($('#lk__vin_sn').is(':checked')){ 
            $("div[name='lk__sn_group']").css('display','block');
            $("div[name='lk__pn_group']").css('display','none');
            $("div[name='lk__pn_group'] > select[name='plate_number']").val('NULL').change()
        }
        $("input[name='lk__jenis_vin']").change(function(e){
            if ($('#lk__vin_pn').is(':checked')){ 
                $("div[name='lk__pn_group']").css('display','block');
                $("div[name='lk__sn_group']").css('display','none');
            $("div[name='lk__sn_group'] > select[name='serial_number']").val('NULL').change()
            } else if ($('#lk__vin_sn').is(':checked')){ 
                $("div[name='lk__sn_group']").css('display','block');
                $("div[name='lk__pn_group']").css('display','none');
                $("div[name='lk__pn_group'] > select[name='plate_number']").val('NULL').change()
            }
        });
        monitorKM();
    });
    function monitorKM() {
        $("input[name^='lk__km']").change(function(e){
            if(checkInputs()) {
                $("#lk__jarak").val(calculate());
            }
        });
    }
    function checkInputs() {
        if (($("input[name='lk__km_onStart']").val() == '') || ($("input[name='lk__km_onFinish']").val() == '')){
            return false;
        }
        return true;
    }
    function calculate(){
        var start = parseInt($("input[name='lk__km_onStart']").val());
        var finish = parseInt($("input[name='lk__km_onFinish']").val());
        return finish-start;
    }
    </script>
</body>

</html>
