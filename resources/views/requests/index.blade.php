@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .float {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 45px;
            right: 30px;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
        }

        .my-float {
            margin-top: 35%
        }

        .select2-container .select2-selection--single {
            height: 40px;
        }

    </style>
@endsection
@section('content_header')
    <h3>Pusat Data Permintaan Barang</h3>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Data Permintaan
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pemohon</th>
                        <th>NIK</th>
                        <th>Departemen</th>
                        <th>Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->user->nik }}</td>
                            <td>{{ $transaction->user->department->name }}</td>
                            <td>
                                @foreach ($transaction->products as $key => $product)
                                    @if (count($transaction->products) > 1)
                                        {{ $key + 1 }}. {{ $product->name }}<br>
                                    @else
                                        {{ $product->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs">Detail</button>
                                <button class="btn btn-warning btn-xs">Edit</button>
                                @cannot('isStaff')
                                    <button class="btn btn-danger btn-xs">Delete</button>
                                @endcannot
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="#" id="add" class="float bg-primary" data-toggle="modal" data-target="#modal-xl">
        <i class="fa fa-plus my-float"></i>
    </a>
    @include('requests.partials.modal_create')
@endsection

@section('script')
    <script src="{{ asset('theme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "paging": true,
                "ordering": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            //   $("#productTable").DataTable({
            //     "responsive": true
            //   });
        });
    </script>
    @include('requests.js.create')
@endsection
