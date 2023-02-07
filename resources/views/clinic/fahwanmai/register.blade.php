@extends('layouts.app')
@section('content')
<style>
    .select2-selection__rendered {
        line-height: 38px !important;
    }
    .select2-container .select2-selection--single {
        height: 39px !important;
    }
    .select2-selection__arrow {
        height: 38px !important;
    }
</style>
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.list') }}">ทะเบียนผู้ป่วย</a></li>
            <li class="breadcrumb-item active">ลงทะเบียนใหม่</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-user-plus"></i>
                        ลงทะเบียนผู้ป่วย
                    </h5>
                    <form action="{{ route('fah.add') }}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">HN <span class="text-danger">*</span></label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input id="hn" name="patient_hn" type="text" class="form-control"
                                        value="{{ old('patient_hn') }}"
                                        placeholder="ระบุหมายเลข HN 9 หลัก"
                                        >
                                    <div class="input-group-text">
                                        <a id="hn_find" type="button" style="font-size: 1rem;">
                                            <small class="text-muted">
                                                <i class="fa-solid fa-search"></i> Enter
                                            </small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">หมายเลขบัตรประชาชน</label>
                                <input type="text" id="patient_pid" name="patient_pid" class="form-control"
                                    value="{{ old('patient_pid') }}"
                                    placeholder="ระบุหมายเลขบัตรประชาชน" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">ชื่อ-สกุล</label>
                                <input type="text" id="patient_name" name="patient_name" class="form-control"
                                    value="{{ old('patient_name') }}" placeholder="ระบุชื่อ-สกุล">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">เพศ</label>
                                <select id="patient_gender" name="patient_gender" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($sex as $res)
                                        <option value="{{ $res->sex_id }}">{{ $res->sex_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">วันเกิด</label>
                                <input type="text" id="patient_dob" name="patient_dob" class="form-control"
                                    value="{{ old('patient_dob') }}" placeholder="ระบุวันเกิด">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ศาสนา</label>
                                <select id="patient_religion" name="patient_religion" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($religion as $res)
                                        <option value="{{ '0'.$res->reg_id }}">{{ $res->reg_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">สถานภาพ</label>
                                <select id="patient_marriage" name="patient_marriage" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($marriage as $res)
                                        <option value="{{ $res->marry_id }}">{{ $res->marry_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">การศึกษา</label>
                                <select id="patient_education" name="patient_education" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($education as $res)
                                        <option value="{{ $res->edu_id }}">{{ $res->edu_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">อาชีพ</label>
                                <select id="patient_job" name="patient_job" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($job as $res)
                                        <option value="{{ $res->job_value }}">{{ $res->job_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">รายได้</label>
                                <input type="text" id="patient_benefit" name="patient_benefit" class="form-control"
                                    value="{{ old('patient_benefit') }}" placeholder="ระบุรายได้">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">โทรศัพท์</label>
                                <input type="text" id="patient_tel" name="patient_tel" class="form-control"
                                    value="{{ old('patient_tel') }}" pattern="[0-9]" maxlength="10"
                                    placeholder="ระบุเฉพาะตัวเลข">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">บ้านเลขที่</label>
                                <input type="text" id="patient_hno" name="patient_hno" class="form-control"
                                    value="{{ old('patient_hno') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ถนน</label>
                                <input type="text" id="patient_hroad" name="patient_hroad" class="form-control"
                                    value="{{ old('patient_hroad') }}">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">หมู่ที่</label>
                                <input type="text" id="patient_hmoo" name="patient_hmoo" class="form-control"
                                    value="{{ old('patient_hmoo') }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">ชื่อหมู่บ้าน</label>
                                <input type="text" id="patient_hmooname" name="patient_hmooname" class="form-control"
                                    value="{{ old('patient_hmooname') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ตำบล</label>
                                <select id="patient_htambon" name="patient_htambon" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($district as $res)
                                        <option value="{{ $res->dis_value }}"
                                            {{ old('patient_htambon') === $res->dis_value ? 'selected' : '' }}>
                                            {{ $res->dis_value." : ".$res->dis_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">อำเภอ</label>
                                <select id="patient_aumphur" name="patient_aumphur" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($aumphur as $res)
                                        <option value="{{ $res->aum_value }}"
                                            {{ old('patient_aumphur') === $res->aum_value ? 'selected' : '' }}>
                                            {{ $res->aum_value." : ".$res->aum_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">จังหวัด</label>
                                <select id="patient_province" name="patient_province" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($province as $res)
                                        <option value="{{ $res->pro_code }}"
                                            {{ old('patient_province') === $res->pro_code ? 'selected' : '' }}>
                                            {{ $res->pro_code." : ".$res->pro_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">ผู้ที่อาศัยอยู่ด้วยใน 30 วันที่ผ่านมา</label>
                                <small class="text-danger">สามารถเพิ่มตัวเลือกเองได้</small>
                                <select class="basic-multiple" name="patient_live[]" multiple="multiple">
                                    <option value="อยู่คนเดียว">อยู่คนเดียว</option>
                                    <option value="บิดา">บิดา</option>
                                    <option value="มารดา">มารดา</option>
                                    <option value="คู่สมรส">คู่สมรส</option>
                                    <option value="บุตร">บุตร</option>
                                    <option value="ญาติ">ญาติ</option>
                                    <option value="เพื่อน">เพื่อน</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">ความสัมพันธ์ระหว่างบิดา-มารดา</label>
                                <select id="patient_family" name="patient_family" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    <option value="ไม่ทราบ">ไม่ทราบ</option>
                                    <option value="อยู่ด้วยกันอย่างราบรื่น">อยู่ด้วยกันอย่างราบรื่น</option>
                                    <option value="หย่า">หย่า</option>
                                    <option value="แยกกันอยู่">แยกกันอยู่</option>
                                    <option value="บิดาเสียชีวิต">บิดาเสียชีวิต</option>
                                    <option value="มารดาเสียชีวิต">มารดาเสียชีวิต</option>
                                    <option value="บิดา-มารดาเสียชีวิต">บิดา-มารดาเสียชีวิต</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">โปรแกรมที่เข้ารับการบำบัด</label>
                                <select id="patient_program" name="patient_program" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($program as $res)
                                        <option value="{{ $res->program_id }}">{{ $res->program_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-end" style="margin-top: 1rem">
                            <button type="button" class="btn btn-success"
                                onclick="Swal.fire({
                                    title: 'ลงทะเบียนผู้ป่วยใหม่ ?',
                                    showCancelButton: true,
                                    confirmButtonText: `<i class='fa-solid fa-check-circle'></i> ลงทะเบียน`,
                                    cancelButtonText: `<i class='fa-solid fa-times-circle'></i> ยกเลิก`,
                                    icon: 'success',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    } else if (result.isDenied) {
                                        form.reset();
                                    }
                                })">
                                <i class="fa-solid fa-plus-circle"></i> ลงทะเบียน
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    document.onkeydown = fkey;
    document.onkeypress = fkey
    document.onkeyup = fkey;

    function fkey(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $('#hn_find').click();
        }
    }

    $('#hn_find').click(function () {
        var regSelect = $('#basic-select2');
        var id = document.getElementById("hn").value;
        Swal.fire({
            title: 'กำลังค้นหาข้อมูล',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
            },
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {}
        })
        $.ajax({
            url: "http://203.157.209.59:8550/hn/" + id,
            success: function (result) {
                document.getElementById("hn_find").disabled = true;
                if ($.trim(result)) {

                    // DOB-Format
                    const resbd = new Date(result[0].birthday);
                        function formatDate(date) {
                            var d = new Date(date),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear();

                            if (month.length < 2) 
                                month = '0' + month;
                            if (day.length < 2) 
                                day = '0' + day;
                            return [year, month, day].join('-');
                        }
                    dob = formatDate(resbd);
    
                    $("#patient_pid").val(result[0].cid);
                    $("#patient_name").val(result[0].pname + result[0].fname + " " + result[0].lname);
                    $('#patient_religion').val(result[0].religion);
                    $('#patient_gender').val(result[0].sex);
                    $('#patient_education').val(result[0].educate);
                    $("#patient_job").val(result[0].occupation);
                    $("#patient_dob").val(dob);
                    $("#patient_hno").val(result[0].addrpart);
                    $("#patient_hroad").val(result[0].road);
                    $("#patient_hmoo").val(result[0].moopart);
                    $("#patient_htambon").val(result[0].chwpart + result[0].amppart + result[0].tmbpart).trigger('change');
                    $("#patient_aumphur").val(result[0].chwpart + result[0].amppart).trigger('change');
                    $("#patient_province").val(result[0].chwpart).trigger('change');
                    if ($.trim(result[0].family_status)) {
                        $('#patient_marriage').val(result[0].family_status);
                    } else {
                        $('#patient_marriage').val(9);
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'พบข้อมูล HN: ' + id,
                        text: result[0].pname + result[0].fname + " " + result[0].lname,
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    $("#hn").val("");
                    $("#cid").val("");
                    $("#pname").val("");
                    $("#patient_religion").val("");
                    $("#patient_marriage").val("");
                    $("#patient_education").val("");
                    $("#patient_job").val("");
                    $("#patient_dob").val("");
                    $("#patient_hno").val("");
                    $("#patient_hroad").val("");
                    $("#patient_hmoo").val("");
                    $("#patient_htambon").val("");
                    $("#patient_aumphur").val("");
                    $("#patient_province").val("");
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบ HN: ' + id,
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    })
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

</script>
@endsection

