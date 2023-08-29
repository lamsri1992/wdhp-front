@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกผู้สูงอายุ</a></li>
            <li class="breadcrumb-item active"><a href="#">ทะเบียนผู้สูงอายุ</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">
                        <i class="fa-solid fa-person-cane"></i>
                        ทะเบียนผู้สูงอายุ
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    // $(document).ready(function () {
    //     var table = $('#ancList').dataTable({
    //         lengthMenu: [
    //             [10, 25, 50, -1],
    //             [10, 25, 50, "All"]
    //         ],
    //         responsive: true,
    //         ordering: false,
    //         oLanguage: {
    //             oPaginate: {
    //                 sFirst: '<small>หน้าแรก</small>',
    //                 sLast: '<small>หน้าสุดท้าย</small>',
    //                 sNext: '<small>ถัดไป</small>',
    //                 sPrevious: '<small>กลับ</small>'
    //             },
    //             sSearch: '<small><i class="fa fa-search"></i> ค้นหา</small>',
    //             sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
    //             sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
    //             sInfoEmpty: '<small>ไม่มีข้อมูล</small>',
    //             sInfoFiltered: '<small>(ค้นหาจาก _MAX_ รายการ)</small>',
    //         },
    //         dom: 'Bfrtip',
    //             buttons: {
    //                 buttons: [
    //                     {
    //                         extend: 'print',
    //                         text: '<i class="fa fa-print"></i> Print',
    //                         className: 'btn btn-primary',
    //                         footer: true
    //                     },
    //                     {
    //                         extend: 'excel',
    //                         text: '<i class="fa fa-file-excel"></i> Excel',
    //                         className: 'btn btn-success',
    //                         footer: true
    //                     }
    //                 ],
    //                 dom: {
    //                     button: {
    //                         className: 'btn-sm'
    //                     }
    //                 }
    //             },
    //             initComplete: function() 
    //             {
    //                 this.api().columns([4,8]).every(function() {
    //                     var column = this;
    //                     var select = $(
    //                             '<select class="form-select" style="text-align-last:center;font-size:14px;">' + 
    //                                 '<option value="">ทั้งหมด</option>' + 
    //                             '</select>'
    //                             )
    //                         .appendTo($(column.footer()).empty())
    //                         .on('change', function() {
    //                             var val = $.fn.dataTable.util.escapeRegex(
    //                                 $(this).val()
    //                             );
    //                             column
    //                                 .search(val ? '^' + val + '$' : '', true, false)
    //                                 .draw();
    //                         });
    //                     column.cells('', column[0]).render('display').sort().unique().each(function(
    //                         d, j) {
    //                         select.append('<option value="' + d + '">' + d + '</option>')
    //                     });
    //                 });
    //             },
    //             ajax: "http://203.157.209.59:8550/anc/list",
    //             // ajax: "http://127.0.0.1:8550/anc/list",
    //             columns: 
    //             [
    //                 { data: 'hn' , className: "fw-bold text-center" },
    //                 { data: 'patient' , className: "" },
    //                 { data: 'reg_date' , className: "text-center" , 
    //                     render: function (data, type, row) {
    //                         if ( data === null ) {
    //                             return '-';
    //                         }
    //                         else {
    //                             return moment(new Date(data).toString()).add(543, 'year').format('L');
    //                         }
    //                     }
    //                 },
    //                 { data: 'preg_no' , className: "text-center" },
    //                 { data: 'has_risk' , className: "text-center" , 
    //                     render: function (data, type, row) {
    //                         if ( data === 'Y' ) {
    //                             return 'มี';
    //                         }
    //                         else {
    //                             return 'ไม่มี';
    //                         }
    //                     }
    //                 },
    //                 { data: 'preg_age' , className: "text-center" },
    //                 { data: 'service_count' , className: "text-center" },
    //                 { data: 'labor_date' , className: "text-center" , 
    //                     render: function (data, type, row) {
    //                         if ( data === null ) {
    //                             return '-';
    //                         }
    //                         else {
    //                             return moment(new Date(data).toString()).add(543, 'year').format('L');
    //                         }
    //                     }
    //                 },
    //                 { data: 'labor_status' , className: "text-center" },
    //                 { data: 'person_anc_id', className: "text-center",
    //                     render: function(data, type, row) {
    //                     return '<a href="{{ url("clinic/anc") }}/'+ data +'"class="btn btn-sm btn-success"><i class="fa-solid fa-book-medical"></i></a>'
    //                     }
    //                 }
    //             ],
    //         });
            
    //     });
</script>
@endsection
