<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Card for Users Count -->
            <div class="col-lg-2 col-md-4 col-12">
                <div class="card card-stats">
                    <div class="card-header bg-gradient-primary text-white shadow-primary border-radius-lg">
                        <div class="text-center">
                            <h6 class="mb-0">إجمالي المستخدمين</h6>
                            <h3 class="font-weight-bold">{{ $usersCount }}</h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary btn-sm">
                                عرض المستخدمين
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Roles Count -->
            <div class="col-lg-2 col-md-4 col-12">
                <div class="card card-stats">
                    <div class="card-header bg-gradient-info text-white shadow-primary border-radius-lg">
                        <div class="text-center">
                            <h6 class="mb-0">إجمالي الأدوار</h6>
                            <h3 class="font-weight-bold">{{ $rolesCount }}</h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            {{-- <a href="{{ route('dashboard.roles.index') }}" class="btn btn-outline-info btn-sm">
                                عرض الأدوار
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Services Count -->
            <div class="col-lg-2 col-md-4 col-12">
                <div class="card card-stats">
                    <div class="card-header bg-gradient-success text-white shadow-primary border-radius-lg">
                        <div class="text-center">
                            <h6 class="mb-0">إجمالي الخدمات</h6>
                            <h3 class="font-weight-bold">{{ $servicesCount }}</h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('dashboard.services.index') }}" class="btn btn-outline-success btn-sm">
                                عرض الخدمات
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Payments Count -->
            <div class="col-lg-2 col-md-4 col-12">
                <div class="card card-stats">
                    <div class="card-header bg-gradient-warning text-white shadow-primary border-radius-lg">
                        <div class="text-center">
                            <h6 class="mb-0">إجمالي المدفوعات</h6>
                            <h3 class="font-weight-bold">{{ $paymentsCount }}</h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('dashboard.payments.index') }}" class="btn btn-outline-warning btn-sm">
                                عرض المدفوعات
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Patients Count -->
            <div class="col-lg-2 col-md-4 col-12">
                <div class="card card-stats">
                    <div class="card-header bg-gradient-danger text-white shadow-primary border-radius-lg">
                        <div class="text-center">
                            <h6 class="mb-0">إجمالي المرضى</h6>
                            <h3 class="font-weight-bold">{{ $patientsCount }}</h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('dashboard.patients.index') }}" class="btn btn-outline-danger btn-sm">
                                عرض المرضى
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Medical Records Count -->
            <div class="col-lg-2 col-md-4 col-12">
                <div class="card card-stats">
                    <div class="card-header bg-gradient-dark text-white shadow-primary border-radius-lg">
                        <div class="text-center">
                            <h6 class="mb-0">إجمالي السجلات الطبية</h6>
                            <h3 class="font-weight-bold">{{ $medicalRecordsCount }}</h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('dashboard.medical_records.index') }}" class="btn btn-outline-dark btn-sm">
                                عرض السجلات الطبية
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row mt-4">
            <!-- Add more sections or cards here as needed -->
        </div>
    </div>
</x-app-layout>
