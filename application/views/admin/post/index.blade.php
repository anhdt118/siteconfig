@extends('admin.layouts.app')
@section('title') {{ $title }} @endsection
@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="{{ site_url('admin/dashboard') }}">Dashboard</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>{{ $title }}</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
				<i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="#">
						<i class="icon-bell"></i> Action
					</a>
				</li>
				<li>
					<a href="#">
						<i class="icon-shield"></i> Another action
					</a>
				</li>
				<li>
					<a href="#">
						<i class="icon-user"></i> Something else here
					</a>
				</li>
				<li class="divider"> </li>
				<li>
					<a href="#">
						<i class="icon-bag"></i> Separated link
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title bold"> {{ $title }} </h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green">
					<i class="fa fa-cog font-green"></i>
					<span class="caption-subject bold uppercase"> {{ $grid }}</span>
				</div>
				<div class="actions">
					<a class="btn blue" href="{{ site_url('post/create') }}"><i class="fa fa-plus"></i> Create new</a>
				</div>
			</div>
			<div class="portlet-body form">
				{!! form_open(site_url('post/save')) !!}
				<div class="form-body">
					<table class="table table-striped table-bordered table-hover order-column">
						<thead>
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>URL</th>
							<th>Published</th>
						</tr>
						</thead>
						<tbody>
						@if (!empty($collection))
						@foreach ($collection as $entity)
						<tr>
							<td><a href="{{ site_url('post/edit/id/' . data_get($entity, '_id')) }}">{{ data_get($entity, '_id') }}</a></td>
							<td><a href="{{ site_url('post/edit/id/' . data_get($entity, '_id')) }}">{{ data_get($entity, 'title') }}</a></td>
							<td><a href="{{ site_url('post/edit/id/' . data_get($entity, '_id')) }}">{{ data_get($entity, 'url') }}</a></td>
							<td>
								<div class="md-checkbox">
									<input readonly @if (data_get($entity, 'status') == MY_Model::VALUE_YES) checked @endif id="chk-status" type="checkbox" class="md-check">
									<label>
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
									</label>
								</div>
							</td>
						</tr>
						@endforeach
						@endif
						</tbody>
					</table>
				</div>
				{!! form_close() !!}
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
@endsection
