@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">

                        @include('errors.errors')
                        @if(Session::has('msg'))
                            <div class="alert alert-danger">
                                <p>{{ Session::get('msg') }}</p>
                            </div>
                        @endif

                        {!! Form::open(array('url' => URL::to('auth/login'), 'method' => 'post', 'files'=> true)) !!}                            
                            <div class="form-group">
                                {!! Form::label('email', "E-Mail Address", array('class' => 'col-md-4 control-label')) !!}                                
                                <div class="col-md-6">
                                    {!! Form::text('email', null, array('class' => 'form-control',
                                                                        'autofocus'=>true,
                                                                        'value'=> old('email'),
                                                                        )) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', "Password", array('class' => 'col-md-4 control-label')) !!}                                
                                <div class="col-md-6">
                                    {!! Form::password('password', array('class' => 'form-control')) !!}                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <label>
                                        <a href="/password/email">Forgot Password?</a>
                                    </label>
                                </div> 
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <a class="btn btn-primary" href="/auth/facebook" role="button">Login with Facebook</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection