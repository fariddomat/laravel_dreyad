<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">إضافة سجل طبي جديد</h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <form action="{{ route('dashboard.medical_records.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="patient_id" class="form-label">اسم المريض</label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">اختر مريض</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="service" class="form-label">نوع الخدمة</label>
                                    <select name="service" id="service" class="form-control" required>
                                        <option value="">اختر نوع الخدمة</option>
                                        @foreach ($services as $service)
                                        <option value="{{ $service->name }}">{{ $service->name }}</option>
                                        @endforeach
                                        <!-- يمكنك إضافة المزيد من الخيارات هنا -->
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="teeth_no" class="form-label">أرقام الأسنان المعالجة</label>
                                    <input type="text" class="form-control" id="teeth_no" name="teeth_no" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="visits_no" class="form-label">عدد الزيارات</label>
                                    <input type="number" class="form-control" id="visits_no" name="visits_no" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="date_start" class="form-label">تاريخ بدء العلاج</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="date_end" class="form-label">تاريخ انتهاء العلاج</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="treatment_plan" class="form-label">خطة العلاج</label>
                                    <textarea class="form-control" id="treatment_plan" name="treatment_plan" required></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="status" class="form-label">الحالة</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="attended">حضر</option>
                                        <option value="booked_but_not_attended">مجدول ولم يحضر</option>
                                        <option value="not_booked">غير مجدول</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="pricing" class="form-label">التسعير</label>
                                    <input type="number" class="form-control" id="pricing" name="pricing" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="discount" class="form-label">الخصم</label>
                                    <input type="number" class="form-control" id="discount" name="discount" value="0" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="total_cost" class="form-label">التكلفة الإجمالية</label>
                                    <input type="number" class="form-control" id="total_cost" name="total_cost" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="follow_up" class="form-label">المتابعة</label>
                                    <input type="text" class="form-control" id="follow_up" name="follow_up">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="outcome" class="form-label">النتيجة</label>
                                    <textarea class="form-control" id="outcome" name="outcome"></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="financial_status" class="form-label">الحالة المالية</label>
                                    <select name="financial_status" id="financial_status" class="form-control" required>
                                        <option value="fully_paid">مدفوع بالكامل</option>
                                        <option value="partially_paid">مدفوع جزئيًا</option>
                                        <option value="overdue">متأخر</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="amount_paid" class="form-label">المبلغ المدفوع</label>
                                    <input type="number" class="form-control" id="amount_paid" name="amount_paid" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="notes" class="form-label">الملاحظات</label>
                                    <textarea class="form-control" id="notes" name="notes"></textarea>
                                </div>
                                <div class="col-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-primary">حفظ السجل</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
