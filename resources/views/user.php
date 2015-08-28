<html>
<head>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <link href="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" rel="stylesheet" type="text/css" />
  <link href='http://fonts.googleapis.com/css?family=Oxygen:300' rel='stylesheet' type='text/css'>
  <meta charset="utf-8">
  <title>Chartist.js - Aspect ratio containers</title>
<style id="jsbin-css">
html {
  font-family: Oxigen, Helvetica, Arial;
  font-size: 120%;
}

.tooltip {
  position: absolute;
  z-index: 1;
  padding: 5px;
  background: rgba(0, 0, 0, 0.3);
  opacity: 1;
  border-radius: 3px;
  text-align: center;
  pointer-events: none;
  color: white;
  transition: opacity .1s ease-out;
}

.tooltip.tooltip-hidden {
  opacity: 0;
}

.ct-chart {
  position: relative;
}

.ct-chart .ct-label.ct-horizontal,
.ct-chart .ct-label.ct-vertical {
  color: rgba(0, 0, 0, 0.3);
}
.ct-chart .ct-grid.ct-horizontal,
.ct-chart .ct-grid.ct-vertical {
  shape-rendering: crispEdges;
  stroke-width: 1px;
  stroke-dasharray: 1px 4px;
  stroke: rgba(0, 0, 0, 0.2);
}

.ct-chart .ct-point {
  stroke-width: 16px;
}

.ct-chart .ct-line {
  stroke-width: 3px;
}

.ct-chart .ct-series.ct-series-a .ct-point {
  stroke: #3299BB;
}

.ct-chart .ct-series.ct-series-a .ct-line {
  stroke: #3299BB;
}

.ct-chart .ct-series.ct-series-b .ct-point {
  stroke: #FF9900;
}

.ct-chart .ct-series.ct-series-b .ct-line {
  stroke: #FF9900;
}

.ct-chart.ct-blured .ct-point,
.ct-chart.ct-blured .ct-line {
  stroke-opacity: 0.2;
}
</style>
</head>
<body>
  <p><?php echo $username; ?></p>
  <p><?php echo $link_karma; ?></p>
  <p><?php echo $comment_karma; ?></p>
  <p><?php echo $age; ?></p>
  <p><?php echo $goukei; ?></p>
  <p><?php echo $heikin; ?></p>
  <p><?php echo $comments; ?></p>
  <p><?php echo $submitted; ?></p>
  <div class="ct-chart ct-golden-section"></div>
<script id="jsbin-javascript">
var chart = new Chartist.Line('.ct-chart', {
  labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
  series: [{
    name: 'comments',
    data: [<?php echo $comments; ?>]
  } , {
    name: 'submitted',
    data: [<?php echo $submitted; ?>]
  }]
}, {
  width: 720,
  height: 360
}, {
  low: 0,
  axisX: {
    offset: 25,
    labelOffset: {
      y: 10
    }
  },
  axisY: {
    offset: 35,
    labelOffset: {
      x: -10,
      y: 3
    }
  }
});

var $tooltip = $('<div class="tooltip tooltip-hidden"></div>').appendTo($('.ct-chart'));
 
$(document).on('mouseenter', '.ct-point', function() {
  var seriesName = $(this).closest('.ct-series').attr('ct:series-name'),
      value = $(this).attr('ct:value');
  
  $tooltip.text(seriesName + ': ' + value);
  $tooltip.removeClass('tooltip-hidden');
});

$(document).on('mouseleave', '.ct-point', function() {
  $tooltip.addClass('tooltip-hidden');
});

$(document).on('mousemove', '.ct-point', function(event) {
  console.log(event);
  $tooltip.css({
    left: (event.offsetX || event.originalEvent.layerX) - $tooltip.width() / 2,
    top: (event.offsetY || event.originalEvent.layerY) - $tooltip.height() - 20
  });
});
</script>
</body>
</html>
