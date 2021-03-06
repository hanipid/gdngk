@extends('adminlte::page')

@section('title', 'Gudang | Tambah Data Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Pengguna</h1>
@stop

@section('content')
    <form method="post" action="/users" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label">Profil</label>
                            <div class="col-md-8">
                                <select class="form-control" id="role_id" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label">Ulangi Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik" class="col-md-4 col-form-label">NIK</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="NIK" value="{{old('nik')}}">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label">Alamat</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="address" name="address" placeholder="Alamat">{{old('address')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label">Telepon</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telepon" value="{{old('phone')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label">Perusahaan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="company" name="company" placeholder="Perusahaan" value="{{old('company')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank" class="col-md-4 col-form-label">Bank</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank" value="{{old('bank')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_account" class="col-md-4 col-form-label">No. Rekening</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="No. Rekening" value="{{old('bank_account')}}">
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
                            <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Foto" value="{{old('avatar')}}">
                        </div>
                    </div> {{-- /.card-body --}}
                </div> {{-- /.card --}}
            </div> {{-- /.col-md-6 --}}
        </div> {{-- /.row --}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-right">
                        <button type="submit" class="btn bg-gradient-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop