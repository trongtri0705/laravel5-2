@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>
                    <div class="panel-body">

                        @include('errors.errors')
                        @if(Session::has('status'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('status') }}</p>
                            </div>
                        @endif
                        
                        @if(Session::has('alert'))
                            <div class="alert alert-warning">
                                <p>{{ Session::get('alert') }}</p>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('password::email') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                                </div>
                            </div>      

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection