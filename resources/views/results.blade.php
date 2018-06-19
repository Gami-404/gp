@extends('layouts.app')

@section('content')
    <div class="container login-box " id="loginbox">


        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>File Name</th>
                <th>Experience</th>
                <th>Education</th>
                <th>Skills</th>
                <th>Personal Information</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $cv)
                <tr>

                    <td><a href="{{uploads_url($cv->path)}}">{{$cv->title}}</a></td>
                    <td>{{$cv->educations}} %</td>
                    <td>{{$cv->experiences}} %</td>
                    <td>{{$cv->personal_data}} %</td>
                    <td>{{$cv->skills}} %</td>
                    <td>{{$cv->score}} %</td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>

@endsection
@section('head')
    <link rel="stylesheet" href="/assets/css/shared.css">
    <link rel="stylesheet" href="/assets/css/output.css">
@endsection
@push('js')
    <!-- Custom CSS -->

    <link rel="stylesheet" href="/assets/css/librariesV2/bootstrap-3.3.7-dist/css/dataTables.bootstrap4.min.css">
    <style>
        .dataTables_paginate {
            display: none;
        }
    </style>
    <script src="/assets/js/output.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js">

    </script>
    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            debugger;
            $('#example').dataTable({
                "bDestroy": true,
                "ordering": false,
            });

        });
    </script>
@endpush
