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
                paging: true,
                info: true,
                sorting: true,
                pageLength: 25, // Sets the default number of records per page
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json', // Correct URL
                },
                dom: 'Bfrtip',
                buttons: [
                    {
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
                    var date = moment(data[11], 'YYYY-MM-DD H:mm:ss'); // Assuming created_at is in the 12th column
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

            $('#filter-today').click(function() {
                var today = moment().startOf('day');
                filterByDate(today, moment().endOf('day'));
            });

            $('#filter-yesterday').click(function() {
                var yesterday = moment().subtract(1, 'days').startOf('day');
                filterByDate(yesterday, yesterday.endOf('day'));
            });

            $('#filter-week').click(function() {
                var startOfWeek = moment().startOf('isoWeek');
                filterByDate(startOfWeek, moment().endOf('day'));
            });

            $('#filter-month').click(function() {
                var startOfMonth = moment().startOf('month');
                filterByDate(startOfMonth, moment().endOf('day'));
            });

            $('#filter-all').click(function() {
                filterByDate(null, null);
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
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة الخدمات</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.services.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة خدمة
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="Table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الخدمة</th>
                                        <th>الوصف</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description ?? 'غير متوفر' }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.services.show', $service) }}" class="btn btn-primary text-white">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="{{ route('dashboard.services.edit', $service) }}" class="btn btn-success text-white">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('dashboard.services.destroy', $service) }}" method="POST" style="display:inline;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
