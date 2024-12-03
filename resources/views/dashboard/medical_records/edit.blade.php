<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">تعديل السجل الطبي</h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <form action="{{ route('dashboard.medical_records.update', $medicalRecord) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <label for="patient_id" class="form-label">اسم المريض</label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="{{ $medicalRecord->patient_id }}" selected>
                                            {{ $medicalRecord->patient->name }}</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="service" class="form-label">نوع الخدمة</label>
                                    <select name="service" id="service" class="form-control" required>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->name }}"
                                                @if ($medicalRecord->service == $service->name) selected @endif>{{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="teeth_no" class="form-label">أرقام الأسنان المعالجة</label>
                                    <input type="text" class="form-control" id="teeth_no" name="teeth_no"
                                        value="{{ $medicalRecord->teeth_no }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="visits_no" class="form-label">عدد الزيارات</label>
                                    <input type="number" class="form-control" id="visits_no" name="visits_no"
                                        value="{{ $medicalRecord->visits_no }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="date_start" class="form-label">تاريخ بدء العلاج</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start"
                                        value="{{ $medicalRecord->date_start }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="date_end" class="form-label">تاريخ انتهاء العلاج</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end"
                                        value="{{ $medicalRecord->date_end }}">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="treatment_plan" class="form-label">خطة العلاج</label>
                                    <textarea class="form-control" id="treatment_plan" name="treatment_plan" required>{{ $medicalRecord->treatment_plan }}</textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="status" class="form-label">الحالة</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="attended" @if ($medicalRecord->status == 'attended') selected @endif>حضر
                                        </option>
                                        <option value="booked_but_not_attended"
                                            @if ($medicalRecord->status == 'booked_but_not_attended') selected @endif>مجدول ولم يحضر</option>
                                        <option value="not_booked" @if ($medicalRecord->status == 'not_booked') selected @endif>غير
                                            مجدول</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="pricing" class="form-label">التسعير</label>
                                    <input type="number" class="form-control" id="pricing" name="pricing"
                                        value="{{ $medicalRecord->pricing }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="discount" class="form-label">الخصم</label>
                                    <input type="number" class="form-control" id="discount" name="discount"
                                        value="{{ $medicalRecord->discount }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="total_cost" class="form-label">التكلفة الإجمالية</label>
                                    <input type="number" class="form-control" id="total_cost" name="total_cost"
                                        value="{{ $medicalRecord->total_cost }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="follow_up" class="form-label">المتابعة</label>
                                    <input type="text" class="form-control" id="follow_up" name="follow_up"
                                        value="{{ $medicalRecord->follow_up }}">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="outcome" class="form-label">النتيجة</label>
                                    <textarea class="form-control" id="outcome" name="outcome">{{ $medicalRecord->outcome }}</textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="financial_status" class="form-label">الحالة المالية</label>
                                    <select name="financial_status" id="financial_status" class="form-control"
                                        required>
                                        <option value="fully_paid" @if ($medicalRecord->financial_status == 'fully_paid') selected @endif>
                                            مدفوع بالكامل</option>
                                        <option value="partially_paid"
                                            @if ($medicalRecord->financial_status == 'partially_paid') selected @endif>مدفوع جزئيًا</option>
                                        <option value="overdue" @if ($medicalRecord->financial_status == 'overdue') selected @endif>متأخر
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="amount_paid" class="form-label">المبلغ المدفوع</label>
                                    <input type="number" class="form-control" id="amount_paid" name="amount_paid"
                                        value="{{ $medicalRecord->amount_paid }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="notes" class="form-label">الملاحظات</label>
                                    <textarea class="form-control" id="notes" name="notes">{{ $medicalRecord->notes }}</textarea>
                                </div>
                                <div class="col-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-primary">تحديث السجل</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
