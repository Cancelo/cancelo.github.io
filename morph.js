'use strict';

var morpher = function morpher(element, start, end) {
  // var chars = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', '4', '5', '6', '7', '8', '9', '%', '$', '?', '!'];
  var chars = [''];
  var duration = 2;
  var frameRate = 30;

  var string = start.split('');
  var result = end.split('');
  var slen = string.length;
  var rlen = result.length;

  var present = new Date();
  var past = present.getTime();
  var count = 0;
  var spentTime = 0;
  
  var splitTime = duration * 1000 / Math.max(slen, rlen);

  var update = function update() {
    present = new Date();
    spentTime += present.getTime() - past;

    for (var i = count; i < Math.max(slen, rlen); i++) {
      var random = Math.floor(Math.random() * (chars.length - 1));
      string[i] = chars[random];
    }

    if (spentTime >= splitTime) {
      count += Math.floor(spentTime / splitTime);
      for (var j = 0; j < count; j++) {
        string[j] = result[j] || null;
      }
      spentTime = 0;
    }

    element.textContent = string.join('');

    past = present.getTime();

    if (count < Math.max(slen, rlen)) {
      setTimeout(function () {
        window.requestAnimationFrame(update);
      }, 1000 / frameRate);
    }
  };
  update();
};

$(function () {
  var button = document.querySelector('.js-morph-trigger');
  var morph = document.querySelector('*[data-morph]');
  // var words = ["Php", "JavaScript", "HTML5", "CSS3", "C#", "XAML", "Wordpress", "Bootstrap"];
  var words = ["LAB"];

  var counter = 0;

  setInterval(function () {
    var start = morph.textContent;
    var end = words[counter];

    morpher(morph, start, end);

    if (counter < words.length - 1) {
      counter++;
    } else {
      counter = 0;
    }
  }, 4000);
});