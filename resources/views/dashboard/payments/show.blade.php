<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">تفاصيل الدفعة المالية</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>اسم المريض:</strong> {{ $payment->medicalRecord->patient->name }}</p>
                        <p><strong>الخدمة:</strong> {{ $payment->medicalRecord->service }}</p>
                        <p><strong>المبلغ:</strong> {{ $payment->amount }}</p>
                        <p><strong>الخصم:</strong> {{ $payment->discount }}</p>
                        <p><strong>طريقة الدفع:</strong>
                            @switch($payment->payment_method)
                                @case('cash') نقدًا @break
                                @case('card') بطاقة @break
                                @case('bank_transfer') تحويل بنكي @break
                                @default أخرى
                            @endswitch
                        </p>
                        <p><strong>تاريخ الدفع:</strong> {{ $payment->payment_date }}</p>
                        <p><strong>حالة الدفع:</strong>
                            @switch($payment->status)
                                @case('fully_paid') مدفوع بالكامل @break
                                @case('partially_paid') غير مدفوع بالكامل @break
                                @case('overdue') متأخر @break
                            @endswitch
                        </p>
                        <a href="{{ route('dashboard.payments.edit', $payment) }}" class="btn btn-success">تعديل</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
