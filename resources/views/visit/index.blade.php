@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ฐานข้อมูลบริการ</a></li>
            <li class="breadcrumb-item active">ค้นหาผู้รับบริการ</li>
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
                        <h5 class="card-title">ข้อมูลทั้งหมด</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($patient) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ยืนยันตัวตนแล้ว</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-user-check text-success"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($confirm) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ยังไม่ได้ยืนยันตัวตน</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-user-clock text-warning"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($unconfirmed) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ปฏิเสธการเข้าถึง</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-user-xmark text-danger"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($denied) }} ราย</h6>
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
                    <h5 class="card-title fw-bold">
                        <i class="fa-solid fa-search"></i>
                        ค้นหาผู้รับบริการ
                    </h5>
                    <div class="container-fluid">
                        <form id="frm_search" action="{{ route('visit.search') }}">
                            <div class="input-group mb-3">
                                <input type="text" id="s_keys" name="s_keys" class="form-control" placeholder="ค้นหาจาก HN / เลข 13 หลัก / ชื่อผู้รับบริการ" aria-describedby="basic-addon2">
                                <a href="#" id="btn_search" class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-search"></i>
                                    &nbsp;ค้นหาข้อมูล (Enter)&nbsp;
                                </a>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        Swal.fire({
            icon: 'warning',
            title: 'โปรดระวัง',
            text: 'ความผิดฐานเปิดเผยข้อมูลส่วนบุคคล'+
                'ผู้ใดล่วงรู้ข้อมูลส่วนบุคคลของผู้อื่นเนื่องจากการปฏิบัติหน้าที่ตาม PDPA แล้วนำไปเปิดเผยแก่ผู้อื่น'+
                'ต้องระวางโทษจำคุกไม่เกิน 6 เดือน หรือปรับไม่เกิน 500,000 บาท หรือทั้งจำทั้งปรับ',
            width: '720'
        })
    });
</script>
@endsection
