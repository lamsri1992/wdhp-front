@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกฝากครรภ์</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <p class="mb-0">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span>ช่วงข้อมูลตั้งแต่วันที่</span>
                    ::
                    <span class="fw-bold">
                        {{ DateThai($_REQUEST['dstart'])." - ".DateThai($_REQUEST['dended']) }}
                    </span>
                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">
                        <i class="fa-solid fa-search"></i>
                        รายงาน LAB คลินิกฝากครรภ์
                    </h5>
                    <table id="ancReport" class="tableBasic table table-borderless table-striped nowrap"
                        style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">VN</th>
                                <th class="text-center">HN</th>
                                <th>ผู้รับบริการ</th>
                                <th class="text-center">ICD10</th>
                                <th class="text-center">รายการ LAB</th>
                                <th class="text-center">ผล LAB</th>
                                <th class="text-center">วันที่</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        var dstart = "{{ $_REQUEST['dstart'] }}";
        var dended = "{{ $_REQUEST['dended'] }}";
        var table = $('#ancReport').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            oLanguage: {
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sSearch: '<small><i class="fa fa-search"></i> ค้นหา</small>',
                sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
                sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
                sInfoEmpty: '<small>ไม่มีข้อมูล</small>',
                sInfoFiltered: '<small>(ค้นหาจาก _MAX_ รายการ)</small>',
            },
            dom: 'Bfrtip',
                buttons: {
                    buttons: [
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print',
                            className: 'btn btn-primary',
                            footer: true
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel"></i> Excel',
                            className: 'btn btn-success',
                            footer: true
                        }
                    ],
                    dom: {
                        button: {
                            className: 'btn-sm'
                        }
                    }
                },
                initComplete: function() 
                {
                    this.api().columns([3,4]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value="">แสดงทั้งหมด</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.cells('', column[0]).render('display').sort().unique().each(function(
                            d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                },
                ajax: "http://203.157.209.59:8550/anc/" + dstart + "/" + dended,
                columns: 
                [
                    { data: 'vn' , className: "text-center" },
                    { data: 'hn' , className: "text-center" },
                    { data: 'pname' },
                    { data: 'icd10' , className: "text-center" },
                    { data: 'lab_items_name_ref' , className: "text-center" },
                    { data: 'lab_order_result' , className: "text-center" },
                    { data: 'vstdate' , className: "text-center" , 
                        render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('YYYY-MM-DD');
                    }}
                ],
            });
            
            var myTable = $('#ancReport').DataTable();
            var tableEdits = myTable.rows().data();
            if(tableEdits)
            {
                Swal.fire({
                    icon: 'success',
                    title: 'API CONNECTED',
                    text: 'Query ข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000,
                })
            }
    });
</script>
@endsection
