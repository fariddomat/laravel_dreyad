<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary text-white">
                        <h6>عرض الملف الطبي</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>نوع الملف:</strong> {{ $medicalFile->file_type }}</p>
                        <p><strong>الوصف:</strong> {{ $medicalFile->description ?? 'لا يوجد' }}</p>
                        <p><strong>التاريخ:</strong> {{ $medicalFile->created_at->format('Y-m-d') }}</p>
                        <div class="mb-3">
                            <strong>عرض الملف:</strong>
                            <div>
                                <img src="{{ asset($medicalFile->file_path) }}" alt="صورة الملف" class="img-fluid">
                            </div>
                        </div>
                        <a href="{{ route('dashboard.patients.medical_files.index', $patient) }}" class="btn btn-secondary">العودة إلى القائمة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
