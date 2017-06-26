jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
	var slideCount = $('#slider ul li').length;
    var nr = 0;

    $('#slider ul li').prependTo('#slider ul');

    function moveLeft() {
        $('#slider li').eq(nr-1).show();
        nr = nr - 1;
        if(nr < 0){
            nr=slideCount;
            $('#slider li').hide();
            $('#slider li:last-child').show();
        }
    };

    function moveRight() {        
        $('#slider li').eq(nr).hide();
        nr = nr +1;
        if (nr >= slideCount) {            
            $('#slider li').show();         
            nr = 0;
        }
    };

    $('a.control_prev').click(function () {
       // alert();
        moveLeft();
    });

    $('a.control_next').click(function () {
       // alert();
        moveRight();
    });

});  
