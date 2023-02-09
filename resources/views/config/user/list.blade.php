@extends('layouts.app')
@section('content')
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
                            <a href="{{ route('users.add') }}" class="btn btn-success">
                                <i class="fa-solid fa-user-plus"></i> เพิ่มผู้ใช้งานใหม่
                            </a>
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
                                    <td class="text-center">
                                        <span class="badge bg-{{ $res->perm_color }}">
                                            {!! $res->perm_icon !!}
                                            {{ $res->perm_name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit',$res->id) }}" class="btn btn-secondary btn-circle btn-sm">
                                            <i class="fa-solid fa-edit"></i>
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
@endsection
@section('script')

@endsection
