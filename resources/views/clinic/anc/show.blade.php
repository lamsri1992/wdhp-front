@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกฝากครรภ์</a></li>
            <li class="breadcrumb-item"><a href="{{ route('anc.index') }}">ทะเบียนฝากครรภ์</a></li>
            <li class="breadcrumb-item active"><a href="#">{{ $id }}</a></li>
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
                    {{-- Code Space --}}
                    <input id="pid" name="pid" type="hidden" value="{{ $id }}">
                    <div class="personal"></div>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-service-tab" data-bs-toggle="tab" data-bs-target="#nav-service" type="button" role="tab" aria-controls="nav-service" aria-selected="true">
                                <i class="fa-regular fa-calendar"></i>
                                การเข้ารับบริการ
                            </button>
                            <button class="nav-link" id="nav-risk-tab" data-bs-toggle="tab" data-bs-target="#nav-risk" type="button" role="tab" aria-controls="nav-risk" aria-selected="false">
                                <i class="fa-solid fa-list-check"></i>
                                Risk & Plan
                            </button>
                            <button class="nav-link" id="nav-lab-tab" data-bs-toggle="tab" data-bs-target="#nav-lab" type="button" role="tab" aria-controls="nav-lab" aria-selected="false">
                                <i class="fa-solid fa-flask"></i>
                                ผลแลป ANC
                            </button>
                            <button class="nav-link" id="nav-note-tab" data-bs-toggle="tab" data-bs-target="#nav-note" type="button" role="tab" aria-controls="nav-note" aria-selected="false">
                                <i class="fa-solid fa-pen-to-square"></i>
                                สมุดบันทึก
                            </button>
                            <button class="nav-link" id="nav-refer-tab" data-bs-toggle="tab" data-bs-target="#nav-refer" type="button" role="tab" aria-controls="nav-refer" aria-selected="false">
                                <i class="fa-solid fa-truck-medical"></i>
                                การส่งต่อ
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">
                            <div class="service" style="margin-top: 0.5rem;">
                                <table id="serviceTable" class="table table-bordered table-borderless table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>วันที่รับบริการ</th>
                                            <th>อายุครรภ์</th>
                                            <th>ครั้งที่</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ancPoster">
                                    <small>
                                        <i class="fa-regular fa-hand-point-right"></i>
                                        เกณฑ์คุณภาพการฝากครรภ์
                                    </small>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="ancPoster" tabindex="-1" aria-labelledby="ancPosterLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ancPosterLabel">เกณฑ์คุณภาพการฝากครรภ์</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('img/anc/anc_poster.jpg') }}" class="img img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-risk" role="tabpanel" aria-labelledby="nav-risk-tab">
                            <div style="margin-top: 1rem;">
                                <div class="col-md-6">
                                    <h5>
                                        <i class="fa-solid fa-list-ol"></i>
                                        ระดับความเสี่ยง
                                    </h5>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 1rem;">
                                    <select id="risk_level" class="form-select" onchange="riskFunction()">
                                        @foreach ($score as $res)
                                        <option value="{{ $res->rs_id }}"
                                            {{ (@$iscore->person_level_id == $res->rs_id) ? 'SELECTED' : '' }}>
                                            {{ $res->rs_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="risk" style="margin-top: 0.5rem;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 0.5rem;">
                                            <button type="button" class="btn btn-sm btn-danger insertFrm" data-id="1">
                                                <i class="fa-solid fa-plus"></i>
                                                เพิ่มความเสี่ยง
                                            </button>
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="alert-heading fw-bold">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                Risk : ความเสี่ยง
                                            </span>
                                            <hr>
                                            <ul>
                                                @foreach ($risk as $res)
                                                <li>
                                                    <a href="#">
                                                        {{ $res->risk_text }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 0.5rem;">
                                            <button type="button" class="btn btn-sm btn-success insertFrm" data-id="2">
                                                <i class="fa-solid fa-plus"></i>
                                                เพิ่มการจัดการความเสี่ยง
                                            </button>
                                        </div>
                                        <div class="alert alert-success" role="alert">
                                            <span class="alert-heading fw-bold">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Plan : การจัดการความเสี่ยง
                                            </span>
                                            <hr>
                                            <ul class="">
                                                @foreach ($plan as $res)
                                                <li>
                                                    <a href="#">
                                                        {{ $res->plan_text }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-lab" role="tabpanel" aria-labelledby="nav-lab-tab">
                            <div style="margin-top: 0.5rem;">
                                <div class="accordion" id="accordionLab">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLab-1" aria-expanded="true" aria-controls="collapseLab-1">
                                                LAB ANC # 1
                                            </button>
                                        </h2>
                                        <div id="collapseLab-1" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionLab">
                                            <div class="accordion-body">
                                                <table id="labTable" class="table table-bordered table-borderless table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>วันที่</th>
                                                            <th>VN</th>
                                                            <th>ICD10</th>
                                                            <th>รายการ LAB</th>
                                                            <th>ผลตรวจ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <h2 class="accordion-header" id="heading-2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLab-2" aria-expanded="true" aria-controls="collapseLab-2">
                                                LAB ANC # 2
                                            </button>
                                        </h2>
                                        <div id="collapseLab-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionLab">
                                            <div class="accordion-body">
                                                <table id="labTable2" class="table table-bordered table-borderless table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>VN</th>
                                                            <th width="10%">วันที่ส่งตรวจ</th>
                                                            <th width="20%">รายการ LAB</th>
                                                            <th>ผลตรวจ</th>
                                                            <th width="10%">วันที่รายงานผล</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-note" role="tabpanel" aria-labelledby="nav-note-tab">
                            <div class="margin-top: 0.5rem;">
                                <i class="fa-solid fa-code"></i>
                                อยู่ระหว่างพัฒนาระบบ
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-refer" role="tabpanel" aria-labelledby="nav-refer-tab">
                            <div class="margin-top: 0.5rem;">
                                <i class="fa-solid fa-code"></i>
                                อยู่ระหว่างพัฒนาระบบ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
 $( document ).ready(function() {
        var pid = document.getElementById("pid").value;
        $.ajax({
            // url: "http://127.0.0.1:8550/anc/" + pid,
            url: "http://203.157.209.59:8550/anc/" + pid,
            success: function (data) {
                $('.personal').html("");

                if(data.data[0].nationality == 99){
                    var nat = 'คนไทย';
                }else{
                    var nat = 'ต่างชาติ';
                }

                if(data.data[0].has_risk == 'Y'){
                    var risk = 'มีความเสี่ยง';
                    if(data.data[0].risk_list === null ){
                        var risk_list = '<small class="text-danger"> - ไม่ได้ระบุหมายเหตุ</small>';
                    }else{
                        var risk_list = '<small class="text-danger"> - ' + data.data[0].risk_list + '</small>';
                    }
                }else{
                    var risk = 'ไม่มีความเสี่ยง';
                    var risk_list = '';
                }

                // Date-Format
                const dob_date = new Date(data.data[0].birthday);
                const reg_date = new Date(data.data[0].anc_register_date);
                        function formatDate(date) {
                            var d = new Date(date),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear() + 543;

                            if (month.length < 2) 
                                month = '0' + month;
                            if (day.length < 2) 
                                day = '0' + day;
                            return [day, month, year].join('/');
                        }
                    bd = formatDate(dob_date);
                    reg = formatDate(reg_date);

                    var dob = new Date(data.data[0].birthday);  
                    var month_diff = Date.now() - dob.getTime();  
                    var age_dt = new Date(month_diff);   
                    var year = age_dt.getUTCFullYear();   
                    var age = Math.abs(year - 1970);

                var row =
                    $(
                        '<table class="table table-borderless">' +
                            '<tr>' +
                                '<td class=""><b>HN : </b>' + data.data[0].hn + '</td>' +
                                '<td class=""><b><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล : </b>' + data.data[0].patient + '</td>' +
                                '<td class=""><b>วันเกิด : </b>' + bd + '</td>' +
                                '<td class=""><b>อายุ : </b>' + age + ' ปี</td>' +
                                '<td class=""><b>ประเภท : </b>' + nat + '</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td class=""><b>การตั้งครรภ์ : </b>' + data.data[0].preg_no + ' ครั้ง</td>' +
                                '<td class=""><b><i class="fa-regular fa-calendar-check"></i> วันที่ฝากครรภ์ : </b>' + reg + ' <small class="text-muted">[ ล่าสุด ]</small> ' + 
                                    '<span class="badge bg-success"> อายุครรภ์ - '+ data.data[0].preg_age +' Week</span></td>' +
                                '<td class=""><b>ความเสี่ยง : </b>' + risk + risk_list + '</td>' +
                            '</tr>' +
                        '</table>'
                    );
                $('.personal').append(row);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });

        $.ajax({
            // url: "http://127.0.0.1:8550/service/" + pid,
            url: "http://203.157.209.59:8550/service/" + pid,
            success: function (data) {
                $('#serviceTable tbody').html("");
                for (var i = 0; i < data.data.length; i++) {
                    // Date-Format
                    const sv_date = new Date(data.data[i].anc_service_date);
                            function formatDate(date) {
                                var d = new Date(date),
                                    month = '' + (d.getMonth() + 1),
                                    day = '' + d.getDate(),
                                    year = d.getFullYear() + 543;

                                if (month.length < 2) 
                                    month = '0' + month;
                                if (day.length < 2) 
                                    day = '0' + day;
                                return [day, month, year].join('/');
                            }
                        svdate = formatDate(sv_date);

                        var row =
                        $(
                            '<tr>' +
                                '<td>' + svdate + '</td>' +
                                '<td>' + data.data[i].pa_week + '</td>' +
                                '<td>' + data.data[i].anc_service_number + '</td>' +
                            '</tr>'
                        );
                    $('#serviceTable').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });

        $.ajax({
            // url: "http://127.0.0.1:8550/ancLabs/" + pid,
            url: "http://203.157.209.59:8550/ancLabs/" + pid,
            success: function (data) {
                $('#labTable tbody').html("");
                for (var i = 0; i < data.data.length; i++) {
                    // Date-Format
                    const vst_date = new Date(data.data[i].vstdate);
                    function formatDate(date) {
                        var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear() + 543;
                        
                        if (month.length < 2) 
                            month = '0' + month;
                        if (day.length < 2) 
                            day = '0' + day;
                        return [day, month, year].join('/');
                    }
                    vstdate = formatDate(vst_date);
                    var row =
                    $(
                        '<tr>' +
                            '<td>' + vstdate + '</td>' +
                            '<td>' + data.data[i].vn + '</td>' +
                            '<td>' + data.data[i].icd10 + '</td>' +
                            '<td>' + data.data[i].lab_items_name_ref + '</td>' +
                            '<td>' + data.data[i].lab_order_result + '</td>' +
                        '</tr>'
                    );
                        $('#labTable').append(row);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สามารถเชื่อมต่อ API LAB ANC ได้',
                        text: 'Error: ' + textStatus + ' - ' + errorThrown,
                    })
                }
            });

            $.ajax({
            // url: "http://127.0.0.1:8550/ancLabs2/" + pid,
            url: "http://203.157.209.59:8550/ancLabs2/" + pid,
            success: function (data) {
                $('#labTable2 tbody').html("");
                for (var i = 0; i < data.data.length; i++) {
                    // Date-Format
                    const odr_date = new Date(data.data[i].order_date);
                    const rpt_date = new Date(data.data[i].report_date);
                    function formatDate(date) {
                        var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear() + 543;
                        
                        if (month.length < 2) 
                            month = '0' + month;
                        if (day.length < 2) 
                            day = '0' + day;
                        return [day, month, year].join('/');
                    }
                    odrdate = formatDate(odr_date);
                    rptdate = formatDate(rpt_date);

                    var row =
                    $(
                        '<tr>' +
                            '<td>' + data.data[i].vn + '</td>' +
                            '<td>' + odrdate + '</td>' +
                            '<td>' + data.data[i].lab_items_name_ref + '</td>' +
                            '<td>' + data.data[i].lab_order_result + '</td>' +
                            '<td>' + rptdate + '</td>' +
                        '</tr>'
                    );
                        $('#labTable2').append(row);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สามารถเชื่อมต่อ API LAB ANC ได้',
                        text: 'Error: ' + textStatus + ' - ' + errorThrown,
                    })
                }
            });
    });

    function riskFunction(sel) {
        var val = document.getElementById("risk_level").value;
        var text = $("#risk_level option:selected" ).text();
        var token = "{{ csrf_token() }}";
        Swal.fire({
            icon: 'success',
            title: text,
            text: 'ปรับปรุงระดับความเสี่ยงแล้ว'
        })
        $.ajax({
            url: "{{ route('anc.risk_level',$id) }}",
            data:{val: val,_token: token},
            success: function (data) {
                
            }
        });
    }

    $('.insertFrm').on("click", function (event) {
        var pid = document.getElementById("pid").value;
        var type = $(this).data("id")

        if(type == 1){
            var text = "บันทึกความเสี่ยง";
            var icon = 'warning'
        }else{
            var text = "บันทึกการจัดการความเสี่ยง";
            var icon = 'success'
        }

        event.preventDefault();
        Swal.fire({
            title: text,
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
            icon: icon,
            input: 'text',
            inputPlaceholder: 'กรุณาระบุช่องนี้',
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = result.value;
                var token = "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('anc.risk',$id) }}",
                    data:{formData: formData,type: type,_token: token},
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: formData,
                            showConfirmButton: false,
                            timer: 3500
                        })
                        window.setTimeout(function () {
                            location.replace('')
                        }, 3000);
                    }
                });
            }
        })
    });
</script>
@endsection
