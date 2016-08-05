<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>401 Error Page - donkeyli Admin</title>

		<meta name="description" content="404 Error Page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="/assets/css/ace-fonts.css" />

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

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="/assets/js/html5shiv.min.js"></script>
		<script src="/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
	
		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-content">
				<div class="page-content">
					<div class="page-content-area">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<!-- #section:pages/error -->
								<div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="ace-icon fa fa-sitemap"></i>
												401
											</span>
											你没有操作权限,详情咨询站长!
										</h1>

										<hr />
										<h3 class="lighter smaller">I'm sorry, you don't have the access!</h3>

										<hr />
										<div class="space"></div>

										<div class="center">
											<a href="{{ $previousUrl or ''}}" class="btn btn-grey">
												<i class="ace-icon fa fa-arrow-left"></i>
												Go Back
											</a>
										</div>
									</div>
								</div>

								<!-- /section:pages/error -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

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

		<!-- ace scripts -->
		<script src="/assets/js/ace-elements.min.js"></script>
		<script src="/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		
	</body>
</html>
