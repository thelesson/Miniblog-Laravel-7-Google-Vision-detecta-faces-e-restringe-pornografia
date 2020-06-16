<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
@include('partials.head')
    <body>
    @include('partials.menuprincipal')
    @include('partials.header-posts')
    @include('partials.conteudo-posts')
    <div id="disqus_thread" style="width:100%;padding-left:10%;padding-right:10%;"></div>
   @include('partials.footer')
   @if(!empty($disqus->value))
    <script>
 var disqus = {!! json_encode($disqus->value) !!};
 console.log(disqus);
/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://'+disqus+'.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>

<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
    
    <script id="dsq-count-scr" src="//"+disqus+".disqus.com/count.js" async></script> 
    <script>
    (function() {
   // your page initialization code here
   // the DOM will be available here
   document.addEventListener("DOMContentLoaded", function() {
      
	var button = document.getElementById("btnstar");
	button.addEventListener("click", function(e) {
        var id = JSON.parse("{{ json_encode($post->id) }}");
        var className = $(this).attr('class');
        console.log(className);
        if(className ==='liked'){
            var pegaRota ='/seguro/desfavorita/';
        }else{
            var pegaRota ='/seguro/favorito/';
        }
        
		button.classList.toggle("liked");
        var montaUrl = pegaRota+id;
        console.log(id);
        console.log(montaUrl);
        $.ajax({
        type: 'post',
        url: montaUrl,
        data: {
           
            "_token": $('#token').val()
        },
        success: function () {
           console.log("sucesso");
        },
        error: function (XMLHttpRequest) {
            // handle error
        }
    });
	});
});
})();
 

    </script>
    @endif
    </body>
</html>
