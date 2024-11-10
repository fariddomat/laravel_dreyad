<x-app-layout>
    <div class="container-fluid my-6">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="col-6 text-white text-capitalize ps-3">إضافة مريض جديد</h6>
                </div>
            </div>
        <div class="card my-4 mx-md-4 mt-n6">
            <form action="{{ route('dashboard.patients.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الملف</label>
                        <input name="file_number" type="text" class="form-control" value="{{ old('file_number') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">اسم المريض</label>
                        <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الجنس</label>
                        <select name="gender" class="form-control">
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الجوال الأول</label>
                        <input name="mob1" type="text" class="form-control" value="{{ old('mob1') }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الجوال الثاني</label>
                        <input name="mob2" type="text" class="form-control" value="{{ old('mob2') }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">تاريخ التواصل</label>
                        <input name="date_contacted" type="date" class="form-control" value="{{ old('date_contacted') }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">المصدر</label>
                        <input name="source" type="text" class="form-control" value="{{ old('source') }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">مستوى المريض</label>
                        <select name="level" class="form-control">
                            <option value="junk" {{ old('level') == 'junk' ? 'selected' : '' }}>غير هام</option>
                            <option value="vip" {{ old('level') == 'vip' ? 'selected' : '' }}>VIP</option>
                            <option value="normal" {{ old('level') == 'normal' ? 'selected' : '' }}>عادي</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">الملاحظات</label>
                        <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark">إضافة مريض</button>
            </form>
        </div>
    </div>
</x-app-layout>
