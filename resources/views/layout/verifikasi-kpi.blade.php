@extends('master.master')
@section('title')
    KPI
@endsection
    @section('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    @endsection
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengisian KPI</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('masuk-verifikasi-kpi') }}" method="post">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                @csrf
                                @method('post')
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>KPI</th>
                                <th>Nilai KPI</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kebutuhan KPI</th>
                                <th>Nilai KPI</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->kpiquestion->kpi}}</td>
                                <td>{{$d->skor}}</td>
                                <td>{{$d->keterangan}}</td>
                                <td>
                                    <input type="checkbox" value="{{ $d->id }}" name="kpi[]">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    @endsection
    @section('script')
     <!-- Page level plugins -->
     <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    
     <!-- Page level custom scripts -->
     <script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>
    @endsection