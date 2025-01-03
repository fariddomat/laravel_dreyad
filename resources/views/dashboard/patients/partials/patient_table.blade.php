<table id="Table" class="table align-items-center mb-0">
    <thead>
        <tr>
            <th>اسم المريض</th>
            <th>رقم الملف</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->file_number }}</td>
                <td>
                    <a href="{{ route('dashboard.patients.show', $patient) }}" class="btn btn-primary text-white">
                        <i class="material-icons">visibility</i>
                    </a>
                    <a href="{{ route('dashboard.payments.user', $patient->id) }}" class="btn btn-info text-white">
                        <i class="material-icons">payments</i> عرض الدفعات
                    </a>
                    <a href="{{ route('dashboard.medical_records.user', $patient->id) }}" class="btn btn-info text-white">
                        <i class="material-icons">bookmark</i> السجلات الطبية
                    </a>
                    <a href="{{ route('dashboard.patients.edit', $patient) }}" class="btn btn-success text-white">
                        <i class="material-icons">edit</i>
                    </a>
                    <form action="{{ route('dashboard.patients.destroy', $patient) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">
                            <i class="material-icons">close</i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">لا توجد بيانات</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $patients->links() }}
</div>
