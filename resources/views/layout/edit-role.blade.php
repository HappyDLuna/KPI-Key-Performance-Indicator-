@extends('master.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengubahan Data Jabatan</h6>
            </div>
            <div class="card-body">
                <form action="{{route('update-jabatan',$data['id'])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input type="text" class="form-control @error('name_role') is-invalid @enderror" name="name_role" value="{{$data['name_role']}}" required>
                        @error('name_role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="type" id="type" class="form-control">
                            <option value="0" @if ($data['type']== 0) selected @endif>Admin</option>
                            <option value="1" @if ($data['type']== 1) selected @endif>Mahasiswa</option>
                            <option value="2" @if ($data['type']== 2) selected @endif>Pegawai</option>
                            <option value="3" @if ($data['type']== 3) selected @endif>Rektor</option>
                            <option value="4" @if ($data['type']== 4) selected @endif>Kaprodi</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Ubah</button>
                    <a class="btn btn-danger" href="{{route('tabel-jabatan')}}"><i class="fa fa-ban" aria-hidden="true"></i>
                        Batal Ubah</a>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection