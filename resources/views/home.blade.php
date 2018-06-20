@extends('layouts.app')

@section('content')
    <div id="carouselExampleControls" class="carousel slide container-fluid" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/assets/images/one.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/assets/images/two.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/assets/images/three.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!--start contact-->
    <div class="container" style="text-align: center;margin: 5%">
        <div class="row">


            <div class="col-md-4" style="margin-top: 30px;margin-bottom: 30px;">

                <h4 style="text-align: left"><i class="fa fa-map"></i> Cairo, Egypt</h4>
                <h4 style="text-align: left"><i class="fa fa-phone"></i> Phone: +02 01120379685</h4>
                <h4 style="text-align: left"><i class="fa fa-envelope"></i> Email: fcih@gmail.com</h4>

            </div>

            <div class="col-md-6" style="margin-top: 30px;margin-bottom: 30px;">
                <div id="submit-result"></div>
                <form id="submit-send-mail">
                    <div class="form-group">
                        <input type="email" class="form-control" id="send-email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <textarea id="send-message" placeholder="Enter your message ..."
                                  class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger pull-right">Submit</button>
                </form>
            </div>


        </div>
    </div>
@endsection



@section('head')
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/shared.css">
    <link rel="stylesheet" href="/assets/css/home.css">
@endsection
@push('js')
    <script>
        $('#submit-send-mail').submit(function (event) {
            event.preventDefault();
            console.log($('textarea#send-message').val());
            $.ajax({
                url: '{{route('mail.contact')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "email": $('#send-email').val(),
                    "message": $('textarea#send-message').val(),
                    "_token": "{{csrf_token()}}"
                }
            }).done(function (json) {
                $('#submit-result').html('<p style="color: green">Your message sent</p>');
                $('#send-email').val("");
                $('textarea#send-message').val("")
            }).fail(function (xhr, status, errorThrown) {
                alert('alert their error in request');
            });

        });
    </script>
@endpush
