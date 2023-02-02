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
            <li class="breadcrumb-item active">{{ $patient->patient_hn }}</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">
                        <i class="fa-solid fa-user-circle"></i>
                        ทะเบียนผู้ป่วย : {{ $patient->patient_hn }}
                    </h5>
                    <form action="{{ route('fah.update',$patient->patient_id) }}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">HN</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input id="hn" name="patient_hn" type="text" class="form-control"
                                        value="{{ $patient->patient_hn }}" disabled
                                    >
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">หมายเลขบัตรประชาชน</label>
                                <input type="text" id="patient_pid" name="patient_pid" class="form-control"
                                    value="{{ $patient->patient_pid }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">ชื่อ-สกุล</label>
                                <input type="text" id="patient_name" name="patient_name" class="form-control"
                                    value="{{ $patient->patient_name }}" placeholder="ระบุชื่อ-สกุล">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">เพศ</label>
                                <select id="patient_gender" name="patient_gender" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($sex as $res)
                                        <option value="{{ $res->sex_id }}"
                                            {{ ($patient->patient_gender == $res->sex_id) ? 'SELECTED' : '' }}>
                                            {{ $res->sex_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">วันเกิด</label>
                                <input type="text" id="patient_dob" name="patient_dob" class="form-control basicDate" value="{{ $patient->patient_dob }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ศาสนา</label>
                                <select id="patient_religion" name="patient_religion" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($religion as $res)
                                        <option value="{{ $res->reg_id }}"
                                            {{ ($patient->patient_religion == $res->reg_id) ? 'SELECTED' : '' }}>
                                            {{ $res->reg_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">สถานภาพ</label>
                                <select id="patient_marriage" name="patient_marriage" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($marriage as $res)
                                        <option value="{{ $res->marry_id }}"
                                            {{ ($patient->patient_marriage == $res->marry_id) ? 'SELECTED' : '' }}>
                                            {{ $res->marry_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">การศึกษา</label>
                                <select id="patient_education" name="patient_education" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($education as $res)
                                        <option value="{{ $res->edu_value }}"
                                            {{ ($patient->patient_education == $res->edu_value) ? 'SELECTED' : '' }}>
                                            {{ $res->edu_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">อาชีพ</label>
                                <select id="patient_job" name="patient_job" class="form-select">
                                    <option>กรุณาเลือก</option>
                                    @foreach($job as $res)
                                        <option value="{{ $res->job_value }}"
                                            {{ ($patient->patient_job == $res->job_value) ? 'SELECTED' : '' }}>
                                            {{ $res->job_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">รายได้</label>
                                <input type="text" id="patient_benefit" name="patient_benefit" class="form-control" value="{{ $patient->patient_benefit }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">โทรศัพท์</label>
                                <input type="text" id="patient_tel" name="patient_tel" class="form-control" pattern="[0-9]" maxlength="10" value="{{ $patient->patient_tel }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">บ้านเลขที่</label>
                                <input type="text" id="patient_hno" name="patient_hno" class="form-control" value="{{ $patient->patient_hno }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ถนน</label>
                                <input type="text" id="patient_hroad" name="patient_hroad" class="form-control" value="{{ $patient->patient_hroad }}">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">หมู่ที่</label>
                                <input type="text" id="patient_hmoo" name="patient_hmoo" class="form-control" value="{{ $patient->patient_hmoo }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">ชื่อหมู่บ้าน</label>
                                <input type="text" id="patient_hmooname" name="patient_hmooname" class="form-control" value="{{ $patient->patient_hmooname }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">ตำบล</label>
                                <select id="patient_htambon" name="patient_htambon" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($district as $res)
                                        <option value="{{ $res->dis_value }}"
                                            {{ ($patient->patient_htambon == $res->dis_value) ? 'SELECTED' : '' }}>
                                            {{ $res->dis_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">อำเภอ</label>
                                <select id="patient_aumphur" name="patient_aumphur" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($aumphur as $res)
                                        <option value="{{ $res->aum_value."00" }}"
                                            {{ ($patient->patient_aumphur == $res->aum_value."00") ? 'SELECTED' : '' }}>
                                            {{ $res->aum_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">จังหวัด</label>
                                <select id="patient_province" name="patient_province" class="basic-select2">
                                    <option>กรุณาเลือก</option>
                                    @foreach($province as $res)
                                        <option value="{{ $res->pro_code."0000" }}"
                                            {{ ($patient->patient_province == $res->pro_code."0000") ? 'SELECTED' : '' }}>
                                            {{ $res->pro_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">ผู้ที่อาศัยอยู่ด้วยใน 30 วันที่ผ่านมา</label>
                                <p style="font-weight: bold;">
                                    {{ $patient->patient_live }}
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">ความสัมพันธ์ระหว่างบิดา-มารดา</label>
                                <p style="font-weight: bold;">
                                    {{ $patient->patient_family }}
                                </p>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">โปรแกรมที่เข้ารับการบำบัด</label>
                                <div class="list-group">
                                    @foreach($program as $res)
                                    <span class="list-group-item list-group-item-action
                                        {{ ($patient->program_id == $res->program_id) ? 'active' : '' }}" aria-current="true">
                                        {{ $res->program_name }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if ($patient->patient_status == 1)
                        <div class="text-end" style="margin-top: 1rem">
                            <a href="{{ route('form.info',$patient->patient_id) }}" class="btn btn-outline-dark">
                                <i class="fa-regular fa-pen-to-square"></i>
                                ข้อมูลรับเข้า
                            </a>
                            <a href="{{ route('form.screen',$patient->patient_id) }}" class="btn btn-outline-dark">
                                <i class="fa-regular fa-file-lines"></i>
                                แบบคัดกรอง
                            </a>
                            <a href="{{ route('form.depress',$patient->patient_id) }}" class="btn btn-outline-dark">
                                <i class="fa-regular fa-face-smile"></i>
                                แบบประเมิน
                            </a>
                            <a href="{{ route('fah.consent',$patient->patient_id) }}" class="btn btn-outline-dark" target="_blank">
                                <i class="fa-solid fa-print"></i> พิมพ์ใบยินยอม
                            </a>
                            <a href="#" id="btnDischarge" class="btn btn-danger">
                                <i class="fa-solid fa-times-circle"></i> Discharge ผู้ป่วย
                            </a>
                            <button type="button" class="btn btn-success"
                                onclick="Swal.fire({
                                    title: 'แก้ไขข้อมูล ?',
                                    text: ' {{ $patient->patient_name }} ',
                                    showCancelButton: true,
                                    confirmButtonText: `<i class='fa-solid fa-edit'></i> แก้ไขข้อมูล`,
                                    cancelButtonText: `<i class='fa-regular fa-times-circle'></i> ยกเลิก`,
                                    icon: 'success',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    } else if (result.isDenied) {
                                        form.reset();
                                    }
                                })">
                                <i class="fa-solid fa-edit"></i> แก้ไขข้อมูล
                            </button>
                        </div>
                        @else
                        <div class="text-center" style="margin-top: 1rem;">
                            <h5 class="fw-bold">
                                ผู้ป่วยถูก Discharge : 
                                <i class="fa-regular fa-calendar-check text-success"></i>
                                วันที่ {{ DateThai($patient->patient_dc_date) }} <br><br>
                                <i class="{!! $patient->status_icon !!} {{ $patient->status_color }}"></i>
                                {{ $patient->status_name }}
                            </h5>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $('#btnDischarge').on("click", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการ Discharge ผู้ป่วย',
            text: '{{ $patient->patient_name }}',
            showCancelButton: true,
            confirmButtonText: `ตกลง`,
            cancelButtonText: `ยกเลิก`,
            icon: 'warning',
            input: 'select',
            inputOptions: {
                3: 'รักษาหายขาด',
                4: 'ติดตามไม่ได้',
                5: 'ยกเลิกการบำบัด'
            },
            inputPlaceholder: 'เลือกหมายเหตุการ Discharge',
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = result.value;
                var token = "{{ csrf_token() }}";
                console.log(formData);
                $.ajax({
                    url: "{{ route('fah.discharge',$patient->patient_id) }}",
                    data:{formData: formData,_token: token},
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Discharge ผู้ป่วยสำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('')
                        }, 1500);
                    }
                });
            }
        })
    });
</script>
@endsection
