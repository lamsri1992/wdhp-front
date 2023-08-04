@extends('layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-regular fa-address-card"></i>
                        ระบบยืนยันตัวตน
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <center>
                                <div id="my_camera"></div>
                            </center>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('visit.confirm',$patient->id) }}">
                                @csrf
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">ชื่อ - สกุล</th>
                                        <td>{{ $patient->prename.$patient->fname." ".$patient->lname }}</td>
                                    </tr>
                                    <tr>
                                        <th>หมายเลข 13 หลัก</th>
                                        <td>{{ $patient->idcard }}</td>
                                    </tr>
                                    <tr>
                                        <th>หน่วยบริการ</th>
                                        <td>{{ $patient->h_code." :: ".$patient->h_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>HN</th>
                                        <td>{{ $patient->hcode }}</td>
                                    </tr>
                                    <tr>
                                        <th>ผู้บันทึกข้อมูล</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <input type="hidden" name="image" class="image">
                                            <button id="confirm" class="btn btn-success" onclick="take_snapshot()">
                                                ยินยอมเปิดเผยข้อมูล
                                            </button>
                                            <button class="btn btn-danger">
                                                ไม่ยินยอมเปิดเผยข้อมูล
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <a href="https://www.ratchakitcha.soc.go.th/DATA/PDF/2562/A/069/T_0052.PDF" target="_blank">
                                                <i class="fa-solid fa-book"></i>
                                                พรบ.คุ้มครอบข้อมูลส่วนบุคคล
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
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
    Webcam.set({
        width: 480,
        height: 320,
        image_format: 'jpeg',
        jpeg_quality: 100,
    });
    Webcam.attach('#my_camera');

    function take_snapshot() {
        alert('ยืนยันการเปิดเผยข้อมูล\n{{ $patient->prename.$patient->fname." ".$patient->lname }}')
            Webcam.snap( function(data_uri) {
                $(".image").val(data_uri);
                document.getElementById('snap').innerHTML = '<img src="'+ data_uri +'"/ class="img img-fluid" style="width: 100%;">';
            });
        }
</script>
@endsection
