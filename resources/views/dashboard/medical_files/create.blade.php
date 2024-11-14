<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white">
                        <h6>إضافة ملف طبي جديد</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.patients.medical_files.store', $patient) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('components.error-alert')
                            <div class="mb-3">
                                <label class="form-label">نوع الملف</label>
                                <select name="file_type" class="form-select">
                                    <option value="consent">إقرار</option>
                                    <option value="x-ray">أشعة</option>
                                    <option value="examination">فحص</option>
                                    <option value="before_after">قبل وبعد</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الوصف</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الملف</label>
                                <input type="file" name="file_path" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">إضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
