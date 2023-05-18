@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ฐานข้อมูลบริการ</a></li>
            <li class="breadcrumb-item">ค้นหาผู้รับบริการ</li>
            <li class="breadcrumb-item">{{ $patient->prename.$patient->fname." ".$patient->lname }}</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                ประวัติการเข้ารับบริการ
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="overflow: auto;height: 45rem;">
                            <div class="list-group">
                               <div class="list-thp"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-ccpi-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-ccpi" type="button" role="tab" aria-controls="nav-ccpi"
                                        aria-selected="true">
                                        <i class="fa-solid fa-edit"></i>
                                        ข้อมูลซักประวัติ
                                    </button>
                                    <button class="nav-link" id="nav-dx-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-dx" type="button" role="tab"
                                        aria-controls="nav-dx" aria-selected="false">
                                        <i class="fa-solid fa-comment-medical"></i>
                                        การวินิจฉัย
                                    </button>
                                    <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-order" type="button" role="tab"
                                        aria-controls="nav-order" aria-selected="false">
                                        <i class="fa-solid fa-prescription-bottle-medical"></i>
                                        รายการยา
                                    </button>
                                    <button class="nav-link" id="nav-lab-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-lab" type="button" role="tab"
                                        aria-controls="nav-lab" aria-selected="false">
                                        <i class="fa-solid fa-flask"></i>
                                        รายการ LAB
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-ccpi" role="tabpanel"
                                    aria-labelledby="nav-ccpi-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <div id="weltxt" class="text-center">
                                            <p>เลือกดูรายละเอียดข้อมูลด้านซ้ายมือ</p>
                                        </div>
                                        <div class="ccpi"></div>
                                        <div class="hpi"></div>
                                        <div class="pe"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-dx" role="tabpanel"
                                    aria-labelledby="nav-dx-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <table id="dx" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="">PDX:ID</th>
                                                    <th class="text-center" style="">ICD10</th>
                                                    <th class="" style="">คำอธิบาย</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-order" role="tabpanel"
                                    aria-labelledby="nav-order-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <table id="drug" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="">DGX:ID</th>
                                                    <th class="" style="">รายการยา</th>
                                                    <th class="" style="">คำอธิบาย</th>
                                                    <th class="text-center" style="">Unit</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-lab" role="tabpanel"
                                    aria-labelledby="nav-lab-tab">
                                    <div class="card-body" style="margin-top: 1rem;">
                                        <table id="lab" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: %;">รหัสแลป</th>
                                                    <th class="" style="width: %;">รายการแลป</th>
                                                    <th class="text-center" style="width: %;">ผลตรวจแลป</th>
                                                    <th class="text-center" style="width: %;">วันที่สั่งแลป</th>
                                                    <th class="text-center" style="width: %;">วันที่รายงาน</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-end">
                                        <small id="vnr"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
        $( document ).ready(function() {
        var cid = {{ $patient->idcard }};
        $.ajax({
            url: "/api/history/" + cid,
            success: function (data) {
                $('.list-thp').html("");
                for (var i = 0; i < data.length; i++) {
                    var vn = data[i].visitno;
                    // Date-Format
                    const json_date = new Date(data[i].visitdate);
                        function formatDate(date) {
                            var d = new Date(date),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear() + 543;

                            if (month.length < 2) 
                                month = '0' + month;
                            if (day.length < 2) 
                                day = '0' + day;
                            return [day, month, year].join('/');
                        }
                    vstdate = formatDate(json_date);

                    var row =
                        $(
                            '<button id="'+ data[i].visitno +'" role="button" class="list-group-item list-group-item-action" onclick="vnClick(this)"' + 
                            ' data-id="'+ data[i].visitno +'">' +
                                '<div class="d-flex w-100 justify-content-between">' +
                                    '<h5 class="mb-1"><i class="fa-regular fa-calendar"></i> '+ vstdate +'</h5>' +
                                '</div>' +
                                '<p class="mb-1">VN : '+ data[i].visitno +'</p>' +
                                '<p class="mb-1 badge '+ data[i].h_color +'">'+ data[i].h_name +'</p>' +
                            '</button>'
                        );
                    $('.list-thp').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });
    });

     function vnClick(btn) {
        var id = btn.getAttribute("data-id");
        var element = document.getElementById(id);
            element.classList.add("bg-secondary");
            element.classList.add("text-white");

        document.getElementById("weltxt").hidden = true;
        $("#vnr").html('VN : '+ id);

        $.ajax({
            url: "/api/ccpi/" + id,
            success: function (data) {
                $('.ccpi').html("");
                Swal.fire({
                    title: 'กำลังเรียกดูข้อมูลจาก API',
                    text: 'VN : ' + id,
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // console.log('I was closed by the timer')
                    }
                })
                var row =
                    $(
                    '<p style="font-weight:bold;">' +
                        '<i class="fa-solid fa-heart-pulse text-danger"></i> ' +
                        'Vital Sign' + 
                    '</p>' +
                    '<div class="row">' +
                        '<div class="col-md-6">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'ความดัน' +
                                    '<span style="font-weight:bold;">'+ data[0].pressure +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'อุณหภูมิ' +
                                    '<span style="font-weight:bold;">'+ data[0].temperature +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'ชีพจร' +
                                    '<span style="font-weight:bold;">'+ data[0].pulse +'</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' + 
                        '<div class="col-md-6">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'RR' +
                                    '<span style="font-weight:bold;">'+ data[0].respri +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'น้ำหนัก' +
                                    '<span style="font-weight:bold;">'+ data[0].weight +'</span>' +
                                '</li>' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    'ส่วนสูง' +
                                    '<span style="font-weight:bold;">'+ data[0].height +'</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>' +
                    '<br>' +
                    '<p style="font-weight:bold;">' +
                        '<i class="fa-solid fa-clipboard text-primary"></i> ' +
                        'อาการสำคัญ' +
                    '</p>' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    '<span style="font-weight:bold;">'+ data[0].symptoms +'</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>'
                    );
                $('.ccpi').append(row);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });

        $.ajax({
            url: "/api/hpi/" + id,
            success: function (data) {
                $(".hpi").html("");
                for (var i = 0; i < data.length; i++) {
                var row =
                    $(
                    '<br>' +
                    '<p style="font-weight:bold;">' +
                        '<i class="fa-solid fa-clipboard-list text-success"></i> ' +
                        'HPI' +
                    '</p>' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    '<span>' +
                                        '<b>'+ data[0].h_entry_date + ' ' + data[0].h_entry_time + '</b><br>' + data[0].h_hpi_text +
                                    '</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>'
                    );
                    $('.hpi').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });
        
        $.ajax({
            url: "/api/pe/" + id,
            success: function (data) {
                $(".pe").html("");
                for (var i = 0; i < data.length; i++) {
                var row =
                    $(
                    '<br>' +
                    '<p style="font-weight:bold;">' +
                        '<i class="fa-solid fa-stethoscope text-secondary"></i> ' +
                        'การตรวจร่างกาย' +
                    '</p>' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                    '<span>' + data[0].pe_text + '</span>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>'
                    );
                    $('.pe').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });

        $.ajax({
            url: "/api/diag/" + id,
            success: function (data) {
                $("#dx tbody").html("");
                for (var i = 0; i < data.length; i++) {
                var row =
                    $(
                        '<tr>'+
                            '<td class="text-center">' + data[i].v_dx_id + '</td>' +
                            '<td class="text-center">' + data[i].diagcode + '</td>' +
                            '<td class="">' + data[i].diseasenamethai + '</td>' +
                        '</tr>'
                    );
                    $('#dx').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });

        $.ajax({
            url: "/api/drug/" + id,
            success: function (data) {
                $("#drug tbody").html("");
                for (var i = 0; i < data.length; i++) {
                var row =
                    $(
                        '<tr>'+
                            '<td class="text-center">' + data[i].v_drug_id + '</td>' +
                            '<td class="">' + data[i].drugname + '</td>' +
                            '<td class="">' + data[i].dose + '</td>' +
                            '<td class="text-center">' + data[i].unit + '</td>' +
                        '</tr>'
                    );
                    $('#drug').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });

        $.ajax({
            url: "/api/lab/" + id,
            success: function (data) {
                $("#lab tbody").html("");
                for (var i = 0; i < data.length; i++) {
                var row =
                    $(
                        '<tr>'+
                            '<td class="text-center">' + data[i].v_lab_no + '</td>' +
                            '<td class="">' + data[i].v_lab_name + '</td>' +
                            '<td class="">' + data[i].v_lab_result + '</td>' +
                            '<td class="text-center">' + data[i].lab_order_date + '</td>' +
                            '<td class="text-center">' + data[i].lab_report_date + '</td>' +
                        '</tr>'
                    );
                    $('#lab').append(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถเชื่อมต่อ API ได้',
                    text: 'Error: ' + textStatus + ' - ' + errorThrown,
                })
            }
        });
    }
</script>
@endsection
