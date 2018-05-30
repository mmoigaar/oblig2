function appendCategories(json){

  for(i = 0; i < json.length; i++){

    var tmpl = $('#categoryTemplate').clone();
    tmpl.removeAttr('id');
    tmpl.find('h3').html(json[i].title);
    tmpl.attr('role', 'button');
    tmpl.attr('onclick', 'displayChoice("' + json[i].title + '")');

    $('#categoriesContainer').append(tmpl);
  }
}// End function Categories

function appendCards(json){
  console.log(json);
  for(i = 0; i < json.length; i++){

    var tmpl = $('#cardTemplate').clone();
    tmpl.removeAttr('id');

    if(typeof(json[i].classes) == 'array'){

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
}// End function appendCards


var entries = $('.entryCard');
function displayChoice(category){

  entries.removeClass('hide');
  entries.addClass('hide');

  if(category == 'showAll'){
    entries.removeClass('hide');
  }else{
    $('#cardContainer').find('.'+category).removeClass('hide');
  }
}// End function displayChoice
