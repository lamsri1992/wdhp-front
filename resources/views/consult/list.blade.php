@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ฐานข้อมูลบริการ</a></li>
            <li class="breadcrumb-item active">รายการขอคำปรึกษาแพทย์</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="col-lg-12">
        <div class="row">
            <!-- Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">รายการทั้งหมด</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-clipboard-list text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($tall) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">รอการตอบรับ</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-spinner fa-spin text-info"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($wait) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">รอการตอบกลับ</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-folder-open text-warning"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($read) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ดำเนินการแล้ว</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-clipboard-check text-success"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($answ) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</section>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title">
                                <i class="fa-regular fa-clipboard"></i>
                                รายการขอคำปรึกษาแพทย์
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <table id="tableBasic" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center">ID::</th>
                                    <th class="text-center">VSTNO</th>
                                    <th>NOTE</th>
                                    <th class="text-center">ระดับ</th>
                                    <th class="text-center">หน่วยบริการ</th>
                                    <th class="text-center">วันที่ส่ง</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $res)
                                <tr>
                                    <td class="text-center">{{ $res->id }}</td>
                                    <td class="text-center">{{ $res->vstno }}</td>
                                    <td>{{ $res->note }}</td>
                                    <td class="text-center"><b>{{ $res->level }}</b></td>
                                    <td class="text-center">{{ $res->h_code." : ".$res->h_name }}</td>
                                    <td class="text-center">{{ DateTimeThai($res->created_date) }}</td>
                                    <td class="text-center">
                                        <span class="text-{{ $res->st_color }}">
                                            {!! $res->st_icon !!}
                                            {{ $res->st_name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('consult.show',$res->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fa-solid fa-right-to-bracket"></i>
                                            ตอบรับ
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
        
</script>
@endsection
