$(document).ready(function(){
  getCategories();
});

function getCategories(){
  // Posts 'getCategories' to the index controller
  $.ajax({
    url: 'controller/controller.php',
    data: {action: 'getCategories'},
    type: 'post',
    success: function(output){
      // Callback function stores global var
      callback('categories', JSON.parse(output));
      // Makes next ajax call once something is returned from current call
      getMostPop();
    }
  });
}
function getMostPop(){
  // Posts 'mostPop' to the index controller
  $.ajax({
    url: 'controller/controller.php',
    data: {action: 'mostPop'},
    type: 'post',
    success: function(output){
      // Callback function stores global var
      console.log(output);
      callback('mostPop', output);
      // Makes next ajax call once something is returned from current call
      checkDisplayPref();
    }
  });
}
function checkDisplayPref(){
  // Posts 'checkDisplayPref' to the index controller
  $.ajax({
    url: 'controller/controller.php',
    data: {action: 'checkDisplayPref'},
    type: 'post',
    success: function(output){
      // Callback function stores global var
      callback('displayPref', output);
      // Makes next ajax call once something is returned from current call
      getEntries();
    }
  });
}
function getEntries(){
  // Posts 'getEntries' to the index controller
  $.ajax({
    url: 'controller/controller.php',
    data: {action: 'getEntries'},
    type: 'post',
    success: function(output){
      // Callback function stores global var
      callback('entries', JSON.parse(output));
    }
  });
}

// Callback values stored as global vars
var categoryJSON;
var mostPop;
var entryJSON;
var displayPref;

// Stores callback values as global vars
function callback(source, output){

  switch(source){
    case 'categories':
      categoryJSON = output;
      break;
    case 'mostPop':
      mostPop = output;
      appendCategories(categoryJSON, mostPop);
      break;

    case 'displayPref':
      displayPref = output;
      console.log(displayPref);
      break;

    case 'entries':
      entryJSON = output;
      appendCards('home', entryJSON);
      break;
  }
}

var categories = [];
function appendCategories(json, currentMostPop){

  if(currentMostPop != 'none'){

    // Shows #mostPop wrapper and appends whichever category has the most entries this week
    $('#mostPop').removeClass('hide');
    var tmpl = $('#categoryTemplate').clone();
    tmpl.removeAttr('id');
    tmpl.find('h3').html(currentMostPop);
    tmpl.attr('role', 'button');

    tmpl.attr('onclick', 'displayCat("' + currentMostPop + '"), setDisplayPref("mostPop")');

    $('#mostPop').append(tmpl);
  }

  for(i = 0; i < json.length; i++){

    // Appends category title to categories array for use in displayCat
    categories.push(json[i].title);

    // Appends rest of category divs if they don't have the same title as mostPop
    if(json[i].title != mostPop){
      var tmpl = $('#categoryTemplate').clone();
      tmpl.removeAttr('id');
      tmpl.find('h3').html(json[i].title);
      tmpl.attr('role', 'button');
      tmpl.attr('onclick', 'displayCat("' + json[i].title + '")');

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


  // Calls displayCat to display random category after all cards are appended, unless preference is set to mostPop.
  if(page == 'home'){
    if(displayPref == 'mostPop' && mostPop != 'none'){
      displayCat(mostPop);
    }else{
      displayCat('rand');
    }
  }
}// End function appendCards

function setDisplayPref(choice){
  $.ajax({
    url: 'controller/controller.php',
    data: {
      action: 'setDisplayPref',
      pref: choice
    },
    type: 'post',
    success: function(output){
      console.log(output);
    }
  });

}

function displayCat(category){

  if(category == 'rand'){
    // Gets random element from the categories array
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


}// End function displayCat
