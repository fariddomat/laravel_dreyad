<x-app-layout>
    <div class="container-fluid my-6">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="col-6 text-white text-capitalize ps-3">الإحصائيات</h6>
                </div>
            </div>
            <div class="card-body my-4 mx-md-4 mt-n6">
                {{-- <form method="GET" action="{{ route('dashboard.statistics.show') }}">
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
                </form> --}}

                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>الشهر</th>
                                <th>عدد المرضى</th>
                                <th>عدد السجلات الطبية</th>
                                <th>إجمالي المدفوعات</th>
                                <th>إجمالي المدفوعات للملفات الطبية</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- First row - All months totals -->
                            <tr>
                                <td><strong>الإجمالي الكلي</strong></td>
                                <td>{{ array_sum(array_column($allMonthsData, 'patients_count')) }}</td>
                                <td>{{ array_sum(array_column($allMonthsData, 'medical_records_count')) }}</td>
                                <td>{{ number_format(array_sum(array_column($allMonthsData, 'total_payments')), 2) }}</td>
                                <td>{{ number_format(array_sum(array_column($allMonthsData, 'total_medical_record_payments')), 2) }}</td>
                            </tr>

                            <!-- Other rows for specific months -->
                            @foreach ($allMonthsData as $monthKey => $data)
                                <tr>
                                    <td>{{ \Carbon\Carbon::create()->month($monthKey)->format('F') }}</td>
                                    <td>{{ $data['patients_count'] }}</td>
                                    <td>{{ $data['medical_records_count'] }}</td>
                                    <td>{{ number_format($data['total_payments'], 2) }}</td>
                                    <td>{{ number_format($data['total_medical_record_payments'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('dashboard.statistics', ['month' => $month, 'year' => $year, 'export' => 'excel']) }}" class="btn btn-success">تصدير إلى Excel</a>
                    <a href="{{ route('dashboard.statistics', ['month' => $month, 'year' => $year, 'export' => 'pdf']) }}" class="btn btn-danger">تصدير إلى PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
