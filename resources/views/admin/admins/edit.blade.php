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
            </div>


            <h2 class="page-title">Kemaskini Admin</h2>
            <p class="text-muted">Edit maklumat admin</p>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('settings-admin.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="staff_id">ID Kakitangan</label>
                                <input type="text" class="form-control" name="staff_id" value="{{ $admin->matric_no}}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $admin->email }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sector">Sektor</label>
                                <select class="form-control" name="sector" required>
                                    <option disabled>-- Sila Pilih Sektor --</option>
                                    @foreach(['Sistem Komputer','Tekstil Pakaian','Elektrik','Automotif','Motosikal','Kulinari','Pastri','Penyaman Udara'] as $sector)
                                    <option value="{{ $sector }}" {{ $admin->sector == $sector ? 'selected' : '' }}>{{ $sector }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $admin->fullname }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_no">No Telefon</label>
                                <input type="text" name="phone_no" class="form-control" value="{{ $admin->phone_no }}" required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button class="btn btn-md btn-primary mr-2" type="submit">Kemaskini</button>
                        <a href="{{ route('settings-admin.index') }}" class="btn btn-secondary btn-md">Kembali</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection