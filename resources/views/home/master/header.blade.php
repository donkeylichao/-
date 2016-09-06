
	<nav class="navbar navbar-inverse" style="margin-bottom:0px">
		    <div class="container">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">DonkeyLi</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li @if(strpos(Request::getUri(),'room')) class="active" @endif><a href="{{ url('donkey/room') }}">房源 <span class="sr-only">(current)</span></a></li>
							<li class="dropdown  @if(strpos(Request::getUri(),'video')) active @endif">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">视频<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php 
										$video_types = Cache::get("video_types",function(){
											$video_types = App\Models\Category::where("pid",1)->get();
											Cache::put("video_types",$video_types,10);
											return $video_types;
										});
									?>
									@foreach($video_types as $item0)
									<li><a href="{{ url('donkey/video').'/'.$item0->id }}">{{ $item0->name}}</a></li>
									@endforeach
								</ul>
							</li>
							<!--<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">日记 <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
								</ul>
							</li>-->
							<li  @if(strpos(Request::getUri(),'post')) class="active" @endif><a href="{{ url('donkey/post')}}">日记</a></li>
							<li><a href="#">不知道</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</div>
		</nav>
		