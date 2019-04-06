<?php global $client_css, $client_js; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	@include ('admin.layouts.zone.head')
</head>
<body class="page-sidebar-closed-hide-logo page-content-white page-md page-header-fixed page-sidebar-fixed">
	<div class="page-wrapper">
		@include ('admin.layouts.zone.header')
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			@include ('admin.layouts.zone.content.sidebar')
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					@include ('admin.layouts.zone.content.panel')
					@yield('content')
				</div>
				<!-- END CONTENT BODY -->
			</div>
			<!-- END CONTENT -->
			@include ('admin.layouts.zone.content.quick_sidebar')
		</div>
		<!-- END CONTAINER -->
		@include ('admin.layouts.zone.footer')
	</div>
	@include ('admin.layouts.zone.nav')
	@include ('admin.layouts.zone.js')
</body>
</html>
