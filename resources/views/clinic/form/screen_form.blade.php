<form action="{{ route('methadone.addScreen',$patient->patient_id) }}">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">วันที่คัดกรอง</label>
            <div class="input-group mb-2">
                <input type="text" name="screen_date" class="form-control basicDate" placeholder="เลือกวันที่"
                value="{{ old('screen_date') }}" readonly>
                <div class="input-group-text">
                    <i class="fa-regular fa-calendar"></i>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="">สถานที่คัดกรอง</label>
            <div class="input-group mb-2">
                <input type="text" name="screen_place" class="form-control" placeholder="ระบุสถานที่"
                value="{{ old('screen_place') }}">
                <div class="input-group-text">
                    <i class="fa-solid fa-home"></i>
                </div>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="">ชนิดของสารเสพติดที่ใช้</label>
            <small class="text-danger">* สามารถเพิ่มตัวเลือกเองได้ *</small>
            <select class="form-control basic-multiple" name="screen_drug[]" multiple="multiple">
                @foreach ($m_type as $res)
                <option value="{{ $res->m_type_id }}"
                    {{ (collect(old('screen_drug'))->contains($res->m_type_id)) ? 'selected' : '' }}>
                    {{ $res->m_type_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <table class="table table-borderless table-striped">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th colspan="2">
                            ยา และสารเสพติดหลักที่ใช้และคัดกรองครั้งนี้คือ
                            <select class="form-select" name="screen_primary">
                                <option></option>
                                @foreach ($m_type as $res)
                                <option value="{{ $res->m_type_id }}"
                                    {{ old('screen_primary') === $res->m_type_id ? 'selected' : '' }}>
                                    {{ $res->m_type_name }}
                                </option>
                                @endforeach
                            </select>
                            ในช่วง 3 เดือนที่ผ่านมา
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1. คุณใช้สารเสพติดชนิดนี้บ่อยเพียงใด</th>
                        <td>
                            <select name="screen_1" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="0"
                                    {{ old('screen_1') === '0' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                                <option value="2"
                                    {{ old('screen_1') === '2' ? 'selected' : '' }}>
                                    1-2 ครั้ง
                                </option>
                                <option value="3"
                                    {{ old('screen_1') === '3' ? 'selected' : '' }}>
                                    เดือนละ 1-3 ครั้ง
                                </option>
                                <option value="4"
                                    {{ old('screen_1') === '4' ? 'selected' : '' }}>
                                    สัปดาห์ละ 1-4 ครั้ง
                                </option>
                                <option value="6"
                                    {{ old('screen_1') === '6' ? 'selected' : '' }}>
                                    เกือบทุกวัน (สัปดาห์ละ 5-7 วัน)
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>2. คุณมีความต้องการ หรือมีความรู้สึกอยากใช้สารเสพติดชนิดนี้จนทนไม่ได้บ่อยเพียงใด</th>
                        <td>
                            <select name="screen_2" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="0"
                                    {{ old('screen_2') === '0' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                                <option value="3"
                                    {{ old('screen_2') === '3' ? 'selected' : '' }}>
                                    1-2 ครั้ง
                                </option>
                                <option value="4"
                                    {{ old('screen_2') === '4' ? 'selected' : '' }}>
                                    เดือนละ 1-3 ครั้ง
                                </option>
                                <option value="5"
                                    {{ old('screen_2') === '5' ? 'selected' : '' }}>
                                    สัปดาห์ละ 1-4 ครั้ง
                                </option>
                                <option value="6"
                                    {{ old('screen_2') === '6' ? 'selected' : '' }}>
                                    เกือบทุกวัน (สัปดาห์ละ 5-7 วัน)
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>3. การใช้สารเสพติดชนิดนี้ทำให้คุณเกิดปัญหาสุขภาพ ครอบครัว สังคมกฏหมาย หรือการเงินบ่อยเพียงใด</th>
                        <td>
                            <select name="screen_3" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="0"
                                    {{ old('screen_3') === '0' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                                <option value="4"
                                    {{ old('screen_3') === '4' ? 'selected' : '' }}>
                                    1-2 ครั้ง
                                </option>
                                <option value="5"
                                    {{ old('screen_3') === '5' ? 'selected' : '' }}>
                                    เดือนละ 1-3 ครั้ง
                                </option>
                                <option value="6"
                                    {{ old('screen_3') === '6' ? 'selected' : '' }}>
                                    สัปดาห์ละ 1-4 ครั้ง
                                </option>
                                <option value="7"
                                    {{ old('screen_3') === '7' ? 'selected' : '' }}>
                                    เกือบทุกวัน (สัปดาห์ละ 5-7 วัน)
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>4. การใช้สารเสพติดชนิดนี้ทำให้คุณไม่สามารถรับผิดชอบ หรือทำกิจกรรมที่คุณเคยทำตามปกติได้บ่อยเพียงใด</th>
                        <td>
                            <select name="screen_4" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="0"
                                    {{ old('screen_4') === '0' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                                <option value="5"
                                    {{ old('screen_4') === '5' ? 'selected' : '' }}>
                                    1-2 ครั้ง
                                </option>
                                <option value="6"
                                    {{ old('screen_4') === '6' ? 'selected' : '' }}>
                                    เดือนละ 1-3 ครั้ง
                                </option>
                                <option value="7"
                                    {{ old('screen_4') === '7' ? 'selected' : '' }}>
                                    สัปดาห์ละ 1-4 ครั้ง
                                </option>
                                <option value="8"
                                    {{ old('screen_4') === '8' ? 'selected' : '' }}>
                                    เกือบทุกวัน (สัปดาห์ละ 5-7 วัน)
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr class="thead-dark">
                        <th colspan="2" class="text-center">ในช่วงเวลาที่ผ่านมา</th>
                    </tr>
                    <tr>
                        <th>5. ญาติ เพื่อ หรือคนที่รู้จัก เคยกล่าวว่าตักเตือน วิพากษ์วิจารณ์ จับผิด หรือแสดงท่าทีสงสัยว่าท่านเกี่ยวข้องกับการใช้สารเสพติดชนิดนี้หรือไม่</th>
                        <td>
                            <select name="screen_5" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="0"
                                    {{ old('screen_5') === '0' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                                <option value="3"
                                    {{ old('screen_5') === '3' ? 'selected' : '' }}>
                                    เคย แต่ก่อน 3 เดือนที่ผ่านมา
                                </option>
                                <option value="6"
                                    {{ old('screen_5') === '6' ? 'selected' : '' }}>
                                    เคย ในช่วง 3 เดือนที่ผ่านมา
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>6. คุณเคยลด หรือหยุดใช้สารเสพติดชนิดนี้แต่ไม่ประสบผลสำเร็จหรือไม่</th>
                        <td>
                            <select name="screen_6" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="0"
                                    {{ old('screen_6') === '0' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                                <option value="3"
                                    {{ old('screen_6') === '3' ? 'selected' : '' }}>
                                    เคย แต่ก่อน 3 เดือนที่ผ่านมา
                                </option>
                                <option value="6"
                                    {{ old('screen_6') === '6' ? 'selected' : '' }}>
                                    เคย ในช่วง 3 เดือนที่ผ่านมา
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>คุณเคยใช้สารเสพติดชนิดฉีดหรือไม่ (หากเคยให้ระบุข้อต่อไป)</th>
                        <td>
                            <select name="screen_inject" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="Y"
                                    {{ old('screen_inject') === 'Y' ? 'selected' : '' }}>
                                    เคย
                                </option>
                                <option value="N"
                                    {{ old('screen_inject') === 'N' ? 'selected' : '' }}>
                                    ไม่เคย
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>ภายใน 3 เดือนที่ผ่านมา คุณใช้บ่อยเพียงใด</th>
                        <td>
                            <select name="screen_inject_note" class="form-select">
                                <option value="">กรุณาระบุ</option>
                                <option value="1"
                                    {{ old('screen_inject_note') === '1' ? 'selected' : '' }}>
                                    1 ครั้งต่อสัปดาห์ หรือน้อยกว่า 3 วันติดต่อกัน
                                </option>
                                <option value="2"
                                    {{ old('screen_inject_note') === '2' ? 'selected' : '' }}>
                                    มากกว่า 1 ครั้งต่อสัปดาห์ หรือมากกว่า 3 วันติดต่อกัน
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center"><span>ผู้บันทึก</span></th>
                        <td>
                            <input type="text" name="screen_viewer" class="form-control" value="ผู้ดูแลระบบ" readonly>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group text-end">
        <button type="button" class="btn btn-success"
            onclick="Swal.fire({
                title: 'บันทึกการคัดกรอง ?',
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
            <i class="fa-solid fa-save"></i> บันทึกข้อมูล
        </button>
    </div>
</form>