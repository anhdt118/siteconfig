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
				<a href="{{ site_url('post/index') }}">{{ $title }}</span>
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
	{!! form_open(site_url('post/save')) !!}
	{!! form_hidden('id', data_get($entity, '_id')) !!}
	<div class="form-actions noborder form-group">
		<button type="submit" class="btn blue">Save</button>
		<a href="{{ site_url('post/index') }}" type="button" class="btn default">Back To List</a>
	</div>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN FORM PORTLET-->
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
									<a href="{{ site_url('post/create') }}">
										<i class="fa fa-plus"></i> Create new
									</a>
								</li>
								<li>
									<a onclick="return confirm('Do you want to delete this record?')" href="{{ site_url('post/delete/id/' . data_get($entity, 'id')) }}">
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
										'name' => 'data[title]',
										'value' => data_get($entity, 'title'),
										'autofocus' => true,
										'class' => 'form-control')) !!}
									<label>Title</label>
									<span class="help-block">Post title</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_input(array(
										'name' => 'data[url]',
										'value' => data_get($entity, 'url'),
										'class' => 'form-control')) !!}
									<label >URL</label>
									<span class="help-block">URL</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Categories</label>
									<select name="data[category_ids][]" class="form-control select2 mt-10" multiple>
										@foreach ($categories as $category)
										<option @if (in_array((string)data_get($category, '_id'), (array)data_get($entity, 'category_ids'))) selected @endif value="{{ (string)data_get($category, '_id') }}">{{ data_get($category, 'name') }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Published time</label>
									{!! form_input(array(
                                            'name' => 'data[publish_at]',
                                            'value' => date('d/m/Y, H:i:s', data_get($entity, 'publish_at')),
                                            'class' => 'form-control datetime-picker')) !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input form-md-floating-label">
									{!! form_textarea(array(
										'name' => 'data[description]',
										'class' => 'form-control',
										'rows' => 8,
										'cols' => 50,
										'value' => data_get($entity, 'description')
									)) !!}
									<label>Description</label>
									<span class="help-block">Post description</span>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-checkboxes">
									<label class="control-label">Is published</label>
									<div class="md-checkbox-list">
										<div class="md-checkbox">
											<input @if (data_get($entity, 'status') == MY_Model::VALUE_YES) checked @endif id="chk-status" type="checkbox" name="data[status]" value="1" class="md-check">
											<label for="chk-status">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Published
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="cl"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- END FORM PORTLET-->
			<!-- BEGIN FORM PORTLET-->
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
			<!-- END FORM PORTLET-->
			<div class="form-actions noborder">
				<button type="submit" class="btn blue">Save</button>
				<a href="{{ site_url('post/index') }}" type="button" class="btn default">Back To List</a>
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
									<span class="help-block">Title of post</span>
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
									<span class="help-block">Keywords of post</span>
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
									<span class="help-block">Description of post</span>
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
