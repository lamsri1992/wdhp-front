@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ฐานข้อมูลบริการ</a></li>
            <li class="breadcrumb-item">รายการขอคำปรึกษาแพทย์</li>
            <li class="breadcrumb-item active">VN : {{ $data->vstno }}</li>
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
                                <i class="fa-regular fa-clipboard"></i>
                                VN : {{ $data->vstno }}
                            </h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <h5 class="card-title">
                                <i class="fa-regular fa-folder-open"></i>
                                ผู้เปิดอ่าน : {{ $data->cn_read }}
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless table-striped" border="1">
                                    <tr>
                                        <th>ข้อมูล</th>
                                        <td>ผู้ป่วยเพศ{{ $ptex->sex_name }} / อายุ {{ GetAge($ptex->birth) }} ปี</td>
                                    </tr>
                                    <tr>
                                        <th>หน่วยบริการ</th>
                                        <td>{{ $data->pcucode." : ".$data->h_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>ระดับ</th>
                                        <td>{{ $data->level }}</td>
                                    </tr>
                                    <tr>
                                        <th>บันทึกข้อความ</th>
                                        <td>{{ $data->note }}</td>
                                    </tr>
                                    <tr>
                                        <th>วันที่ส่ง</th>
                                        <td>{{ DateTimeThai($data->created_date) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <p style="font-weight:bold;">
                                    <i class="fa-solid fa-heart-pulse text-danger"></i> 
                                    Vital Sign 
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                ความดัน
                                                <span style="font-weight:bold;">{{ $ovst->pressure }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                อุณหภูมิ
                                                <span style="font-weight:bold;">{{ $ovst->temperature }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                ชีพจร
                                                <span style="font-weight:bold;">{{ $ovst->pulse }}</span>
                                            </li>
                                        </ul>
                                    </div> 
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                RR
                                                <span style="font-weight:bold;">{{ $ovst->respri }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                น้ำหนัก
                                                <span style="font-weight:bold;">{{ $ovst->weight }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                ส่วนสูง
                                                <span style="font-weight:bold;">{{ $ovst->height }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                <p style="font-weight:bold;">
                                    <i class="fa-solid fa-clipboard"></i> 
                                    อาการสำคัญ
                                </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span style="font-weight:bold;">{{ $ovst->symptoms }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <p style="font-weight:bold;">
                                    <i class="fa-solid fa-stethoscope"></i>
                                    การให้รหัสโรค 
                                </p>
                                <table class="table table-borderless table-striped" border="1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ICD10</th>
                                            <th class="">คำอธิบาย</th>
                                            <th class="text-center">dxType</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diag as $res)
                                        <tr>
                                            <td class="text-center">{{ $res->diagcode }}</td> 
                                            <td class="">{{ $res->diseasenamethai }}</td> 
                                            <td class="text-center">{{ $res->dxtypedesc }}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <p style="font-weight:bold;">
                                    <i class="fa-solid fa-file-medical"></i>
                                    รายการตรวจรักษา 
                                </p>
                                <table class="table table-borderless table-striped" border="1">
                                    <thead>
                                        <tr>
                                            <th class="">รายการ</th>
                                            <th class="text-center">Unit</th>
                                            <th class="">คำอธิบาย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($drug as $res)
                                        <tr>
                                            <td class="">{{ $res->drugname }}</td> 
                                            <td class="text-center">{{ $res->unit }}</td> 
                                            <td class="">{{ $res->dose }}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if (!isset($answ))
                            <div class="col-md-12">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#order">
                                    <i class="fa-regular fa-comment-dots"></i>
                                    ความเห็นแพทย์
                                </a>
                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    <p style="font-weight:bold;">
                                        <i class="fa-regular fa-comment-dots"></i>
                                        ความเห็นแพทย์ 
                                    </p>
                                    <p>{{ $answ->cs_text }}</p>
                                    <p>{{ "ผู้ตอบ : ".$answ->cs_respon." / วันที่ ".DateTimeThai($answ->cs_date) }}</p>
                                  </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('consult.answer',$data->id) }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderLabel">
                        <i class="fa-regular fa-comment-dots"></i>
                        ความเห็นแพทย์
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            <i class="fa-regular fa-circle-user"></i>
                            ผู้ให้คำปรึกษา
                        </label>
                        <input type="text" name="cn_respon" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            <i class="fa-regular fa-edit"></i>
                            บันทึกข้อความ
                        </label>
                        <textarea name="cn_txt" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="Swal.fire({
                            title: 'บันทึกการให้คำแนะนำ ?',
                            text: 'VSTNO : {{ $data->vstno }}',
                            showCancelButton: true,
                            confirmButtonText: `<i class='fa-solid fa-check-circle'></i> ยืนยัน`,
                            cancelButtonText: `<i class='fa-solid fa-times-circle'></i> ยกเลิก`,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else if (result.isDenied) {
                                form.reset();
                            }
                        })">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        ตอบกลับเคส
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
        
</script>
@endsection
