@extends('layouts.dashboard')

@section('sidebar')
@include('sidebars.admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-start">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}<i class="fa fa-check ml-1"></i></div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}<i class="fa fa-times ml-1"></i></div>
                @endif
            </div>
            <div class="row align-items-center mb-2">
                <div class="col">
                    <a class="btn btn-primary rounded btn-sm" href="{{ route('equipment.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                            <div class="h5 font-weight-normal">Jenis Alatan - <span class="font-weight-bolder">{{ $type }}</span></div>
                        </div>
                        <div class="card-body my-n2">
                            <table class="table table-striped table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Maklumat</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <button class="btn-edit-equipment btn btn-sm btn-warning text-white rounded"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                data-type="{{ $item->type }}"
                                                data-status="{{ $item->status }}"
                                                data-description="{{ e($item->description) }}"
                                                data-toggle="modal"
                                                data-target="#editEquipmentModal">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Adakah anda pasti mahu padam peralatan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger rounded ml-2">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
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
<div class="modal fade" id="editEquipmentModal" tabindex="-1" aria-labelledby="editEquipmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('equipment.update') }}">
            @csrf
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Peralatan</h5>

                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" id="edit-name">
                    </div>
                    <div class="mb-3">
                        <label>Jenis</label>
                        <select class="form-control" id="edit-type" name="type">
                            <option>-- Sila Pilih --</option>
                            @foreach ($master as $item)
                            <option value="{{ $item->type_name }}">{{ $item->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status" id="edit-status">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Rosak">Rosak</option>
                            <option value="Sudah Dibaiki">Sudah Dibaiki</option>
                            <option value="Hilang">Hilang</option>
                            <option value="Sedang Dibaiki">Sudah Diganti</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="description" id="edit-description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success text-white" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).on("click", ".btn-edit-equipment", function() {
        console.log('Clicked!', $(this).data()); // Debug all data

        $('#edit-id').val($(this).data('id'));
        $('#edit-name').val($(this).data('name'));
        $('#edit-type').val($(this).data('type'));
        $('#edit-status').val($(this).data('status'));
        $('#edit-description').val($(this).data('description'));
    });
</script>
@endsection