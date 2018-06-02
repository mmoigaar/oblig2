var categories = [];

var categoryJSON;
var mostPop;
var entryJSON;
var displayPref;

var catSet = false;
var popSet = false;

$(document).ready(function(){

  // Posts 'getCategories' to the index controller
  $.ajax({ url: 'controllers/index.php',
           data: {action: 'getCategories'},
           type: 'post',
           success: function(output) {
             //callback function stores global var
             callback('categories', JSON.parse(output));
           }
  });

  // Posts 'mostPop' to the index controller
  $.ajax({ url: 'controllers/index.php',
           data: {action: 'mostPop'},
           type: 'post',
           success: function(output) {
             //callback function stores global var
             callback('mostPop', output);
           }
  });

  // Posts 'checkDisplayPref' to the index controller
  $.ajax({ url: 'controllers/index.php',
           data: {action: 'checkDisplayPref'},
           type: 'post',
           success: function(output) {
             //callback function stores global var
             callback('displayPref', output);
           }
  });

  // Posts 'getEntries' to the index controller
  $.ajax({ url: 'controllers/index.php',
           data: {action: 'getEntries'},
           type: 'post',
           success: function(output) {
             //callback function stores global var
             callback('entries', JSON.parse(output));
           }
  });

});

function callback(source, output){

  switch(source){
    case 'categories':
      categoryJSON = output;
      catSet = true;
      break;

    case 'mostPop':
      mostPop = output;
      popSet = true;
      if(catSet == true && popSet == true){
        appendCategories(categoryJSON, mostPop);
      }
      break;

    case 'displayPref':
      displayPref = output;

      break;

    case 'entries':
      entryJSON = output;
      appendCards('home', entryJSON);
      break;
  }
}

function appendCategories(json, currentMostPop){

  // Appends mostPop div to #mostPop
  var tmpl = $('#categoryTemplate').clone();
  tmpl.removeAttr('id');
  tmpl.find('h3').html(currentMostPop);
  tmpl.attr('role', 'button');
  tmpl.attr('onclick', 'displayChoice("' + currentMostPop + '")');

  $('#mostPop').append(tmpl);

  for(i = 0; i < json.length; i++){

    // Appends category title to categories array for use in displayChoice
    categories.push(json[i].title);

    // Appends rest of category divs if they don't have the same title as mostPop
    if(json[i].title != mostPop){
      var tmpl = $('#categoryTemplate').clone();
      tmpl.removeAttr('id');
      tmpl.find('h3').html(json[i].title);
      tmpl.attr('role', 'button');
      tmpl.attr('onclick', 'displayChoice("' + json[i].title + '")');

      $('#categoriesContainer').append(tmpl);
    }
  }
}// End function Categories

function appendCards(page, json){

  for(i = 0; i < json.length; i++){

    var tmpl = $('#cardTemplate').clone();
    tmpl.removeAttr('id');

    if(page == 'home'){

      for(j = 0; j < json[i].classes.length; j++){
        tmpl.addClass(json[i].classes[j]);

        tmpl.find('.categories').find('p').html(
          tmpl.find('.categories').find('p').html()+json[i].classes[j]+' '
        );
      }
    }else{
      var value = json[i].title;
      tmpl.find('.deleteEntry').val(value);
    }

    tmpl.find('.title').html(json[i].title);
    tmpl.find('.descPar').html(json[i].content);
    tmpl.find('.contextPar').html(json[i].context);

    $('#cardContainer').append(tmpl);
  }


  // Calls displayChoice to display random category after all cards are appended, unless preference is set to mostPop.
  if(page == 'home'){
    if(displayPref == 'mostPop'){
      displayChoice(mostPop);
    }else{
      displayChoice('rand');
    }
  }

}// End function appendCards


function displayChoice(category){

  // Gets random element from the categories array
  if(category == 'rand'){
    category = categories[Math.floor(Math.random() * categories.length)];
  }

  var entries = $('.entryCard');

  entries.addClass('hide');

  if(category == 'All'){
    entries.removeClass('hide');
  }else{
    $('#cardContainer').find('.'+category).removeClass('hide');
  }

  $('#topOfCards h3').html('Displaying entries for category: '+category);
}// End function displayChoice
