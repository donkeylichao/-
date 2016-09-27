<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Donkeyli</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />

		<style type="text/css">
			#headimg:hover{
				cursor:pointer;
			}
		</style>
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="/assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="/assets/css/select2.css" />
		<link rel="stylesheet" href="/assets/css/datepicker.css" />
		<link rel="stylesheet" href="/assets/css/bootstrap-editable.css" />

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

@include('admin.master.common_header')

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
					<a href="{{ url('donkey/admin/personal') }}">个人中心</a>
				</li>	
			</ul><!-- /.breadcrumb -->
		</div>
		
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			
			<div class="hr dotted"></div>
			
			<div>
				<div id="user-profile-1" class="user-profile row">
					<div class="col-xs-12 col-sm-3 center">
						<div>
							<!-- #section:pages/profile.picture -->
							<span class="profile-picture">
								<img id="headimg" width="180px" class="editable img-responsive" alt="{{ $user->name }}" src="{{ $user->headimg ? $user->headimg : '/assets/avatars/profile-pic.jpg'}}" />
							</span>
							<input type="hidden" name="oldhead" value="{{ $user->headimg }}"/>
							<!-- /section:pages/profile.picture -->
							<div class="space-4"></div>

							<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
								<div class="inline position-relative">
									<a href="#" class="user-title-label" data-toggle="dropdown">
										<span class="white">{{ ucfirst($user->name )}}</span>
									</a>

								</div>
							</div>
						</div>

						<div class="space-6"></div>

						<!-- #section:pages/profile.contact -->
						<div class="profile-contact-info">
							<div class="profile-contact-links align-left">
								<a href="#" class="btn btn-link">
									<i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
									添加好友
								</a>

								<a href="#" class="btn btn-link">
									<i class="ace-icon fa fa-envelope bigger-120 pink"></i>
									发送邮件
								</a>

								<a href="#" class="btn btn-link">
									<i class="ace-icon fa fa-globe bigger-125 blue"></i>
									网站
								</a>
							</div>
						</div>

					</div>

					<div class="col-xs-12 col-sm-9">
						<div class="center">
							<a href="{{ url('donkey/admin/room/index/1')}}" style="text-decoration:none">
							<span class="btn btn-app btn-sm btn-light no-hover">
								<span class="line-height-1 bigger-170 blue"> {{ $rooms }} </span>

								<br />
								<span class="line-height-1 smaller-90"> 房子 </span>
							</span>
							</a>
							
							<a href="{{ url('donkey/admin/video/index')}}" style="text-decoration:none">
							<span class="btn btn-app btn-sm btn-yellow no-hover">
								<span class="line-height-1 bigger-170"> {{ $videos }} </span>

								<br />
								<span class="line-height-1 smaller-90"> 视频 </span>
							</span>
							</a>

							<a href="{{ url('donkey/admin/music/index')}}" style="text-decoration:none">
							<span class="btn btn-app btn-sm btn-pink no-hover">
								<span class="line-height-1 bigger-170"> {{ $musics }} </span>

								<br />
								<span class="line-height-1 smaller-90"> 音频 </span>
							</span>
							</a>

							<span class="btn btn-app btn-sm btn-grey no-hover">
								<span class="line-height-1 bigger-170"> 0 </span>

								<br />
								<span class="line-height-1 smaller-90">  相册 </span>
							</span>
			
							<a href="{{ url('donkey/admin/post/index')}}" style="text-decoration:none">
							<span class="btn btn-app btn-sm btn-success no-hover">
								<span class="line-height-1 bigger-170"> {{ $posts }} </span>

								<br />
								<span class="line-height-1 smaller-90"> 日记 </span>
							</span>
							</a>

							<a href="{{ url('donkey/admin/pdf/index')}}" style="text-decoration:none">
							<span class="btn btn-app btn-sm btn-primary no-hover">
								<span class="line-height-1 bigger-170"> {{ $pdfs }} </span>

								<br />
								<span class="line-height-1 smaller-90"> 文件 </span>
							</span>
							</a>
						</div>

						<div class="space-12"></div>

						<!-- #section:pages/profile.info -->
						<div class="profile-user-info profile-user-info-striped">
							<div class="profile-info-row">
								<div class="profile-info-name"> 用户名 </div>

								<div class="profile-info-value">
									<span class="editable" id="name">{{ $user->name or ''}}</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> email </div>

								<div class="profile-info-value">
									<span class="editable" id="email">{{ $user->email or ''}}</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> phone </div>

								<div class="profile-info-value">
									<span class="editable" id="phone">{{ $user->phone or ''}}</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> 真实姓名 </div>

								<div class="profile-info-value">
									<span class="editable" id="real_name">{{ $user->real_name or ''}}</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Last Online </div>

								<div class="profile-info-value">
									<span class="editable" id="last_login_time">{{ date("Y-m-d H:i:s",$user->last_login_time) }}</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Last Ip </div>

								<div class="profile-info-value">
									<span class="editable" id="last_login_ip">{{ $user->last_login_ip }}</span>
								</div>
							</div>
						</div>

						<!-- /section:pages/profile.info -->

					</div>
				</div>
			</div>
			
			@include('admin.master.common_footer')
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

		<!--[if lte IE 8]>
		  <script src="/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="/assets/js/jquery-ui.custom.min.js"></script>
		<script src="/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/assets/js/jquery.gritter.min.js"></script>
		<script src="/assets/js/bootbox.min.js"></script>
		<script src="/assets/js/jquery.easypiechart.min.js"></script>
		<script src="/assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="/assets/js/jquery.hotkeys.min.js"></script>
		<script src="/assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="/assets/js/select2.min.js"></script>
		<script src="/assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="/assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="/assets/js/x-editable/ace-editable.min.js"></script>
		<script src="/assets/js/jquery.maskedinput.min.js"></script>
		<!-- ace scripts -->
		<script src="/assets/js/ace-elements.min.js"></script>
		<script src="/assets/js/ace.min.js"></script>
		
		<script type="text/javascript">
			jQuery(function($) {
				$('#head_file').click();
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    
				$.fn.editable.defaults.ajaxOptions = {type: "GET"}
				//editables 
				
				//text editable
			    $('#name')
				.editable({
					type: 'text',
					name: 'name',
					pk: {{ $user->id }},
					url: "/donkey/admin/personal/update",
					success: function(response,newValue){
						console.log(response.msg);
						//if(response.status == 'success') console.log(response.msg);
					},
			    });
			
				$('#email').editable({
					type: 'text',
					name: 'email',
					pk : {{ $user->id }},
					url : "/donkey/admin/personal/update",
					success : function(response,newValue) {
						console.log(response.msg)
					},
				});
			
			    $('#phone').editable({
			        type: 'text',
					name : 'phone',
					pk : {{ $user->id }},
					url : "/donkey/admin/personal/update",
					success : function(response,newValue) {
						console.log(response.msg)
					},
				});
				
				$('#real_name').editable({
			        type: 'text',
					name : 'real_name',
                    ajaxOptions: {
                        type: 'GET',
                        dataType: 'json',
                    },
                    pk : "{{ $user->id }}",
                    url : "/donkey/admin/personal/update",
					success : function(response,newValue) {
						console.log(response.msg)
					},
				});
				
				/*$('#headfile').on('click',function(){
					$(this).click();
				})*/
				$('#headimg').click(function(){
					
					var content = '<span class="editable-container editable-inline">\
						<div>\
							<div class="editableform-loading" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin fa-2x light-blue"></i>\
						</div>\
							<form class="form-inline editableform" action="#" method="post" enctype="multipart/form-data">\
								<div class="control-group form-group">\
									<div>\
										<div class="editable-input editable-image">\
										<span style="display:none;">\
											<input type="file" name="files" id="files" value="">\
										</span>\
										<span>\
											<label class="ace-file-input ace-file-multiple" style="width: 150px;">\
												<span class="ace-file-container" data-title="Change Avatar">\
													<span class="ace-file-name" data-title="No File ...">\
													<i class=" ace-icon fa fa-picture-o"></i>\
													</span>\
												</span>\
											</label>\
										</span>\
										</div>\
									</div>\
									<div class="editable-error-block help-block" style="display: none;"></div>\
								</div>\
							</form>\
						</div>\
					</span>';
					$(this).css('display','none');
					$(this).parent().append(content);
					$('.ace-file-container').click(function(){
						$('#files').click();
						$('#files').change(function(){
                            var oMyForm = new FormData();
							//console.log('hehe');
                            oMyForm.append("id", "{{ $user->id }}");
                            oMyForm.append("_token", "{{ csrf_token() }}"); // 数字123456被立即转换成字符串"123456"
							oMyForm.append("url", $("input[name='oldhead']").val());
                            //用户所选择的文件
                            //console.log($("input[name='files']").get(0).files[0]);
                            oMyForm.append("userfile", $("input[name='files']").get(0).files[0]);

                            var oReq = new XMLHttpRequest();
                            oReq.onreadystatechange = zswFun;
                            oReq.open("POST", "{{ url('donkey/admin/personal/headimg')}}");
                            oReq.send(oMyForm);
							
                            function zswFun(){
                                if(oReq.readyState == 4 && oReq.status == 200){
                                    var b = JSON.parse(oReq.responseText);
                                    if(b.status == 1){
										console.log(b.msg);
										$('.editable-container').remove();
										$("#headimg").attr('src',b.url);
										$("#headimg").css('display','block');
                                    }else{
                                        console.log(b.msg);
                                    }
									//$('#files').remove();
                                }
                            }
                        });
						/*$("#files").change(function(){
							//console.log('adsf');
							//获取上一张图片的地址
							var oldhead = $("input[name='oldhead']").val();
							var newhead = $("input[name='files']").get(0).files[0];
                            //var myForm = new FormData();
                            //myForm.append('filename',newhead);
                           // var newheadimg = newhead.files[0];

                            //console.log(newhead);
							$.ajax({
                                type : 'POST',
								url : '/donkey/admin/personal/headimg',
                                dataType: 'json',
								data : {'id':"{{ $user->id }}",
										'headimg': newhead,
										'old' : oldhead,
										'_token': "{{ csrf_token() }}",
								},
								success : function(msg){
									console.log('success');
								}
							})
						});*/
					});
				});


				// *** editable avatar *** //
				/*try {//ie8 throws some harmless exceptions, so let's catch'em
			
					//first let's add a fake appendChild method for Image element for browsers that have a problem with this
					//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
					try {
						document.createElement('IMG').appendChild(document.createElement('B'));
					} catch(e) {
						Image.prototype.appendChild = function(el){}
					}
			
					var last_gritter
					$('#headimg').editable({
						ajaxOptions: {
							type: 'post',
							dataType: 'json',
							data:{'pk':"{{ $user->id }}",'name':'headimg','_token':"{{ csrf_token() }}",'file':$('.ace-file-name').attr('data-title')},
							success : function(e){
								console.log('asdf');
							},
						},
						type: 'image',
						name: 'headimg',
						value: null,
						pk : {{ $user->id }},
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Avatar',
							droppable: true,
							maxSize: 110000,//~100Kb
			
							//and a few extra ones here
							name: 'headimg',//put the field name here as well, will be used inside the custom plugin
							on_error : function(error_type) {//on_error function will be called when the selected file has a problem

                                if(last_gritter) $.gritter.remove(last_gritter);
								if(error_type == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(error_type == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
									var filevalue = $(".ace-file-name").attr('data-title');
									$("headimg-hidden").val(filevalue);
								}
							},
							on_success : function() {
								//console.log(suc);
								//$.gritter.removeAll();
								var filevalue = $(".ace-file-name").attr('data-title');
								$("headimg-hidden").val(filevalue);
							}
						},
					   /* url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//for a working upload example you can replace the contents of this function with 
							//examples/profile-avatar-update.js
			
							var deferred = new $.Deferred
			
							var value = $('#headimg').next().find('input[type=hidden]:eq(0)').val();
							if(!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}
			
			
							//dummy upload
							setTimeout(function(){
								if("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#headimg').next().find('img').data('thumb');
									//var thumb = $('#headimg').next().find('img').get(0).style.backgroundImage;
									//var thumb = $('#headimg').next().find('img').css('background');
									//console.log(thumb);
									if(thumb) $('#headimg').get(0).src = thumb;
								}
								
								deferred.resolve({'status':'OK'});
			
								if(last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Avatar Updated!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});
								
							 } , parseInt(Math.random() * 800 + 800))
							return deferred.promise();
							
							// ***END OF UPDATE AVATAR HERE*** //
						},*/
						/*url : '/donkey/admin/personal/headimg',
						success: function(response, newValue) {
							//console.log(response);
							//console.log(newValue);
						}
					})
				}catch(e) {}*/
				
				
			
				//another option is using modals
				/*$('#avatar2').on('click', function(){
					var modal = 
					'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Change Avatar</h4>\
						</div>\
						\
						<form class="no-margin" enctype="multipart/form-data">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Submit</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click to choose new avatar',
						btn_change:null,
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});*/
			
				
			
				//////////////////////////////
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible : true
				});
			
				$('a[ data-original-title]').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				//right & left position
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter touchstart', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function(e) {
					e.preventDefault();
				});
			
			
				///////////////////////////////////////////
				$('#user-profile-3')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'ace-icon fa fa-picture-o',
					thumbnail:'large',
					droppable:true,
					
					allowExt: ['jpg', 'jpeg', 'png', 'gif'],
					allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				$('.input-mask-phone').mask('(999) 999-9999');
			
			
			
				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
			});
		</script>

</html>
	