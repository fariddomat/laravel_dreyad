<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <form action="{{ route('dashboard.patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الملف</label>
                        <input name="file_number" type="text" class="form-control" value="{{ old('file_number', $patient->file_number) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">اسم المريض</label>
                        <input name="name" type="text" class="form-control" value="{{ old('name', $patient->name) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الجوال</label>
                        <input name="phone" type="text" class="form-control" value="{{ old('phone', $patient->phone) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">تاريخ الميلاد</label>
                        <input name="birth_date" type="date" class="form-control" value="{{ old('birth_date', $patient->birth_date) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">المصدر</label>
                        <input name="source" type="text" class="form-control" value="{{ old('source', $patient->source) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-control">
                            <option value="مجدول مسبقاً" @if($patient->status == 'مجدول مسبقاً') selected @endif>مجدول مسبقاً</option>
                            <option value="حضر" @if($patient->status == 'حضر') selected @endif>حضر</option>
                            <option value="لم يحضر" @if($patient->status == 'لم يحضر') selected @endif>لم يحضر</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">العيادة</label>
                        <input name="clinic" type="text" class="form-control" value="{{ old('clinic', $patient->clinic) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الملاحظات</label>
                        <textarea name="notes" class="form-control">{{ old('notes', $patient->notes) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark">تحديث المريض</button>
            </form>
        </div>
    </div>
</x-app-layout>
