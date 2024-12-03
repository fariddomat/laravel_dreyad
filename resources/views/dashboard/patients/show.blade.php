<x-app-layout>
    <div class="container-fluid my-6">
        <div class="card my-4 shadow-lg border-radius-lg">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="col-6 text-white text-capitalize ps-3">عرض مريض</h6>
                </div>
            </div>
            <div class="card-body my-4 mx-md-4 mt-n6">
                <!-- معلومات المريض -->
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">رقم الملف</label>
                        <p>{{ $patient->file_number }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">اسم المريض</label>
                        <p>{{ $patient->name }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">الجنس</label>
                        <p>{{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">رقم الجوال الأول</label>
                        <p>{{ $patient->mob1 }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">رقم الجوال الثاني</label>
                        <p>{{ $patient->mob2 }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">تاريخ التواصل</label>
                        <p>{{ $patient->date_contacted ?? 'غير محدد' }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">المصدر</label>
                        <p>{{ $patient->source }}</p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">مستوى المريض</label>
                        <p>
                            @if($patient->level == 'vip') VIP
                            @elseif($patient->level == 'junk') غير هام
                            @else عادي @endif
                        </p>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-primary fw-bold">الملاحظات</label>
                        <p>{{ $patient->notes ?? 'لا توجد ملاحظات' }}</p>
                    </div>
                </div>

               <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label text-primary fw-bold">عدد السجلات الطبية</label>
                    <p>{{ $medicalRecordsCount }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label text-primary fw-bold">عدد المدفوعات</label>
                    <p>{{ $paymentsCount }}</p>
                </div>
               </div>
                <!-- إجمالي الدفعات -->
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label  text-primary fw-bold">إجمالي المبلغ المدفوع</label>
                        <p>{{ number_format($patient->total_amount_paid, 2) }} ر.س</p>
                    </div>
                </div>

                <!-- زر الملفات الطبية -->
                <div class="mb-3">
                    <a href="{{ route('dashboard.patients.medical_files.index', $patient) }}" class="btn btn-primary">عرض الملفات الطبية</a>
                </div>

                <!-- زر العودة -->
                <a href="{{ route('dashboard.patients.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
            </div>
        </div>
    </div>
</x-app-layout>
