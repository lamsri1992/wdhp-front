<form action="{{ route('depress.add2Q',$patient->patient_id) }}">
    <div class="row">
        <h5>แบบคัดกรองซึมเศร้า 2 คำถาม (2Q)</h5>
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
                        <td>1. ใน 2 สัปดาห์ที่ผ่านมา รวมวันนี้ ท่านรู้สึกหดหู่ เศร้า หรือท้อแท้สิ้นหวัง หรือไม่</td>
                        <td>
                            <select id="2q_1" name="2q_1" class="form-select text-center">
                                <option value="">กรุณาระบุ</option>
                                <option value="1"
                                    {{ old('2q_1') === '1' ? 'selected' : '' }}>
                                    • Positive
                                </option>
                                <option value="0"
                                    {{ old('2q_1') === '0' ? 'selected' : '' }}>
                                    • Negative
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>2. ใน 2 สัปดาห์ที่ผ่านมา รวมวันนี้ ท่านรู้สึกเบื่อ ทำอะไรก็ไม่เพลิดเพลิน หรือไม่</td>
                        <td>
                            <select id="2q_2" name="2q_2" class="form-select text-center">
                                <option value="">กรุณาระบุ</option>
                                <option value="1"
                                    {{ old('2q_2') === '1' ? 'selected' : '' }}>
                                    • Positive
                                </option>
                                <option value="0"
                                    {{ old('2q_2') === '0' ? 'selected' : '' }}>
                                    • Negative
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
                title: 'บันทึกแบบประเมินซึมเศร้า 2Q ?',
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
            <i class="fa-solid fa-save"></i> บันทึกข้อมูล 2Q
        </button>
    </div>
</form>