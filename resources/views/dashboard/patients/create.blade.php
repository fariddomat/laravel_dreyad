<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <form action="{{ route('dashboard.patients.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الملف</label>
                        <input name="file_number" type="text" class="form-control" value="{{ old('file_number') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">اسم المريض</label>
                        <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الجوال</label>
                        <input name="phone" type="text" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">تاريخ الميلاد</label>
                        <input name="birth_date" type="date" class="form-control" value="{{ old('birth_date') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">المصدر</label>
                        <input name="source" type="text" class="form-control" value="{{ old('source') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-control">
                            <option value="مجدول مسبقاً">مجدول مسبقاً</option>
                            <option value="حضر">حضر</option>
                            <option value="لم يحضر">لم يحضر</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">العيادة</label>
                        <input name="clinic" type="text" class="form-control" value="{{ old('clinic') }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الملاحظات</label>
                        <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark">إضافة مريض</button>
            </form>
        </div>
    </div>
</x-app-layout>
