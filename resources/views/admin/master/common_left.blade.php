<?php 
	$uri = $_SERVER['REQUEST_URI'];
	
	
?>
<ul class="nav nav-list">
	<li @if(strpos($uri,'home')) class="active" @endif>
		<a href="{{ url('donkey/admin/home')}}">
			<i class="menu-icon fa fa-info"></i>
			<span class="menu-text"> 网站统计 </span>
		</a>
			
		<b class="arrow"></b>
	</li>

	<li @if(strpos($uri,'user')) class="active" @endif>
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

	<li @if(strpos($uri,'role') || strpos($uri,'permission')) class="active" @endif>
		<a href="{{ url('donkey/admin/role') }}" class="dropdown-toggle">
			<i class="menu-icon fa fa-eye"></i>
			<span class="menu-text"> 权限管理 </span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li @if(strpos($uri,'role')) class="active" @endif>
				<a href="{{ url('donkey/admin/role')}}">
					<i class="menu-icon fa fa-caret-right"></i>
					角色管理
				</a>

				<b class="arrow"></b>
			</li>

			<li @if(strpos($uri,'permission')) class="active" @endif>
				<a href="{{ url('donkey/admin/permission')}}">
					<i class="menu-icon fa fa-caret-right"></i>
					权限管理
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	
	<li @if(strpos($uri,'category')) class="active" @endif>
		<a href=" {{ url('donkey/admin/category')}}">
			<i class="menu-icon fa fa-list"></i>
			<span class="menu-text"> 分类管理 </span>
			<b class="arrow"></b>
			<!--<b class="arrow fa fa-angle-down"></b>-->
		</a>
	</li>	
		
	<li @if(strpos($uri,'room')) class="active" @endif>
		<a href=" {{ url('donkey/admin/room')}}">
			<i class="menu-icon fa fa-home"></i>
			<span class="menu-text"> 房源管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
		
	<li @if(strpos($uri,'video')) class="active" @endif>
		<a href="{{ url('donkey/admin/video')}}">
			<i class="menu-icon fa fa-video-camera"></i>
			<span class="menu-text"> 视频管理 </span>
			<b class="arrow"></b>
		</a>
	</li>
	
	<li @if(strpos($uri,'music')) class="active" @endif>
		<a href="{{ url('donkey/admin/music')}}">
			<i class="menu-icon fa fa-music"></i>
			<span class="menu-text"> 音频管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li @if(strpos($uri,'photo')) class="active" @endif>
		<a href="{{ url('donkey/admin/photo')}}">
			<i class="menu-icon fa fa-image"></i>
			<span class="menu-text"> 图片管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li @if(strpos($uri,'post')) class="active" @endif>
		<a href="{{ url('donkey/admin/post')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text"> 日记管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li @if(strpos($uri,'post')) class="active" @endif>
		<a href="{{ url('donkey/admin/comment')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-comment"></i>
			<span class="menu-text"> 评论管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li @if(strpos($uri,'notification')) class="active" @endif>
		<a href="{{ url('donkey/admin/notification')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-bullhorn"></i>
			<span class="menu-text"> 消息管理 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	
	<li @if(strpos($uri,'personal')) class="active" @endif>
		<a href="{{ url('donkey/admin/personal')}}" class="dropdown-toggle">
			<i class="menu-icon fa fa-user"></i>
			<span class="menu-text"> 个人中心 </span>
			
			<b class="arrow"></b>
		</a>
	</li>
	

</ul><!-- /.nav-list -->