@extends('layouts.app')


@section('content')

    <div class="container login-box " id="loginbox">

        @if(count($errors)>0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    <li>{{session('status')}}</li>
                </ul>
            </div>
        @endif
        <form class="form-horizontal" method="post" action="{{route('register')}}">
            {{csrf_field()}}
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-envelope"></i> First Name</h4>
                <input type="text" class="form-control" name="first_name" id="inputEmail" placeholder="First Name"
                       value="{{old("first_name")}}" required="true">
                <div id="first_name"></div>
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-envelope"></i> Last Name</h4>
                <input type="text" class="form-control" name="last_name" id="inputEmail" placeholder="Last Name"
                       value="{{old("last_name")}}" required="true">
                <div id="last_name"></div>
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-envelope"></i> Email</h4>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email"
                       value="{{old("email")}}" required="true">
                <div id="email"></div>
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-lock"></i> Password</h4>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"
                       required="true">
                <div id="password"></div>
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-lock"></i> Confirm Password</h4>
                <input type="password" class="form-control" name="password_confirmation" id="inputConfirm"
                       placeholder="Confirm Password" required>
                <div id="confirm_password"></div>
            </div>
            <div class="form-group">
                <input type="submit" name="register" id="register" class="btn btn-success center-block"
                       value="Register"/>
            </div>

            <div id="loginerror"></div>
        </form>

    </div>

@endsection