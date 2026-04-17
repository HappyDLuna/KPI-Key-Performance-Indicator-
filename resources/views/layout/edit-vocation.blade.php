@extends('master.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengubahan Data Unit</h6>
            </div>
            <div class="card-body">
                <form action="{{route('update-jurusan',$data->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Unit</label>
                        <input type="text" class="form-control @error('name_role') is-invalid @enderror" name="name_vocation" required value="{{$data['name_vocation']}}">
                        @error('name_role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Ubah</button>
                    <a class="btn btn-danger" href="{{route('tabel-jurusan')}}"><i class="fa fa-ban" aria-hidden="true"></i>
                        Batal Ubah</a>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection