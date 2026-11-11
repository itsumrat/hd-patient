@extends('layout.master')
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <form method="get" action="" class="form-horizontal" id="employeeForm">
                <div class="card-header">
                    <p>Im Archiv erhalten Sie eine Übersicht über alle geleisteten Stunden im ausgewählten Zeitraum.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">

                                <div class="col-md-3">
                                    <input type="text" name="selected_date" class="form-control" id="month_year" value="{{ date('Y-m-d', strtotime($startDate)) }}" data-format="MM-yyyy" required>
                                    @if($errors->has('selected_date'))
                                        <div class="error">{{ $errors->first('selected_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-success">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

    </div>
    <div class="col-md-12 col-lg-12">

        <div class="card" style="padding: 0; background: border-box;">

            <div class="table-responsive-vertical ">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Mitarbeiter</th>
                            <th>Anfang</th>
                            <th>Ende</th>
                            <th>Stunden</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($books as $book)

                            <tr>
                                <td>{{ date("d-m-Y", strtotime($book->book_date)) }}</td>
                                <td>{{ $book->getEmployee->first_name ." ".$book->getEmployee->last_name }}</td>
                                <td>{{ $book->start_time }}</td>
                                <td>{{ $book->end_time }}</td>
                                <td>{{ $book->total_hours }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>


@endsection

@push('scripts')
    <script src="{{ asset('/') }}assets/table_design/script.js"></script>
    <script src="{{ asset('/') }}assets/stweetAlert/js/sweetalert2@11.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>

    <script>
        $(function () {
            $('#month_year').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy-mm',
                monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
                monthNamesShort: ["1","2","3","4","5","6","7","8","9","10","11","12"],
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                },
                beforeShow: function (elem,dp) {
                    $(dp.dpDiv).addClass('hide-day-calender'); //here a change
                }
            })
            var value = '{{$startDate}}'
            $('#month_year').datepicker('setDate', new Date(value));
        })
    </script>


@endpush

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('/') }}assets/datatables/css/dataTables.dataTables.css" /> --}}
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('/') }}assets/table_design/style.css" />

    <style>
        thead, tbody, tfoot, tr, td, th {
            color: #000 !important;
        }
        .dot_status {
            padding: 0;
            margin: 0;


        }

        .hide-day-calender .ui-datepicker-calendar{
            display:none;
        }

        .dot_status li {
                list-style: none;
                float: left;
                margin-right: 20px;
            }
    </style>

@endpush
