<ul class="nav nav-list">
	<li class="active">
		<a href="{{ url('donkey/admin')}}">
			<i class="menu-icon fa fa-info"></i>
			<span class="menu-text"> 网站统计 </span>
		</a>

		<b class="arrow"></b>
	</li>

	<li class="">
		<a href="{{ url('donkey/admin/user') }}">
			<i class="menu-icon fa fa-users"></i>
			<span class="menu-text"> 用户管理 </span>

			<!--<b class="arrow fa fa-angle-down"></b>-->
		</a>

		<b class="arrow"></b>

		<!--<ul class="submenu">
			<li class="">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-caret-right"></i>

					用户列表
					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu">
					<li class="">
						<a href="top-menu.html">
							<i class="menu-icon fa fa-caret-right"></i>
							用户列表
						</a>

						<b class="arrow"></b>
					</li>
				</ul>
			</li>
		</ul>-->
	</li>

	<li class="">
		<a href="{{ url('donkey/admin/role') }}" class="dropdown-toggle">
			<i class="menu-icon fa fa-eye"></i>
			<span class="menu-text"> 权限管理 </span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li class="">
				<a href="{{ url('donkey/admin/role')}}">
					<i class="menu-icon fa fa-caret-right"></i>
					角色管理
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="{{ url('donkey/admin/permission')}}">
					<i class="menu-icon fa fa-caret-right"></i>
					权限管理
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	
	<li class="">
		<a href=" {{ url('donkey/admin/category')}}">
			<i class="menu-icon fa fa-list"></i>
			<span class="menu-text"> 分类管理 </span>
			<b class="arrow"></b>
			<!--<b class="arrow fa fa-angle-down"></b>-->
		</a>
	</li>	
		
	<li class="">
		<a href=" {{ url('donkey/admin/room')}}">
			<i class="menu-icon fa fa-home"></i>
			<span class="menu-text"> 房源管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
		
	<li class="">
		<a href="{{ url('donkey/admin/video')}}">
			<i class="menu-icon fa fa-video-camera"></i>
			<span class="menu-text"> 视频管理 </span>
			<b class="arrow"></b>
		</a>
	</li>
	
	<li class="">
		<a href="{{ url('donkey/admin/music')}}">
			<i class="menu-icon fa fa-music"></i>
			<span class="menu-text"> 音频管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li class="">
		<a href="{{ url('donkey/admin/photo')}}">
			<i class="menu-icon fa fa-image"></i>
			<span class="menu-text"> 图片管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li class="">
		<a href="{{ url('donkey/admin/post')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text"> 日记管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li class="">
		<a href="{{ url('donkey/admin/comment')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-comment"></i>
			<span class="menu-text"> 评论管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li class="">
		<a href="{{ url('donkey/admin/notification')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-bullhorn"></i>
			<span class="menu-text"> 消息管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li class="">
		<a href="{{ url('donkey/admin/personal')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-user"></i>
			<span class="menu-text"> 个人中心 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	

</ul><!-- /.nav-list -->