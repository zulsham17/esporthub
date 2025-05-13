@extends('layouts.dashboard')

@section('sidebar')
@include('sidebars.user')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <a class="btn btn-primary rounded btn-sm mr-2" href="{{ route('user.dashboard') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a class="text-primary" href="{{ route('application.index') }}">Senarai Permohonan</a>
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
                <div class="col-12">
                    <h2 class="page-title">Permohonan Pinjaman Alatan Sukan</h2>
                    <div class="card shadow mb-4">
                        <form method="POST" action="{{ route('application.store') }}">
                            @csrf
                            <div class="card-body">
                                <!-- Applicant info -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nama Pemohon</label>
                                        <input type="text" class="form-control" name="applicant_name" value="{{ Auth::user()->fullname }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>No Matriks</label>
                                        <input type="text" class="form-control" name="applicant_matric_no" value="{{ Auth::user()->matric_no }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Sektor</label>
                                        <input type="text" class="form-control" name="applicant_sector" value="{{ Auth::user()->sector }}">
                                    </div>
                                </div>

                                <!-- Booking info -->
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label>Tarikh Pinjam</label>
                                        <input type="date" class="form-control" name="date_borrow" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tarikh Pulang</label>
                                        <input type="date" class="form-control" name="date_return" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Masa Ambil</label>
                                        <input type="time" class="form-control" name="time_borrow" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Masa Pulang</label>
                                        <input type="time" class="form-control" name="time_return" required>
                                    </div>
                                </div>

                                <!-- Equipment selection -->
                                <div id="equipment-selections">
                                    <div class="row equipment-row mb-1">
                                        <div class="col-md-5">
                                            <label>Jenis Peralatan</label>
                                            <select name="equipment_type[]" class="form-control equipment-type" required>
                                                <option value="">-- Sila Pilih --</option>
                                                @foreach($types as $type)
                                                <option value="{{ $type->type }}">{{ $type->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label>Nama Alatan</label>
                                            <select name="equipment_id[]" class="form-control equipment-name" required></select>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-remove-equipment"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>


                                    <button type="button" class="btn btn-secondary mt-1" id="add-equipment">Tambah Alatan</button>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Hantar Permohonan</button>
                                    </div>
                                </div>
                        </form>

                        <!-- JavaScript to handle dynamic equipment loading -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                function fetchEquipmentNames(type, targetSelect) {
                                    if (!type) {
                                        targetSelect.innerHTML = '<option value="">-- Pilih Nama Alatan --</option>';
                                        return;
                                    }

                                    fetch(`/equipment/by-type/${encodeURIComponent(type)}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            targetSelect.innerHTML = '<option value="">-- Pilih Nama Alatan --</option>';
                                            data.forEach(item => {
                                                const option = document.createElement('option');
                                                option.value = item.id;
                                                option.textContent = item.name;
                                                targetSelect.appendChild(option);
                                            });
                                        })
                                        .catch(() => {
                                            targetSelect.innerHTML = '<option value="">Tiada alatan dijumpai</option>';
                                        });
                                }

                                function bindEvents(row) {
                                    const typeSelect = row.querySelector('.equipment-type');
                                    const nameSelect = row.querySelector('.equipment-name');

                                    typeSelect.addEventListener('change', function() {
                                        fetchEquipmentNames(this.value, nameSelect);
                                    });

                                    row.querySelector('.btn-remove-equipment').addEventListener('click', function() {
                                        row.remove();
                                    });
                                }

                                document.querySelectorAll('.equipment-row').forEach(bindEvents);

                                document.getElementById('add-equipment').addEventListener('click', function() {
                                    const firstRow = document.querySelector('.equipment-row');
                                    const newRow = firstRow.cloneNode(true);
                                    newRow.querySelector('.equipment-type').value = '';
                                    newRow.querySelector('.equipment-name').innerHTML = '';
                                    document.getElementById('equipment-selections').appendChild(newRow);
                                    bindEvents(newRow);
                                });
                            });
                        </script>
                    </div> <!-- / .card -->
                    <!-- end section -->
                </div> <!-- .col-12 -->
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