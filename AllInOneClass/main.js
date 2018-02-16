$(document).ready(function() {

  // Dodaj ogloszenie walidacja pól
  $('#newitemform').submit(function(e){       
    var allow = 1;
    $('.need').each(function(){
      if($(this).val() == ""){
        allow = 0;
        $(this).css("border", "1px solid #f20");
        // scroll to top
        $('html, body').animate({scrollTop : 150},800);
        e.preventDefault();
      }      
    });    
  });

  // show question comment form  
  $('.setaddress').click(function(){
    $(this).hide();
    $(".hideaddress").show();
  });
  // upload file
  $('.file').click(function(){
    $(this).hide();
    $(".dealerfile").show();
  });
  // upload item foto
  $('.file1').click(function(){ 
    $(".fotofile").trigger('click');
  });

  $('.aliasinfo').click(function(){    
    $("#aliasinfo").show();
  });

  $('.close').click(function(){    
    $("#aliasinfo").hide();
  });

  $('.showphone').click(function(){
    $(this).children("span").hide();
    $(this).children("b").show();    
  });

  $('.addimg').click(function(){ 
    $('#imgupload').trigger('click');     
    $('input[type="file"]').change(function(){
      var file = document.forms['form']['file'].files[0];
      $('.addimg').html(file.name);
    });        
  });
     
  $('body').on('click', '.delpost', function(){  
    var pid = $(this).data('pid');
    var ti = $(this).parent().parent();
    // questionid, commentuserid
    $.post( "/ajax-delpost.php", {pid: pid}, function( data ) {      
        if(data > 0){
          ti.hide();
        }      
    });
  });

  // delete uploaded images
  $('body').on('click', '.deletefoto', function(){  
    var file = $(this).data('file');
    var ti = $(this).parent();
    // questionid, commentuserid
    $.post( "/ajax-deletefoto.php", {filename: file}, function( data ) {      
        if(data > 0){
          ti.hide();
        }      
    });
  });

  // load uploaded images
  $.post( "/upload-folder.php", { cid: 1 }, function( data ) {         
    $("#itemfoto").html(data);
  });
  // Zmien markę pojazdu
  $('.changemarka').change(function(){    
    var cid = $(this).val();     
    $.post( "/ajax-changecategory.php", { cid: cid }, function( data ) {         
      $(".model").html(data);
      $(".model").trigger("chosen:updated");
    });
  });

  // load more user posts
  $('body').on('click', '#loadmoreposts', function(){    
    var offset = $(this).data('offset');    
    var ile = $(this).data('ile');
    var uid = $(this).data('uid');
    var ti = $("#allpost"); 
    var btn = $(this);    
    $.post( "/ajax-loadmoreposts.php", {uid: uid, offset: offset, ile: ile}, function( data ) {
      if(data == 0){
        btn.html("Nie ma więcej postów!");
      }else{   
        btn.data("offset", offset+ile);
        ti.append(data);
      }
    });
  });

  $( "#username" ).keyup(function() {
      var user = $(this).val();
      $.post( "/ajax-userexists.php", { user: user }, function( data ) {
      if(data == 1){
        $("#username").css("border", "1px solid #f20");
        $("#username").css("color", "#f20");                    
      }else{
        $("#username").css("border", "1px solid #5c5");
        $("#username").css("color", "#5c5");
      }
    });       
  });

  // Validate email
  $( ".validateemail" ).keyup(function() {
      var email = $(this).val();      
      var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,10}$/i;
      if (testEmail.test(email)){
        // Pass
        $(this).css("border", "1px solid #5c5");
        $(this).css("color", "#5c5");
      }else{
        // Do whatever if it fails.      
        $(this).css("border", "1px solid #f20");
        $(this).css("color", "#f20");
      }
  }); 

  // Validate email
  $( ".validatepass" ).keyup(function() {
      var email = $(this).val();            
      if (email.length >= 8){
        // Pass
        $(this).css("border", "1px solid #5c5");
        $(this).css("color", "#5c5");
      }else{
        // Do whatever if it fails.      
        $(this).css("border", "1px solid #f20");
        $(this).css("color", "#000");
      }
  }); 

  $( ".validatemobile" ).keyup(function() {
      var f = $(this).val();            
      var reg = new RegExp('^[+]{0,1}([0-9])+$');
      if (reg.test(f)){
        // Pass
        $(this).css("border", "1px solid #5c5");
        $(this).css("color", "#5c5");
      }else{
        // Do whatever if it fails.      
        $(this).css("border", "1px solid #f20");
        $(this).css("color", "#000");
      }
  }); 

  $( ".validatenumber" ).keyup(function() {
      var f = $(this).val();            
      var reg = new RegExp('^([0-9])+$');
      if (reg.test(f)){
        // Pass
        $(this).css("border", "1px solid #5c5");
        $(this).css("color", "#5c5");
      }else{
        // Do whatever if it fails.      
        $(this).css("border", "1px solid #f20");
        $(this).css("color", "#000");
      }
  });

  // Demo
  // $( ".ads-300-250" ).load('/ajax-ads.php');
  $( ".ads-300-250" ).each(function(){    
    var size = $(this).data('size');    
    if(size < 1){ size = 1; }
    var ti = $(this);    
    $.post( "/ajax-ads.php", { size: size }, function(data){
      ti.html(data);
    });
  });
  

  $(".clike").bind('click', function(){
    var qid = $(this).data('like');
    var cuid = $(this).data('userid');   
    var ti = $(this);
    // questionid, commentuserid
    $.post( "/ajax-comment.php", { qid: qid, cuid: cuid }, function( data ) {      
      ti.html('<i class="fa fa-chevron-up"></i> ' + data);      
    });
    /*
    $.ajax({
      method: "POST",
      url: "/ajax-comment.php",
      data: { qid: qid, xx: "text" }
    }).done(function( msg ) {
      alert( "Data Saved: " + msg );
    });
    */
  });  

  $(".like").bind('click', function(){
    var qid = $(this).data('like'); 
    var cuid = $(this).data('userid');   
    var ti = $(this).parent().children('.allpoints');
    $.post( "/ajax-question-like.php", { qid: qid, cuid: cuid }, function( points ) {   
      if(points != 0){   
        ti.html(points);
      }
    });
  });

  $(".unlike").bind('click', function(){
    var qid = $(this).data('like');
    var cuid = $(this).data('userid');   
    var ti = $(this).parent().children('.allpoints');
    $.post( "/ajax-question-unlike.php", { qid: qid, cuid: cuid }, function( points ) {
      if(points != 0){        
        ti.html(points);
      }
    });
  });

  // Select correct answer
  $(".check-answer").on('click', function(e){
    e.stopPropagation();
    var qid = $(this).data('qid'); 
    var aid = $(this).data('aid'); 
    $('i').removeClass('check-answer-checked');
    $(this).children('i').toggleClass('check-answer-checked');    
    $.post( "/ajax-question-answered.php", { qid: qid, aid: aid }, function( data ) {
      if(data == 0){alert("Coś nie tak!");}      
    });
  });

  $(".show-answer-form").bind('click', function(){
    $(this).hide();    
    $('.add-answer-form').show();
    $.post( "/ajax-question-unlike.php", { qid: qid }, function( points ) {
      ti.html(points);      
    });
  });

  $(".edit-answer").bind('click', function(){     
    var qid = $(this).data('qid'); 
    var ti = $(this).parent().parent().parent().children(".editanswer-form");
    ti.show();
    $.post( "/ajax-question-edit.php", { qid: qid }, function( html ) {
      //alert(html);
      ti.children("form").children(".html").text(html);      
    });
  });

	$(".notify").hover(function(){
		$(this).children("#shownotify").show();
	},function(){
		$("#shownotify").hide();
	});

  // show question comment form  
  $('.show-comment-form').click(function(){    
    $(this).parent().parent().children('.comment-form').show();
    $(this).hide();
  });

  // show question comment form  
  $('.show-link').click(function(){    
    $(this).children('span').show();
  });
  
  $('body').on('click', '.userchange', function(){
    var uname = $(this).data('user');
    var fid = $(this).data('userid');   
    $("#sendto").val(uname);
    $("#recipient").val(fid);   
    $("*").removeClass("activeuser");
    $(this).addClass("activeuser");
    $.post( "ajax-messages.php", { fid: fid }, function( data ) {  
      //alert(data);  
      $("body #messages").html(data+'<a class="loadmore" data-fid="'+fid+'">Pokaż wszystkie</a>');
    });
  });

  $('body').on('click', '.loadmore', function(){
    var fid = $(this).data('fid');    
    $.post( "ajax-messages.php", { fid: fid, loadall: 1}, function( data ) {  
      //alert(data);  
      $("body #messages").html(data);
    });
  });

  // Delete contact
  $('body').on('click', '.deletecontact', function(e){
    e.stopPropagation();    
    var fid = $(this).data('userid');
    var it = $("#msgcontacts");
    $.post( "ajax-deletecontact.php", { fid: fid }, function( data ) {  
      //alert(data);  
      it.html(data);      
    });
  });

  // delete job answer
  $('body').on('click', '.deljobanswer', function(e){
    e.stopPropagation();    
    var aid = $(this).data('id');  
    var it = $(this).parent().parent();
    $.post( "/ajax-deletejobanswer.php", { aid: aid }, function( data ) {  
      it.hide();
    });
  });

  $('body').on('click', '.job-activ', function(e){
    e.stopPropagation();        
    var id = $(this).data('id');
    var it = $(this).parent().parent();
    $.post( "/ajax-activjob.php", { id: id }, function( data ) {  
      location.reload();
    });
  });

  // Zatwierdzenie odpowiedzi do oferty
  $('body').on('click', '.okjobanswer', function(e){
    e.stopPropagation();    
    var aid = $(this).data('id');
    var jid = $(this).data('jid');  
    var it = $(this).parent().parent();
    $.post( "/ajax-deletejobanswer.php", { aid: aid, jid: jid }, function( data ) { 
      $(".answer").css("border-left", "1px solid #eee");
      it.css("border-left", "3px solid #55cc55");
    });
  });

  $('#searchuser').click(function(){
      $("#searchuser-form").show();      
      $(".searchtxt-form").hide();
  });

  $('.searchtxt').click(function(){
      $(".searchtxt-form").show();
      $("#searchuser-form").hide();
  });

  $('.showtxt').click(function(){
      $(".searchtxt-form").show();      
  });  
  
  // Add contact for user
  $('body').on('click', '.addcontact', function(){ 
    var uid = $(this).data('uid');
    var it = $("#msgcontacts");
    $.post( "ajax-getmessagesusers.php", { uid: uid }, function( data ) {      
      it.html(data);
    });
  });

  $('body').on('click', function(){
    $("#userstip").hide();
  });

  // Search users messages contacts
  $( "#searchusername" ).keyup(function() {
      var u = $(this).val();      
      $("#userstip").css("display","inherit");
      var it = $("#userstip");      
      $.post( "ajax-contacts.php", { user: u }, function( data ) {        
        it.html(data);
      });       
  }); 

  // Search user
  $( ".searchusername" ).keyup(function() {
      var u = $(this).val();      
      $("#userstip").css("display","inherit");
      var it = $("#userstip");      
      $.post( "ajax-searchusers.php", { user: u }, function( data ) {        
        it.html(data);
      });       
  }); 

  $('.close').click(function(e){
    $(this).parent().hide();
  });
  $('.msg').click(function(e){
    $("#sendmsgform").show();
  });
  $('#sendmsg').click(function(e){
    e.preventDefault();  
    var tid = $("#msgemail").data('tid');    
    var email = $("#msgemail").val();  
    var phone = $("#msgmobile").val();  
    var msg = $("#msgtext").val();      
    if(msg.length > 1){
      // msg = "[Dotyczy produktu ID-"+pid+"] " + msg;
      $.post( "/ajax-sendmessage.php", { tid: tid, email: email, phone: phone, msg: msg }, function( data ) {    
        if(data > 0){
          var h = '<span class="error"> Wiadomość została wysłana!</span>';          
          $("#error").html(h);
          $("#msgemail").val("");  
          $("#msgmobile").val("");  
          $("#msgtext").val(""); 
        }
        if(data == -1){
          var h = '<span class="error"> Wiadomość jest już wysłana!!!</span>';
          $("#error").html(h);
        }
        if(data == -2){
          var h = '<span class="error"> Uzupełnij wszystkie pola formularza! Podaj poprawny adres e-mail lub numer telefonu.</span>';
          $("#error").html(h);
        }        
        if(data == 0){
          var h = '<span class="error"> Coś poszło nie tak. Spróbuj później!</span>';
          $("#error").html(h);
        }
      });
    }else{
      var h = '<span class="error"> Podaj adres e-mail lub numer telefonu. Wiadomość minimum 2 znaki!</span>';
      $("#error").html(h);
    }
  });

  $('#sendmessage').click(function(e){
    e.preventDefault();
    var id = $("#userid").val();
    var uid = $("#username").val();
    var tid = $("#recipient").val();  
    var msg = $("#msg").val();     
    if(msg.length > 1 && tid > 0){
      $.post( "ajax-sendmessage.php", { tid: tid, msg: msg }, function( data ) {        
        var dat = new Date().toISOString().slice(0, 19).replace('T', ' ');;
        msg = urlify(msg);
        msg = msg.replace(/(?:\r\n|\r|\n)/g, '<br>');
        ht = "<div class=\"tid\"> <div class=\"tuser\"> <div class=\"tuser-small\"> <img src=\"media/avatar/"+id+".jpg\"> <span>"+uid+"</span> </div> </div> <div class=\"tmsg\"> "+msg+" </div><div class=\"ttime\"> <i class=\"fa fa-trash\" title=\"Usuń wiadomość\"></i> "+dat+" </div></div>";
        if(data > 0){
          var xx = $("#messages").html();          
          $("#messages").html(ht + xx);  
          $("#msg").val("");
        }
        if(data == -1){
          var h = '<span class="error"> Wiadomosć jest już wysłana!!!</span>';
          $("#msgform").html(h);
        }
        if(data == 0){
          var h = '<span class="error"> Coś poszło nie tak. Spróbuj później!</span>';
          $("#msgform").html(h);
        }
      });
    }else{
      var h = '<span class="error"> Wiadomość minimum 2 znaki!</span>';
      $("#msgform").html(h);
    }
  });

  $('body').on('click', '.deletemsg', function(){ 
    var mid = $(this).data('delid');    
    var it = $(this).parent().parent();
    $.post( "ajax-messages-delete.php", { mid: mid }, function( data ) {  
      if(data == 1){
        it.hide();
      }            
    });
  });

	$('code').each(function(i, block) {
    	hljs.highlightBlock(block);
  	});

});

$( window ).resize(function() {    
  // get iframe with id
  var frame = $('#xframe');
  // get iframe parent div width
  var parentWidth = frame.parent().width();   
  // resize iframe
  $('#xframe').css({'width':parentWidth + 'px'});       
  // get iframe document
  var frameDocument = $("#xframe", top.document);
  // get iframe html
  var frameHtml = frameDocument.contents().find("html").html();  
  // resize iframe height to inside content height
  var frameContentHeight = frameDocument.contents().height();
  // set frame height  
  $('#xframe').css({'height':frameContentHeight + 'px'}); 
  // change iframe content
  // var frameHtml = frameDocument.contents().find("html").html("<h1>New HTML</h1>");   

  // resize left sidebar
  // var wi = $('#xframe').height();  
  $('#job-html').css("border","1px solid #f23");
  $('#job-html').height(frameContentHeight+20); 
});

// Decimal price validation
function checkDec(el){
 // var ex = /^[0-9]+\.?[0-9]*$/;
 // var ex = /^\d+(?:\.\d{1,2})?$/ 
 var ex = /^\d*\.?\d{0,2}$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}

function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function(url) {
        if(url.includes(".jpg") || url.includes(".jepg") || url.includes(".bmp") || url.includes(".png") || url.includes(".ico")){
           return '<a href="' + url + '"> <img src="' + url + '"> </a>';
        }else{
          return '<a href="' + url + '">' + url + '</a>';
        }
    })
    // or alternatively
    // return text.replace(urlRegex, '<a href="$1">$1</a>')
}


function resizeIframe(obj) {
  obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
  // resize side bar
  var wi = $('.main').height();
  $('.left').height(wi);

  // iframe.src = 'data:text/html;charset=utf-8,' + encodeURI(html);
}

$("#xframe").load(function() {
  $(this).height( $(this).contents().find("html").height() );
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

/*
<script type="text/javascript">
  $(document).ready(function() {
    window.addEventListener("beforeunload", function (e) {
      var confirmationMessage = "\o/---";
      (e || window.event).returnValue = confirmationMessage; //Gecko + IE
      return confirmationMessage;                            //Webkit, Safari, Chrome
    });
  });
</script>
*/

/* Scroll to top

$(document).ready(function(){
	
	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
});

*/
