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
	
	<!-- intro.js CSS-->
	<link href = "http://cdn.bootcss.com/intro.js/1.0.0/introjs.css" rel="stylesheet">
	
	<style>
    #candle_chart {
        font: 10px sans-serif;
    }


    .axis path,
    .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
    }

    path.candle {
        stroke: #000000;
    }

    path.candle.body {
        stroke-width: 0;
    }

    path.candle.up {
        fill: #00AA00;
        stroke: #00AA00;
    }

    path.candle.down {
        fill: #FF0000;
        stroke: #FF0000;
    }

    path.ohlc {
        stroke: #000000;
        stroke-width: 1;
    }

    path.ohlc.up {
        stroke: #00AA00;
    }

    path.ohlc.down {
        stroke: #FF0000;
    }

    path.volume {
        fill: #EEEEEE;
    }

    path.line {
        fill: none;
        stroke: #BF5FFF;
        stroke-width: 1;
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
                        <li class="sidebar-search" data-step="1" data-intro="Pick a portfolio and a symbol" data-position="right">
							<select class="selectpicker" title="Select Portfolio" id="portfolio_picker"></select>
                            <div class="input-group custom-search-form">
								<select class="selectpicker" title="Select Symbol" id="symbol_picker" data-width="100%"></select>
                                <span class="input-group-btn" data-step="2" data-intro="Click to load the chart" data-position="right">
                                    <button class="btn btn-default" type="button"  onclick="drawChart()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>

                        <li class="active">
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" data-step="3" data-intro="Click and repeat above steps to view other charts" data-position="right">
                                <li>
                                    <a class="active" href="main_content">Candlestick</a>
                                </li>
                                <li>
                                    <a href="stockVolumePage">Volume</a>
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
                        <li data-step="4" data-intro="get your raw data here, make sure to select symbol before you generate" data-position="right">
                            <a href="#" onclick="genCSV()"><i class="fa fa-table fa-fw" ></i> Generate CSV</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                        <div class="panel-body">
                            <h3 id="candle_h"></h3>
                            <p id="candle_p"></p>
						</div>
				</div>
			</div>
			<div id="candle_chart"></div>
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
	
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="http://techanjs.org/techan.min.js"></script>
	
	<!-- Custom Dropdown JavaScript -->
    <script src="../assets/js/bootstrap-select.min.js"></script>
	
	<!-- intro.js-->
	<script src= "http://cdn.bootcss.com/intro.js/1.0.0/intro.js"></script>
	
	<!-- loader animation-->
	<script src= "http://fgnass.github.io/spin.js/spin.min.js"></script>

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
			introJs().goToStep(1).start();
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
			var symbol = $("#symbol_picker option:selected").val() ;
			$('#candle_chart').empty();
			$("#candle_h").html("Candlestick Chart : "+ symbol);
			$("#candle_p").html("Brush the chart below to select range. ");
			   var margin = {top: 20, right: 20, bottom: 100, left: 50},
        margin2 = {top: 420, right: 20, bottom: 20, left: 50},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom,
        height2 = 500 - margin2.top - margin2.bottom;
		var target = document.getElementById('candle_chart');
		var spinner = new Spinner().spin(target);

  	var parseDate = d3.time.format("%d-%b-%y").parse;

    var x = techan.scale.financetime()
            .range([0, width]);

    var x2 = techan.scale.financetime()
            .range([0, width]);

    var y = d3.scale.linear()
            .range([height, 0]);

    var yVolume = d3.scale.linear()
            .range([y(0), y(0.3)]);

    var y2 = d3.scale.linear()
            .range([height2, 0]);

    var brush = d3.svg.brush()
            .on("brushend", draw);

    var candlestick = techan.plot.candlestick()
            .xScale(x)
            .yScale(y);

    var volume = techan.plot.volume()
            .xScale(x)
            .yScale(yVolume);

    var close = techan.plot.close()
            .xScale(x2)
            .yScale(y2);

    var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

    var xAxis2 = d3.svg.axis()
            .scale(x2)
            .orient("bottom");

    var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left");

    var yAxis2 = d3.svg.axis()
            .scale(y2)
            .ticks(0)
            .orient("left");

    var svg = d3.select("#candle_chart").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom);

    var focus = svg.append("g")
            .attr("class", "focus")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    focus.append("clipPath")
            .attr("id", "clip")
        .append("rect")
            .attr("x", 0)
            .attr("y", y(1))
            .attr("width", width)
            .attr("height", y(0) - y(1));

    focus.append("g")
            .attr("class", "volume")
            .attr("clip-path", "url(#clip)");

    focus.append("g")
            .attr("class", "candlestick")
            .attr("clip-path", "url(#clip)");

    focus.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")");

    focus.append("g")
            .attr("class", "y axis")
        .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Price ($)");

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

    var result =d3.json('<?php echo base_url(); ?>ajax/getStockPrice/'+symbol, function(error, data) {
        var accessor = candlestick.accessor(),
            timestart = Date.now();

			 spinner.stop();
        data = data.slice(0, 10000).map(function(d) {
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
        y.domain(techan.scale.plot.ohlc(data, accessor).domain());
        y2.domain(y.domain());
        yVolume.domain(techan.scale.plot.volume(data).domain());

        focus.select("g.candlestick").datum(data);
        focus.select("g.volume").datum(data);



        // Associate the brush with the scale and render the brush only AFTER a domain has been applied
        zoomable = x.zoomable();
        zoomable2 = x2.zoomable();
        brush.x(zoomable2);
        context.select("g.pane").call(brush).selectAll("rect").attr("height", height2);

        draw();

        console.log("Render time: " + (Date.now()-timestart));
    });

    function draw() {
        var candlestickSelection = focus.select("g.candlestick"),
            data = candlestickSelection.datum();
        zoomable.domain(brush.empty() ? zoomable2.domain() : brush.extent());
        y.domain(techan.scale.plot.ohlc(data.slice.apply(data, zoomable.domain()), candlestick.accessor()).domain());
        candlestickSelection.call(candlestick);
        focus.select("g.volume").call(volume);
        // using refresh method is more efficient as it does not perform any data joins
        // Use this if underlying data is not changing
       svg.select("g.candlestick").call(candlestick.refresh);
	    context.select("g.close").datum(data).call(close);
        context.select("g.x.axis").call(xAxis2);
        focus.select("g.x.axis").call(xAxis);
        focus.select("g.y.axis").call(yAxis);
    }
		}
	function genCSV(){
		var symbol = $("#symbol_picker option:selected").val() ;
		console.log(symbol);
		document.location.href = '<?php echo base_url(); ?>ajax/generateCSV/'+symbol;
	}	
		
</script>

</body>

</html>
