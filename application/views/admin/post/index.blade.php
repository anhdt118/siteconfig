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
					<span class="caption-subject bold"> {{ $grid }}</span>
				</div>
				<div class="actions">
					<a class="btn blue" href="{{ site_url('post/create') }}"><i class="fa fa-plus"></i> Create new</a>
				</div>
			</div>
			<div class="portlet-body form">
				{!! form_open(site_url('post')) !!}
				<div class="form-body">
					<table class="table table-striped table-bordered table-hover order-column">
						<thead>
						<tr>
							<th width="50px">ID</th>
							<th width="300px">Title</th>
							<th>URL</th>
							<th>Published</th>
							<th>Actions</th>
						</tr>
						<tr>
							<th colspan="2">
								<input placeholder="Filter by title" type="text" class="form-control" name="filters[title][value]" type="hidden" value="{{ data_get(data_get($filters, 'title'), 'value') }}" />
								<input type="hidden" name="filters[title][type]" value="text" />
							</th>
							<th>
								<input placeholder="Filter by url" type="text" class="form-control" name="filters[url][value]" type="hidden" value="{{ data_get(data_get($filters, 'url'), 'value') }}" />
								<input type="hidden" name="filters[url][type]" value="text" />
							</th>
							<th>
								<select onchange="this.form.submit()" name="filters[status][value]" class="form-control select2">
									<option @if (data_get(data_get($filters, 'status'), 'value')) selected @endif value="0">-- All status --</option>
									<option @if (data_get(data_get($filters, 'status'), 'value') == MY_Model::VALUE_YES) selected @endif value="{{ MY_Model::VALUE_YES }}">Active</option>
									<option @if (data_get(data_get($filters, 'status'), 'value') == MY_Model::VALUE_NO) selected @endif value="{{ MY_Model::VALUE_NO }}">Deactive</option>
								</select>
								<input type="hidden" name="filters[status][type]" value="equal" />
							</th>
							<th>
								<button type="submit" data-toggle="tooltip" title="Search" class="btn btn-primary"><i class="fa fa-search"></i></button>
								<a data-toggle="tooltip" title="Reset filters" href="{{ site_url('post') }}" class="btn btn-default"><i class="fa fa-history"></i></a>
							</th>
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
							<td>
								<a data-toggle="tooltip" title="Edit row" href="{{ site_url('post/edit/id/' . data_get($entity, '_id')) }}" class="btn btn-primary"><i class="fa fa-cog"></i></a>
								<a onclick="return window.confirm('Do you want to delete this record?')" data-toggle="tooltip" title="Delete row" href="{{ site_url('post/delete/id/' . data_get($entity, '_id')) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
