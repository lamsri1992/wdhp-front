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
            url: "http://127.0.0.1:8550/anc/" + pid,
            // url: "http://203.157.209.59:8550/anc/" + pid,
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
                                '<td class=""><b><i class="fa-regular fa-calendar-check"></i> วันที่ฝากครรภ์ : </b>' + reg + ' <small class="text-muted">[ ล่าสุด ]</small></td>' +
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
    });
</script>
@endsection
