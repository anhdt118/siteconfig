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
				<a href="{{ site_url('site/index') }}">{{ $title }}</span>
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
	{!! form_open(site_url('site/save')) !!}
	{!! form_hidden('id', data_get($entity, '_id')) !!}
	<div class="form-actions noborder form-group">
		<button type="submit" class="btn blue">Save</button>
		<a href="{{ site_url('site/index') }}" type="button" class="btn default">Back To List</a>
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
									<a href="{{ site_url('site/create') }}">
										<i class="fa fa-plus"></i> Create new
									</a>
								</li>
								<li>
									<a onclick="return confirm('Do you want to delete this record?')" href="{{ site_url('site/delete/id/' . data_get($entity, 'id')) }}">
										<i class="fa fa-trash-o"></i> Delete
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class="dropzone-wp pd-15 form-group">
							<input id="logo" name="data[logo]" type="hidden" value="{{ data_get($entity, 'logo') }}" />
							<div class="row">
								<div class="col-md-3" align="center">
									<img width="100%" id="logo-img" src="{{ data_get($entity, 'logo') }}" />
								</div>
								<div class="col-md-8" align="left">
									<div id="dropzone" class="dropzone form-group uppercase mt-20">
										<div class="fallback">
											<input name="file" type="file" />
										</div>
										<div class="dz-default dz-message"><span>Drop files here to upload Logo</span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<div class="form-group">
									<label>Color</label>
									<div class="input-group">
										{!! form_input('data[color]', data_get($entity, 'color', '#FFF'), array(
											'class' => 'form-control demo minicolors-input',
											'data-control' => 'hue',
											'readonly' => true)) !!}
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_input(array(
										'name' => 'data[name]',
										'value' => data_get($entity, 'name'),
										'autofocus' => true,
										'class' => 'form-control')) !!}
									<label>Name</label>
									<span class="help-block">Name of website</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_input(array(
										'name' => 'data[url]',
										'value' => data_get($entity, 'url'),
										'class' => 'form-control')) !!}
									<label >Domain URL</label>
									<span class="help-block">URL of website</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-1">
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
							<div class="col-md-11">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_textarea(array(
										'name' => 'data[description]',
										'class' => 'form-control',
										'rows' => 8,
										'cols' => 50,
										'value' => data_get($entity, 'description')
									)) !!}
									<label>Description</label>
									<span class="help-block">Site description</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-green">
						<span class="caption-subject bold"> Content</span>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-md-floating-label">
									{!! form_textarea(array(
										'id' => 'content',
										'name' => 'data[content]',
										'class' => 'form-control',
										'rows' => 22,
										'cols' => 50,
										'value' => data_get($entity, 'content')
									)) !!}
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
				</div>
			</div>
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-green">
						<span class="caption-subject bold"> Footer</span>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group form-md-floating-label">
									{!! form_textarea(array(
										'id' => 'footer',
										'name' => 'data[footer]',
										'class' => 'form-control',
										'rows' => 35,
										'cols' => 50,
										'value' => data_get($entity, 'footer')
									)) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group form-md-line-input">
									{!! form_textarea(array(
										'id' => 'custom-css',
										'name' => 'data[custom_css]',
										'class' => 'form-control',
										'rows' => 3,
										'cols' => 50,
										'placeholder' => 'Custom CSS',
										'value' => data_get($entity, 'custom_css')
									)) !!}
									<label class="form-label">Custom CSS</label>
								</div>
								<div class="form-group form-md-line-input">
									{!! form_textarea(array(
										'id' => 'custom-js',
										'name' => 'data[custom_js]',
										'class' => 'form-control',
										'rows' => 3,
										'cols' => 50,
										'value' => data_get($entity, 'custom_js')
									)) !!}
									<label class="form-label">Custom JS</label>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
			<div class="form-actions noborder">
				<button type="submit" class="btn blue">Save</button>
				<a href="{{ site_url('site/index') }}" type="button" class="btn default">Back To List</a>
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
