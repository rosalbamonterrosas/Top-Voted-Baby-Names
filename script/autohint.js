// Using jQuery autocomplete widget

$('document').ready(function() {
            $( "#nameDescription" ).autocomplete({
              source: 'autohint.php'
            });
            $( "#nameDescription" ).on("keyup", function() {  // Hide any previous success message
              $('.alert-success').hide();
            });  
  
});     