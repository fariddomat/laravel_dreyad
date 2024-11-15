<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">
                                الدفعات المالية - {{ $patient->name }}
                            </h6>
                            <div class="col-6 text-end">
                                <a href="{{ route('dashboard.payments.index') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;رجوع
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
                                        <th>المبلغ المدفوع</th>
                                        <th>طريقة الدفع</th>
                                        <th>التاريخ</th>
                                        <th>الوصف</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ $payment->payment_method }}</td>
                                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $payment->description ?? 'لا يوجد وصف' }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.payments.show', $payment->id) }}" class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.payments.edit', $payment->id) }}" class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('dashboard.payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($payments->isEmpty())
                            <div class="text-center mt-4">
                                <h6 class="text-muted">لا توجد دفعات مالية لهذا المستخدم.</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
