@php @$q2 = explode(',',$patient->dep_2q); @$q2_value = $q2[0] + $q2[1]; @endphp
@php @$q9 = explode(',',$patient->dep_9q); @$q9_value = 0; @endphp
@php @$q8 = explode(',',$patient->dep_8q); @$q8_value = 0; @endphp
@foreach ($q9 as $res)
@php @$q9_value += $res; @endphp
@endforeach
@foreach ($q8 as $res)
@php @$q8_value += $res; @endphp
@endforeach
@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.list') }}">ทะเบียนผู้ป่วย</a></li>
            <li class="breadcrumb-item active">แบบประเมินโรคซึมเศร้า</li>
        </ol>
    </nav>
</div>
<div class="pagetitle">
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-regular fa-smile"></i>
                        แบบประเมินโรคซึมเศร้า : {{ $patient->patient_name }}
                    </h5>
                    @if (!isset($patient->dep_patient_id))
                        @include('clinic.form.depress_form')
                    @else
                        @include('clinic.form.depress_data')
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="text-center">
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
    </div>
</section>
@endsection
@section('script')
@if(!isset($patient->dep_id))
<script>
    Swal.fire({
        icon: 'error',
        title: 'ไม่พบข้อมูลการประเมินซึมเศร้า',
        text: 'กรุณาบันทึกข้อมูลประเมินซึมเศร้า'
    })
</script>
@endif
@if($q2_value >= 1 && (!isset($patient->dep_9q)))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'กรุณาทำแบบประเมิน 9Q',
        text: '"เป็นผู้ที่มีความเสี่ยง" หรือ "แนวโน้มที่จะเป็นโรคซึมเศร้า" กรุณาทำแบบประเมิน 9Q ต่อ',
        confirmButtonText: '<a href="{{ route("depress.9Q",$patient->patient_id) }}" class="text-white"><i class="fa-solid fa-clipboard-check"></i> ทำแบบประเมิน 9Q</a>',
        allowOutsideClick: false,
    })
</script>
@endif

@if(@$q9_value >= 7 && (!isset($patient->dep_8q)))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'กรุณาทำแบบประเมิน 8Q',
        text: 'คะแนน 9Q = {{ @$q9_value }} คะแนน , กรุณาทำแบบประเมิน 8Q ต่อ',
        confirmButtonText: '<a href="{{ route("depress.8Q",$patient->patient_id) }}" class="text-white"><i class="fa-solid fa-clipboard-check"></i> ทำแบบประเมิน 8Q</a>',
        allowOutsideClick: false,
    })
</script>
@endif
@endsection
