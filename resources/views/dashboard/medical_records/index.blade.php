<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة السجلات الطبية</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0"
                                    href="{{ route('dashboard.medical_records.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة سجل طبي
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
                                        <th>اسم المريض</th>
                                        <th>نوع الخدمة</th>
                                        <th>أرقام الأسنان المعالجة</th>
                                        <th>عدد الزيارات</th>
                                        <th>تاريخ بدء العلاج</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicalRecords as $medicalRecord)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $medicalRecord->patient->name }}</td>
                                            <td>{{ $medicalRecord->service }}</td>
                                            <td>{{ $medicalRecord->teeth_no }}</td>
                                            <td>{{ $medicalRecord->visits_no }}</td>
                                            <td>{{ $medicalRecord->date_start }}</td>

                                            <td>
                                                <a href="{{ route('dashboard.medical_records.show', $medicalRecord) }}"
                                                    class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.medical_records.edit', $medicalRecord) }}"
                                                    class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form
                                                    action="{{ route('dashboard.medical_records.destroy', $medicalRecord) }}"
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

                            {{ $medicalRecords->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
