<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ใบยินยอมให้ทำการบำบัดรักษา {{ $patient->patient_name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/font_sarabun.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
</head>
    <body>
        <div class="container-fluid">
            <div class="card-body">
                <div class="text-center">
                    <button class="btn btn-sm btn-light" onclick="printDiv('printThis')">
                        <i class="fa fa-print"></i>
                        พิมพ์ใบยินยอม
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div id="printThis">
                <div style="margin-top: 2rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <h6 class="font-weight-bold">ขั้นตอนการบำบัดรักษาสารเสพติด</h6>
                        </div>
                        <div class="container">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check_1">
                                <label class="custom-control-label" for="check_1">
                                    1. ยืนยันดัวยบัตรประจำตัวประชาชน / ใบขับขี่ / บัตรประจำตัวอื่น ๆ ซึ่งมีรูปถ่าย
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check_2">
                                <label class="custom-control-label" for="check_2">
                                    2. จัดทำบัตรประจำตัวผู้ป่วย
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check_3">
                                <label class="custom-control-label" for="check_3">
                                    3. ผู้ป่วยสมัครใจ และเซ็นต์ใบยินยอมรักษา ( ได้รับความยินยอมจากผู้ปกครอง กรณีอายุต่ำกว่า 18 ปี )
                                </label>
                            </div>
                        </div><br>
                        <div class="text-center">
                            <h6 class="font-weight-bold">แบบยินยอมให้ทำการบำบัดรักษา</h6>
                            <span>( สารเสพติดที่ต้องการบำบัดรักษา )</span>
                        </div>
                        <div class="text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">
                                    ยาบ้า
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">
                                    เฮโรอีน
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                <label class="form-check-label" for="inlineCheckbox3">
                                    ฝิ่น
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                                <label class="form-check-label" for="inlineCheckbox4">
                                    กัญชา
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5">
                                <label class="form-check-label" for="inlineCheckbox5">
                                    อื่น ๆ ...................................
                                </label>
                            </div>
                        </div><br>
                        <div class="card">
                            <table class="table table-borderless">
                                <tr>
                                    <td colspan="3">
                                        <b>สถานที่ให้บริการ</b> โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
                                        เลขที่ 94 หมู่ที่ 3 ตำบลบ้านจันทร์ อำเภอกัลยาณิวัฒนา จังหวัดเชียงใหม่ 58130
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="3">
                                        วันที่..............เดือน..............พ.ศ...............
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ข้าพเจ้า {{ $patient->patient_name }} ( ผู้เข้ารับการบำบัด )
                                    </td>
                                    <td>
                                        อายุ {{ GetAge($patient->patient_dob)." ปี" }}
                                    </td>
                                    <td class="text-right">
                                        HN : {{ $patient->patient_hn }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ข้าพเจ้า ...................................................................................
                                    </td>
                                    <td>
                                        อายุ........ปี
                                    </td>
                                    <td class="text-right">
                                        มีความเกี่ยวข้องเป็น....................................................ของผู้ป่วย
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        ยินยอมที่จะปฏิบัติตามระเบียบข้อบังคับเพื่อการควบคุมการบำบัดรักษา และวินัยสำหรับสถานพยาบาล เพื่อการวินิจฉัยบำบัดโรค สงเสริมสุขภาพ
                                        ป้องกันโรค การฟื้นฟูสภาพร่างกาย และจิตใจ และเพื่อการบรรลุผลสำเร็จการบำบัดรักษา ดังต่อไปนี้
                                        <ol>
                                            <li>
                                                ข้าพเจ้ายินยอมให้ประวัติ ข้อมูลต่าง ๆ ตลอดจนภูมิหลังของข้าพเจ้า และครอบครัว หรือผู้ใกล้ชิด ตามจริงทุกครั้งที่เข้ารับบริการกับเจ้าหน้าที่
                                            </li>
                                            <li>
                                                ข้าพเจ้ายินยอมให้ตรวจร่างกาย ตรวจทางห้องปฏิบัติการ สภาพจิตใจ และสุ่มตรวจปัสสาวะในช่วงบำบัด และติดตามผล
                                            </li>
                                            <li>
                                                ข้าพเจ้ายินยอมที่จะชำระค่ารักษาบริการตามประกาศของโรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
                                            </li>
                                            <li>
                                                ข้าพเจ้าจะมารับยาด้วยตนเอง พร้อมแสดงบัตรประจำตัวผู้เข้ารับการบำบัดรักษาของสถานพยาบาลทุกครั้ง ในกรณีเจ็บป่วยกระทันหัน
                                                หรือติดธุระจำเป็น ให้ญาติชื่อ...................................................................................
                                                เกี่ยวข้องเป็น....................................................มารับยาแทน
                                            </li>
                                            <li>
                                                หากข้าพเจ้ามีความประพฤติที่ละเมิดต่อระเบียบบังคับ ข้าพเจ้ายินยอมที่จะปฏิบัติตามข้อกำหนดของสถาบัน หากข้าพเจ้าพบอาการผิดปกติระหว่างการ
                                                บำบัดรักษา จะมาพบแพทย์/โทรปรึกษาเจ้าหน้าที่ทันที ข้าพเจ้าจะไม่เรียกร้อง ฟ้องร้อง หรือฟ้องดำเนินคดีในทางอาญา และทางแพ่งกับเจ้าหน้าที่
                                                และส่วนราชการเจ้าสังกัดของโรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา แต่อย่างใด และเจ้าหน้าที่ของสถานพยาบาลได้อธิบายให้ข้าพเจ้าได้รับทราบ
                                                รายละเอียดของการได้รับเมทาโดน และข้อควรระวังทุกประการ จาการได้รับยาทดแทนจากเจ้าหน้าที่ของสถานพยาบาล โดยเข้าใจแล้ว
                                                จึงลงมือชื่อ หรือลายนิ้วมือไว้เป็นหลักฐาน
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="text-center">
                                                    ลงชื่อ ................................................................................... ผู้ให้คำยินยอม ( ผู้ป่วย ) <br>
                                                    (...................................................................................)
                                                </td>
                                                <td class="text-center">
                                                    ลงชื่อ ................................................................................... เจ้าหน้าที่ผู้ให้ข้อมูล<br>
                                                    (...................................................................................)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" colspan="2">
                                                    ลงชื่อ ...................................................................................ผู้ให้คำยินยอม<br>
                                                    เกี่ยวข้องเป็น ..........................................................<br>
                                                    (.....................................................................................................)
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</html>