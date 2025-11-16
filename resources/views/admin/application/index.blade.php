@extends('layouts.dashboard')

@section('sidebar')
@include('sidebars.admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <div class="d-flex justify-content-start">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}<i class="fa fa-check ml-1"></i></div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}<i class="fa fa-times ml-1"></i></div>
                        @endif
                    </div>
                </div>
                <div class="col-auto">
                    <form class="form-inline">
                        <div class="form-group d-none d-lg-inline">
                            <label for="reportrange" class="sr-only">Date Ranges</label>
                            <div id="reportrange" class="px-2 py-2 text-muted">
                                <span class="small"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                            <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 col-lg-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Permohonan</h3>

                        </div>
                        <div class="card-body my-2">
                            <table class="table table-striped table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Nama</th>
                                        <th>No Matriks</th>
                                        <th>Jenis Alatan</th>
                                        <th style="width:100px;">Nama Alatan</th>
                                        <th>Tarikh Pinjam</th>
                                        <th>Masa Pinjaman</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $index => $app)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $app->applicant_name }}</td>
                                        <td>{{ $app->applicant_matric_no }}</td>
                                        <td>{{ $app->equipment_type }}</td>
                                        <td>{{ $app->equipment_names }}</td>
                                        <td>
                                            @if ($app->date_borrow == $app->date_return)
                                            {{ \Carbon\Carbon::parse($app->date_borrow)->format('d-m-Y') }}
                                            @else
                                            {{ \Carbon\Carbon::parse($app->date_borrow)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($app->date_return)->format('d-m-Y') }}
                                            @endif

                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($app->time_borrow)->format('g:i A') }} - {{ \Carbon\Carbon::parse($app->time_return)->format('g:i A') }}
                                        </td>

                                        <td>
                                            @if($app->status == 'Diproses')
                                            <span class="badge fs-6 bg-info text-white">
                                                Baru*
                                            </span>
                                            @else
                                            <span class="badge fs-6 bg-{{ 
                                                                    $app->status === 'Lulus' ? 'success' : 
                                                                    ($app->status === 'Ditolak' ? 'danger' : 
                                                                    ($app->status === 'Selesai' ? 'primary' : 'warning')) 
                                                }}  text-{{ $app->status === 'Lulus' ? 'dark' : 
                                                                    ($app->status === 'Ditolak' ? 'white' : 
                                                                    ($app->status === 'Diproses' ? 'dark' : 'white'))  }}">
                                                {{ $app->status }}
                                            </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($app->status == 'Lulus')
                                            <form action="{{ route('admin.application.update', $app->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Selesai">
                                                <button title="Telah Dipulangkan" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i></button>
                                            </form>
                                            @elseif($app->status == 'Diproses')
                                            <form action="{{ route('admin.application.update', $app->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Lulus">
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                            </form>

                                            <form action="{{ route('admin.application.update', $app->id) }}" method="POST" class="d-inline ms-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Ditolak">
                                                <button type="submit" class="btn btn-danger btn-sm ml-2"><i class="fa fa-x"></i></button>
                                            </form>
                                            @else

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-3">
                                {{ $applications->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div> <!-- Striped rows -->
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