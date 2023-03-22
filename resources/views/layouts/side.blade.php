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
                    <a href="#">
                        <i class="bi bi-circle"></i><span>ระบบรายงานข้อมูล</span>
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
