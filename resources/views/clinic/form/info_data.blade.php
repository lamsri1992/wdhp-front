<form action="{{ route('form.updateInfo',$patient->patient_id) }}">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="">รูปแบบการบำบัด</label>
            <select name="info_type" class="form-select">
                <option value="">----- กรุณาเลือก -----</option>
                <optgroup label="สมัครใจ">
                    @foreach ($type_1 as $res)
                    <option value="{{ $res->type_group.",".$res->type_id }}"
                        {{ $patient->info_type === $res->type_group.",".$res->type_id ? 'selected' : '' }}>
                        {{ $res->type_name }}
                    </option>
                    @endforeach
                </optgroup>
                <optgroup label="บังคับบำบัด">
                    @foreach ($type_2 as $res)
                    <option value="{{ $res->type_group.",".$res->type_id }}"
                        {{ $patient->info_type === $res->type_group.",".$res->type_id ? 'selected' : '' }}>
                        {{ $res->type_name }}
                    </option>
                    @endforeach
                </optgroup>
                <optgroup label="โปรดระบุ">
                    <option>อื่น ๆ</option>
                </optgroup>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="">วันที่รับตัว</label>
            <div class="input-group mb-2">
                <input type="text" name="info_date_in" class="form-control basicDate" placeholder="เลือกวันที่"
                value="{{ $patient->info_date_in }}" readonly>
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-regular fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="">อายุ</label>
            <div class="input-group mb-2">
                <input type="text" name="info_age" class="form-control" value="{{ GetAge($patient->patient_dob) }}" readonly>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="">ชนิดของสารเสพติดที่ใช้</label>
            <small class="text-danger">* สามารถเพิ่มตัวเลือกเองได้ *</small>
            <select class="basic-multiple" name="info_drug[]" multiple="multiple">
                @php $drug = explode(',',$patient->info_drug); @endphp
                @foreach ($drug as $drugs)
                @foreach ($m_type as $res)
                <option value="{{ $res->m_type_id }}"
                    {{ (collect($drugs)->contains($res->m_type_id)) ? 'selected' : '' }}>
                    {{ $res->m_type_name }}
                </option>
                @endforeach 
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="">ระยะเวลาที่ใช้สารเสพติด</label>
            <div class="input-group mb-2">
                <input type="text" name="info_drug_use" class="form-control" placeholder="ระบุระยะเวลาที่ใช้สารเสพติด"
                value="{{ $patient->info_drug_use }}">
                &nbsp;
                <div class="input-group-prepend">
                    <select name="info_drug_time" class="form-select" style="width: 100%;">
                        <option>- เลือก -</option>
                        <option value="d"
                        {{ $patient->info_drug_time === 'd' ? 'selected' : '' }}>
                            วัน
                        </option>
                        <option value="m"
                        {{ $patient->info_drug_time === 'm' ? 'selected' : '' }}>
                            เดือน
                        </option>
                        <option value="y"
                        {{ $patient->info_drug_time === 'y' ? 'selected' : '' }}>
                            ปี
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="">วันที่ใช้สารเสพติดครั้งล่าสุด</label>
            <div class="input-group mb-2">
                <input type="text" name="info_drug_last" class="form-control" placeholder="ระบุระยะเวลาที่ใช้สารเสพติด"
                value="{{ $patient->info_drug_last }}">
                &nbsp;
                <div class="input-group-prepend">
                    <select name="info_last_time" class="form-select" style="width: 100%;">
                        <option>- เลือก -</option>
                        <option value="d"
                        {{ $patient->info_last_time === 'd' ? 'selected' : '' }}>
                            วัน
                        </option>
                        <option value="m"
                        {{ $patient->info_last_time === 'm' ? 'selected' : '' }}>
                            เดือน
                        </option>
                        <option value="y"
                        {{ $patient->info_last_time === 'y' ? 'selected' : '' }}>
                            ปี
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="">รายละเอียดการใช้สารเสพติด และอาการแสดง</label>
            <div class="input-group mb-2">
                <textarea name="info_pi" rows="5" class="form-control">{{ $patient->info_pi }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group text-end">
        <button type="button" class="btn btn-success" 
            onclick="Swal.fire({
                title: 'แก้ไขข้อมูลการรับเข้าบำบัด ?',
                showCancelButton: true,
                confirmButtonText: `<i class='fa-solid fa-edit'></i> แก้ไขข้อมูล`,
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