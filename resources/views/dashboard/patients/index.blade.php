<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة المرضى</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.patients.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة مريض
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="Table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>رقم الملف</th>
                                        <th>اسم المريض</th>
                                        <th>الجنس</th>
                                        <th>مستوى المريض</th>
                                        <th>تاريخ التواصل</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $patient->file_number }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                            <td>{{ $patient->level == 'vip' ? 'VIP' : ($patient->level == 'junk' ? 'غير هام' : 'عادي') }}
                                            </td>
                                            <td>{{ $patient->date_contacted ?? 'غير محدد' }}</td>

                                            <td>
                                                <a href="{{ route('dashboard.payments.user', $patient->id) }}" class="btn btn-info text-white">
                                                    <i class="material-icons">payments</i> عرض الدفعات
                                                </a>
                                                <a href="{{ route('dashboard.patients.show', $patient) }}"
                                                    class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.patients.edit', $patient) }}"
                                                    class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('dashboard.patients.destroy', $patient) }}"
                                                    method="POST" style="display: inline;">
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
