<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- DC CSS -->
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/dc/1.7.0/dc.css"/>

    <style>
        #monthly-volume-chart g.y {
            display: none;
        }
        #logo {
            margin-right: 2em;
            margin-top: 2em;
        }
		.dc-number{
			color:steelblue;
			font-size: 26px;
		}

		    <style>

    </style>
    </style>

    <title>User Page</title>

</head>

<body>

<div class="container">
<h2>Portfolio Performance Dashboard</h2>

<div class="row">
	The maximum value is   <span class ="dc-number" id="max-value"></span> on  <span class ="dc-number" id="max-value-date"></span> .
	The minimum value is   <span class ="dc-number" id="min-value"></span> on  <span class ="dc-number" id="min-value-date"></span> .
 </div>
	
	

<div class="row">
    <div id="yearly-bubble-chart" class="dc-chart">
        <strong>Yearly Performance</strong> (radius: fluctuation/index ratio, color: gain/loss)
        <a class="reset" href="javascript:yearlyBubbleChart.filterAll();dc.redrawAll();"
           style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>
</div>

<div class="row">
    <div id="gain-loss-chart">
        <strong>Days by Gain/Loss</strong>
        <a class="reset" href="javascript:gainOrLossChart.filterAll();dc.redrawAll();" style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>

    <div id="quarter-chart">
        <strong>Quarters</strong>
        <a class="reset" href="javascript:quarterChart.filterAll();dc.redrawAll();" style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>

    <div id="day-of-week-chart">
        <strong>Day of Week</strong>
        <a class="reset" href="javascript:dayOfWeekChart.filterAll();dc.redrawAll();" style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>

    <div id="fluctuation-chart">
        <strong>Days by Fluctuation(%)</strong>
        <span class="reset" style="display: none;">range: <span class="filter"></span></span>
        <a class="reset" href="javascript:fluctuationChart.filterAll();dc.redrawAll();" style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>
</div>


<div class="row">
    <div id="symbol-chart">
        <strong>Symbol</strong>
        <span class="reset" style="display: none;">range: <span class="filter"></span></span>
        <a class="reset" href="javascript:moveChart.filterAll();symbolChart.filterAll();dc.redrawAll();"
           style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>
	
</div>


<div class="row">
	
	    <div id="portfolio-value-chart">
        <strong>portfolio Value</strong>
        <span class="reset" style="display: none;">range: <span class="filter"></span></span>
        <a class="reset" href="javascript:moveChart.filterAll();volumeChart.filterAll();dc.redrawAll();"
           style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>
	
	
</div>


<div class="row">
    <div id="monthly-move-chart">
        <strong>Monthly Index Abs Move & Volume/500,000 Chart</strong>
        <span class="reset" style="display: none;">range: <span class="filter"></span></span>
        <a class="reset" href="javascript:moveChart.filterAll();volumeChart.filterAll();dc.redrawAll();"
           style="display: none;">reset</a>

        <div class="clearfix"></div>
    </div>
</div>

<div class="row">
    <div id="monthly-volume-chart">
    </div>
    <p class="muted pull-right" style="margin-right: 15px;">select a time range to zoom in</p>
</div>

<div class="row">
    <div>
        <div class="dc-data-count">
            <span class="filter-count"></span> selected out of <span class="total-count"></span> records | <a
                href="javascript:dc.filterAll(); dc.renderAll();">Reset All</a>
        </div>
    </div>
    <table class="table table-hover dc-data-table">
    </table>
</div>
</div>
<div class="clearfix"></div>


</body>

	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../../assets/js/crossfilter.js"></script>
<script type="text/javascript" src="../../assets/js/dc.js"></script>
<script type="text/javascript" src="../../assets/js/colorbrewer.js"></script>

<script>
//# dc.js Getting Started and How-To Guide
'use strict';

/* jshint globalstrict: true */
/* global dc,d3,crossfilter,colorbrewer */

// ### Create Chart Objects
// Create chart objects assocated with the container elements identified by the css selector.
// Note: It is often a good idea to have these objects accessible at the global scope so that they can be modified or
// filtered by other page controls.
var gainOrLossChart = dc.pieChart('#gain-loss-chart');
var fluctuationChart = dc.barChart('#fluctuation-chart');
var quarterChart = dc.pieChart('#quarter-chart');
var dayOfWeekChart = dc.rowChart('#day-of-week-chart');
var moveChart = dc.lineChart('#monthly-move-chart');
var volumeChart = dc.barChart('#monthly-volume-chart');

//new added
var symbolChart=dc.rowChart('#symbol-chart');
var portfolioValueChart= dc.lineChart('#portfolio-value-chart');
var maxValueBox=dc.numberDisplay('#max-value');
var maxValueDateBox=dc.numberDisplay();
var minValueBox=dc.numberDisplay('#min-value');
var minValueDateBox=dc.numberDisplay();

// ### Anchor Div for Charts
/*
// A div anchor that can be identified by id
    <div id='your-chart'></div>
// Title or anything you want to add above the chart
    <div id='chart'><span>Days by Gain or Loss</span></div>
// ##### .turnOnControls()
// If a link with css class 'reset' is present then the chart
// will automatically turn it on/off based on whether there is filter
// set on this chart (slice selection for pie chart and brush
// selection for bar chart). Enable this with `chart.turnOnControls(true)`
     <div id='chart'>
       <a class='reset' href='javascript:myChart.filterAll();dc.redrawAll();' style='display: none;'>reset</a>
     </div>
// dc.js will also automatically inject applied current filter value into
// any html element with css class set to 'filter'
    <div id='chart'>
        <span class='reset' style='display: none;'>Current filter: <span class='filter'></span></span>
    </div>
*/

//### Load your data
//Data can be loaded through regular means with your
//favorite javascript library
//
//```javascript
//d3.csv('data.csv', function(data) {...};
//d3.json('data.json', function(data) {...};
//jQuery.getJson('data.json', function(data){...});
//```
//d3.json('<?php echo base_url(); ?>ajax/getStockPrice/BABA', function (data) {
d3.json('<?php echo base_url(); ?>ajax/get_portfolio_stock_price/<?php echo $id?>', function (data) {
    /* since its a csv file we need to format the data a bit */
    var dateFormat = d3.time.format("%d-%b-%y").parse;
    var numberFormat = d3.format('.2f');

    data.forEach(function (d) {
        d.dd = dateFormat(d.date);
       // console.log(d.dd);
        d.month = d3.time.month(d.dd); // pre-calculate month for better performance
       //d.month= d.dd.getMonth();
        d.close = +d.close; // coerce to number
      //  console.log(d.close);
        d.open = +d.open;
		d.adjusted_close= + d.adjusted_close;
    });

    //### Create Crossfilter Dimensions and Groups
    //See the [crossfilter API](https://github.com/square/crossfilter/wiki/API-Reference) for reference.
    var ndx = crossfilter(data);
    var all = ndx.groupAll();



    // dimension by full date
    var dateDimension = ndx.dimension(function (d) {
        return d.dd;
    });
	//console.log(dateDimension.top(1)[0]['date']);
	//console.log(dateDimension.bottom(1)[0]['date']);
	
	//group by value*quantity within date for portfolio
	var valueOfPortoflioGroup= dateDimension.group().reduceSum(function (d) {
        return d.adjusted_close*d.quantity;
    });
	var TestGroup= dateDimension.group().reduce(
		 function (p, v) {
            ++p.counts;
            p.closevalue += v.close*v.quantity;
			p.openvalue += v.open*v.quantity;
            p.fluctuation= Math.round((p.closevalue - p.openvalue) / p.openvalue * 100);
            return p;
        },
        function (p, v) {
            --p.counts;
            p.closevalue -= v.close*v.quantity;
			p.openvalue -= v.open*v.quantity;
            p.fluctuation= Math.round((p.closevalue - p.openvalue) / p.openvalue * 100);
            return p;
        },
        function () {
            return {counts: 0, closevalue: 0, openvalue: 0, fluctuation :0};
        }
    );
	console.log(TestGroup.top(10)[2]);
	

    // dimension by month
    var moveMonths = ndx.dimension(function (d) {
        return d.month;
    });
    // group by total movement within month
    var monthlyMoveGroup = moveMonths.group().reduceSum(function (d) {
        return Math.abs(d.close - d.open);
    });
    // group by total volume within move, and scale down result
    var volumeByMonthGroup = moveMonths.group().reduceSum(function (d) {
        return d.volume / 500000;
    });
    var indexAvgByMonthGroup = moveMonths.group().reduce(
        function (p, v) {
            ++p.days;
            p.total += (v.open + v.close) / 2;
            p.avg = Math.round(p.total / p.days);
            return p;
        },
        function (p, v) {
            --p.days;
            p.total -= (v.open + v.close) / 2;
            p.avg = p.days ? Math.round(p.total / p.days) : 0;
            return p;
        },
        function () {
            return {days: 0, total: 0, avg: 0};
        }
    );

    // create categorical dimension
    var gainOrLoss = ndx.dimension(function (d) {
        return d.open > d.close ? 'Loss' : 'Gain';
    });
    // produce counts records in the dimension
    var gainOrLossGroup = gainOrLoss.group();
	
	// create symbol dimension
    var symbol = ndx.dimension(function (d) {
        return d.symbol;
    });
    // produce counts records in the dimension
    var symbolGroup = symbol.group();

    // determine a histogram of percent changes
    var fluctuation = ndx.dimension(function (d) {
        return Math.round((d.close - d.open) / d.open * 100);
    });
    var fluctuationGroup = fluctuation.group();

    // summerize volume by quarter
    var quarter = ndx.dimension(function (d) {
        var month = d.dd.getMonth();
        if (month <= 2) {
            return 'Q1';
        } else if (month > 2 && month <= 5) {
            return 'Q2';
        } else if (month > 5 && month <= 8) {
            return 'Q3';
        } else {
            return 'Q4';
        }
    });
    var quarterGroup = quarter.group().reduceSum(function (d) {
        return d.volume;
    });

    // counts per weekday
    var dayOfWeek = ndx.dimension(function (d) {
        var day = d.dd.getDay();
        var name = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        return day + '.' + name[day];
    });
    var dayOfWeekGroup = dayOfWeek.group();

    //### Define Chart Attributes
    //Define chart attributes using fluent methods. See the
    // [dc API Reference](https://github.com/dc-js/dc.js/blob/master/web/docs/api-latest.md) for more information
    //

    // #### Pie/Donut Chart
    // Create a pie chart and use the given css selector as anchor. You can also specify
    // an optional chart group for this chart to be scoped within. When a chart belongs
    // to a specific group then any interaction with such chart will only trigger redraw
    // on other charts within the same chart group.

    gainOrLossChart
        .width(180) // (optional) define chart width, :default = 200
        .height(180) // (optional) define chart height, :default = 200
        .radius(80) // define pie radius
        .dimension(gainOrLoss) // set dimension
        .group(gainOrLossGroup) // set group
        /* (optional) by default pie chart will use group.key as its label
         * but you can overwrite it with a closure */
        .label(function (d) {
            if (gainOrLossChart.hasFilter() && !gainOrLossChart.hasFilter(d.key)) {
                return d.key + '(0%)';
            }
            var label = d.key;
            if (all.value()) {
                label += '(' + Math.floor(d.value / all.value() * 100) + '%)';
            }
            return label;
        }) /*
        // (optional) whether chart should render labels, :default = true
        .renderLabel(true)
        // (optional) if inner radius is used then a donut chart will be generated instead of pie chart
        .innerRadius(40)
        // (optional) define chart transition duration, :default = 350
        .transitionDuration(500)
        // (optional) define color array for slices
        .colors(['#3182bd', '#6baed6', '#9ecae1', '#c6dbef', '#dadaeb'])
        // (optional) define color domain to match your data domain if you want to bind data or color
        .colorDomain([-1750, 1644])
        // (optional) define color value accessor
        .colorAccessor(function(d, i){return d.value;})
        */;

    quarterChart.width(180)
        .height(180)
        .radius(80)
        .innerRadius(30)
        .dimension(quarter)
        .group(quarterGroup);

    //#### Row Chart
    dayOfWeekChart.width(180)
        .height(180)
        .margins({top: 20, left: 10, right: 10, bottom: 20})
        .group(dayOfWeekGroup)
        .dimension(dayOfWeek)
        // assign colors to each value in the x scale domain
        .ordinalColors(['#3182bd', '#6baed6', '#9ecae1', '#c6dbef', '#dadaeb'])
        .label(function (d) {
            return d.key.split('.')[1];
        })
        // title sets the row text
        .title(function (d) {
            return d.value;
        })
        .elasticX(true)
        .xAxis().ticks(4);
		
		

    //#### Bar Chart
    // Create a bar chart and use the given css selector as anchor. You can also specify
    // an optional chart group for this chart to be scoped within. When a chart belongs
    // to a specific group then any interaction with such chart will only trigger redraw
    // on other charts within the same chart group.
    /* dc.barChart('#volume-month-chart') */
    fluctuationChart.width(420)
        .height(180)
        .margins({top: 10, right: 50, bottom: 30, left: 40})
        .dimension(fluctuation)
        .group(fluctuationGroup)
	//	.dimension(TestGroup)
	//	.group(TestGroup)
        .elasticY(true)
        // (optional) whether bar should be center to its x value. Not needed for ordinal chart, :default=false
        .centerBar(true)
        // (optional) set gap between bars manually in px, :default=2
        .gap(1)
        // (optional) set filter brush rounding
        .round(dc.round.floor)
        .alwaysUseRounding(true)
        .x(d3.scale.linear().domain([-25, 25]))
        .renderHorizontalGridLines(true)
        // customize the filter displayed in the control span
        .filterPrinter(function (filters) {
            var filter = filters[0], s = '';
            s += numberFormat(filter[0]) + '% -> ' + numberFormat(filter[1]) + '%';
            return s;
        });

    // Customize axis
    fluctuationChart.xAxis().tickFormat(
        function (v) { return v + '%'; });
    fluctuationChart.yAxis().ticks(5);
	
	
	//symbol chart
	    symbolChart.width(180)
        .height(180)
        .margins({top: 20, left: 10, right: 10, bottom: 20})
        .group(symbolGroup)
        .dimension(symbol)
        // assign colors to each value in the x scale domain
        .ordinalColors(['#3182bd', '#6baed6', '#9ecae1', '#c6dbef', '#dadaeb'])
        .label(function (d) {
            return d.key;
        })
        // title sets the row text
        .title(function (d) {
            return d.value;
        })
        .elasticX(true)
        .xAxis().ticks(4);
	
	//####Value Chart
    //Specify an area chart, by using a line chart with `.renderArea(true)`
    portfolioValueChart
       // .renderArea(true)
        .width(990)
        .height(200)
        .transitionDuration(1000)
        .margins({top: 30, right: 50, bottom: 25, left: 40})
        .dimension(dateDimension)
        .mouseZoomable(true)
        // Specify a range chart to link the brush extent of the range with the zoom focue of the current chart.
        .rangeChart(volumeChart)
        .x(d3.time.scale().domain([new Date(1985, 0, 1), new Date(2015, 1, 1)]))
        .round(d3.time.month.round)
        .xUnits(d3.time.months)
        .elasticY(true)
        .renderHorizontalGridLines(true)
        .legend(dc.legend().x(620).y(10).itemHeight(13).gap(5))
        .brushOn(false)
        // Add the base layer of the stack with group. The second parameter specifies a series name for use in the
        // legend
        // The `.valueAccessor` will be used for the base layer
        .group(valueOfPortoflioGroup, 'Value of the Portfolio')
        // title can be called by any stack layer.
;
	
	//number box added
	 maxValueBox
      .formatNumber(d3.format(".3s"))
      .valueAccessor(function(d){
		return valueOfPortoflioGroup.top(1)[0]['value'];
	  })
      .group(valueOfPortoflioGroup);
	  
	  
	 maxValueDateBox
      .formatNumber(d3.format(".g"))
      .valueAccessor(function(d){
			var d=new Date(valueOfPortoflioGroup.top(1)[0]['key']);
	  		document.getElementById("max-value-date").innerHTML = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate();
	//	return valueOfPortoflioGroup.top(1)[0]['key'];
	  })
      .group(valueOfPortoflioGroup);
	  
	  
	  
	  minValueBox
      .formatNumber(d3.format(".3s"))
      .valueAccessor(function(d){
		return valueOfPortoflioGroup.top(Number.POSITIVE_INFINITY)[valueOfPortoflioGroup.size()-1]['value'];
	  })
      .group(valueOfPortoflioGroup);
	  
	  
	 minValueDateBox
      .formatNumber(d3.format(".g"))
      .valueAccessor(function(d){
			var d=new Date(valueOfPortoflioGroup.top(Number.POSITIVE_INFINITY)[valueOfPortoflioGroup.size()-1]['key']);
	  		document.getElementById("min-value-date").innerHTML = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate();
	//	return valueOfPortoflioGroup.top(20)[valueOfPortoflioGroup.size()]['key'];
	  })
      .group(valueOfPortoflioGroup);


    //#### Stacked Area Chart
    //Specify an area chart, by using a line chart with `.renderArea(true)`
    moveChart
        .renderArea(true)
        .width(990)
        .height(200)
        .transitionDuration(1000)
        .margins({top: 30, right: 50, bottom: 25, left: 40})
        .dimension(moveMonths)
        .mouseZoomable(true)
        // Specify a range chart to link the brush extent of the range with the zoom focue of the current chart.
        .rangeChart(volumeChart)
        .x(d3.time.scale().domain([new Date(1985, 0, 1), new Date(2015, 1, 1)]))
        .round(d3.time.month.round)
        .xUnits(d3.time.months)
        .elasticY(true)
        .renderHorizontalGridLines(true)
        .legend(dc.legend().x(800).y(10).itemHeight(13).gap(5))
        .brushOn(false)
        // Add the base layer of the stack with group. The second parameter specifies a series name for use in the
        // legend
        // The `.valueAccessor` will be used for the base layer
        .group(indexAvgByMonthGroup, 'Monthly Index Average')
        .valueAccessor(function (d) {
            return d.value.avg;
        })
        // stack additional layers with `.stack`. The first paramenter is a new group.
        // The second parameter is the series name. The third is a value accessor.
        .stack(monthlyMoveGroup, 'Monthly Index Move', function (d) {
            return d.value;
        })
        // title can be called by any stack layer.
        .title(function (d) {
            var value = d.value.avg ? d.value.avg : d.value;
            if (isNaN(value)) {
                value = 0;
            }
            return d3.time.format("%d-%b-%y")(d.key) + '\n' + numberFormat(value);
        });

    volumeChart.width(990)
        .height(40)
        .margins({top: 0, right: 50, bottom: 20, left: 40})
        .dimension(moveMonths)
        .group(volumeByMonthGroup)
        .centerBar(true)
        .gap(1)
        .x(d3.time.scale().domain([new Date(1985, 0, 1), new Date(2015, 1, 1)]))
        .round(d3.time.month.round)
        .alwaysUseRounding(true)
        .xUnits(d3.time.months);

    /*
    //#### Data Count
    // Create a data count widget and use the given css selector as anchor. You can also specify
    // an optional chart group for this chart to be scoped within. When a chart belongs
    // to a specific group then any interaction with such chart will only trigger redraw
    // on other charts within the same chart group.
    <div id='data-count'>
        <span class='filter-count'></span> selected out of <span class='total-count'></span> records
    </div>
    */
    dc.dataCount('.dc-data-count')
        .dimension(ndx)
        .group(all)
        // (optional) html, for setting different html for some records and all records.
        // .html replaces everything in the anchor with the html given using the following function.
        // %filter-count and %total-count are replaced with the values obtained.
        .html({
            some:'<strong>%filter-count</strong> selected out of <strong>%total-count</strong> records' +
                ' | <a href=\'javascript:dc.filterAll(); dc.renderAll();\'\'>Reset All</a>',
            all:'All records selected. Please click on the graph to apply filters.'
        });

    /*
    //#### Data Table
    // Create a data table widget and use the given css selector as anchor. You can also specify
    // an optional chart group for this chart to be scoped within. When a chart belongs
    // to a specific group then any interaction with such chart will only trigger redraw
    // on other charts within the same chart group.
    <!-- anchor div for data table -->
    <div id='data-table'>
        <!-- create a custom header -->
        <div class='header'>
            <span>Date</span>
            <span>Open</span>
            <span>Close</span>
            <span>Change</span>
            <span>Volume</span>
        </div>
        <!-- data rows will filled in here -->
    </div>
    */
    dc.dataTable('.dc-data-table')
        .dimension(dateDimension)
        // data table does not use crossfilter group but rather a closure
        // as a grouping function
        .group(function (d) {
            var format = d3.format('02d');
            return d.dd.getFullYear() + '/' + format((d.dd.getMonth() + 1));
        })
        .size(100) // (optional) max number of records to be shown, :default = 25
        // There are several ways to specify the columns; see the data-table documentation.
        // This code demonstrates generating the column header automatically based on the columns.
        .columns([
            'date',    // d['date'], ie, a field accessor; capitalized automatically
            'open',    // ...
            'close',   // ...
            {
                label: 'Change', // desired format of column name 'Change' when used as a label with a function.
                format: function (d) {
                    return numberFormat(d.close - d.open);
                }
            },
            'volume',   // d['volume'], ie, a field accessor; capitalized automatically
			'symbol'
        ])

        // (optional) sort using the given field, :default = function(d){return d;}
        .sortBy(function (d) {
            return d.dd;
        })
        // (optional) sort order, :default ascending
        .order(d3.descending )
        // (optional) custom renderlet to post-process chart using D3
        .renderlet(function (table) {
            table.selectAll('.dc-table-group').classed('info', true);
        });

    /*
    //#### Geo Choropleth Chart
    //Create a choropleth chart and use the given css selector as anchor. You can also specify
    //an optional chart group for this chart to be scoped within. When a chart belongs
    //to a specific group then any interaction with such chart will only trigger redraw
    //on other charts within the same chart group.
    dc.geoChoroplethChart('#us-chart')
        .width(990) // (optional) define chart width, :default = 200
        .height(500) // (optional) define chart height, :default = 200
        .transitionDuration(1000) // (optional) define chart transition duration, :default = 1000
        .dimension(states) // set crossfilter dimension, dimension key should match the name retrieved in geo json layer
        .group(stateRaisedSum) // set crossfilter group
        // (optional) define color function or array for bubbles
        .colors(['#ccc', '#E2F2FF','#C4E4FF','#9ED2FF','#81C5FF','#6BBAFF','#51AEFF','#36A2FF','#1E96FF','#0089FF',
            '#0061B5'])
        // (optional) define color domain to match your data domain if you want to bind data or color
        .colorDomain([-5, 200])
        // (optional) define color value accessor
        .colorAccessor(function(d, i){return d.value;})
        // Project the given geojson. You can call this function mutliple times with different geojson feed to generate
        // multiple layers of geo paths.
        //
        // * 1st param - geo json data
        // * 2nd param - name of the layer which will be used to generate css class
        // * 3rd param - (optional) a function used to generate key for geo path, it should match the dimension key
        // in order for the coloring to work properly
        .overlayGeoJson(statesJson.features, 'state', function(d) {
            return d.properties.name;
        })
        // (optional) closure to generate title for path, :default = d.key + ': ' + d.value
        .title(function(d) {
            return 'State: ' + d.key + '\nTotal Amount Raised: ' + numberFormat(d.value ? d.value : 0) + 'M';
        });

        //#### Bubble Overlay Chart
        // Create a overlay bubble chart and use the given css selector as anchor. You can also specify
        // an optional chart group for this chart to be scoped within. When a chart belongs
        // to a specific group then any interaction with such chart will only trigger redraw
        // on other charts within the same chart group.
        dc.bubbleOverlay('#bubble-overlay')
            // bubble overlay chart does not generate it's own svg element but rather resue an existing
            // svg to generate it's overlay layer
            .svg(d3.select('#bubble-overlay svg'))
            .width(990) // (optional) define chart width, :default = 200
            .height(500) // (optional) define chart height, :default = 200
            .transitionDuration(1000) // (optional) define chart transition duration, :default = 1000
            .dimension(states) // set crossfilter dimension, dimension key should match the name retrieved in geo json
                layer
            .group(stateRaisedSum) // set crossfilter group
            // closure used to retrieve x value from multi-value group
            .keyAccessor(function(p) {return p.value.absGain;})
            // closure used to retrieve y value from multi-value group
            .valueAccessor(function(p) {return p.value.percentageGain;})
            // (optional) define color function or array for bubbles
            .colors(['#ccc', '#E2F2FF','#C4E4FF','#9ED2FF','#81C5FF','#6BBAFF','#51AEFF','#36A2FF','#1E96FF','#0089FF',
                '#0061B5'])
            // (optional) define color domain to match your data domain if you want to bind data or color
            .colorDomain([-5, 200])
            // (optional) define color value accessor
            .colorAccessor(function(d, i){return d.value;})
            // closure used to retrieve radius value from multi-value group
            .radiusValueAccessor(function(p) {return p.value.fluctuationPercentage;})
            // set radius scale
            .r(d3.scale.linear().domain([0, 3]))
            // (optional) whether chart should render labels, :default = true
            .renderLabel(true)
            // (optional) closure to generate label per bubble, :default = group.key
            .label(function(p) {return p.key.getFullYear();})
            // (optional) whether chart should render titles, :default = false
            .renderTitle(true)
            // (optional) closure to generate title per bubble, :default = d.key + ': ' + d.value
            .title(function(d) {
                return 'Title: ' + d.key;
            })
            // add data point to it's layer dimension key that matches point name will be used to
            // generate bubble. multiple data points can be added to bubble overlay to generate
            // multiple bubbles
            .point('California', 100, 120)
            .point('Colorado', 300, 120)
            // (optional) setting debug flag to true will generate a transparent layer on top of
            // bubble overlay which can be used to obtain relative x,y coordinate for specific
            // data point, :default = false
            .debug(true);
    */

    //#### Rendering
    //simply call renderAll() to render all charts on the page
    dc.renderAll();
    /*
    // or you can render charts belong to a specific chart group
    dc.renderAll('group');
    // once rendered you can call redrawAll to update charts incrementally when data
    // change without re-rendering everything
    dc.redrawAll();
    // or you can choose to redraw only those charts associated with a specific chart group
    dc.redrawAll('group');
    */

});

//#### Version
//Determine the current version of dc with `dc.version`
d3.selectAll('#version').text(dc.version);
</script>


</body>

</html>