@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกฝากครรภ์</a></li>
            <li class="breadcrumb-item active"><a href="#">ทะเบียนฝากครรภ์</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">
                        <i class="fa-solid fa-person-pregnant"></i>
                        ทะเบียนฝากครรภ์
                    </h5>
                    <table id="ancList" class="tableBasic table table-borderless table-striped nowrap"
                        style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">HN</th>
                                <th>ผู้รับบริการ</th>
                                <th class="text-center">วันที่ฝากครรภ์</th>
                                <th class="text-center">จำนวนการตั้งครรภ์</th>
                                <th class="">ความเสี่ยง</th>
                                <th class="">หมายเหตุความเสี่ยง</th>
                                <th class="text-center">อายุครรภ์ : Week</th>
                                <th class="text-center">จำนวนการรับบริการ</th>
                                <th class="text-center">วันที่คลอด</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th width="15%"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th width="15%"></th>
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
        var table = $('#ancList').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            ordering: false,
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
                    this.api().columns([4,9]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select" style="text-align-last:center;font-size:14px;">' + 
                                    '<option value="">ทั้งหมด</option>' + 
                                '</select>'
                                )
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
                ajax: "http://203.157.209.59:8551/anc/list",
                // ajax: "http://127.0.0.1:8550/anc/list",
                columns: 
                [
                    { data: 'hn' , className: "fw-bold text-center" },
                    { data: 'patient' , className: "" },
                    { data: 'reg_date' , className: "text-center" , 
                        render: function (data, type, row) {
                            if ( data === null ) {
                                return '-';
                            }
                            else {
                                return moment(new Date(data).toString()).add(543, 'year').format('L');
                            }
                        }
                    },
                    { data: 'preg_no' , className: "text-center" },
                    { data: 'has_risk' , className: "text-center" , 
                        render: function (data, type, row) {
                            if ( data === 'Y' ) {
                                return 'มี';
                            }
                            else {
                                return 'ไม่มี';
                            }
                        }
                    },
                    { data: 'risk_list' , className: "text-center" },
                    { data: 'preg_age' , className: "text-center" },
                    { data: 'service_count' , className: "text-center" },
                    { data: 'labor_date' , className: "text-center" , 
                        render: function (data, type, row) {
                            if ( data === null ) {
                                return '-';
                            }
                            else {
                                return moment(new Date(data).toString()).add(543, 'year').format('L');
                            }
                        }
                    },
                    { data: 'labor_status' , className: "text-center" },
                    { data: 'person_anc_id', className: "text-center",
                        render: function(data, type, row) {
                        return '<a href="{{ url("clinic/anc") }}/'+ data +'"class="btn btn-sm btn-success"><i class="fa-solid fa-book-medical"></i></a>'
                        }
                    }
                ],
            });
            
            var myTable = $('#ancList').DataTable();
            var tableEdits = myTable.rows().data();
            if(tableEdits)
            {
                Swal.fire({
                    icon: 'success',
                    title: 'API CONNECTED',
                    text: 'เชื่อมต่อข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000,
                })
            }
    });
</script>
@endsection
