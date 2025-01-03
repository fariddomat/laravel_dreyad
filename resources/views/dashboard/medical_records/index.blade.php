@section('styles')
    {{-- <link href="{{asset('dashboard/css/datatables.min.css')}}" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.css" rel="stylesheet">
    <style>
        table.dataTable thead>tr>th.dt-orderable-asc,
        table.dataTable thead>tr>th.dt-orderable-desc,
        table.dataTable thead>tr>td.dt-orderable-asc,
        table.dataTable thead>tr>td.dt-orderable-desc {
            text-align: right;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/filtering/row-based/range_dates.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.js"
        defer></script>

    <script defer>
        $(document).ready(function() {
                    var table = $('#Table').DataTable({
                        responsive: true,
                        searching: true,
                        paging: false,
                        info: true,
                        sorting: true,
                        pageLength: 25, // Sets the default number of records per page
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json', // Correct URL
                        },
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'print',
                                exportOptions: {
                                    columns: ':not(:last-child)'
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: ':not(:last-child)'
                                },
                                customize: function(xlsx) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    $('sheet', sheet).attr('rightToLeft', 'true');
                                }
                            }
                        ]
                    });

                    function filterByDate(startDate, endDate) {
                        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                            var date = moment(data[11],
                            'YYYY-MM-DD H:mm:ss'); // Assuming created_at is in the 12th column
                            if (
                                (!startDate && !endDate) ||
                                (!startDate && date.isBefore(endDate)) ||
                                (!endDate && date.isAfter(startDate)) ||
                                (date.isBetween(startDate, endDate))
                            ) {
                                return true;
                            }
                            return false;
                        });
                        table.draw();
                        $.fn.dataTable.ext.search.pop();
                    }



                    $('#apply-filters').on('click', function() {
                        let service = $('#filter-service').val();
                        let dateStart = $('#filter-date-start').val();
                        let status = $('#filter-status').val();
                        let financialStatus = $('#filter-financial-status').val();

                        let queryParams = new URLSearchParams({
                            service: service,
                            date_start: dateStart,
                            status: status,
                            financial_status: financialStatus
                        }).toString();

                        window.location.href = `?${queryParams}`;
                    });
                });
    </script>
@endsection
<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة السجلات الطبية</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0"
                                    href="{{ route('dashboard.medical_records.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة سجل طبي
                                </a>
                            </div>
                            <div class="row mb-3 mt-2">
                                <div class="col-md-2">
                                    <select name="service" id="filter-service" class="form-control">
                                        <option value="">كل الخدمات</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service }}">{{ $service }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="date_start" id="filter-date-start" class="form-control"
                                        placeholder="Start Date">
                                </div>
                                <div class="col-md-2">
                                    <select name="status" id="filter-status" class="form-control">
                                        <option value="">الحالات</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="financial_status" id="filter-financial-status" class="form-control">
                                        <option value="">الحالة المالية</option>
                                        @foreach ($financialStatuses as $financialStatus)
                                            <option value="{{ $financialStatus }}">{{ $financialStatus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button id="apply-filters" class="btn btn-primary">فلترة</button>
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="{{ route('dashboard.medical_records.export') }}"
                                        class="btn btn-success">Export to Excel</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="Table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المريض</th>
                                        <th>نوع الخدمة</th>
                                        <th>أرقام الأسنان المعالجة</th>
                                        <th>عدد الزيارات</th>
                                        <th>تاريخ بدء العلاج</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicalRecords as $medicalRecord)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $medicalRecord->patient?->name }}</td>
                                            <td>{{ $medicalRecord->service }}</td>
                                            <td>{{ $medicalRecord->teeth_no }}</td>
                                            <td>{{ $medicalRecord->visits_no }}</td>
                                            <td>{{ $medicalRecord->date_start }}</td>

                                            <td>
                                                <a href="{{ route('dashboard.medical_records.show', $medicalRecord) }}"
                                                    class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.medical_records.edit', $medicalRecord) }}"
                                                    class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form
                                                    action="{{ route('dashboard.medical_records.destroy', $medicalRecord) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $medicalRecords->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
