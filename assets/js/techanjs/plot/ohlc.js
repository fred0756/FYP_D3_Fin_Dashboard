'use strict';

module.exports = function(d3_scale_linear, d3_extent, accessor_ohlc, plot, plotMixin) {  // Injected dependencies
  return function() { // Closure constructor
    var p = {},  // Container for private, direct access mixed in variables
        ohlcGenerator;

    function ohlc(g) {
      var group = plot.groupSelect(g, plot.dataMapper.array, p.accessor.d);

      plot.appendUpDownEqual(group.selection, p.accessor, 'ohlc');

      ohlc.refresh(g);
    }

    ohlc.refresh = function(g) {
      g.selectAll('path.ohlc').attr('d', ohlcGenerator);
    };

    function binder() {
      ohlcGenerator = plot.joinPath(p.accessor, p.xScale, p.yScale, ohlcPath);
    }

    // Mixin 'superclass' methods and variables
    plotMixin(ohlc, p).plot(accessor_ohlc(), binder);

    return ohlc;
  };
};

function ohlcPath(accessor, x, y) {
  return function(d) {
    var open = y(accessor.o(d)),
        close = y(accessor.c(d)),
        rangeBand = x.band(),
        xPoint = x(accessor.d(d)),
        xValue = xPoint - rangeBand/2;

    return [
        'M', xValue, open,
        'l', rangeBand/2, 0,
        'M', xPoint, y(accessor.h(d)),
        'L', xPoint, y(accessor.l(d)),
        'M', xPoint, close,
        'l', rangeBand/2, 0
      ].join(' ');
  };
}