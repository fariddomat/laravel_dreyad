<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة الدفعات المالية</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.payments.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة دفعة
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المريض</th>
                                        <th>الخدمة</th>
                                        <th>المبلغ المدفوع</th>
                                        <th>طريقة الدفع</th>
                                        <th>تاريخ الدفع</th>
                                        <th>حالة الدفع</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->medicalRecord->patient->name }}</td>
                                            <td>{{ $payment->medicalRecord->service }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>
                                                @switch($payment->payment_method)
                                                    @case('cash') نقدًا @break
                                                    @case('card') بطاقة @break
                                                    @case('bank_transfer') تحويل بنكي @break
                                                    @default أخرى
                                                @endswitch
                                            </td>
                                            <td>{{ $payment->payment_date }}</td>
                                            <td>
                                                @switch($payment->status)
                                                    @case('fully_paid') مدفوع بالكامل @break
                                                    @case('partially_paid') غير مدفوع بالكامل @break
                                                    @case('overdue') متأخر @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.payments.show', $payment) }}" class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.payments.edit', $payment) }}" class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('dashboard.payments.destroy', $payment) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
