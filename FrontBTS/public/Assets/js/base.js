document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems);
  });

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems);
  });

  $(document).ready(function(){
    $('.carousel').carousel();
  });

  $(document).ready(function(){
    $('input.autocomplete').autocomplete({
      data: {
        "Paris CDG": null,
        "Londres Hearthrow": null,
        "New York JFK" : null,
        "Tokyo Haneda" : null,
      },
    });
  });
  
  console.log("blblblblbl");