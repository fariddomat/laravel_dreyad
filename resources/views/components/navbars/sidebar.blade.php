<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white"> لوحة التحكم</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">لوحة التحكم</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">العيادة</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard.patients.index' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.patients.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">bookmark</i>
                    </div>
                    <span class="nav-link-text ms-1">المرضى</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard.medical_records.index' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.medical_records.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">bookmark</i>
                    </div>
                    <span class="nav-link-text ms-1">السجلات الطبية</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard.payments.index' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.payments.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">الدفعات المالية</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard.services.index' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.services.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">build</i>
                    </div>
                    <span class="nav-link-text ms-1">الخدمات</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard.import.patient' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.import.patient') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">build</i>
                    </div>
                    <span class="nav-link-text ms-1">استيراد البيانات</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard.users.index' ? ' active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.users.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1">المستخدمين</span>
                </a>
            </li>





            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">الاعدادات</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'profile.edit' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('profile.edit') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">الملف الشخصي</span>
                </a>
            </li>


        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">

        <div class="mx-3">
            <a class="btn bg-gradient-primary w-100" href="/" target="_blank" type="button">الرئيسية</a>
        </div>
    </div>
</aside>
