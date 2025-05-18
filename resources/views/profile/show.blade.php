@extends('layouts.dashboard')

@section('sidebar')
@if(Auth::user()->roles == 'admin')
@include('sidebars.admin')
@else
@include('sidebars.user')
@endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">

            <div class="d-flex flex-row justify-content-start">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}<i class="fa fa-check ml-1"></i></div>
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <h2 class="page-title">Profil Pengguna</h2>
                    <p class="text-muted">Kemaskini maklumat anda di sini</p>
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Profil</strong>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="matric_no">No Matriks</label>
                                            <input type="text" name="matric_no" id="matric_no" class="form-control" value="{{ $user->matric_no }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="sector">Sektor</label>
                                            <select class="form-control" name="sector" id="sector">
                                                <option disabled {{ $user->sector == null ? 'selected' : '' }}>-- Sila Pilih Sektor --</option>
                                                <option value="Sistem Komputer" {{ $user->sector == 'Sistem Komputer' ? 'selected' : '' }}>Sistem Komputer</option>
                                                <option value="Tekstil Pakaian" {{ $user->sector == 'Tekstil Pakaian' ? 'selected' : '' }}>Tekstil Pakaian</option>
                                                <option value="Elektrik" {{ $user->sector == 'Elektrik' ? 'selected' : '' }}>Elektrik</option>
                                                <option value="Automotif" {{ $user->sector == 'Automotif' ? 'selected' : '' }}>Automotif</option>
                                                <option value="Motosikal" {{ $user->sector == 'Motosikal' ? 'selected' : '' }}>Motosikal</option>
                                                <option value="Kulinari" {{ $user->sector == 'Kulinari' ? 'selected' : '' }}>Kulinari</option>
                                                <option value="Pastri" {{ $user->sector == 'Pastri' ? 'selected' : '' }}>Pastri</option>
                                                <option value="Penyaman Udara" {{ $user->sector == 'Penyaman Udara' ? 'selected' : '' }}>Penyaman Udara</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="fullname">Nama Penuh</label>
                                            <input type="text" name="fullname" id="fullname" class="form-control" value="{{ $user->fullname }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="phone_no">No Telefon</label>
                                            <input type="text" name="phone_no" id="phone_no" class="form-control" value="{{ $user->phone_no }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row px-3 align-items-center">
                                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                                    <a href="{{ route('profile.reset-password') }}" class="text-primary ml-3">Reset Kata Laluan</a>
                                </div>
                            </form>
                        </div>
                    </div> <!-- / .card -->

                </div>
            </div> <!-- .row-->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-box fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Package has uploaded successfull</strong></small>
                                <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                <small class="badge badge-pill badge-light text-muted">1m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-download fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Widgets are updated successfull</strong></small>
                                <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                <small class="badge badge-pill badge-light text-muted">2m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-inbox fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Notifications have been sent</strong></small>
                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-link fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Link was attached to menu</strong></small>
                                <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                <small class="badge badge-pill badge-light text-muted">1h ago</small>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div> <!-- / .list-group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <div class="squircle bg-success justify-content-center">
                            <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Control area</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Activity</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Droplet</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Upload</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-users fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Users</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Settings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection