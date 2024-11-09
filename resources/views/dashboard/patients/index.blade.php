<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة المرضى</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.patients.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة مريض</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="Table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الملف</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم المريض</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الجوال</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحالة</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->file_number }}</td>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->phone }}</td>
                                        <td>{{ $patient->status }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('dashboard.patients.show', $patient) }}" class="btn btn-primary btn-link  text-white">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{ route('dashboard.patients.edit', $patient) }}" class="btn btn-success btn-link  text-white">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="{{ route('dashboard.patients.destroy', $patient) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-link  text-white">
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
