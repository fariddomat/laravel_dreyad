<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">تفاصيل السجل الطبي</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="row">
                            <div class="col-12">
                                <label for="patient_id" class="form-label">اسم المريض</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->patient->name }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="service" class="form-label">نوع الخدمة</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->service }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="teeth_no" class="form-label">أرقام الأسنان المعالجة</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->teeth_no }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="visits_no" class="form-label">عدد الزيارات</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->visits_no }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="date_start" class="form-label">تاريخ بدء العلاج</label>
                                <input type="date" class="form-control" value="{{ $medicalRecord->date_start }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="date_end" class="form-label">تاريخ انتهاء العلاج</label>
                                <input type="date" class="form-control" value="{{ $medicalRecord->date_end }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="treatment_plan" class="form-label">خطة العلاج</label>
                                <textarea class="form-control" disabled>{{ $medicalRecord->treatment_plan }}</textarea>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="status" class="form-label">الحالة</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->status }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="pricing" class="form-label">التسعير</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->pricing }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="discount" class="form-label">الخصم</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->discount }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="total_cost" class="form-label">التكلفة الإجمالية</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->total_cost }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="follow_up" class="form-label">المتابعة</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->follow_up }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="outcome" class="form-label">النتيجة</label>
                                <textarea class="form-control" disabled>{{ $medicalRecord->outcome }}</textarea>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="financial_status" class="form-label">الحالة المالية</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->financial_status }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="amount_paid" class="form-label">المبلغ المدفوع</label>
                                <input type="text" class="form-control" value="{{ $medicalRecord->amount_paid }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="notes" class="form-label">الملاحظات</label>
                                <textarea class="form-control" disabled>{{ $medicalRecord->notes }}</textarea>
                            </div>


            <div class="mt-4">
                <a href="{{ route('dashboard.medical_records.index') }}" class="btn btn-primary">الرجوع إلى القائمة</a>
                <a href="{{ route('dashboard.medical_records.edit', $medicalRecord->id) }}" class="btn btn-warning">تعديل السجل الطبي</a>
            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


