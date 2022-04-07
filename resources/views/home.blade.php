@extends('layouts.dashboard')

@section('content_header')
    <h3>My Dashboard</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col-md">

            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>150</h3>
                    <p>Total Permintaan</p>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>100</h3>
                    <p>Permintaan Disetujui</p>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>50</h3>
                    <p>Permintaan Ditolak</p>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
