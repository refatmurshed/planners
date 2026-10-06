<!-- Main Footer -->
<footer class="main-footer text-muted no-print">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Developed by: Refat Murshed || Version: 1.0 || Release Date: 14 May, 2026
    </div>
    <!-- Default to the left -->
    <span>Copyright © Planners & Designers. All rights reserved. </span>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked="">
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset ('assets/admin/jquery.min.js.download')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset ('assets/admin/bootstrap.min.js.download')}}"></script>
<!--toastr-->
<script src="{{asset ('assets/admin/admin/toastr.min.js.download')}}"></script>

<!--jquery-confirm -->
<script src="{{asset ('assets/admin/jquery-confirm.min.js.download')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset ('assets/admin/adminlte.min.js.download')}}"></script>

<script>
    $(document).ready(function () {
            });
</script>


<script src="{{asset ('assets/admin/jquery.validate.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/bootstrap-datepicker.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/bootstrap-filestyle.min.js.download')}}"></script>

<!-- For datatable -->
 
<script>
  $(function () {
    var table1 = $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "ordering": true,
      "order": [],
      "buttons": [
        "copy", "csv", "excel", "pdf", "print", "colvis"
      ],
      "columnDefs": [
          { "orderable": true, "targets": "_all" }
      ]
    });

    // Append the buttons container to a proper place
    table1.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    var table2 = $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
    $(document).ready(function () {
        //copy present address into permanent address
        $("#same_to").on("click",function(){
            var same_to = $(this).is(":checked");
            $("[id^='present_']").each(function(){
                var tmpID = this.id.split('present_')[1];
                $(this).val(same_to?$("#permanent_"+tmpID).val():"");
            });
        });

        $(":file").filestyle();

        //pick date
        $('#appointment_date').datepicker({
            format: "dd M yyyy",
            endDate: '+0d',
            todayHighlight: true,
            autoclose: true
        });

        $('#dob').datepicker({
            format: "dd M yyyy",
            endDate: '+0d',
            todayHighlight: true,
            autoclose: true
        });

        //add validation rules
        $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var check = false;
                return this.optional(element) || regexp.test(value);
            },
            "BD mobile number format only."
        );

        //FOR FORM VALIDATION
        var validator = $('#form').validate({

            rules: {
                "name" : {
                    required : true
                },
                "content" : {
                    required: true
                },
                "mobile_no" : {
                    number: true,
                    regex: /^01[13-9]\d{8}$/
                }
            },
            messages: {
                "name" : "Please enter worker name",
                "content" : "Please enter content",
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },

            submitHandler: function(form) {
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure?',
                    buttons: {
                        confirm: function () {
                            form.submit();
                        },
                        cancel: function () {
                            //$.alert('Canceled!');
                        }
                    }
                });
            }
        });

    });
</script>


<script type="text/javascript">toastr.options = {"closeButton":true,"closeClass":"toast-close-button","closeDuration":300,"closeEasing":"swing","closeHtml":"<button><i class=\"icon-off\"><\/i><\/button>","closeMethod":"fadeOut","closeOnHover":true,"containerId":"toast-container","debug":false,"escapeHtml":false,"extendedTimeOut":10000,"hideDuration":1000,"hideEasing":"linear","hideMethod":"fadeOut","iconClass":"toast-info","iconClasses":{"error":"toast-error","info":"toast-info","success":"toast-success","warning":"toast-warning"},"messageClass":"toast-message","newestOnTop":false,"onHidden":null,"onShown":null,"positionClass":"toast-top-right","preventDuplicates":true,"progressBar":true,"progressClass":"toast-progress","rtl":false,"showDuration":300,"showEasing":"swing","showMethod":"fadeIn","tapToDismiss":true,"target":"body","timeOut":5000,"titleClass":"toast-title","toastClass":"toast"};</script>

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
</body></html>
