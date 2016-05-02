@extends('admin.layout')

@section('content')
	<div class="col-md-12">
        @if(Session::has('msg'))
            <div class="alert alert-success register">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
    </div>         	
    @include('table-view::container', ['tableView' => $tableView])
@stop