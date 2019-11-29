@extends('adminlte::page')

@section('title', 'Gudang | Ubah Data Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Data Pengguna</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="role_id" class="col-md-4 col-form-label">Profil</label>
                        <div class="col-md-8">
                            {{ $user->role->display_name }}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-8">
                            {{$user->email}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nik" class="col-md-4 col-form-label">NIK</label>
                        <div class="col-md-8">
                            {{$user->nik}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Nama Lengkap</label>
                        <div class="col-md-8">
                            {{$user->name}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            {{$user->address}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label">Telepon</label>
                        <div class="col-md-8">
                            {{$user->phone}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="company" class="col-md-4 col-form-label">Perusahaan</label>
                        <div class="col-md-8">
                            {{$user->company}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bank" class="col-md-4 col-form-label">Bank</label>
                        <div class="col-md-8">
                            {{$user->bank}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bank_account" class="col-md-4 col-form-label">No. Rekening</label>
                        <div class="col-md-8">
                            {{$user->bank_account}}
                        </div>
                    </div>
                </div> {{-- /.card-body --}}
            </div> {{-- /.card --}}
        </div> {{-- /.col-md-6 --}}

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="avatar" class="form-label">Foto</label>
                        <hr>
                        <div class="text-center mb-3">
                            <img src="{{url('/storage/'.$user->avatar)}}" class="img-fluid">
                        </div>
                    </div>
                </div> {{-- /.card-body --}}
            </div> {{-- /.card --}}
        </div> {{-- /.col-md-6 --}}
    </div> {{-- /.row --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-right">
                    <a href="/users/{{$user->id}}/edit" class="btn bg-gradient-success text-white">Ubah Data</a>
                </div>
            </div>
        </div>
    </div>
@stop