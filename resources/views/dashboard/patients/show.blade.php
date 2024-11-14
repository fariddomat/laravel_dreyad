<x-app-layout>
    <div class="container-fluid my-6">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="col-6 text-white text-capitalize ps-3">عرض مريض </h6>
                </div>
            </div>
        <div class="card-body my-4 mx-md-4 mt-n6">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">رقم الملف</label>
                    <p>{{ $patient->file_number }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">الملفات الطبية</label>
                    <p><a href="{{ route('dashboard.patients.medical_files.index', $patient) }}" class="btn btn-primary">الملفات الطبية</a></p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">اسم المريض</label>
                    <p>{{ $patient->name }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">الجنس</label>
                    <p>{{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">رقم الجوال الأول</label>
                    <p>{{ $patient->mob1 }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">رقم الجوال الثاني</label>
                    <p>{{ $patient->mob2 }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">تاريخ التواصل</label>
                    <p>{{ $patient->date_contacted ?? 'غير محدد' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">المصدر</label>
                    <p>{{ $patient->source }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">مستوى المريض</label>
                    <p>
                        @if($patient->level == 'vip') VIP
                        @elseif($patient->level == 'junk') غير هام
                        @else عادي @endif
                    </p>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">الملاحظات</label>
                    <p>{{ $patient->notes ?? 'لا توجد ملاحظات' }}</p>
                </div>
            </div>
            <a href="{{ route('dashboard.patients.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
        </div>
    </div>
</x-app-layout>
