'use strict';

$('.round')
  .circleProgress({
    lineCap: 'round',

    fill: {
      color: '#00B41F',
    },
    emptyFill: '#191C26',
  })
  .on('circle-animation-progress', function (event, progress, stepValue) {
    $(this)
      .find('strong')
      .text(String(stepValue.toFixed(2)).substr(2) + '%');
  });

$('.round-1')
  .circleProgress({
    lineCap: 'round',

    fill: {
      color: '#00B41F',
    },
    emptyFill: '#FFDAE0',
  })
  .on('circle-animation-progress', function (event, progress, stepValue) {
    $(this)
      .find('strong')
      .text(String(stepValue.toFixed(2)).substr(2) + '%');
  });
