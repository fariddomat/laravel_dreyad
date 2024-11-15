<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">إضافة دفعة مالية</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.payments.store') }}">
                            @csrf
                            @include('components.error-alert')
                            <div class="form-group">
                                <label for="medical_record_id">السجل الطبي</label>
                                <select id="medical_record_id" name="medical_record_id" class="form-control">
                                    @foreach ($medicalRecords as $record)
                                        <option value="{{ $record->id }}">{{ $record->patient->name }} -
                                            {{ $record->service }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">المبلغ</label>
                                <input type="number" id="amount" name="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="discount">الخصم</label>
                                <input type="number" id="discount" name="discount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="payment_method">طريقة الدفع</label>
                                <select id="payment_method" name="payment_method" class="form-control">
                                    <option value="cash">نقدًا</option>
                                    <option value="card">بطاقة</option>
                                    <option value="bank_transfer">تحويل بنكي</option>
                                    <option value="other">أخرى</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_date">تاريخ الدفع</label>
                                <input type="date" id="payment_date" name="payment_date" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="status">حالة الدفع</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="fully_paid">مدفوع بالكامل</option>
                                    <option value="partially_paid">غير مدفوع بالكامل</option>
                                    <option value="overdue">متأخر</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
