@extends('layouts.app')

@section('content')
    <div class="container login-box " id="loginbox">
        @if(session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('status')}}
            </div>
        @endif
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th style="width: 15px">#</th>
                <th>File Name</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cvs as $cv)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td><a href="{{uploads_url($cv->path)}}">{{$cv->title}}.pdf</a></td>
                    <td>{{$cv->created_at->render()}}</td>
                    <td>
                        <a href="{{route('cvs.delete',['id'=>$cv->id])}}" class="text-danger">
                            Delete
                        </a>
                    </td>
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

        .login-box {
            margin-top: 100px;
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
