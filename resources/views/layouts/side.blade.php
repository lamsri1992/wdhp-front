a<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">เมนูระบบ</li>
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('home')) ? '' : 'collapsed' }}"
                href="{{ route('home') }}">
                <i class="fa-solid fa-folder-tree"></i>
                <span>Monitoring - API</span>
            </a>
        </li>
        <!-- Config Nav -->
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('config*')) ? '' : 'collapsed' }}"
                data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-cog"></i>
                <span>การตั้งค่าระบบ</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="config-nav" class="nav-content collapse {{ (request()->is('config*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('users.list') }}" class="{{ (request()->is('config/users')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>ตั้งค่าผู้ใช้งาน</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ (request()->is('config/api')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>การเชื่อมต่อ API</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Config Nav -->
        <li class="nav-heading">ระบบคลินิก</li>
        <!-- Fahwanmai Nav -->
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('clinic/fahwanmai*') || request()->is('clinic/form*')) ? '' : 'collapsed' }}"
                data-bs-target="#fahwanmai-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-prescription-bottle-medical"></i>
                <span>คลินิกฟ้าวันใหม่</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fahwanmai-nav" class="nav-content collapse {{ (request()->is('clinic/fahwanmai*') || request()->is('clinic/form*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('fah.index') }}" class="{{ (request()->is('clinic/fahwanmai')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fah.list') }}" class="{{ (request()->is('clinic/fahwanmai/list*') || request()->is('clinic/form*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>ทะเบียนผู้ป่วย</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('met.index') }}" class="{{ (request()->is('clinic/fahwanmai/methadone*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Methadone</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mtx.index') }}" class="{{ (request()->is('clinic/fahwanmai/matrix')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Matrix Program</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>ระบบรายงานข้อมูล</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Fahwanmai Nav -->
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('clinic/anc*')) ? '' : 'collapsed' }}"
                data-bs-target="#anc-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-person-dress"></i>
                <span>คลินิกฝากครรภ์</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="anc-nav" class="nav-content collapse {{ (request()->is('clinic/anc*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#" class="{{ (request()->is('clinic/anc')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ancLab">
                        <i class="bi bi-circle"></i><span>รายงานผล LAB</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">ฐานข้อมูลบริการ</li>
         <!-- Health Nav -->
         <li class="nav-item">
            <a class="nav-link {{ (request()->is('visit*')) ? '' : 'collapsed' }}"
                href="{{ route('visit.list') }}">
                <i class="fa-solid fa-hospital-user"></i>
                <span>ประวัติการรับบริการ</span>
            </a>
        </li>
        <!-- End Health Nav -->
    </ul>
</aside>
<!-- End Sidebar-->

<!-- ANC MODAL -->
<div class="modal fade" id="ancLab" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('anc.report') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายงานข้อมูล LAB ANC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="" class="form-label">วันที่เริ่มต้น</label>
                            <input type="text" name="dstart" class="basicDate form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">วันที่สิ้นสุด</label>
                            <input type="text" name="dended" class="basicDate form-control" readonly>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading fw-bold">เงื่อนไขการ Query ข้อมูล</h4>
                                <p class="mb-0">
                                    LAB ANC :: Hb, HCT(30104), HCT
                                </p>
                                <p class="mb-0">
                                    ICD10 :: Z33, Z340, Z348
                                </p>
                                <hr>
                                <p class="mb-0">
                                    หากต้องการเพิ่ม LAB / ICD10 กรุณาแจ้งผู้ดูแลระบบ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-print"></i>
                        ออกรายงาน
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>
