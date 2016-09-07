	@include("home.master.head")
		<!--special class-->
		<link rel="stylesheet" href="/video/video-js.css" /> 
		<link rel="stylesheet" href="/css/video-detail.css" /> 
		<script src="/video/video.js"></script>
		
		<script>
			_V_.options.flash.swf = "/video/video-js.swf";
		</script>
	</head>
	<body>
		@include("home.master.header")
		<div class="container">
			<div class="page-header">
				<h3>视频列表<small> > 视频播放 > {{ $resource->title }}</small></h3>
			</div>
		</div>
		<div class="container">
            <form action="{{ url('donkey/video').'/'. $category_id .'/comment'}}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="resource_id" value="{{ $resource->id }}" />
            <div class="row">
				<div class="col-md-6 col-sm-12 xs-sm-12 fixed" style="margin-bottom:20px;">		
					<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="320"
						poster=""
						data-setup="{}">
						<source src="{{ $resource->path }}" type='video/mp4' />
						<source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
						<source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
						<!--<track kind="captions" src="captions.vtt" srclang="en" label="English" />-->
					</video>
				</div>
				<div class="col-md-6 col-sm-12 xs-sm-12" style="margin-bottom:20px;">
					
				</div>				
				<div class="col-md-6 col-sm-12 xs-sm-12 fixed-right" style="margin-bottom:20px;">
					<p class="comment"><em>评论列表</em></p>
					<div class="media">
						<a class="pull-left" href="#">
							<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Media heading</h4>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
							scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
							in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
							vulputate fringilla. Donec lacinia congue felis in faucibus. 
							<div class="media">
								<a class="pull-left" href="#">
									<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
								</a>
								<div class="media-body">
									<h4 class="media-heading">Media heading</h4>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
									scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
									in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
									vulputate fringilla. Donec lacinia congue felis in faucibus. 
								</div>
							</div>
						</div>
						<div class="media">
							<a class="pull-left" href="#">
								<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Media heading</h4>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
								scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
								in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
								vulputate fringilla. Donec lacinia congue felis in faucibus. 
							</div>
						</div>
						<div class="media">
							<a class="pull-left" href="#">
								<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Media heading</h4>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
								scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
								in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
								vulputate fringilla. Donec lacinia congue felis in faucibus. 
							</div>
						</div>
						<div class="media">
							<a class="pull-left" href="#">
								<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Media heading</h4>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
								scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
								in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
								vulputate fringilla. Donec lacinia congue felis in faucibus. 
							</div>
						</div>
					</div>
					<button id="tucao" type="button" class="btn btn-primary btn-sm pull-right" style="margin-right:20px;margin-bottom:30px;">我要吐槽</button>
						<!--<div class="Main" style="display:none;"> -->
							<div class="Input_Box" style="display:none;">
								<textarea class="Input_text"></textarea>     
								<div class="faceDiv"> </div>     
								<div class="Input_Foot"> <a class="imgBtn fa fa-smile-o" href="javascript:void(0);"></a><a class="postBtn">确定</a></div>
							</div>
						<!--</div> 	-->
				</div>
			</div>
            </form>
		</div>
		<script>
			$("#tucao").click(function(){
				var show = $(this).html();
				if(show == "我要吐槽") {
					$(this).html("取消吐槽");
					$(".Input_Box").css("display","block");
				}else{
					$(this).html("我要吐槽");
					$(".Input_Box").css("display","none");
				}
			})
			var ImgIputHandler={     
				facePath:{!! $emojis !!}    
				,     
				
				Init:function(){     
					var isShowImg=false;     
					$(".Input_text").focusout(function(){     
						$(this).parent().css("border-color", "#cccccc");     
						$(this).parent().css("box-shadow", "none");     
						$(this).parent().css("-moz-box-shadow", "none");     
						$(this).parent().css("-webkit-box-shadow", "none");     
					});     
					$(".Input_text").focus(function(){     
					$(this).parent().css("border-color", "rgba(19,105,172,.75)");     
					$(this).parent().css("box-shadow", "0 0 3px rgba(19,105,192,.5)");     
					$(this).parent().css("-moz-box-shadow", "0 0 3px rgba(241,39,232,.5)");     
					$(this).parent().css("-webkit-box-shadow", "0 0 3px rgba(19,105,252,3)");     
					});     
					$(".imgBtn").click(function(){ 
						if(isShowImg==false){     
							isShowImg=true;     
							$(this).parent().prev().animate({marginTop:"-115px"},300);     
							if($(".faceDiv").children().length==0){     
								for(var i=0;i<ImgIputHandler.facePath.length;i++ ){     
									$(".faceDiv").append("<img dmark=\""+ImgIputHandler.facePath[i].mark+"\" title=\"" +ImgIputHandler.facePath[i].name+"\" src=\"" +ImgIputHandler.facePath[i].path+ "\" />");     
								}    
								$(".faceDiv>img").click(function(){     	  
									isShowImg=false;     
									$(this).parent().animate({marginTop:"0px"},300);  
									
									//alert($(this).parent().prev().get(0));	
									//alert($(".Input_text")[0]);								
									
									ImgIputHandler.insertAtCursor($(this).parent().prev().get(0),$(this).attr("dmark"));     
								});     
							}     
						}else{     
							isShowImg=false;     
							$(this).parent().prev().animate({marginTop:"0px"},300);     
						}     
					});     
					$(".postBtn").click(function(){     
						alert($(".Input_text").val());     
					});     
				},     
				insertAtCursor:function(myField, myValue) {		     
				if (document.selection) {     
					myField.focus();     
					sel = document.selection.createRange();     
					sel.text = myValue;     
					sel.select();     
				} else if (myField.selectionStart || myField.selectionStart == "0") {     
					var startPos = myField.selectionStart;     
					var endPos = myField.selectionEnd;     
					var restoreTop = myField.scrollTop;     
					myField.value = myField.value.substring(0, startPos) +  myValue +  myField.value.substring(endPos, myField.value.length);     
					if (restoreTop > 0) {     
						myField.scrollTop = restoreTop;     
					}     
					myField.focus();     
					myField.selectionStart = startPos  + myValue.length;     
					myField.selectionEnd = startPos  + myValue.length;     
				} else {     
					myField.value  = myValue;     
					myField.focus();     
				}     
				}
			}      
			ImgIputHandler.Init();
			//console.log(ImgIputHandler.facePath);			
		</script>
		<footer class="footer">
			<p>©donkeyLi</p>
		</footer>
	</body>
</html>