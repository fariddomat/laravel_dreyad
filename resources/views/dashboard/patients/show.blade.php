<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">رقم الملف</label>
                    <p>{{ $patient->file_number }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">اسم المريض</label>
                    <p>{{ $patient->name }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">رقم الجوال</label>
                    <p>{{ $patient->phone }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">تاريخ الميلاد</label>
                    <p>{{ $patient->birth_date }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">المصدر</label>
                    <p>{{ $patient->source }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">الحالة</label>
                    <p>{{ $patient->status }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">العيادة</label>
                    <p>{{ $patient->clinic }}</p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">الملاحظات</label>
                    <p>{{ $patient->notes }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
