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
                searching: false,
                paging: false,
                info: true,
                sorting: true,
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

        });
    </script>
<script>
    $(document).ready(function () {
        const searchField = $('#search');

        searchField.on('keyup', function () {
            const query = $(this).val();

            $.ajax({
                url: "{{ route('dashboard.patients.index') }}",
                method: "GET",
                data: { search: query },
                beforeSend: function () {
                    $('#patientTable').html('<p class="text-center">جاري التحميل...</p>');
                },
                success: function (response) {
                    $('#patientTable').html(response.html);
                },
                error: function () {
                    alert('حدث خطأ أثناء البحث.');
                }
            });
        });

        // Handle pagination clicks
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();

            const url = $(this).attr('href');

            $.ajax({
                url: url,
                success: function (response) {
                    $('#patientTable').html(response.html);
                },
                error: function () {
                    alert('حدث خطأ أثناء التحميل.');
                }
            });
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
                            <h6 class="col-6 text-white text-capitalize ps-3">قائمة المرضى</h6>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.patients.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;إضافة مريض
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="p-3">
                            <input id="search" type="text" class="form-control" placeholder="ابحث عن مريض...">
                        </div>
                        <div class="table-responsive p-0" id="patientTable">
                            @include('dashboard.patients.partials.patient_table', ['patients' => $patients])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

