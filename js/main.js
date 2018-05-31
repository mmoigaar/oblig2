
var categories = [];

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

function appendCards(json){

  for(i = 0; i < json.length; i++){

    var tmpl = $('#cardTemplate').clone();
    tmpl.removeAttr('id');

    if(typeof(json[i].classes).isArray){

      for(j = 0; j < json[i].classes.length; j++){
        console.log(json[i].classes[j]);
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
  if(pref == 'mostPop'){
    displayChoice(mostPop);
  }else{
    displayChoice('rand');
  }
}// End function appendCards


function displayChoice(category){

  // Gets random element from the categories array
  if(category == 'rand'){
    category = categories[Math.floor(Math.random() * categories.length)];
  }

  //There should also be some text above cards which shows which category is being displayed. "Showing entries for "+category

  var entries = $('.entryCard');

  entries.addClass('hide');

  if(category == 'showAll'){
    entries.removeClass('hide');
  }else{
    $('#cardContainer').find('.'+category).removeClass('hide');
  }
}// End function displayChoice
