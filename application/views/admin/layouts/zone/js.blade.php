<!--[if lt IE 9]>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/respond.min.js"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/excanvas.min.js"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ base_url() }}themes/admin/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
@if (!empty($client_js))
@foreach ($client_js as $js)
<script src="{{ $js }}" type="text/javascript"></script>
@endforeach
@endif
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ base_url() }}themes/admin/theme/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="{{ base_url() }}themes/admin/theme/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script type="text/javascript">
	var url = window.location.href.toString();
	$(".nav-item a").each(function() {
		var href = $(this).attr("href").toString();
		if (url.indexOf(href) >= 0) {
			$(this).parent().addClass("active").find("a").first().append("<span class='selected'></span>");
		}
	});
	$validate_forms = $(".has-validate");
	if ($validate_forms.size() > 0) {
		$validate_forms.each(function() {
			$(this).validate();
		});
	}
	$("[data-toggle=tooltip]").tooltip();
</script>
