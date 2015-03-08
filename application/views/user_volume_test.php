<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- Dropdown CSS -->
    <link href="../assets/css/bootstrap-select.min.css" rel="stylesheet">
	
	<style>
    #volume_chart {
        font: 10px sans-serif;
    }

    .axis path,
    .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
    }

    path.volume {
        fill: #AAAAAA;
        opacity: 0.5;
    }

    path.volume.up {
        fill: #00AA00;
    }

    path.volume.down {
        fill: #FF0000;
    }
	.extent {
        stroke: #fff;
        fill-opacity: .125;
        shape-rendering: crispEdges;
    }

	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

       
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">User Page</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href='<?php echo base_url()."main/logout"?>'><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

             <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
							<select class="selectpicker" title="Select Portfolio" id="portfolio_picker"></select>
                            <div class="input-group custom-search-form">
								<select class="selectpicker" title="Select Symbol" id="symbol_picker" data-width="100%"></select>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"  onclick="drawChart()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>

                        <li class="active">
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a  href="main_content">Candlestick</a>
                                </li>
                                <li>
                                    <a class="active" href="stockVolumePage">Volume</a>
                                </li>
								<li>
                                    <a href="MACDPage">MACD</a>
                                </li>
								<li>
                                    <a href="RSIPage">RSI</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
			<div id="volume_chart"></div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/sb-admin-2.js"></script>
	
	<script src="http://d3js.org/d3.v3.js"></script>
	<!--<script src="http://techanjs.org/techan.js"></script>-->
	
	<script src="../assets/js/techan.js"></script>
	<!-- Custom Dropdown JavaScript -->
    <script src="../assets/js/bootstrap-select.min.js"></script>

<script>
		$( document ).ready(function() {
			console.log( "ready!" );
			$.post('<?php echo base_url(); ?>ajax/get_portfolio_id',function(data){
				$("#portfolio_picker").empty();
				$("#portfolio_picker").append(("<option data-hidden=\"true\"></option>"));
				$.each($.parseJSON(data), function(i, item){
					$("#portfolio_picker").append(("<option>"+item.id+"</option>"));
				});
				$('#portfolio_picker').selectpicker('refresh');
			})
		});
		
		$( document ).ready(function() {
			$("#portfolio_picker").change(function(){
				console.log($("#portfolio_picker option:selected").val());
				var id=$("#portfolio_picker option:selected").val();
				$.get(
					'<?php echo base_url(); ?>ajax/get_symbol_from_portfolio/'+id,
					function(data){
						$("#symbol_picker").empty();
						$("#symbol_picker").append(("<option data-hidden=\"true\"></option>"));
						$.each($.parseJSON(data), function(i, item){
							$("#symbol_picker").append(("<option>"+item.symbol+"</option>"));
						});
						$('#symbol_picker').selectpicker('refresh');	
					}
				);
			});
		});
		function drawChart(){
			var  symbol= $("#symbol_picker option:selected").val() ;
			$('#volume_chart').empty();

			 var margin = {top: 20, right: 20, bottom: 30, left: 50},
			  margin2 = {top: 420, right: 20, bottom: 20, left: 50},
						width = 960 - margin.left - margin.right,
						height = 500 - margin.top - margin.bottom,
						 height2 = 600 - margin2.top - margin2.bottom;

			var parseDate = d3.time.format("%d-%b-%y").parse;

			var x = techan.scale.financetime()
					.range([0, width]);
			
			var x2 = techan.scale.financetime()
					.range([0, width]);			

			var y = d3.scale.linear()
					.range([height, 0]);
					
			var y2 = d3.scale.linear()
					.range([height2, 0]);

			var brush = d3.svg.brush()
					.on("brushend", draw);

			var volume = techan.plot.volume()
					.accessor(techan.accessor.ohlc())   // For volume bar highlighting
					.xScale(x)
					.yScale(y)
					;

			var xAxis = d3.svg.axis()
					.scale(x)
					.orient("bottom");
					
			var xAxis2 = d3.svg.axis()
					.scale(x2)
					.orient("bottom");

			var yAxis = d3.svg.axis()
					.scale(y)
					.orient("left")
					.tickFormat(d3.format(",.3s"));
			
			var yAxis2 = d3.svg.axis()
					.scale(y2)
					.ticks(0)
					.orient("left");

			var svg = d3.select("#volume_chart").append("svg")
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom);
					
					
			var focus=svg.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
					
					
			focus.append("g")
        //        .datum(data)
                .attr("class", "volume")
         //       .call(volume)
				;

        focus.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
          //      .call(xAxis)
				;

        focus.append("g")
                .attr("class", "y axis")
                .call(yAxis)
            .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 6)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Volume");
				
		    var context = svg.append("g")
            .attr("class", "context")
            .attr("transform", "translate(" + margin2.left + "," + margin2.top + ")");

		context.append("g")
				.attr("class", "close");

		context.append("g")
				.attr("class", "pane");

		context.append("g")
				.attr("class", "x axis")
				.attr("transform", "translate(0," + height2 + ")");
	
		context.append("g")
				.attr("class", "y axis")
				.call(yAxis2);
				
		var zoomable, zoomable2;

			var result = d3.json('<?php echo base_url(); ?>ajax/getStockPrice/'+symbol, function(error, source_data) {
				  var accessor = volume.accessor();

				data = source_data.slice(0, 500).map(function(d) {
				// Open, high, low, close generally not required, is being used here to demonstrate colored volume
				// bars
					return {
						date: parseDate(d.date),
						open: +d.open,
						high: +d.high,
						low: +d.low,
						close: +d.close,
						volume: +d.volume
					};
				}).sort(function(a, b) { return d3.ascending(accessor.d(a), accessor.d(b)); });

        x.domain(data.map(accessor.d));
		x2.domain(x.domain());
        y.domain(techan.scale.plot.volume(data, accessor.v).domain());
		y2.domain(y.domain());
		
		focus.select("g.volume").datum(data);
		
		
		// Associate the brush with the scale and render the brush only AFTER a domain has been applied
        zoomable = x.zoomable();
        zoomable2 = x2.zoomable();
        brush.x(zoomable2);
        context.select("g.pane").call(brush).selectAll("rect").attr("height", height2);

        draw();

     //   console.log("Render time: " + (Date.now()-timestart));

        
    });
		function draw() {
			var volumeSelection = focus.select("g.volume"),
            data = volumeSelection.datum();
			zoomable.domain(brush.empty() ? zoomable2.domain() : brush.extent());
			y.domain(techan.scale.plot.ohlc(data.slice.apply(data, zoomable.domain()), volume.accessor()).domain());
			volumeSelection.call(volume);
			focus.select("g.volume").call(volume);
			// using refresh method is more efficient as it does not perform any data joins
			// Use this if underlying data is not changing
			svg.select("g.volume").call(volume.refresh);
		//	context.select("g.close").datum(data).call(close);
			context.select("g.x.axis").call(xAxis2);
			focus.select("g.x.axis").call(xAxis);
			focus.select("g.y.axis").call(yAxis);
    }
			
		}
		
</script>

</body>

</html>
