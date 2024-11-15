<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">تعديل دفعة مالية</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.payments.update', $payment) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="medical_record_id">السجل الطبي</label>
                                <select id="medical_record_id" name="medical_record_id" class="form-control">
                                    @foreach ($medicalRecords as $record)
                                        <option value="{{ $record->id }}"
                                            {{ $record->id == $payment->medical_record_id ? 'selected' : '' }}>
                                            {{ $record->patient->name }} - {{ $record->service }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">المبلغ</label>
                                <input type="number" id="amount" name="amount" class="form-control"
                                    value="{{ $payment->amount }}" required>
                            </div>

                            <div class="form-group">
                                <label for="discount">الخصم</label>
                                <input type="number" id="discount" name="discount" class="form-control"
                                    value="{{ $payment->discount }}">
                            </div>

                            <div class="form-group">
                                <label for="payment_method">طريقة الدفع</label>
                                <select id="payment_method" name="payment_method" class="form-control">
                                    <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>
                                        نقدًا</option>
                                    <option value="card" {{ $payment->payment_method == 'card' ? 'selected' : '' }}>
                                        بطاقة</option>
                                    <option value="bank_transfer"
                                        {{ $payment->payment_method == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي
                                    </option>
                                    <option value="other" {{ $payment->payment_method == 'other' ? 'selected' : '' }}>
                                        أخرى</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_date">تاريخ الدفع</label>
                                <input type="date" id="payment_date" name="payment_date" class="form-control"
                                    value="{{ $payment->payment_date }}" required>
                            </div>

                            <div class="form-group">
                                <label for="status">حالة الدفع</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="fully_paid"
                                        {{ $payment->status == 'fully_paid' ? 'selected' : '' }}>مدفوع بالكامل</option>
                                    <option value="partially_paid"
                                        {{ $payment->status == 'partially_paid' ? 'selected' : '' }}>غير مدفوع بالكامل
                                    </option>
                                    <option value="overdue" {{ $payment->status == 'overdue' ? 'selected' : '' }}>متأخر
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">تحديث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
