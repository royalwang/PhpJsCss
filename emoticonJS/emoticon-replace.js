<script type="text/javascript">	
$(function(){
	$('.msgemo').each(function(){			
		var msg = $(this).html();
		//alert(msg);			
		$(this).html(emoticons(msg));
	});		
});
</script>

// emoticon.js
var time = new Date();
var x = time.getMillisecond();

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

// alert(["foo", "bar", "baz"].indexOf("bar"));
//alert(MD5("pass"));
//var allmsg = new Array();

function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}

function emoticons(msg){
	var emoticons = {
	    ':-)' : 'smile.gif',
	    ':)'  : 'smile.gif',
	    ':]'  : 'smile.gif',
	    ':}'  : 'smile.gif',
	    ':D'  : 'haha.gif',
	    ':d'  : 'ha.gif',
	    ':P'  : 'pbig.gif',
	    ':p'  : 'p.gif',
	    ':X' : 'milcz.gif',
	    ':x' : 'milcz.gif',
	    ':O' : 'bigsurprise.gif',
	    ':o' : 'bigsurprise.gif',		    
	    ':hug'  : 'hug.gif',
	    ':crazy'  : 'crazy.gif',
	    ':spacer'  : 'spacer.gif',
	    ':bigdog'  : 'dog.gif',
	    ':cutedog'  : 'cutedog.gif',
	    ':angrydog'  : 'angrydog.gif',
	    ':hoho'  : 'hoho.gif',
	    ':bighi'  : 'big.gif',
	    ':haha'  : '1hoho.gif',
	    ':lick' : 'lick.gif',
	    ':santa' : 'santa.gif',
	    ':target' : 'target.gif',
	    ':stupid' : 'stupid.gif',
	    ':finger' : 'finger.gif',
	    ':sprint' : 'sprint.gif',
	    ':hura'  : 'hura.gif',
	    ':hehe'  : 'hehe.gif',
	    ':boo'  : 'boo.gif',
	    ':rain'  : 'rain.gif',
	    ':happy'  : 'happy.gif',
	    ':1happy'  : 'happy1.gif',
	    ':love'  : 'love.gif',
	    ':1love'  : 'love1.gif',
	    ':roll'  : 'roll.gif',
	    ':1roll' : 'roll1.gif',
	    ':1dance'  : 'dance.gif',
	    ':scared'  : 'scared.gif',
	    ':angry' : 'angry.gif',
	    ':1angry' : 'angry1.gif',
	    ':faint' : 'faint.gif',
	    ':jezor' : 'jezor.gif',
	    ':music' : 'music.gif',
	    ':brum' : 'drum.gif',
	    ':grzyb' : 'grzyb.gif',
	    ':fuck' : 'fuck.gif',
	    ':hop' : 'hop.gif',
	    ':woo' : 'woohoo.gif',		    
	    ':ave' : 'ave.gif',
	    ':1poke' : '1poke.gif',
	    ':kiss' : 'kiss.gif',
	    ':jupi' : 'jupi.gif',
	    ':hi' : 'hi.gif',
	    ':angel' : 'angel.gif',
	    ':tany' : 'tany.gif',
	    ':flowers' : 'flowers.gif',
	    ':gift' : 'gift.gif',
	    ':hello' : 'hello.gif',
	    ':1hello' : '1hello.gif',
	    ':tomato' : 'pomidor.gif',
	    ':ciao' : 'ciao.gif',
	    ':9nono' : 'nono.gif',
	    ':noway' : 'noway.gif',
	    ':sayno' : 'sayno.gif',
	    ':sorry' : 'sorry.gif',
	    ':byebye' : 'byby.gif',
	    ':saybye' : 'saybye.gif',
	    ':pissing' : 'pissing.gif',
	    ':ecstasy' : 'ecstasy.gif',
	    ':you' : 'you.gif',
	    ':bomb' : 'bomb.gif',
	    ':lol' : 'panda.gif',
	    ':evil' : 'evil.gif',
	    ':green' : 'green.gif',
	    ':alien' : 'alien.gif',
	    ':flagpl' : 'flagpl.gif',
	    ':goal' : 'goal.gif',
	    ':football' : 'football.gif',
	    ':win' : 'win.gif',
	    ':boxing' : 'boxing.gif',
	    ':1boxing' : '1boxing.gif',
	    ':clown' : 'clown.gif',
	    ':cool' : 'cool.gif',
	    ':beer' : 'beer.gif',
	    ':hot' : 'hot.gif',
	    ':kawa' : 'hot.gif',
	    ':cheers' : 'cheers.gif',
	    ':macho' : 'macho.gif',
	    ':cat' : 'cat.gif',
	    ':cold' : 'cold.gif',
	    ':coffe' : 'coffe.gif',
	    ':butla' : 'butla.png',
	    ':heniek' : 'heniek.png',
	    ':shocked' : 'shocked.gif',
	    ':sayoh' : 'sayoh.gif',
	    ':cwiety' : 'cwiety.gif',
	    ':mask' : 'mask.gif',
	    ':shoq' : 'bigsurprise.gif',		    
	    ':soda' : 'soda.png',
	  }
	for ( smile in emoticons )
	{			
		// https://qflash-fxstar.rhcloud.com
		var surl = "http://"+window.location.host+"/emoticons/";
		// surl = "https://qflash-fxstar.rhcloud.com/emoticons/";
	   	// msg = msg.replace(smile, '<img src="' + surl + emoticons[smile] + '" />');
	    if (ImageExist(surl + emoticons[smile])) {
	   		msg = msg.split(smile).join('<img class="emo" src="' + surl + emoticons[smile] + '" />');		   		
		}
	}		
	return msg;
}

// preload images
function preload() {
	for (i = 0; i < preload.arguments.length; i++) {
		images[i] = new Image();
		images[i].src = "https://qflash-fxstar.rhcloud.com/emoticons/"+preload.arguments[i]
	}
}

preload(emoticons);

function is_cached(src) {
    var image = new Image();
    image.src = src;

    return image.complete;
}

function parseURL($string){
	var __urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	var __imgRegex = /\.(?:jpe?g|gif|png)$/i;
    var exp = __urlRegex;
    return $string.replace(exp,function(match){
            __imgRegex.lastIndex=0;
            if(__imgRegex.test(match)){
                return '<img src="'+match+'" class="thumb" />';
            }
            else{
                return '<a href="'+match+'" target="_blank">'+match+'</a>';
            }
        }
    );
}

function parseYoutubeUriImgToTag($string){
	var __imgRegex = /\.(?:jpe?g|gif|png)$/i;
	var __YouRegex = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
	var __urlRegexHttp = /(\b(http|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	var __urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	var exp = __urlRegex;
	return $string.replace(exp,function(url){ 
		__imgRegex.lastIndex=0;
   		// youtube
		if(__YouRegex.test(url)){			
			if (url.indexOf('embed') < 0) {
			    var u = url.match(__YouRegex);
			    if (u && u[2].length == 11) {			    	
			        return '<iframe width="300" height="166" src="//www.youtube.com/embed/' + u[2]+ '" frameborder="0" allowfullscreen></iframe>';
			    } else {
			        return url;
			    }
			}
        }
        if(__urlRegexHttp.test(url)){
        	return '<a href="'+url+'" target="_blank" class="links external">'+url+'</a>'; 
        }else if(__imgRegex.test(url)){
            return '<img src="'+url+'" class="links external" />';
        }else{
			return '<a href="'+url+'" target="_blank" class="links external">'+url+'</a>'; 
		}
	});
}
