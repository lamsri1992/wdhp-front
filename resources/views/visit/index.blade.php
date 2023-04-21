@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ฐานข้อมูลบริการ</a></li>
            <li class="breadcrumb-item active">ประวัติการรับบริการ</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">
                        <i class="fa-solid fa-search"></i>
                        ค้นหาประวัติการรับบริการ
                    </h5>
                    <div class="container-fluid">
                        <form id="frm_search" action="{{ route('visit.search') }}">
                            <div class="input-group mb-3">
                                <input type="text" id="s_keys" name="s_keys" class="form-control" placeholder="ค้นหาจาก HN / เลข 13 หลัก / ชื่อผู้รับบริการ" aria-describedby="basic-addon2">
                                <a href="#" id="btn_search" class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-search"></i>
                                    &nbsp;ค้นหาข้อมูลประวัติการรับบริการ&nbsp;
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
    $('#btn_search').on('click', function(event){
        $('#frm_search').submit();
        event.preventDefault();
        let timerInterval
        Swal.fire({
            title: 'กำลังค้นหา',
            html: 'Processing...',
            // timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        })
    });
</script>
@endsection
