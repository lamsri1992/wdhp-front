@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ncd.index') }}">คลินิกโรคไม่ติดต่อเรื้อรัง</a></li>
            <li class="breadcrumb-item active">รายงานข้อมูลผู้ป่วยคลินิก{{ $cnic->clinic_name }}</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title">
                                <i class="fa-solid fa-print"></i>
                                รายงานข้อมูลผู้ป่วยคลินิก{{ $cnic->clinic_name }}
                            </h5>
                        </div>
                    </div>
                    <table id="exportList" class="table table-borderless table-striped nowrap" style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">HN</th>
                                <th><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล</th>
                                <th class="text-center">อายุ</th>
                                <th class="text-center" width="5%">ความดันล่าสุด</th>
                                <th class="text-center">หน่วยบริการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $res)
                            <tr>
                                <td class="text-center"><strong>{{ $res->hcode }}</strong></td>
                                <td>{{ $res->prename.$res->fname." ".$res->lname }}</td>
                                <td class="text-center fw-bold">{{ GetAge($res->birth)." ปี" }}</td>
                                <td class="text-center">
                                    @php
                                       $bp = str_replace(".000","",$res->pressure);
                                       $bps = explode('/', $bp);
                                       $sys = $bps[0];
                                       $dia = $bps[1];
                                    @endphp
                                    @if ($sys >= 140 && $dia >= 90)
                                    <span class="badge bg-danger" style="width: 100%;font-size: 13px;">
                                        {{ $sys."/".$dia }}
                                    </span>
                                    @else
                                    <span class="badge bg-success" style="width: 100%;font-size: 13px;">
                                        {{ $sys."/".$dia }}
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $res->h_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#exportList').DataTable({
            dom: 'Bfrtip',
                buttons: {
                    buttons: [
                        {
                            extend: 'excel',
                            text: '<i class="fa-solid fa-file-excel"></i> Export',
                            className: 'btn btn-success',
                            footer: true
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa-solid fa-print"></i> Print',
                            className: 'btn btn-secondary',
                            footer: true
                        }
                    ],
                    dom: {
                        button: {
                            className: 'btn-sm'
                        }
                    },
                },
            lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ordering: false,
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
            });
        });
</script>
@endsection
