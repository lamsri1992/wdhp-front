@extends('layouts.app')
@section('content')
<style>
    .select2-selection__rendered {
        line-height: 35px !important;
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
            <li class="breadcrumb-item"><a href="#">การตั้งค่าระบบ</a></li>
            <li class="breadcrumb-item active">ตั้งค่าผู้ใช้งาน</li>
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
                                <i class="fa-solid fa-users"></i>
                                ผู้ใช้งานระบบ
                            </h5>
                        </div>
                        <div class="col-md-6 text-end" style="margin-top: 0.8rem;">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNew">
                                <i class="fa-solid fa-user-plus"></i> เพิ่มผู้ใช้งานใหม่
                            </button>
                        </div>
                    </div>
                    <table id="tableBasic" class="table table-borderless table-striped nowrap"
                    style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="1%">USER : ID</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th><i class="fa-regular fa-id-card"></i> Username</th>
                                <th>Email</th>
                                <th class="text-center">หน่วยบริการ</th>
                                <th class="text-center">สิทธิ์การใช้งาน</th>
                                <th class="text-center">
                                    <i class="fa-solid fa-bars"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $res)
                                <tr>
                                    <td class="text-center">{{ $res->id }}</td>
                                    <td>{{ $res->name }}</td>
                                    <td>{{ $res->username }}</td>
                                    <td>{{ $res->email }}</td>
                                    <td class="text-center">{{ $res->h_code.' : '.$res->h_name }}</td>
                                    <td class="text-center">{{ $res->perm_name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit',$res->id) }}" class="btn btn-secondary btn-circle btn-sm">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a href="{{ route('users.reset',$res->id) }}" class="btn btn-secondary btn-circle btn-sm">
                                            <i class="fa-solid fa-lock-open"></i>
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
</section>
<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('users.add') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">
                        <i class="fa-solid fa-user-plus"></i>
                        เพิ่มผู้ใช้งานใหม่
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="ชื่อ-สกุล">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="email" class="form-control" placeholder="e-mail">
                        </div>
                        <div class="col-md-12">
                            <select name="permission" class="basic-select2">
                                <option></option>
                                @foreach ($perm as $res)
                                <option value="{{ $res->perm_id }}">
                                    {{ $res->perm_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm"
                        onclick="Swal.fire({
                        title: 'เพิ่มผู้ใช้งานใหม่ ?',
                        showCancelButton: true,
                        confirmButtonText: `<i class='fa-solid fa-check-circle'></i> เพิ่มผู้ใช้งาน`,
                        cancelButtonText: `<i class='fa-solid fa-times-circle'></i> ยกเลิก`,
                            icon: 'success',
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                } else if (result.isDenied) {
                                    form.reset();
                            }
                        })">
                        <i class="fa-solid fa-plus-circle"></i>
                        เพิ่มผู้ใช้งานใหม่
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        ปิดหน้าต่าง
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
