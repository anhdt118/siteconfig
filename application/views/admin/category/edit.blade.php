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
				<a href="{{ site_url('category/index') }}">{{ $title }}</span>
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
	{!! form_open(site_url('category/save'), array('class' => 'has-validate')) !!}
	{!! form_hidden('id', data_get($entity, '_id')) !!}
	<div class="form-actions noborder form-group">
		<a href="{{ site_url('category/index') }}" type="button" class="btn default">Back To List</a>
		<button type="submit" class="btn blue">Save</button>
	</div>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-green">
						<span class="caption-subject bold"> Information</span>
					</div>
					<div class="actions">
						<div class="btn-group">
							<a class="btn btn-sm default dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Actions
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="{{ site_url('category/create') }}">
										<i class="fa fa-plus"></i> Create new
									</a>
								</li>
								<li>
									<a onclick="return confirm('Do you want to delete this record?')" href="{{ site_url('category/delete/id/' . data_get($entity, 'id')) }}">
										<i class="fa fa-trash-o"></i> Delete
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_input(array(
										'name' => 'data[name]',
										'value' => data_get($entity, 'name'),
										'autofocus' => true,
										'placeholder' => 'Name',
										'class' => 'form-control required')) !!}
									<label>Name</label>
									<span class="help-block">Name of website</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_input(array(
										'name' => 'data[url]',
										'value' => data_get($entity, 'url'),
										'placeholder' => 'URL',
										'class' => 'form-control')) !!}
									<label >URL</label>
									<span class="help-block">URL of category</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<select name="data[parent_id]" class="form-control">
										<option value="0">-- Select parent --</option>
										@foreach ($parents as $parent)
										<option @if ((string)data_get($parent, '_id') == (string)data_get($entity, 'parent_id')) selected @endif value="{{ (string)data_get($parent, '_id') }}">{{ data_get($parent, 'name') }}</option>
										@endforeach
									</select>
									<label>Parent category</label>
									<span class="help-block">Parent Category</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-checkboxes">
									<label class="control-label">Is active</label>
									<div class="md-checkbox-list">
										<div class="md-checkbox">
											<input @if (data_get($entity, 'status') == MY_Model::VALUE_YES) checked @endif id="chk-status" type="checkbox" name="data[status]" value="1" class="md-check">
											<label for="chk-status">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Active
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_textarea(array(
										'name' => 'data[description]',
										'class' => 'form-control required',
										'rows' => 8,
										'cols' => 50,
										'placeholder' => 'Description about category',
										'value' => data_get($entity, 'description')
									)) !!}
									<label>Description</label>
									<span class="help-block">Description about category</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
			<div class="form-actions noborder">
				<a href="{{ site_url('category/index') }}" type="button" class="btn default">Back To List</a>
				<button type="submit" class="btn blue">Save</button>
			</div>
		</div>
		<div class="col-md-3">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-green">
						<span class="caption-subject bold uppercase"> SEO</span>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_input(array(
										'name' => 'data[seo_title]',
										'value' => data_get($entity, 'seo_title'),
										'class' => 'form-control')) !!}
									<label>Title</label>
									<span class="help-block">Title of website</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_textarea(array(
										'name' => 'data[seo_keywords]',
										'class' => 'form-control',
										'rows' => 4,
										'cols' => 50,
										'value' => data_get($entity, 'seo_keywords')
									)) !!}
									<label>Keywords</label>
									<span class="help-block">Keywords of website</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_textarea(array(
										'name' => 'data[seo_description]',
										'class' => 'form-control',
										'rows' => 4,
										'cols' => 50,
										'value' => data_get($entity, 'seo_description')
									)) !!}
									<label>Description</label>
									<span class="help-block">Description of website</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>
	</div>
	{!! form_close() !!}
@endsection
