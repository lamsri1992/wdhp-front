<div class="row">
    <h5>แบบคัดกรองซึมเศร้า 2 คำถาม (2Q)</h5>
    <div class="col-md-12">
        <table class="table table-borderless table-striped table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>คำถาม</th>
                    <th width="20%"><i class="fa-regular fa-check-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. ใน 2 สัปดาห์ที่ผ่านมา รวมวันนี้ ท่านรู้สึกหดหู่ เศร้า หรือท้อแท้สิ้นหวัง หรือไม่</td>
                    <td>
                        <select id="2q_1" name="2q_1" class="form-select text-center">
                            <option value="">กรุณาระบุ</option>
                            <option value="1"
                                {{ $q2[0] === '1' ? 'selected' : '' }}>
                                • Positive
                            </option>
                            <option value="0"
                                {{ $q2[0] === '0' ? 'selected' : '' }}>
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
                                {{ $q2[1] === '1' ? 'selected' : '' }}>
                                • Positive
                            </option>
                            <option value="0"
                                {{ $q2[1] === '0' ? 'selected' : '' }}>
                                • Negative
                            </option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="form-row">
    <h5>แบบคัดกรองซึมเศร้า 9 คำถาม (9Q)</h5>
    <div class="col-md-12">
        <table class="table table-borderless table-striped table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>ในช่วง 2 สัปดาห์ที่ผ่านมา รวมวันนี้ ท่านมีอาการเหล่านี้บ่อยแค่ไหน</th>
                    <th width="20%"><i class="fa-regular fa-check-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. เบื่อ ไม่สนใจอยากทำอะไร</td>
                    <td>
                        <select id="9q_1" name="9q_1" class="form-select text-center">
                            <option value="">-- กรุณาระบุ --</option>
                            <option value="0" {{ @$q9[0] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[0] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[0] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[0] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[1] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[1] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[1] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[1] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[2] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[2] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[2] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[2] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[3] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[3] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[3] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[3] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[4] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[4] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[4] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[4] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[5] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[5] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[5] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[5] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[6] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[6] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[6] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[6] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[7] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[7] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[7] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[7] === '3' ? 'selected' : '' }}>
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
                            <option value="0" {{ @$q9[8] === '0' ? 'selected' : '' }}>
                                • ไม่มีเลย
                            </option>
                            <option value="1" {{ @$q9[8] === '1' ? 'selected' : '' }}>
                                • เป็นบางวัน 1-7 วัน
                            </option>
                            <option value="2" {{ @$q9[8] === '2' ? 'selected' : '' }}>
                                • เป็นบ่อย > 7วัน
                            </option>
                            <option value="3" {{ @$q9[8] === '3' ? 'selected' : '' }}>
                                • เป็นทุกวัน
                            </option>
                        </select>
                    </td>
                </tr>
                <tr class="text-center" style="font-weight: bold;">
                    <td>รวมคะแนน</td>
                    <td>{{ $q9_value }} คะแนน</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="form-row">
    <h5>แบบประเมินการฆ่าตัวตาย 8 คำถาม (8Q)</h5>
    <div class="col-md-12">
        <table class="table table-borderless table-striped table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>คำถาม</th>
                    <th width="20%"><i class="fa-regular fa-check-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. คิดอยากตาย หรือ คิดว่าตายไปจะดีกว่า</td>
                    <td>
                        <select id="8q_1" name="8q_1" class="form-select text-center">
                            <option value="">-- กรุณาระบุ --</option>
                            <option value="1"
                                {{ @$q8[0] === '1' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[0] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[1] === '2' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[1] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[2] === '6' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[2] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[3] === '8' ? 'selected' : '' }}>
                                • ไม่ได้
                            </option>
                            <option value="0"
                                {{ @$q8[3] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[4] === '8' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[4] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[5] === '9' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[5] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[6] === '4' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[6] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[7] === '10' ? 'selected' : '' }}>
                                • มี
                            </option>
                            <option value="0"
                                {{ @$q8[7] === '0' ? 'selected' : '' }}>
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
                                {{ @$q8[8] === '4' ? 'selected' : '' }}>
                                • ใช่
                            </option>
                            <option value="0"
                                {{ @$q8[8] === '0' ? 'selected' : '' }}>
                                • ไม่ใช่
                            </option>
                        </select>
                    </td>
                </tr>
                <tr class="text-center" style="font-weight: bold;">
                    <td>รวมคะแนน</td>
                    <td>{{ $q8_value }} คะแนน</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>