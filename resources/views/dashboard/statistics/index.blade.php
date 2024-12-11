<x-app-layout>
    <div class="container-fluid my-6">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="col-6 text-white text-capitalize ps-3">الإحصائيات</h6>
                </div>
            </div>
            <div class="card-body my-4 mx-md-4 mt-n6">
                <form method="GET" action="{{ route('dashboard.statistics') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="month" class="form-label">الشهر</label>
                            <select name="month" id="month" class="form-control">
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="year" class="form-label">السنة</label>
                            <select name="year" id="year" class="form-control">
                                @foreach(range(now()->year - 5, now()->year) as $y)
                                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">فلترة</button>
                        </div>
                    </div>
                </form>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">عدد المرضى</div>
                            <div class="card-body">
                                <h3>{{ $patientsCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">عدد السجلات الطبية</div>
                            <div class="card-body">
                                <h3>{{ $medicalRecordsCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">إجمالي المدفوعات</div>
                            <div class="card-body">
                                <h3>{{ number_format($totalPayments, 2) }} $</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">إجمالي المدفوعات للسجلات الطبية</div>
                            <div class="card-body">
                                <h3>{{ number_format($totalMedicalRecordPayments, 2) }} $</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
