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
                        ข้อมูลประวัติการรับเข้าบำบัด : {{ $patient->patient_name }}
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
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">
                                        <i class="fa-solid fa-heart-pulse"></i>
                                        ประวัติการเจ็บป่วย
                                    </button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">
                                        <i class="fa-solid fa-prescription-bottle-medical"></i>
                                        รายการยา
                                    </button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">
                                        <i class="fa-solid fa-flask-vial"></i>
                                        ผล LAB
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        ประวัติการเจ็บป่วย CCPI
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        รายการยา Drug Order
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        รายการผล LAB - Urine
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
                            '<a href="#" class="list-group-item list-group-item-action">' +
                                '<div class="d-flex w-100 justify-content-between">' +
                                    '<h5 class="mb-1"><i class="fa-regular fa-calendar"></i> '+ vstdate +'</h5>' +
                                    '<small class="text-muted">dx F11.2</small>' +
                                '</div>' +
                                '<p class="mb-1">VN : '+ data[i].vn +'</p>' +
                                '<small>ดูรายละเอียดการตรวจรักษา</small>' +
                            '</a>'
                        );
                    $('.list-thp').append(row);
                }
            },
        });
    });
</script>
@endsection
