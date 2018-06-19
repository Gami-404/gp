@extends('layouts.app')

@section('content')
    <div class="container login-box " id="loginbox">

        <div><img src="/assets/images/avatar.png" class="img">
            <button style="display: block;margin: auto" class="btn"><i class="fa fa-edit"></i></button>
        </div>
        <h3>{{fauth()->user()->first_name.' '.fauth()->user()->last_name}}</h3>


        <form class="form-horizontal form" method="post" action="{{route('profile.edit')}}">
            {{csrf_field()}}
            <div class="form-group">

                <h4><i class="glyphicon glyphicon-envelope"></i> First Name</h4>
                <input type="text" class="form-control" id="inputEmail" placeholder="First Name"
                       value="{{fauth()->user()->first_name}}" name="first_name">
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-envelope"></i> Last Name</h4>
                <input type="text" class="form-control" value="{{fauth()->user()->last_name}}" id="inputFirst"
                       name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-envelope"></i> Email</h4>
                <input type="email" class="form-control" id="inputLastName" name="email" placeholder="Email"
                       value="{{fauth()->user()->email}}">
                <div id="emailerror"></div>
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-lock"></i> Password</h4>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password"/>
                <div id="passerror"></div>

            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-lock"></i> Confirm Password</h4>
                <input type="password" class="form-control" name="password_confirmation" id="inputConfirm"
                       placeholder="Confirm Password"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success center-block" name="submit" id="submit" value="Submit"/>
            </div>
        </form>
    </div>
@endsection