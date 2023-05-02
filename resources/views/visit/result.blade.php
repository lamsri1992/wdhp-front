@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">ฐานข้อมูลบริการ</a></li>
                <li class="breadcrumb-item active">ค้นหาผู้รับบริการ</li>
            </ol>
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
                        ค้นหาผู้รับบริการ
                    </h5>
                    <div class="col-md-12">
                        <form id="frm_search" action="{{ route('visit.search') }}">
                            <div class="input-group mb-3">
                                <input type="text" id="s_keys" name="s_keys" class="form-control" value="{{ $_REQUEST['s_keys'] }}"
                                placeholder="ค้นหาจาก HN / เลข 13 หลัก / ชื่อผู้รับบริการ" aria-describedby="basic-addon2">
                                <a href="#" id="btn_search" class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-search"></i>
                                    &nbsp;ค้นหาข้อมูล&nbsp;
                                </a>
                              </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            พบข้อมูลทั้งหมด 
                            <b>{{ count($result) }} รายการ</b>
                        </div>
                        <table id="tableBasic" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center">:ID</th>
                                    <th class="text-center">CID</th>
                                    <th class="text-center">HN</th>
                                    <th>ผู้รับบริการ</th>
                                    <th class="text-center">เพศ</th>
                                    <th class="text-center">วันเกิด</th>
                                    <th class="text-center">อายุ</th>
                                    <th class="text-center">หน่วยบริการ</th>
                                    <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $res)
                                <tr>
                                    <td class="text-center">{{ $res->id }}</td>
                                    <td class="text-center">{{ substr($res->idcard,0,5)."XXXXX".substr($res->idcard,10,20) }}</td>
                                    <td class="text-center">{{ $res->hcode }}</td>
                                    <td>{{ $res->prename.$res->fname." ".$res->lname }}</td>
                                    <td class="text-center">{{ $res->sex_name }}</td>
                                    <td class="text-center">{{ DateThai($res->birth) }}</td>
                                    <td class="text-center">{{ GetAge($res->birth)." ปี" }}</td>
                                    <td class="text-center">{{ $res->pcucodeperson." : ".$res->h_name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('visit.list',base64_encode($res->idcard)) }}" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-book-medical"></i>
                                            Visit List
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @php dump($result) @endphp --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@if (count($result) == 0)
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ไม่พบข้อมูลที่ค้นหา',
            text: 'กรุณาลองใหม่อีกครั้ง',
        })
    </script>
@endif
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
