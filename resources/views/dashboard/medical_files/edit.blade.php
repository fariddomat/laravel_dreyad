<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white">
                        <h6>تعديل الملف الطبي</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.patients.medical_files.update', [$patient, $medicalFile]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">نوع الملف</label>
                                <select name="file_type" class="form-select">
                                    <option value="consent" {{ $medicalFile->file_type == 'consent' ? 'selected' : '' }}>إقرار</option>
                                    <option value="x-ray" {{ $medicalFile->file_type == 'x-ray' ? 'selected' : '' }}>أشعة</option>
                                    <option value="examination" {{ $medicalFile->file_type == 'examination' ? 'selected' : '' }}>فحص</option>
                                    <option value="before_after" {{ $medicalFile->file_type == 'before_after' ? 'selected' : '' }}>قبل وبعد</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الوصف</label>
                                <input type="text" name="description" class="form-control" value="{{ $medicalFile->description }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">تحديث الملف (اختياري)</label>
                                <input type="file" name="file_path" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">تحديث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
