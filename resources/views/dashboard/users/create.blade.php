<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">إضافة مستخدم جديد</h6>
                            <div class="col-6 text-end">
                                <a href="{{ route('dashboard.users.index') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;رجوع
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-2 pb-2">
                        <form action="{{ route('dashboard.users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="mb-3">
                                <label for="roles" class="form-label">الأدوار</label>
                                @foreach ($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $role->name }}" name="roles[]" id="role-{{ $role->id }}">
                                        <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
