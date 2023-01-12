@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.list') }}">ทะเบียนผู้ป่วย</a></li>
            <li class="breadcrumb-item active">แบบประเมินโรคซึมเศร้า 9Q</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-regular fa-smile"></i>
                        แบบประเมินโรคซึมเศร้า 9Q : {{ $patient->patient_name }}
                    </h5>
                    <form action="{{ route('depress.add9Q',$patient->patient_id) }}">
                        <div class="form-row">
                            <div class="col-md-12">
                                <table class="table table-borderless table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ในช่วง 2 สัปดาห์ที่ผ่านมา รวมวันนี้ ท่านมีอาการเหล่านี้บ่อยแค่ไหน</th>
                                            <th><i class="fa-regular fa-check-square"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1. เบื่อ ไม่สนใจอยากทำอะไร</td>
                                            <td>
                                                <select id="9q_1" name="9q_1" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_1') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_1') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_1') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_1') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2. ไม่สบายใจ ซึมเศร้า ท้อแท้</td>
                                            <td>
                                                <select id="9q_2" name="9q_2" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_2') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_2') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_2') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_2') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3. หลับยาก หรือหลับๆ ตื่นๆ หรือหลับมากไป</td>
                                            <td>
                                                <select id="9q_3" name="9q_3" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_3') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_3') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_3') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_3') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4. เหนื่อยง่าย หรือไม่ค่อยมีแรง</td>
                                            <td>
                                                <select id="9q_4" name="9q_4" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_4') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_4') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_4') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_4') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5. เบื่ออาหาร หรือกินมากเกินไป</td>
                                            <td>
                                                <select id="9q_5" name="9q_5" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_5') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_5') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_5') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_5') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6. รู้สึกไม่ดีกับตัวเอง คิดว่าตัวเองล้มเหลว หรือครอบครัวผิดหวัง</td>
                                            <td>
                                                <select id="9q_6" name="9q_6" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_6') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_6') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_6') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_6') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7. สมาธิไม่ดีเวลาทำอะไร เช่น ดูโทรทัศน์ ฟังวิทยุ หรือทำงานที่ต้องใช้ความตั้งใจ</td>
                                            <td>
                                                <select id="9q_7" name="9q_7" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_7') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_7') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_7') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_7') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8. พูดช้า ทำอะไรช้าลงจนคนอื่นสังเกตเห็นได้ หรือกระสับกระส่ายไม่สามารถอยู่นิ่งได้เหมือนที่เคยเป็น</td>
                                            <td>
                                                <select id="9q_8" name="9q_8" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_8') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_8') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_8') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_8') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9. คิดทำร้ายตนเอง หรือคิดว่าถ้าตายไปคงจะดี</td>
                                            <td>
                                                <select id="9q_9" name="9q_9" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="0" {{ old('9q_9') === '0' ? 'selected' : '' }}>
                                                        • ไม่มีเลย
                                                    </option>
                                                    <option value="1" {{ old('9q_9') === '1' ? 'selected' : '' }}>
                                                        • เป็นบางวัน 1-7 วัน
                                                    </option>
                                                    <option value="2" {{ old('9q_9') === '2' ? 'selected' : '' }}>
                                                        • เป็นบ่อย > 7วัน
                                                    </option>
                                                    <option value="3" {{ old('9q_9') === '3' ? 'selected' : '' }}>
                                                        • เป็นทุกวัน
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group text-end">
                            <button type="button" class="btn btn-success" onclick="Swal.fire({
                                title: 'บันทึกแบบประเมินซึมเศร้า 9Q ?',
                                showCancelButton: true,
                                confirmButtonText: `<i class='fa-solid fa-check-circle'></i> บันทึกข้อมูล`,
                                cancelButtonText: `<i class='fa-solid fa-times-circle'></i> ยกเลิก`,
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                } else if (result.isDenied) {
                                    form.reset();
                                }
                            })">
                            <i class="fa-solid fa-save"></i> บันทึกข้อมูล 9Q
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection
