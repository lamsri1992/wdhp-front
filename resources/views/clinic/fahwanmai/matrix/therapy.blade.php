@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mtx.index') }}">Matrix Program</a></li>
            <li class="breadcrumb-item active">{{ $patient->patient_hn }}</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                ข้อมูลประวัติการเข้ารับบำบัด : {{ $patient->patient_name }}
                                <input id="hn" name="hn" type="hidden" value="{{ $patient->patient_hn }}">
                                <input id="id" name="id" type="hidden" value="{{ $patient->patient_id }}">
                            </h5>
                        </div>
                        <div class="col-md-6 text-end" style="margin-top: 1rem;">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#teleH">
                                <i class="fa-solid fa-video"></i>
                                Tele-Health
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="overflow: auto;height: 36.6rem;">
                            <div class="list-group">
                               <div class="list-thp"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-ccpi-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-ccpi" type="button" role="tab" aria-controls="nav-ccpi"
                                        aria-selected="true">
                                        <i class="fa-solid fa-edit"></i>
                                        ข้อมูลซักประวัติ
                                    </button>
                                    <button class="nav-link" id="nav-lab-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-lab" type="button" role="tab"
                                        aria-controls="nav-lab" aria-selected="false">
                                        <i class="fa-solid fa-flask-vial"></i>
                                        ผล LAB
                                    </button>
                                    <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-order" type="button" role="tab"
                                        aria-controls="nav-order" aria-selected="false">
                                        <i class="fa-solid fa-prescription-bottle-medical"></i>
                                        รายการยา
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-ccpi" role="tabpanel"
                                    aria-labelledby="nav-ccpi-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <div id="weltxt" class="text-center">
                                            <p>เลือกดูรายละเอียดข้อมูลด้านซ้ายมือ</p>
                                        </div>
                                        <div class="ccpi"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-lab" role="tabpanel"
                                    aria-labelledby="nav-lab-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <table id="lab" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 30%;">รหัสแลป</th>
                                                    <th class="" style="width: 40%;">รายการแลป</th>
                                                    <th class="text-center" style="width: 10%;">ผลตรวจแลป</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-order" role="tabpanel"
                                    aria-labelledby="nav-order-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <table id="drug" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 30%;">รหัสยา</th>
                                                    <th class="" style="width: 40%;">รายการยา</th>
                                                    <th class="text-center" style="width: 10%;">จำนวน</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-end">
                                        <small id="vnr"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="teleH" tabindex="-1" aria-labelledby="teleHLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teleHLabel">
                    <i class="fa-solid fa-video"></i>
                    Tele-Health
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <iframe 
                    allow="camera; microphone; fullscreen; display-capture; autoplay" 
                    src="https://meet.jit.si/{{ $patient->patient_hn }}" 
                    style="height: 640px; width: 100%; border: 0px;">
                </iframe> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    ซ่อนหน้าต่าง
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $( document ).ready(function() {
        var hn = document.getElementById("hn").value;
        var id = document.getElementById("id").value;
        $.ajax({
            // url: "http://127.0.0.1:8550/matrix/" + hn,
            url: "http://203.157.209.59:8550/matrix/" + hn,
            success: function (data) {
                $('.list-thp').html("");
                for (var i = 0; i < data.length; i++) {
                    var vn = data[i].vn;
                    // Date-Format
                    const json_date = new Date(data[i].vstdate);
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
                    vstdate = formatDate(json_date);

                    var row =
                        $(
                            '<button id="'+ data[i].vn +'" role="button" class="list-group-item list-group-item-action" onclick="vnClick(this)"' + 
                            ' data-id="'+ data[i].vn +'">' +
                                '<div class="d-flex w-100 justify-content-between">' +
                                    '<h5 class="mb-1"><i class="fa-regular fa-calendar"></i> '+ vstdate +'</h5>' +
                                '</div>' +
                                '<p class="mb-1">VN : '+ data[i].vn +'</p>' +
                            '</button>'
                        );
                    $('.list-thp').append(row);
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
    });

    function vnClick(btn) {
        var id = btn.getAttribute("data-id");
        document.getElementById("weltxt").hidden = true;
        $("#vnr").html('VN : '+ id);

        $.ajax({
            // url: "http://127.0.0.1:8550/vst/" + id,
            url: "http://203.157.209.59:8550/vst/" + id,
            success: function (data) {
                $('.ccpi').html("");
                Swal.fire({
                    title: 'กำลังเรียกดูข้อมูลจาก API',
                    text: 'VN : ' + id,
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // console.log('I was closed by the timer')
                    }
                })
                var row =
                    $(
                    '<p style="font-weight:bold;">' +
                        '<i class="fa-solid fa-heart-pulse text-danger"></i> ' +
                        'Vital Sign' + 
                    '</p>' +
                    '<div class="row">' +
                        '<div class="col-md-6">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'BPD' +
                                    '<span style="font-weight:bold;">'+ data[0].bpd +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'BPS' +
                                    '<span style="font-weight:bold;">'+ data[0].bps +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'PULSE' +
                                    '<span style="font-weight:bold;">'+ data[0].pulse +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'RR' +
                                    '<span style="font-weight:bold;">'+ data[0].rr +'</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' + 
                        '<div class="col-md-6">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'TEMPERATURE' +
                                    '<span style="font-weight:bold;">'+ data[0].temperature +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'BW' +
                                    '<span style="font-weight:bold;">'+ data[0].bw +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'HEIGHT' +
                                    '<span style="font-weight:bold;">'+ data[0].height +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'BMI' +
                                    '<span style="font-weight:bold;">'+ data[0].bmi +'</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>' +
                    '<br>' +
                    '<p style="font-weight:bold;">' +
                        '<i class="fa-solid fa-clipboard text-primary"></i> ' +
                        'CCPI' +
                    '</p>' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    '<span style="font-weight:bold;">'+ data[0].cc +'</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>'
                    );
                $('.ccpi').append(row);
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
            // url: "http://127.0.0.1:8550/lab/" + id,
            url: "http://203.157.209.59:8550/lab/" + id,
            success: function (data) {
                $("#lab tbody").html("");
                for (var i = 0; i < data.length; i++) {
                    if (data[i].lab_order_result == 'Positive') {
                        var result = "badge bg-danger";
                    } else if(data[i].lab_order_result == 'Negative') {
                        var result = "badge bg-success";
                    }
                var row =
                    $(
                        '<tr>'+
                            '<td class="text-center">' + data[i].lab_order_number + '</td>' +
                            '<td class="">' + data[i].lab_items_name_ref + '</td>' +
                            '<td class="text-center"><span class="'+ result +'" style="width: 100%;">' + data[i].lab_order_result + '</span></td>' +
                        '</tr>'
                    );
                    $('#lab').append(row);
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
            // url: "http://127.0.0.1:8550/drug/" + id,
            url: "http://203.157.209.59:8550/drug/" + id,
            success: function (data) {
                $("#drug tbody").html("");
                for (var i = 0; i < data.length; i++) {
                var row =
                    $(
                        '<tr>'+
                            '<td class="text-center">' + data[i].icode + '</td>' +
                            '<td class="">' + data[i].name + ' : ' + data[i].therapeutic + '</td>' +
                            '<td class="text-center">' + data[i].qty + '</td>' +
                        '</tr>'
                    );
                    $('#drug').append(row);
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
    }
</script>
@endsection
