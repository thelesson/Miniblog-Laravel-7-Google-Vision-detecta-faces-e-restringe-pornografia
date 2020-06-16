<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    
<?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body>
    <?php echo $__env->make('partials.menuprincipal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.header-posts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.conteudo-posts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="disqus_thread" style="width:100%;padding-left:10%;padding-right:10%;"></div>
   <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php if(!empty($disqus->value)): ?>
    <script>
 var disqus = <?php echo json_encode($disqus->value); ?>;
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
        var id = JSON.parse("<?php echo e(json_encode($post->id)); ?>");
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
    <?php endif; ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/posts.blade.php ENDPATH**/ ?>