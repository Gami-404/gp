@extends('layouts.app')


@section('content')
    <div class="container login-box " id="loginbox">
        @if(count($errors))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{route('login')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-envelope"></i> Email</h4>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email"
                       value="{{ old('email') }}" required="true"/>
                <div id="emailerror"></div>
            </div>
            <div class="form-group">
                <h4><i class="glyphicon glyphicon-lock"></i>Password</h4>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"
                       required="true">
                <div id="passerror"></div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="checkbox" style="display: flex">
                        <div class="col">
                            <input type="checkbox" class="form-control" style="width: 32px;"
                                   name="remember" {{ old('remember') ? 'checked' : '' }} />
                        </div>
                        <label class="col">Remember Me</label>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="register" id="register" class="btn btn-success center-block"
                       value="Register"/>
            </div>

        </form>
    </div>

@endsection