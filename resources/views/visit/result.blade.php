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
                    <div class="col-md-12">
                        <form id="frm_search" action="{{ route('visit.search') }}">
                            <div class="input-group mb-3">
                                <input type="text" id="s_keys" name="s_keys" class="form-control" value="{{ $_REQUEST['s_keys'] }}"
                                placeholder="ค้นหาจาก HN / เลข 13 หลัก / ชื่อผู้รับบริการ" aria-describedby="basic-addon2">
                                <a href="#" id="btn_search" class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-search"></i>
                                    &nbsp;ค้นหาข้อมูลประวัติการรับบริการ&nbsp;
                                </a>
                              </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            พบข้อมูลทั้งหมด 
                            <b>{{ count($result) }} รายการ</b>
                        </div>
                        <table id="visit" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center">:ID</th>
                                    <th class="text-center">DATE</th>
                                    <th class="text-center">หน่วยบริการ</th>
                                    <th class="text-center">VN</th>
                                    <th class="text-center">HN</th>
                                    <th>ผู้รับบริการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $res)
                                <tr>
                                    <td class="text-center">{{ $res->v_id }}</td>
                                    <td class="text-center">{{ DateThai($res->visitdate) }}</td>
                                    <td class="text-center">{{ $res->pcucode." : ".$res->h_name }}</td>
                                    <td class="text-center">{{ $res->visitno }}</td>
                                    <td class="text-center">{{ $res->hcode }}</td>
                                    <td>{{ $res->prename.$res->fname." ".$res->lname }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
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
     $(document).ready(function () {
        $('#visit').dataTable({  
        lengthMenu: [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
            responsive: true,
            oLanguage: {
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sSearch: '<small><i class="fa fa-search"></i> ค้นหา</small>',
                sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
                sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
                sInfoEmpty: '<small>ไม่มีข้อมูล</small>',
                sInfoFiltered: '<small>(ค้นหาจาก _MAX_ รายการ)</small>',
            },
            initComplete: function() {
                this.api().columns([2, 4, 5]).every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value="">แสดงทั้งหมด</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.cells('', column[0]).render('display').sort().unique().each(function(
                        d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
            }
        });
    });

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
