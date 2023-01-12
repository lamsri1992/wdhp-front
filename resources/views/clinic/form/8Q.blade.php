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
                        แบบประเมินโรคซึมเศร้า 8Q : {{ $patient->patient_name }}
                    </h5>
                    <form action="{{ route('depress.add8Q',$patient->patient_id) }}">
                        <div class="form-row">
                            <div class="col-md-12">
                                <table class="table table-borderless table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>คำถาม</th>
                                            <th><i class="fa-regular fa-check-square"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1. คิดอยากตาย หรือ คิดว่าตายไปจะดีกว่า</td>
                                            <td>
                                                <select id="8q_1" name="8q_1" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="1"
                                                        {{ old('8q_1') === '1' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_1') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2. อยากทำร้ายตัวเอง หรือ ทำให้ตัวเองบาดเจ็บ</td>
                                            <td>
                                                <select id="8q_2" name="8q_2" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="2"
                                                        {{ old('8q_2') === '2' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_2') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3. คิดเกี่ยวกับการฆ่าตัวตาย</td>
                                            <td>
                                                <select id="8q_3" name="8q_3" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="6"
                                                        {{ old('8q_3') === '6' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_3') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                (ถ้า ข้อ 3. ตอบว่าคิดเกี่ยวกับการฆ่าตัวตายให้ถามต่อ) <br>
                                                ท่านสามารถควบคุมความอยากฆ่าตัวตายที่ท่านคิดอยู่นั้นได้หรือไม่
                                                หรือบอกได้ไหมว่าคงจะไม่ทำตามความคิดนั้นในขณะนี้
                                            </td>
                                            <td>
                                                <select id="8q_31" name="8q_31" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="8"
                                                        {{ old('8q_31') === '8' ? 'selected' : '' }}>
                                                        • ไม่ได้
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_31') === '0' ? 'selected' : '' }}>
                                                        • ได้
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4. แผนการที่จะฆ่าตัวตาย</td>
                                            <td>
                                                <select id="8q_4" name="8q_4" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="8"
                                                        {{ old('8q_4') === '8' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_4') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5. ได้เตรียมการที่จะทำร้ายตัวเอง หรือเตรียมการจะฆ่าตัวตายโดยตั้งใจว่าจะให้ตายจริงๆ</td>
                                            <td>
                                                <select id="8q_5" name="8q_5" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="9"
                                                        {{ old('8q_5') === '9' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_5') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6. ได้ทำให้ตนเองบาดเจ็บ แต่ไม่ตั้งใจที่จะทำให้เสียชีวิต</td>
                                            <td>
                                                <select id="8q_6" name="8q_6" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="4"
                                                        {{ old('8q_6') === '4' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_6') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7. ได้พยายามฆ่าตัวตาย โดยคาดหวัง/ตั้งใจที่จะทำให้ตาย</td>
                                            <td>
                                                <select id="8q_7" name="8q_7" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="10"
                                                        {{ old('8q_7') === '10' ? 'selected' : '' }}>
                                                        • มี
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_7') === '0' ? 'selected' : '' }}>
                                                        • ไม่มี
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8. ท่านเคยพยายามฆ่าตัวตาย</td>
                                            <td>
                                                <select id="8q_8" name="8q_8" class="form-select text-center">
                                                    <option value="">-- กรุณาระบุ --</option>
                                                    <option value="4"
                                                        {{ old('8q_8') === '4' ? 'selected' : '' }}>
                                                        • ใช่
                                                    </option>
                                                    <option value="0"
                                                        {{ old('8q_8') === '0' ? 'selected' : '' }}>
                                                        • ไม่ใช่
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group text-end">
                            <button type="button" class="btn btn-success"
                                onclick="Swal.fire({
                                    title: 'บันทึกแบบประเมินซึมเศร้า 8Q ?',
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
                                <i class="fa-solid fa-save"></i> บันทึกข้อมูล 8Q
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
