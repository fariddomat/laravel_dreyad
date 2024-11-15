<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">تفاصيل الخدمة</h6>
                            <div class="col-6 text-end">
                                <a href="{{ route('dashboard.services.index') }}" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;رجوع
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="mb-3">
                            <strong>اسم الخدمة:</strong> {{ $service->name }}
                        </div>
                        <div class="mb-3">
                            <strong>الوصف:</strong> {{ $service->description ?? 'غير متوفر' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
