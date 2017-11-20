$(document).ready(function() {
  //Sort random function
  function random(owlSelector) {
    owlSelector.children().sort(function() {
      return Math.round(Math.random()) - 0.5;
    }).each(function() {
      $(this).appendTo(owlSelector);
    });
  }

  $("#owl-review").owlCarousel({
    navigation: true,
    navigationText: [
      "<i class='fa fa-chevron-left'></i>",
      "<i class='fa fa-chevron-right'></i>"
    ],
    beforeInit: function(elem) {
      //Parameter elem pointing to $("#owl-demo")
      random(elem);
    }

  });
});

$(document).ready(function() {
  //Sort random function
  function random(owlSelector) {
    owlSelector.children().sort(function() {
      return Math.round(Math.random()) - 0.5;
    }).each(function() {
      $(this).appendTo(owlSelector);
    });
  }

  $("#owl-review2").owlCarousel({
    navigation: true,
    navigationText: [
      "<i class='fa fa-chevron-left'></i>",
      "<i class='fa fa-chevron-right'></i>"
    ],
    beforeInit: function(elem) {
      //Parameter elem pointing to $("#owl-demo")
      random(elem);
    }

  });
});