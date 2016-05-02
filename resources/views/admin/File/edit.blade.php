@extends('admin.layout')

@section('scripts')
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
	$(function () {
		// CKEDITOR.replace('editor');
	});
</script>
@stop
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">		
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Editor <small>Simple and fast</small></h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
					</div><!-- /. tools -->
				</div><!-- /.box-header -->
				<div class="box-body pad">
					@include('errors.errors')
                    @if(Session::has('msg'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('msg') }}</p>
                        </div>
                    @endif

                    {!! Form::open(array('url' => URL::to('/admin/editFile'), 'method' => 'post', 'files'=> true)) !!}      
						<textarea id="editor" name="editor" rows="10" cols="80">{{ $str }} ?>
                    	</textarea>
                    	<div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>	
					{!! Form::close() !!}
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- ./row -->
</section><!-- /.content -->
@stop