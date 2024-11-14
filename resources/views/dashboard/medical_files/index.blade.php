<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">ملفات طبية للمريض: {{ $patient->name }}</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.patients.medical_files.create', $patient) }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة ملف طبي
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
                                        <th>نوع الملف</th>
                                        <th>وصف</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicalFiles as $file)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $file->file_type }}</td>
                                            <td>{{ $file->description ?? 'لا يوجد' }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.patients.medical_files.show', [$patient, $file]) }}" class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.patients.medical_files.edit', [$patient, $file]) }}" class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('dashboard.patients.medical_files.destroy', [$patient, $file]) }}" method="POST" style="display: inline;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
