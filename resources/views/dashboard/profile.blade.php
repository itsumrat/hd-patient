
@extends('layout.master')
@section('content')



        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->first_name.' '.$profile->last_name }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Strasse Hausnummer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->road }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">PLZ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->plz }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Ort</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->place }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Ortsteil / Stadtteil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->ortsteil }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Telefon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->telephone }}" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" value="{{ $profile->email }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Phone No</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $profile->mobile }}"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
