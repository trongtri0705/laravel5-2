@extends('admin.layout')
@section('addNewBtn')
    @if(isset($url) || isset($createUrl))
        <small>
            <a class="create label label-primary"
                  href="{{isset($url)? route($url) : $createUrl}}">Add New</a>
        </small>        
    @endif
@stop

@section('content')
    <section class="content">
        <div class="row">     
            <div class="col-md-8">
                @if(Session::has('msg'))
                    <div class="alert alert-success register">
                        <p>{{ Session::get('msg') }}</p>
                    </div>
                @endif
            </div>       
            @if(!isset($overrideForm))  
                <!-- right column -->
                <div class="col-md-8">            
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">

                        </div><!-- /.box-header -->

                        <!-- Display Validation Errors -->

                        <div class="box-body">                    
                            {!! Form($form) !!}
                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div><!--/.col (right) -->
            @else
                @yield('wrapperForm')
            @endif
        </div>   <!-- /.row -->
    </section>
@stop