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
				<h3><a href="{{ url('donkey/video').'/'.$category_id}}" style="color:#777;">{{ $category_name }}</a><small> > {{ $resource->title }}</small></h3>
			</div>
		</div>
		<div class="container">
            <form action="{{ url('donkey/video').'/'. $category_id .'/comment'}}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="hidden" name="category_id" value="{{ $category_id }}" />
            <input type="hidden" name="resource_id" value="{{ $resource->id }}" />
            <input id="pid" type="hidden" name="pid" value="" />
            <input id="comments" type="hidden" name="contents" />
            <div class="row">
				<!--视频播放开始-->
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
				<!--视频播放结束-->
				
				<div class="col-md-6 col-sm-12 xs-sm-12" style="margin-bottom:20px;">
					
				</div>
				<!--右侧评论板块开始-->
				<div class="col-md-6 col-sm-12 xs-sm-12 fixed-right" style="margin-bottom:20px;">
					@include("admin.master.notify")
					<div class="cmt-list-type">
						<ul class="clear-g type-lists">
							<li class="type-list active">评论</li>
							<li class="bottom-border active"></li>
						</ul>
						<div class="cmt-list-border"> </div>
						<div class="cmt-list-number">
							<span class="comment-number">
							<!--<span class="number">2758</span>
							人参与,-->
							<span class="number">{{ $count }}</span>
							条评论
							</span>
						</div>
					</div>
					
					<span>
						<button id="tucao" type="button" data="0" class="btn btn-primary btn-sm pull-right" style="margin:15px 15px 0px 0px;">我要吐槽</button>
					</span>	
					<div class="Main" style="display:none;">
						<img src="{{ Auth::user()->headimg ? Auth::user()->headimg : '/images/s5.jpg' }}" class="img-circle"/>
						<span class="name">用户:<strong>{{ Auth::check() ? Auth::user()->name : "未登录"}}</strong></span>
						<div class="Input_Box">
							<textarea class="Input_text"></textarea>						
							<div class="faceDiv"></div>     
							<div class="Input_Foot"> <a class="imgBtn fa fa-smile-o" href="javascript:void(0);"></a><a class="postBtn">确定</a></div>
						</div>
					</div>
					
					<div class="list-block-gw list-hot-w">
						<div class="block-title-gw">
							<ul class="clear-g">
								<li>
									<div class="title-name-gw">
										<div class="title-name-gw-tag"></div>
										最新评论
									</div>
								</li>
							</ul>
						</div>
					</div>
				
					<!--评论列表-->
					<div node-type="cmt-list" class="comment-lists">
						@foreach($comments as $item)
						<div class="clear-g block-cont-gw" user-id="483743751" node-type="cmt-item">
							<div class="cont-head-gw">
								<div class="head-img-gw">
									<div class="img-corner"></div>
									<img height="42" width="42" class="img-circle" alt="" src="{{ $item->user->headimg or '/images/s5.jpg'}}">
								</div>
							</div>
							<div class="cont-msg-gw">
								<div class="msg-wrap-gw">
									<div class="wrap-user-gw global-clear-spacing">
										<span class="user-time-gw hidden-xs">{{ $item->created_at }}</span>
										<span class="user-name-gw">{{ $item->user->name or ''}}</span>
									</div>
							
									<div class="wrap-issue-gw">
										<p class="issue-wrap-gw">
											<span class="wrap-word-gw">{!! $item->content !!}</span>
										</p>
									</div>
									<div class="clear-g wrap-action-gw" node-type="btns-bar">
										<div class="action-click-gw global-clear-spacing" node-type="action-click-gw">
											
											<span class="click-reply-gw visible-xs" style="float:left;color:silver;">
												<span>{{ substr($item->created_at,0,16) }}</span>
											</span>
										
											<i class="gap-gw"></i>
											<span class="click-ding-gw" node-type="support">
												<a href="javascript:;" data="{{ $item->id }}">
													<i class="fa fa-thumbs-o-up"></i>
													<em class="icon-name-bg">{{ $item->favour ? $item->favour->favours : 0}}</em>
												</a>
											</span>
											<i class="gap-gw"></i>
											<span class="click-cai-gw" node-type="oppose">
												<a href="javascript:;" data="{{ $item->id }}">
													<i class="fa fa-thumbs-o-down"></i>
													<em class="icon-name-bg">{{ $item->favour ? $item->favour->treads : 0}}</em>
												</a>
											</span>
											<i class="gap-gw"></i>
											<span class="click-reply-gw" node-type="reply">
												<span class="reply" data="{{ $item->id }}">回复</span>
											</span>
											
											<div class='Main-reply' style="display:none;">
												<div class='Input_Box'>
													<textarea class='Input_text'></textarea>
													<div class='faceDiv'></div>
													<div class='Input_Foot'>
														<a class='imgBtn fa fa-smile-o' href='javascript:void(0);'></a>
														<a class='postBtn'>确定</a>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							@if(count($item->childs) > 0)
							@foreach($item->childs as $item1)
							<div class="clear-g block-cont-gw1" user-id="483743751" node-type="cmt-item">
								<div class="cont-head-gw">
									<div class="head-img-gw">
										<div class="img-corner"></div>
										<img height="42" width="42" class="img-circle" alt="" src="{{ $item1->user->headimg or '/images/s5.jpg'}}">
									</div>
								</div>
								<div class="cont-msg-gw">
									<div class="msg-wrap-gw">
										<div class="wrap-user-gw global-clear-spacing">
											<span class="user-time-gw hidden-xs">{{ $item1->created_at }}</span>
											<span class="user-name-gw">{{ $item1->user->name or ''}}</span>
										</div>
								
										<div class="wrap-issue-gw">
											<p class="issue-wrap-gw">
												<span class="wrap-word-gw">{!! $item1->content !!}</span>
											</p>
										</div>
										<div class="clear-g wrap-action-gw" node-type="btns-bar">
											<div class="action-click-gw global-clear-spacing" node-type="action-click-gw">
												
												<span class="click-reply-gw visible-xs" style="float:left;color:silver;">
													<span>{{ substr($item1->created_at,0,16) }}</span>
												</span>
												
												<i class="gap-gw"></i>
												<span class="click-ding-gw" node-type="support">
													<a href="javascript:;" data="{{ $item1->id }}">
														<i class="fa fa-thumbs-o-up"></i>
														<em class="icon-name-bg">{{ $item1->favour ? $item1->favour->favours : 0}}</em>
													</a>
												</span>
												<i class="gap-gw"></i>
												<span class="click-cai-gw" node-type="oppose">
													<a href="javascript:;" data="{{ $item1->id }}">
														<i class="fa fa-thumbs-o-down"></i>
														<em class="icon-name-bg">{{ $item1->favour ? $item1->favour->treads : 0}}</em>
													</a>
												</span>
											</div>
										</div>
									</div>
								</div>	
							</div>
							@endforeach
							@endif
						</div>
						@endforeach
					</div>
					<!--评论列表结束-->
				</div>
				<!--右侧评论板块结束-->
			</div>
			<!--row结束-->
			<button type="submit" style="display:none;" id="submit_comment"></button>
			</form>
		</div>
		<!--container结束-->
		<script>
			//赞操作
			$(".fa-thumbs-o-up").click(function(){
				var comment_id = $(this).parent().attr("data");
				var _token = "{{ csrf_token() }}";
                var favours = $(this).next();
				$.ajax({
					type : "POST",
					url  : "{{ url('donkey/video').'/'.$category_id.'/favour'}}",
					data : {'comment_id':comment_id,'_token':_token},
					success : function(smg){
                        if(smg == 0) {
                            favours.html(Number(favours.html())+1);
                        }
					}
				});
			});
            //踩操作
            $(".fa-thumbs-o-down").click(function(){
                var comment_id = $(this).parent().attr("data");
                var _token = "{{ csrf_token() }}";
                var treads = $(this).next();
                $.ajax({
                    type : "POST",
                    url  : "{{ url('donkey/video').'/'.$category_id.'/tread'}}",
                    data : {'comment_id':comment_id,'_token':_token},
                    success : function(smg){
                        if(smg == 0) {
                            treads.html(Number(treads.html())+1);
                        }
                    }
                });
            });

			//评论操作
			$("#tucao").click(function(){
				//所有回复框影藏
				$(".Main-reply").css("display","none");
				//所有取消回复变成回复
				$(".reply").html("回复");
				//所有faceDiv的marginTop为0
				$(".faceDiv").css("margin-top","0px");
				//isShowImg变为false
				isShowImg = false;
				
				var show = $(this).html();
				var pid = $(this).attr("data");
				
				if(show == "我要吐槽") {
					$(this).html("取消吐槽");
					$(".Main").css("display","block");
					$("#pid").val(pid);
				}else{
					$(this).html("我要吐槽");
					$(".Main").css("display","none");
					$(this).parent().next().children().children(".faceDiv").css("margin-top","0px");
					isShowImg = false;
				}
			});
			
			$(".reply").click(function(){
				//吐槽框影藏
				$(".Main").css("display","none");
				//吐槽的字变
				$("#tucao").html("我要吐槽");
				//所有faceDiv的marginTop为0
				$(".faceDiv").css("margin-top","0px");
				//isShowImg变为false
				isShowImg = false;
				
				$(".Main-reply").not($(this)).css("display","none");

				$(".reply").not($(this)).html("回复");
				
				var show = $(this).html();
				var pid = $(this).attr("data");
				
				if(show == "回复") {
					$(this).html("取消回复");
					$(this).parent().next().css("display","block");
					$("#pid").val(pid);
				}else{
					$(this).html("回复");
					$(this).parent().next().css("display","none");
					$(this).parent().next().children().children(".faceDiv").css("margin-top","0px");
					isShowImg = false;
				}
			})
			var isShowImg=false; 
			var ImgIputHandler={     
				facePath:{!! $emojis !!}    
				,     
				
				Init:function(){     
					//var isShowImg=false;     
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
							 var faceDiv = $(this).parent().prev();
							if(faceDiv.children().length==0){     
								for(var i=0;i<ImgIputHandler.facePath.length;i++ ){     
									faceDiv.append("<img dmark=\""+ImgIputHandler.facePath[i].mark+"\" title=\"" +ImgIputHandler.facePath[i].name+"\" src=\"" +ImgIputHandler.facePath[i].path+ "\" />");     
								}    
								faceDiv.children().click(function(){     	  
									isShowImg=false;     
									$(this).parent().animate({marginTop:"0px"},300);  
									
									//alert($(this).parent().prev().get(0));	
									//alert($(".Input_text")[0]);								
									
									ImgIputHandler.insertAtCursor($(this).parent().prev().get(0),$(this).attr("dmark"));  
									//在这里获取到textarea的值
									//var contents = $(this).parent().prev().get(0).value;
									//alert(contents);
								});     
							}     
						}else{     
							isShowImg=false;     
							$(this).parent().prev().animate({marginTop:"0px"},300);     
						}     
					});  
					
					$(".postBtn").click(function(){     
						var html = $(this).parent().parent().parent().prev().children().html();
						//alert(html);
						if(html == "取消吐槽") {
							$(this).parent().parent().parent().prev().children().html("我要吐槽");
						}else if(html == "取消回复") {
							$(this).parent().parent().parent().prev().children().html("回复");
						}
						
						//这里获取textarea内容
						var contents = $(this).parent().prev().prev().val();
						//$(this).parent().prev().prev().val(contents);
						$("#comments").val(contents);

						$("#submit_comment").click();
						//alert($(".Input_text").val());    
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