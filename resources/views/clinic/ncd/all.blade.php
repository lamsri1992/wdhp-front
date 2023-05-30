@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ncd.index') }}">คลินิกโรคไม่ติดต่อเรื้อรัง</a></li>
            <li class="breadcrumb-item active">ทะเบียนผู้ป่วยคลินิก{{ $clinic->clinic_name }}</li>
        </ol>
    </nav>
</div>
@if (count($incase) >= 1)
<div class="alert alert-dark  alert-dismissible fade show" role="alert">
    <h4 class="alert-heading fw-bold">มีผู้ป่วยรับเข้าดูแลใหม่จำนวน {{ count($incase) }} ราย</h4>
    <small class="text-danger">หากข้อมูลผู้ป่วยรับเข้าไม่ถูกต้อง กรุณาแจ้งกลุ่มงาน NCD รพช.วัดจันทร์ฯ</small>
    <hr>
    <ul>
        @foreach ($incase as $res)
        <li>
            <b>{{ DateThai($res->senddate)." | ".$res->list_hn." - ".$res->prename.$res->fname." ".$res->lname }}</b>
        </li>
        @endforeach
    </ul>
    <a href="#" class="btn btn-sm btn-success"
    onclick="
        Swal.fire({
            title: 'ยืนยันการรับเข้าผู้ป่วยรายใหม่',
            text: 'จำนวน {{ count($incase) }} ราย',
            showCancelButton: true,
            confirmButtonText: `ยืนยัน`,
            cancelButtonText: `ยกเลิก`,
            icon: 'warning',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('ncd.approve',$clinic->clinic_id) }}',
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'รับเข้าผู้ป่วยรายใหม่สำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('')
                        }, 1500);
                    }
                });
            }
    })">
        <i class="fas fa-check"></i>
        ยืนยันรับเข้าใหม่
    </a>
</div>
@endif

<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <i class="fas fa-clinic-medical"></i>
            จำนวนผู้ป่วยแยกตามหน่วยบริการ
        </h5>
        <ul class="list-group">
            @foreach ($count as $res)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $res->h_name }}
                <span class="badge bg-primary rounded-pill" style="width: 5rem;">
                    {{ $res->total." ราย" }}
                </span>
            </li>
            @endforeach
        </ul>
    </div>
</div>


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title">
                                <i class="fa-regular fa-folder-open"></i>
                                ทะเบียนผู้ป่วยคลินิก{{ $clinic->clinic_name }}
                            </h5>
                        </div>
                    </div>
                    <table id="tableList" class="table table-borderless table-striped nowrap" style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">HN</th>
                                <th><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล</th>
                                <th class="text-center">อายุ</th>
                                <th class="text-center">คลินิก</th>
                                <th class="text-center">หน่วยบริการ</th>
                                <th class="text-center">
                                    <i class="fa-regular fa-calendar-check"></i> วันที่ลงทะเบียน
                                </th>
                                <th class="text-center">
                                    <i class="fa-regular fa-calendar-check"></i> วันที่รับเข้า
                                </th>
                                <th class="text-center">
                                    <i class="fa-solid fa-bars"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $res)
                            <tr>
                                <td class="text-center">
                                    <strong>{{ $res->hcode }}</strong>
                                </td>
                                <td>{{ $res->prename.$res->fname." ".$res->lname }}</td>
                                <td class="text-center">{{ GetAge($res->birth)." ปี" }}</td>
                                <td class="text-center">{{ $res->clinic_name }}</td>
                                <td class="text-center text-{{ $res->h_color }}">{{ $res->h_name }}</td>
                                <td class="text-center">{{ DateThai($res->regdate) }}</td>
                                <td class="text-center">
                                    @if ($res->apv_status == 1)
                                    <i class="fas fa-check-circle text-success"></i>
                                    {{ DateThai($res->apv_date) }}
                                    @else
                                    <span class="text-danger">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        รอดำเนินการ
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-secondary btn-sm"
                                    onclick="
                                        Swal.fire({
                                            title: '{{ $res->prename.$res->fname.' '.$res->lname }}',
                                            text: 'ดำเนินการการส่งต่อผู้ป่วย คลินิก{{ $res->clinic_name }}',
                                            showCancelButton: true,
                                            confirmButtonText: `ตกลง`,
                                            cancelButtonText: `ยกเลิก`,
                                            icon: 'warning',
                                            input: 'select',
                                            inputOptions: {
                                                '23736': '23736 - รพช.วัดจันทร์ฯ',
                                                '23976': '23976 - รพ.สต.แม่ตะละ',
                                                '13988': '13988 - รพ.สต.แม่แดด',
                                                '05837': '05837 - รพ.สต.ห้วยบง',
                                                '13989': '13989 - รพ.สต.แม่ละอูป'
                                            },
                                            inputPlaceholder: 'เลือกหน่วยบริการที่รับดูแลต่อ',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                var formData = result.value;
                                                var token = '{{ csrf_token() }}';

                                                $.ajax({
                                                    url: '{{ route('ncd.send',$res->list_id) }}',
                                                    data:{formData: formData,_token: token},
                                                    success: function (data) {
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'ส่งต่อผู้ป่วยสำเร็จ',
                                                            showConfirmButton: false,
                                                            timer: 3000
                                                        })
                                                        window.setTimeout(function () {
                                                            location.replace('')
                                                        }, 1500);
                                                    }
                                                });
                                            }
                                        })">
                                        <i class="fas fa-sign-out-alt"></i>
                                        ส่งต่อผู้ป่วย
                                    </a>
                                    <a href="{{ route('visit.list',base64_encode($res->idcard)) }}" class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-book-medical"></i>
                                        Visit List
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
        $('#tableList').dataTable({  
        lengthMenu: [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
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
            initComplete: function() {
                this.api().columns([4]).every(function() {
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
        }
    });
});
</script>
@endsection
