<div id="navbar" class="navbar navbar-default">
	<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	</script>

	<div class="navbar-container" id="navbar-container">
		<!-- #section:basics/sidebar.mobile.toggle -->
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<!-- /section:basics/sidebar.mobile.toggle -->
		<div class="navbar-header pull-left">
			<!-- #section:basics/navbar.layout.brand -->
			<a href="#" class="navbar-brand">
				<small>
					<i class="fa fa-bicycle"></i>
					Donkey Admin
				</small>
			</a>

			<!-- /section:basics/navbar.layout.brand -->

			<!-- #section:basics/navbar.toggle -->

			<!-- /section:basics/navbar.toggle -->
		</div>

		<!-- #section:basics/navbar.dropdown -->
		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				@if(Auth::user()->id == 1)
				<li class="purple">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-bell icon-animated-bell"></i>
						<?php $count1 = App\Models\Notification::where("is_read",0)->count(); ?>
						@if($count1 > 0)
						<span class="badge badge-important">{{ $count1 }}</span>
						@endif
					</a>

					<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i>
							通知
						</li>
						<?php
							$n = App\Models\Notification::where("is_read",0)->first();
						?>
						@if($n) 
						<li>
							<a href="{{ $n->resource_id ? url(Config::get('common.notify_routes')[$n->type] . $n->resource_id) : url(Config::get('common.notify_routes')[$n->type].$n->album_id)}}">
								<div class="clearfix">
									<span class="pull-left">
										<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
										{{ $n->user->name . $n->body  }}
									</span>
								</div>
							</a>
						</li>
						@endif
						<li class="dropdown-footer">
							<a href="{{ url('donkey/admin/notification') }}">
								 查看所有的通告
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>
				@endif
				<li class="green">
					<?php
						$time = time() - 60*60*3;
						$date = date("Y-m-d H:i:s",$time);
						$num = App\Models\Comment::where('created_at','>',$date)->count();
						$first = App\Models\Comment::where('created_at','>',$date)->orderBy('created_at','desc')->paginate(3);
					?>
					
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-comments icon-animated-vertical"></i>
						@if($num > 0)
						<span class="badge badge-success">{{ $num }}</span>
						@endif
					</a>
				
					<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-comment"></i>
							{{$num}}条评论
						</li>

						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar">
								@if($first)
								@foreach($first as $first1)
								<li>
									<a href="{{url('donkey/admin/comment/show').'/'.$first1->id}}">
										<img src="{{$first1->user->headimg ? $first1->user->headimg : '/assets/avatars/avatar3.png'}}" class="msg-photo" alt="{{ $first1->user->name }}" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">{{ $first1->user->name }}:</span>
												{!! $first1->content !!}
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span>{{ $first1->created_at }}</span>
											</span>
										</span>
									</a>
								</li>
								@endforeach
								@endif
							</ul>
						</li>

						<li class="dropdown-footer">
							<a href="{{ url('donkey/admin/comment')}}">
								查看所有评论
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>

				<!-- #section:basics/navbar.user_menu -->
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<img class="nav-user-photo" src="{{ Auth::user()->headimg ? Auth::user()->headimg : '/assets/avatars/user.jpg'}}"/>
						<span class="user-info">
							<small>Welcome,</small>
							{{ Auth::user()->name }}
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="#">
								<i class="ace-icon fa fa-cog"></i>
								设置
							</a>
						</li>

						<li>
							<a href="{{ url('donkey/admin/personal') }}">
								<i class="ace-icon fa fa-user"></i>
								个人中心
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="{{ url('donkey/admin/auth/logout')}}">
								<i class="ace-icon fa fa-power-off"></i>
								退出
							</a>
						</li>
					</ul>
				</li>

				<!-- /section:basics/navbar.user_menu -->
			</ul>
		</div>

		<!-- /section:basics/navbar.dropdown -->
	</div><!-- /.navbar-container -->
</div>
