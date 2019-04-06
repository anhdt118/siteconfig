$(".select2").select2();
tinymce.init({
	selector: '#content',
	plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount tinymcespellchecker a11ychecker imagetools textpattern help formatpainter permanentpen pageembed tinycomments mentions linkchecker',
	toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
	image_advtab: true,
	importcss_append: true,
	template_cdate_format: '[CDATE: %m/%d/%Y : %H:%M:%S]',
	template_mdate_format: '[MDATE: %m/%d/%Y : %H:%M:%S]',
	image_caption: true,
	spellchecker_dialog: true,
	spellchecker_whitelist: ['Ephox', 'Moxiecode'],
	tinycomments_mode: 'embedded',
	content_style: '.mce-annotation { background: #fff0b7; } .tc-active-annotation {background: #ffe168; color: black; }'
});

