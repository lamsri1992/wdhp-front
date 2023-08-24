@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกฝากครรภ์</a></li>
            <li class="breadcrumb-item"><a href="#">ทะเบียนฝากครรภ์</a></li>
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
