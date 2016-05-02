@extends('app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Register
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('errors.errors')                    

                    @if(Session::has('msg'))
                        <div class="alert alert-success register" style="margin-top:18px;">
                            <strong>Success!</strong><p> {{ Session::get('msg') }}</p>
                        </div>
                    @endif
                            <!-- New Task Form -->
                    {!! Form::open(array('url' => URL::to('auth/register'), 'method' => 'post', 'files'=> true)) !!}

                        <!-- Name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Name', array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}                                
                            </div>
                        </div>
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

                        <!-- Confirm Password -->
                        <div class="form-group">
                            {!! Form::label('password_confirmation', "Confirm Password", array('class' => 'col-md-4 control-label')) !!}
                            <div class="col-sm-6">
                                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-sign-in"></i>Register
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection