<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">استيردا ملف excl</h6>
                            <div class="col-6 text-end">
                                <a href="/" class="btn bg-gradient-dark mb-0">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;رجوع
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-2 pb-2">
                        <form action="{{ route('dashboard.import.patients') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('components.error-alert')

                            <div class="mb-3">
                                <label for="name" class="form-label">الملف</label>
                                <input type="file" class="form-control" id="name" name="file" required>
                            </div>

                            <button type="submit" class="btn btn-primary">تحميل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
