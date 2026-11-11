@extends('layout.master')
@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card card-primary">
            <div class="card-body">
                {!! $notices->description !!}
            </div>
        </div>


    </div>
    <div class="col-md-12 col-lg-12">
         <ul class="dot_status">
            <li><span style="color: #62866c; font-size: 30px;">●</span>  Wir kommen zu ihnen</li>
            <li> <span style="color: red; font-size: 30px;">●</span> Wir kommen NICHT zu ihnen  </li>
        </ul>
    </div>
    <div class="col-md-12 col-lg-12">

        <div class="card" style="padding: 0; background: border-box;">
            <div class="table-responsive-vertical ">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Datum und Uhrzeit</th>
                            <th>Mitarbeiter</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($recursiveSlots as $k => $slot)

                            <tr>
                                <td data-title="Datum">
                                    <b> {{ date('d.m.Y', strtotime($slot['startDate'])) }} </b>
                                    <br>
                                    {{ $slot['start'] . '-' . $slot['end'] }}
                                </td>

                                <td data-title="Mitarbeiter">{{ $slot['employee'] }}</td>
                                <td data-title="Status"><span style="color: {{ $slot['color'] }}; font-size: 30px; line-height: 0;">●</span></td>
                                <td data-title="Action">
                                    <button type="button" class="btn btn-danger open_modal btn-sm {{ $slot['status'] == 1 || ( $slot['status'] == 0 && $slot['color'] == '#dc3545') ? "disabled" : "" }}"
                                        data-get_date="{{ date('Y-m-d', strtotime($slot['startDate'])) }}"
                                        data-get_time="{{ $slot['start'] . '-' . $slot['end'] }}"
                                        data-start_time="{{ $slot['start'] }}"
                                        data-get_employee_id="{{ $slot['employee_id'] }}"
                                        data-get_event_id="{{ $slot['event_id'] }}"
                                    > {{ $slot['status'] == 1 || ($slot['status'] == 0 && $slot['color'] == '#dc3545') ? "Abgesagt" : "Termin absagen" }} </button>
                                </td>
                            </tr>

                            {{-- <tr>
                                <td><b> {{ date('d.m.Y', strtotime($slot['startDate'])) }} </b> <br>
                                    {{ $slot['start'] . '-' . $slot['end'] }}</td>
                                <td>{{ $slot['employee'] }}</td>
                                <td style="color: {{ $slot['color'] }}; font-size: 30px;">●</td>
                                <td>
                                    <button type="button" class="btn btn-danger open_modal btn-sm {{  $slot['status'] == 1 ? "disabled" : "" }}"
                                        data-get_date="{{ date('Y-m-d', strtotime($slot['startDate'])) }}"
                                        data-get_time="{{ $slot['start'] . '-' . $slot['end'] }}"
                                        data-start_time="{{ $slot['start'] }}"
                                        data-get_employee_id="{{ $slot['employee_id'] }}"
                                        data-get_event_id="{{ $slot['event_id'] }}"
                                    > {{ $slot['status'] == 1 ? "Abgesagt" : "Termin absagen" }}</button>
                                </td>
                            </tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <div class="col-md-12 col-lg-12">
         <ul class="dot_status">
            <li><span style="color: #62866c; font-size: 30px;">●</span>  Wir kommen zu ihnen</li>
            <li> <span style="color: red; font-size: 30px;">●</span> Wir kommen NICHT zu ihnen  </li>
        </ul>
    </div>


    {{-- <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="table-responsive text-nowrap p-4">
                <table class="table" id="list_ticket">
                    <thead class="table-light">
                        <tr>
                            <th>Sl</th>
                            <th>Patient</th>
                            <th>Zustandig</th>
                            <th>Status</th>
                            <th>Telefon</th>
                            <th>Datum</th>
                            <th>Info</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($tickets as $k => $ticket)
                            <tr>
                                <td>{{ ++$k }}</td>
                                <td>{{ $ticket->getPatient->first_name .' '.$ticket->getPatient->last_name }}</td>
                                <td>---</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->contact }}</td>
                                <td>{{ $ticket->date != null ? date('d-m-Y', strtotime($ticket->date)) : '---' }}</td>
                                <td>{{ $ticket->description }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($ticket->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('/') }}assets/datatables/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('/') }}assets/datatables/js/dataTables.js"></script> --}}
    <script src="{{ asset('/') }}assets/table_design/script.js"></script>
    <script src="{{ asset('/') }}assets/stweetAlert/js/sweetalert2@11.js"></script>

    <script>
        // new DataTable('#example', {
        //     language: {
        //         infoEmpty: 'Keine Datensätze verfügbar',
        //         emptyTable: "Keine Termine vorhanden",
        //         zeroRecords: "Keine übereinstimmenden Datensätze gefunden",
        //         search: "Suchen:",
        //         lengthMenu: '_MENU_  Datensätze pro Seite',
        //     }

        // });
        // new DataTable('#list_ticket');

        // $(document).on('click', '.open_modal', function(e) {
        //     $("#staticBackdrop").modal('show')
        // })


        // Delete function goes here

        $(document).on('click', '.open_modal', function(){
            let getDate = $(this).data('get_date');
            let getTime = $(this).data('get_time');
            let getEmployee = $(this).data('get_employee_id');
            let getEventId = $(this).data('get_event_id');
            let startTime = $(this).data('start_time');
            let _token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Sind Sie sicher?',
                html: "Termine, die NICHT mindestens 24 Stunden vorher abgesagt werden, sind <u><b>kostenpflichtig</b></u>.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Absage ausführen',
                cancelButtonText: 'Nein'
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('phoneTicket/') }}/",
                        method: "POST",
                        data: {
                            'get_data' : getDate,
                            'get_time' : getTime,
                            'event_id' : getEventId,
                            'start_time' : startTime,
                            'getEmployee' : getEmployee,
                            '_token' : _token,
                        },
                        success: function(rep){

                            console.log(rep);
                            location.reload();

                            // dataTableRefresh();
                        },
                        error: function(xhr){
                            console.log(xhr);
                        }

                    })
                }
            })

        })


    </script>
@endpush

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('/') }}assets/datatables/css/dataTables.dataTables.css" /> --}}
    <link rel="stylesheet" href="{{ asset('/') }}assets/table_design/style.css" />

    <style>
        .dot_status {
            padding: 0;
            margin: 0;
        }

        .dot_status li {
                list-style: none;
                float: left;
                margin-right: 20px;
            }
    </style>

@endpush
