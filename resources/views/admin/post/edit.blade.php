<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Donkeyli</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="/assets/css/colorbox.css" />
		
		<!-- text fonts -->
		<link rel="stylesheet" href="/assets/css/ace-fonts.css" />

        <script src="/assets/js/jquery.min.js"></script>
		<!-- ace styles -->
		<link rel="stylesheet" href="/assets/css/ace.min.css" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
        <link rel="stylesheet" href="/assets/css/add.css" />
		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<link href="/froala_editor/css/froala_editor.min.css" rel="stylesheet" type="text/css">
		
		<!--[if lte IE 8]>
		<script src="/assets/js/html5shiv.min.js"></script>
		<script src="/assets/js/respond.min.js"></script>

		<![endif]-->	
	</head>	

<body class="no-skin">

@include('admin.master.common_header')

<script src="/fileupload/js/vendor/jquery.ui.widget.js"></script>
<script src="/fileupload/js/jquery.iframe-transport.js"></script>
<script src="/fileupload/js/jquery.fileupload.js"></script>
<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	
	<!-- #section:basics/sidebar -->
	<div id="sidebar" class="sidebar  responsive">
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
		</script>
		
		@include('admin.master.common_left')
		
		<!-- #section:basics/sidebar.layout.minimize -->
		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>

		<!-- /section:basics/sidebar.layout.minimize -->
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
		</script>
	</div>
	<div class="main-content">
		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>

			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="{{ url('donkey/admin/post/index') }}">日记管理</a>
				</li>
				<li class="active">编辑日记</li>
			</ul><!-- /.breadcrumb -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			{{-- dump(Session::all())--}}
			{{-- dump($errors->first())--}}
			
			<form method="post" action="{{ url('donkey/admin/post/update')}}">
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">题目：</label>
					<div class="col-sm-11">
						<input type='text' name='title' id="title" class="col-xs-10 col-sm-4" value="{{ old('title') ? old('title') : $post->title}}"/>
						<span class="help-inline col-xs-2 col-sm-7">
							<span class="middle" style="color:red">必填</span>
						</span>
					</div>
				</div>

				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">类型：</label>
					<div class="col-sm-11">
						<select name="pid" class="col-xs-10 col-sm-4">
						@foreach($types as $item)
							<option value="{{$item->id}}" @if($post->pid == $item->id) selected @endif>{{ $item->title}}</option>
						@endforeach
						</select>
						<span class="help-inline col-xs-2 col-sm-7">
							<span class="middle" style="color:red">必填</span>
						</span>
					</div>
				</div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $post->id }}" />
                <input type="hidden" id="post_content" name="content" value="{{ old('content') ? old('content') : $post->content }}" />
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">内容：</label>
					<div class="col-sm-10">
						<section id="editor">
							<div id='edit'>
								
							</div>
						</section>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="col-md-offset-1 col-md-9" style="margin-top:20px;">
					<button class="btn btn-info" onclick="return getcontent()" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						提交保存
					</button>
				</div>
			</form>
		
			<script>

				function getcontent(){
					var content = $("#edit").children(".froala-element").html();
					var title = $("#title").val();
					if(title == '') {
						alert('名称不能为空!');
						return false;
					}
					if(content == '<p><br></p>') {
						alert('内容不能为空!');
						return false;
					}else {
						$('#post_content').val(content);
						return true;
					}
				}
			</script>
			@include('admin.master.common_footer')
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="/froala_editor/js/froala_editor.min.js"></script>
		<!--[if lt IE 9]>
			<script src="../js/froala_editor_ie8.min.js"></script>
		<![endif]-->
		<script src="/froala_editor/js/plugins/tables.min.js"></script>
		<script src="/froala_editor/js/plugins/lists.min.js"></script>
		<script src="/froala_editor/js/plugins/colors.min.js"></script>
		<script src="/froala_editor/js/plugins/media_manager.min.js"></script>
		<script src="/froala_editor/js/plugins/font_family.min.js"></script>
		<script src="/froala_editor/js/plugins/font_size.min.js"></script>
		<script src="/froala_editor/js/plugins/block_styles.min.js"></script>
		<script src="/froala_editor/js/plugins/video.min.js"></script>

		<script>
			$(function(){
				$('#edit').editable({inlineMode: false, alwaysBlank: true})
							
				var content = $("#post_content").val();

				$("#edit").children(".froala-element").html(content);
			});
		</script>
		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="/assets/js/jquery-ui.custom.min.js"></script>
		<script src="/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/assets/js/jquery.easypiechart.min.js"></script>
		<script src="/assets/js/jquery.sparkline.min.js"></script>
		<script src="/assets/js/flot/jquery.flot.min.js"></script>
		<script src="/assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="/assets/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="/assets/js/ace-elements.min.js"></script>
		<script src="/assets/js/ace.min.js"></script>
		
		
	</body>
</html>
	