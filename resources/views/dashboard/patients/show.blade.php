@section('styles')
<!-- Viewer.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.1/viewer.min.css" />
<!-- Viewer.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.1/viewer.min.js"></script>

    {{-- <link href="{{asset('dashboard/css/datatables.min.css')}}" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.css" rel="stylesheet">
    <style>
        img{
            cursor: zoom-in;
        }

        table.dataTable thead>tr>th.dt-orderable-asc,
        table.dataTable thead>tr>th.dt-orderable-desc,
        table.dataTable thead>tr>td.dt-orderable-asc,
        table.dataTable thead>tr>td.dt-orderable-desc {
            text-align: right;
        }

        .card .card-body {
            padding: 0
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
    <div class="container-fluid my-6">
        <div class="card my-4 shadow-lg border-radius-lg">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="col-6 text-white text-capitalize ps-3">عرض مريض</h6>
                </div>
            </div>
            <div class="card-body my-4 mx-md-4 mt-n6">
                <!-- معلومات المريض -->
                <div class="row">
                    @if ($patient->file_number)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">رقم الملف</h6>
                                    <p>{{ $patient->file_number }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->name)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">اسم المريض</h6>
                                    <p>{{ $patient->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->date_contacted)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">تاريخ التواصل</h6>
                                    <p>{{ $patient->date_contacted }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->gender)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">الجنس</h6>
                                    <p>{{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->mob1)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">رقم الجوال الأول</h6>
                                    <p>{{ $patient->mob1 }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->mob2)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">رقم الجوال الثاني</h6>
                                    <p>{{ $patient->mob2 }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->date_contacted)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">تاريخ التواصل</h6>
                                    <p>{{ $patient->date_contacted }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->source)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">المصدر</h6>
                                    <p>{{ $patient->source }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->level)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">مستوى المريض</h6>
                                    <p>
                                        @if ($patient->level == 'vip')
                                            VIP
                                        @elseif($patient->level == 'junk')
                                            غير هام
                                        @else
                                            عادي
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($patient->notes)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">الملاحظات</h6>
                                    <p>{{ $patient->notes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif


                    <hr class="my-4">

                    <!-- إحصائيات المريض -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <label class="form-label text-primary fw-bold">عدد السجلات الطبية</label>
                                    <p><a href="{{ route('dashboard.medical_records.user', $patient) }}"
                                            class="text-decoration-underline">{{ $medicalRecordsCount }}</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <label class="form-label text-primary fw-bold">عدد المدفوعات</label>
                                    <p><a href="{{ route('dashboard.payments.user', $patient) }}"
                                            class="text-decoration-underline">{{ $paymentsCount }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <div class="card shadow-sm border-radius-lg">
                                <div class="card-body">
                                    <label class="form-label text-primary fw-bold">إجمالي المبلغ المدفوع</label>
                                    <p>{{ number_format($patient->total_amount_paid, 2) }} ر.س</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Collapse للسجلات الطبية -->
                    <div class="accordion my-4" id="medicalRecordsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingRecords">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseRecords" aria-expanded="true"
                                    aria-controls="collapseRecords">
                                    السجلات الطبية
                                </button>
                            </h2>
                            <div id="collapseRecords" class="accordion-collapse collapse show"
                                aria-labelledby="headingRecords" data-bs-parent="#medicalRecordsAccordion">
                                <div class="accordion-body">
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
                                                @foreach ($patient->medical_records as $medicalRecord)
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
                                                                <button type="submit"
                                                                    class="btn btn-danger text-white">
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

                    <div class="mb-3">
                        <a href="{{ route('dashboard.patients.medical_files.index', $patient) }}"
                            class="btn btn-primary">عرض الملفات الطبية</a>
                    </div>
                    <!-- Collapse للملفات الطبية -->
                    <div class="accordion my-4" id="medicalFilesAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFiles">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFiles" aria-expanded="true"
                                    aria-controls="collapseFiles">
                                    الملفات الطبية
                                </button>
                            </h2>
                            <div id="collapseFiles" class="accordion-collapse collapse show"
                                aria-labelledby="headingFiles" data-bs-parent="#medicalFilesAccordion">
                                <div class="accordion-body">
                                    <div id="medical-files-gallery" class="row">
                                        @foreach ($patient->medicalFiles as $file)
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img src="{{ asset($file->file_path) }}" class="card-img-top medical-file-image"
                                                        alt="{{ $file->description }}" data-title="{{ $file->description }}">
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $file->description }} - {{ $file->file_type }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Initialize Viewer.js -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Select the gallery container
                            const gallery = document.getElementById('medical-files-gallery');

                            // Initialize Viewer.js
                            const viewer = new Viewer(gallery, {
                                toolbar: {
                                    zoomIn: true,
                                    zoomOut: true,
                                    rotateLeft: true,
                                    rotateRight: true,
                                    reset: true,
                                    prev: true,
                                    next: true,
                                },
                                title: true,
                                movable: true,
                                zoomable: true,
                                rotatable: true,
                                scalable: true,
                                fullscreen: true,
                                url(image) {
                                    return image.src; // Use the image's `src` as the URL
                                }
                            });
                        });
                    </script>

                    <!-- زر العودة -->
                    <a href="{{ route('dashboard.patients.index') }}" class="btn btn-secondary">العودة إلى
                        القائمة</a>
                </div>
            </div>
        </div>
</x-app-layout>
