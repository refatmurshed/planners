<!-- Main Footer -->
<footer class="main-footer text-muted no-print">
    <div class="pull-right hidden-xs">
        Developed by: Afiya Technology || Version: 1.0 || Release Date: 14 May, 2026
    </div>
    <span>Copyright © Planners & Designers. All rights reserved.</span>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
        </div>

        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>

        <div class="tab-pane" id="control-sidebar-settings-tab"></div>
    </div>
</aside>

<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- =========================
    CORE JS (UNCHANGED)
========================= -->

<script src="{{asset ('assets/admin/jquery.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/bootstrap.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/admin/toastr.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/jquery-confirm.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/adminlte.min.js.download')}}"></script>

<script src="{{asset ('assets/admin/jquery.validate.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/bootstrap-datepicker.min.js.download')}}"></script>
<script src="{{asset ('assets/admin/bootstrap-filestyle.min.js.download')}}"></script>

<!-- DataTables (UNCHANGED) -->
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

<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>

<!-- =========================
    EXISTING INIT (UNCHANGED)
========================= -->

<script>
$(function () {

    var table1 = $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "order": [],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "columnDefs": [
            { "orderable": true, "targets": "_all" }
        ]
    });

    table1.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
</script>

<!-- =========================
    GLOBAL TABLE SYSTEM (NEW)
========================= -->

<script>
let TableSystem = {

    init: function(config){

        this.rowsPerPage = config.rowsPerPage || 100;

        this.tableId = config.tableId;
        this.searchId = config.searchId;
        this.paginationId = config.paginationId;
        this.entryInfoId = config.entryInfoId;
        this.columnClass = config.columnClass;

        this.currentPage = 1;

        this.bind();
        this.search();
        this.render();
    },

    bind: function(){

        this.tbody = document.querySelector(`#${this.tableId} tbody`);
        this.rows = Array.from(this.tbody.querySelectorAll("tr"));
        this.filteredRows = [...this.rows];

        this.searchInput = document.getElementById(this.searchId);
        this.pagination = document.getElementById(this.paginationId);
        this.entryInfo = document.getElementById(this.entryInfoId);
    },

    render: function(){

        this.rows.forEach(r => r.style.display = "none");

        let start = (this.currentPage - 1) * this.rowsPerPage;
        let end = start + this.rowsPerPage;

        this.filteredRows.slice(start, end).forEach(r => r.style.display = "");

        this.updateInfo(start, end);
        this.paginationBuild();
    },

    updateInfo: function(start, end){

        let total = this.filteredRows.length;

        let from = total === 0 ? 0 : start + 1;
        let to = end > total ? total : end;

        if(this.entryInfo){
            this.entryInfo.innerHTML =
                `Showing ${from} to ${to} of ${total} entries`;
        }
    },

    paginationBuild: function(){

        if(!this.pagination) return;

        this.pagination.innerHTML = "";

        let pages = Math.ceil(this.filteredRows.length / this.rowsPerPage);

        for(let i=1;i<=pages;i++){

            let btn = document.createElement("button");

            btn.innerText = i;

            if(i === this.currentPage){
                btn.classList.add("active");
            }

            btn.onclick = () => {
                this.currentPage = i;
                this.render();
            };

            this.pagination.appendChild(btn);
        }
    },

    search: function(){

        if(!this.searchInput) return;

        this.searchInput.addEventListener("keyup", (e)=>{

            let val = e.target.value.toLowerCase();

            this.filteredRows = this.rows.filter(r =>
                r.innerText.toLowerCase().includes(val)
            );

            this.currentPage = 1;

            this.render();
        });
    }
};
</script>

</body>
</html>