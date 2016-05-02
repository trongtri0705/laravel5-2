@section('addNewBtn')
	<small><a class="create label label-primary {{ !isset($tableView) || !$tableView ? 'dis-class' : '' }}"
			  href="{{ isset($createUrl) ? $createUrl : route($createRoute) }}">Add New</a></small>
	<small><a class="label label-primary" href="/admin/user/static">Static</a></small>
@stop

<section class="content">
	<div class="row">
		@if(isset($tableView) && $tableView)
		<div class="col-xs-12">
			<div class="box">

				<div class="box-body">

					<div class="m-b-10 clearfix">

						@if ( $tableView->headerView() )
							<div class="pull-right">
								@include( $tableView->headerView() )
							</div>
						@endif
					</div>


					<div class="box-header">
						@include('table-view::elements._per_page_dropdown')
						<div class="box-tools">
							@include('table-view::elements._search_form')
						</div>
					</div>

					<div class="box-body">
						<div class="table-responsive">
							@include( $tableView->present()->table() )
						</div>
					</div>

				</div>
			</div>

			<div class="pull-right">
				<span style="float: left; padding: 30px; font-size: 12px;">{{ $tableView->present()->title() }}</span> <?php echo $tableView->data()->appends( Request::except('page') )->render(); ?>
			</div>

		</div>
		@elseif(isset($msg))
			@include('admin.partials.fail-connect-customer-db')
		@endif
	</div>
</section>
