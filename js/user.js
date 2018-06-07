$(document).ready(function(){
  getOwnEntries();
});

function getOwnEntries(){

  // Posts 'getEntries' to controller
  $.ajax({
    url: 'controller/controller.php',
    data: {action: 'getOwnEntries'},
    type: 'post',
    success: function(output){
      appendCards('user', JSON.parse(output));
    }
  });

}

function deleteEntry(entry){

  // Posts 'deleteEntry' to controller
  $.ajax({
    url: 'controller/controller.php',
    data: {
      action: 'deleteEntry',
      del: entry // specific entry for deletion
    },
    type: 'post',
    success: function(output){
      // Updates page with the remaining entries
      appendCards('user', JSON.parse(output));
    }
  });

}
