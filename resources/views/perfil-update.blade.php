<!DOCTYPE html>
<html class="no-js h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
@include('partials.autenticado.head')
    <body class="h-100">
    <div class="container-fluid">
      <div class="row">
      
      @if (auth()->check())
                       
   @include('partials.autenticado.sidebar')
      <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
      @include('partials.autenticado.navbar')
      <div class="main-content-container container-fluid px-4">
      @include('partials.autenticado.header')
     
      @include('partials.autenticado.perfil-update')
    
      </div>
      @include('partials.autenticado.footer')
      </main>
   @else
   @include('partials.autenticado.errors.erropermissao')
   @endif
  
  
      </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="{{ asset('autenticado/frontend/scripts/extras.1.1.0.min.js') }}"></script>
    <script src="{{ asset('autenticado/frontend/scripts/shards-dashboards.1.1.0.min.js') }}"></script>
    <!-- <script src="{{ asset('autenticado/frontend/scripts/app/app-blog-overview.1.1.0.js') }}"></script>
    --> 
    
     
     @include('notify::messages')
       
     <!-- Load FilePond library -->
     <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
     <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

  <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
  

<!-- Turn all file input elements into ponds -->
<script>
//FilePond.parse(document.body);
FilePond.setOptions({
  labelIdle: 'Arraste e Solte sua imagem de capa ou <span class="filepond--label-action"> Browse </span>'

});
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.setOptions({
                server: {
                   
                    process: {
                 url: '/upload-temp-avatar',
                 revert:null,
                 method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                   
                  }
                
            });
            
          //  const inputElement = document.querySelector('input[type="file"]');
          //  const pond = FilePond.create( inputElement );
         const pond =   FilePond.create(document.querySelector('input[type="file"]'), {
    acceptedFileTypes: ['image/png', 'image/jpeg']
});
pond.on('error',  (file, status) => {
    console.log('File added');

   if (file.code >= 500) {
          pond.addFile('storage/app/public/tempupload/negado.jpg');
       
          $('#sensivel').trigger('click');
         
          $('#removidoOunao').val(1);
       
   
    }
    
  //  console.log('File added', file);
  
});


//const pond = document.querySelector('.filepond--root');

</script>
     <script>

$(document).ready(function () {
 
//funcao trick
$('#fePassword').on('keyup', function(ev){
 // stuff happens
 var tk = $('#fePassword').val();
 $('#tk').val(1);
 if( !$(this).val() ) {
      $('#tk').val(0);

    }
});

$('#fePassword').blur(function()
{
 
  
    if( !$(this).val() ) {
      $('#tk').val(0);

    }
});

//end

 //funcao abrir senha antiga

//end
 //$('.bloco-old-p').toggle(200);
    $("#fePassword").on("click", function () {
        $("#bloco-old-p").show();
        
    });
    $("#feEmailAddress").on("click", function () {
        $("#bloco-old-p").show();
    });
    //end
    //funcao para exibir card de upload de capa
    $('#btnDelimg').click(function() {
      $('#removidoOunao').val(1);
      $('#card-salvado-img').hide();
      $('#cardUpload').show();
    });
 //end
  //funcao para exibir card de upload de capa
  $('#btnDelimg').click(function() {
    $('#removidoOunao').val(1);
    $('#card-salvado-img').hide();
    $('#cardUpload').show();
  });

function usuarioCancelou() {
          $.ajax({
             type:'POST',
             url:'/uploadcancelado',
             headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
             data:'_token = <?php echo csrf_token() ?>',
             success:function(data) {
              $('#removidoOunao').val(data.valor);
              console.log("hackerman");
             }
          });
       }


pond.on('beforeRemoveFile',  (item) => {
  console.log(item);

usuarioCancelou();
//  console.log('File added', file);

});
const pondx = document.querySelector('.filepond--root');
pondx.addEventListener('FilePond:processfilerevert', e => {
  
  usuarioCancelou();
});

$('#image').click(function() { 
$('#removidoOunao').val(0);
});

$('#image').on(
  'drop',
  function(e){
      if(e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
          e.preventDefault();
          e.stopPropagation();
          $('#removidoOunao').val(0);
      }
  }
);
  function convertToSlug(Text)
{
  return Text
      .toLowerCase()
      .replace(/ /g,'-')
      .replace(/[^\w-]+/g,'')
      ;
}
$('#tituloui').blur(function() {

var slug =  $('#tituloui').val();
var slugTop = convertToSlug(slug);
$('#hiddenSlug').val(slugTop);//seta no input hidden o valor digitado no input titulo
$('#textoSlug').text(slugTop);//set no span card-acoes o valor digitado no input titulo
$('#slugp').val(slugTop);//set no modal alterar-slug o valor digitado no input titulo
//console.log(slugTop);
});

$('#salvaSlugp').click(function() {
//funcao para setar no span card-acoes e no input hidden o valor digitao  no modal alterar-stslugatus
var slug =  $('#slugp').val();
var slugTop = convertToSlug(slug);
$('#textoSlug').text(slugTop);
$('#hiddenSlug').val(slugTop);//seta no input hidden
$('#slugp').val(slugTop);
console.log(slugTop);
//$('slugp').addClass('warning');
if(slug ===""){

$('#span-erro').show();
}else{
  $('#span-erro').hide();
  $('#modalSlug').trigger('click');
}



});
//alterar text status pelo select 
$('#btn-status').click(function() {
var valor =  $('select[name=select-status] option').filter(':selected').val();
var  texto = $('select[name=select-status] option').filter(':selected').text();
$('#hiddenStatus').val(valor);
$('#status-publicacao').text(texto);
$('#modalStatus').trigger('click');
});
//alterar text visibilidade pelo select 
$('#btn-visibilidade').click(function() {
var valorV =  $('select[name=select-visibilidade] option').filter(':selected').val();
var  textoV = $('select[name=select-visibilidade] option').filter(':selected').text();
$('#hiddenVisibilidade').val(valorV);
if(valorV ==="logado"){
  $("#txt-visibilidade").attr('class', 'text-warning');
  textoV = "Membros";
}else{

$("#txt-visibilidade").attr('class', 'text-success');
}
 
$('#txt-visibilidade').text(textoV);
$('#modalVisibilidade').trigger('click');
});

//conteudo restrito
$('#btn-restritox').click(function() {
console.log("ssaa");
var  valorR = $('select[name=select-restrito] option').filter(':selected').val();
var  textoR = $('select[name=select-restrito] option').filter(':selected').text();
$('#hiddenRestrito').val(valorR);
if(valorR ==="nudez"){
  //$("#txt-visibilidade").attr('class', 'text-warning');
  textoR = "Nudez";
}
if(valorR ==="violencia"){
  textoR = "Violência";
//$("#txt-visibilidade").attr('class', 'text-success');
}
if(valorR ==="nudez-violencia"){
  textoR = "Nudez ou Violência";
}
 
$('#txt-restrito').text(textoR);
$('#modalRestrito').trigger('click');
});

});
</script>

@notifyJs

    </body>
</html>
