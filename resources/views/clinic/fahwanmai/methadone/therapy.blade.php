@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item"><a href="{{ route('met.index') }}">Methadone</a></li>
            <li class="breadcrumb-item active">{{ $patient->patient_hn }}</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        ข้อมูลประวัติการเข้ารับบำบัด : {{ $patient->patient_name }}
                        <input id="hn" name="hn" type="hidden" value="{{ $patient->patient_hn }}">
                        <input id="id" name="id" type="hidden" value="{{ $patient->patient_id }}">
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
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
                                    <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-order" type="button" role="tab"
                                        aria-controls="nav-order" aria-selected="false">
                                        <i class="fa-solid fa-prescription-bottle-medical"></i>
                                        รายการยา
                                    </button>
                                    <button class="nav-link" id="nav-lab-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-lab" type="button" role="tab"
                                        aria-controls="nav-lab" aria-selected="false">
                                        <i class="fa-solid fa-flask-vial"></i>
                                        ผล LAB
                                    </button>
                                    <button class="nav-link" id="nav-telehealth-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-telehealth" type="button" role="tab"
                                        aria-controls="nav-telehealth" aria-selected="false">
                                        <i class="fa-solid fa-video"></i>
                                        Tele-Health
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-ccpi" role="tabpanel"
                                    aria-labelledby="nav-ccpi-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <div class="ccpi"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-order" role="tabpanel"
                                    aria-labelledby="nav-order-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        รายการยา Drug Order
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-lab" role="tabpanel"
                                    aria-labelledby="nav-lab-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        รายการผล LAB - Urine
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-telehealth" role="tabpanel"
                                    aria-labelledby="nav-telehealth-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        Tele-Health
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
@endsection
@section('script')
<script>
    $( document ).ready(function() {
        var hn = document.getElementById("hn").value;
        var id = document.getElementById("id").value;
        $.ajax({
            url: "http://127.0.0.1:3000/methadone/" + hn,
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
        });
    });

    function vnClick(btn) {
        var id = btn.getAttribute("data-id");
        // document.getElementById(id).classList.add('active');
        $.ajax({
            url: "http://127.0.0.1:3000/vst/" + id,
            success: function (data) {
                $('.ccpi').html("");
                var row =
                    $(
                    '<span class="badge bg-danger" style="font-size:16px;margin-bottom:0.5rem;">' +
                        '<i class="fa-solid fa-heart-pulse"></i> ' +
                        'Vital Sign' + 
                    '</span>' +
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
                    '<span class="badge bg-danger" style="font-size:16px;margin-bottom:0.5rem;">' +
                        '<i class="fa-solid fa-clipboard"></i> ' +
                        'CCPI' +
                    '</span>' +
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
        });
    }
</script>
@endsection
