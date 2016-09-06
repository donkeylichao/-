@include('admin.master.common_head')

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
					<a href="{{ url('donkey/admin/room/index/1') }}">房源管理</a>
				</li>
				<li class="active">添加房源</li>
			</ul><!-- /.breadcrumb -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			{{-- dump(Session::all())--}}
			{{-- dump($errors->first())--}}
			
			<form method="post" action="{{ url('donkey/admin/room/store')}}">
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">类型：</label>
					<div class="col-sm-11">
						<select name="h_type" id="house_type" class="col-xs-10 col-sm-4">
							@foreach(Config::get('common.house_types') as $k=>$v)
							<option value="{{ $k }}" @if(old('h_type') == $k) selected @endif>{{$v}}</option>
							@endforeach
						</select>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle"></span>
						</span>
					</div>	
				</div>	
				<script>
					//
					$(function(){
						$('#house_type').change(function(){
							//alert('asdf');
							var num = $(this).val();
							//alert(num);
							if(num == 1){ 
								$('.play').css('display','none');
							}else if(num == 2) {
								$('.play').css('display','block');
							}
						});
					});
				</script>
				<div height="10px">&nbsp;</div>
				
				<div class="form-group play" style="display:none;">
					<label class="col-sm-1 control-label no-padding-right">买卖单价：</label>
					<div class="col-sm-11">
						<input type='text' name='univalence' placeholder="单位:元/平米" class="col-xs-10 col-sm-4" value="{{ old('univalence') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如:"12000"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px" class='play' style="display:none;">&nbsp;</div>
				
				<div class="form-group play" style="display:none;">
					<label class="col-sm-1 control-label no-padding-right">税率：</label>
					<div class="col-sm-11">
						<input type='text' name='tax_rate' class="col-xs-10 col-sm-4" value="{{ old('tax_rate') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*选填,例如:6%,填写格式为0.06*</span>
						</span>
					</div>
				</div>
				
				<div height="10px" class='play' style="display:none;">&nbsp;</div>
				
				<div class="form-group play" style="display:none">
					<label class="col-sm-1 control-label no-padding-right">税费：</label>
					<div class="col-sm-11">
						<input type='text' name='taxes' placeholder="单位:元" class="col-xs-10 col-sm-4" value="{{ old('taxes') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如:"20000"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px" class='play' style="display:none;">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">小区名称：</label>
					<div class="col-sm-11">
						<input type='text' name='name' class="col-xs-10 col-sm-4" value="{{ old('name') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">小区位置：</label>
					<div class="col-sm-11">
						<input type="text" name="position"  class="col-xs-10 col-sm-4" value="{{ old('position') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如 "北京市 朝阳区 XX大街"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">房子名称：</label>
					<div class="col-sm-11">
						<input type="text" name="room_name"  class="col-xs-10 col-sm-4" value="{{ old('room_name') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如 "38楼3单元205"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">户型：</label>
					<div class="col-sm-11">
						<input type="text" name="type"  class="col-xs-10 col-sm-4" value="{{ old('type') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如 "三室两厅"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">面积：</label>
					<div class="col-sm-11">
						<input type='text' name="area" placeholder="单位:平米" class="col-xs-10 col-sm-4" value="{{ old('area') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>	
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">价格：</label>
					<div class="col-sm-11">
						<input type='text' name="price" placeholder="单位:元" class="col-xs-10 col-sm-4" value="{{ old('price') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>	
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">地图路径：</label>
					<div class="col-sm-11">
						<input type='text' name="position_url" class="col-xs-10 col-sm-4" value="{{ old('position_url') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:green">*可不填*</span>
						</span>
					</div>	
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">备注：</label>
					<div class="col-sm-11">
						<input type='text' name="introduction" class="col-xs-10 col-sm-4" value="{{ old('introduction') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>	
				</div>
			
				<div height="10px">&nbsp;</div>
				
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						提交保存
					</button>
				</div>
			</form>
		
			
			@include('admin.master.common_footer')
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		
		<script>
			$('')
		</script>
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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>
	</body>
</html>
	