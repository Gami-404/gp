@extends('layouts.app')

@section('content')
    <div class="container" style="margin-left: 31px;">

        <div class="page-content" style="margin-top: 7%;">
            <div class="panel panel-collapse">
                <div class="panel-heading">
                    <h5 class="panel-title">Cvs uploading</h5>
                </div>
                <div class="panel-body">

                    <p class="text-semibold">Add new CVs:</p>
                    <div class="file-uploader"><p>Your browser doesn't have Flash installed.</p></div>
                </div>
            </div>

            <div class="btn-group" id="search-button">
                <a type="button" href="{{route('search.form')}}" class="btn btn-primary">Find best Cv</a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <style>
        #search-button {
            margin-top: 16px;
            margin-left: 45%;
            display: none;
        }
    </style>
    <script>
        $(function () {
            // Setup all runtimes
            $(".file-uploader").pluploadQueue({
                runtimes: 'html5, html4, Flash, Silverlight',
                chunk_size: '300Kb',
                unique_names: true,
                url: "{{route('cvs.upload')}}",
                filters: {
                    max_file_size: '400Kb',
                    mime_types: [{
                        title: "Pdf files",
                        extensions: "pdf"
                    }]
                },
                headers: {
                    "X-CSRF-TOKEN": "{{csrf_token()}}"
                },
                init: {
                    UploadComplete: function () {
                        $('#search-button').css('display', 'block')
                    }
                }
            });
        })
    </script>
@endpush
