<head>
   
  
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     </head>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Frontend desenvolvido por StartBootstrap e backend em Laravel desenvolvido por Thélesson de Souza">
    <meta name="author" content="Thélesson de Souza - Algoritmo9">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php $titul = \App\Settings::where('key', 'site.title')->first(); ?>
    <?php if(!empty($titul->value)): ?>
    <title><?php echo e($titul->value); ?></title>
    <?php else: ?>
    <title><?php echo e(config('app.name', 'Miniblog')); ?></title>
    <?php endif; ?>

    <!-- Scripts -->
    <!-- Habilitar se der merda <script src="<?php echo e(asset('js/app.js')); ?>" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="<?php echo e(asset('autenticado/frontend/styles/shards-dashboards.1.1.0.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('autenticado/frontend/styles/extras.1.1.0.min.css')); ?>">
    
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css">
    
  <!-- Filepond stylesheet -->
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
  <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
 

<?php echo notifyCss(); ?>
<style>
  .notify-alert{z-index:9999!important;}

.image-area {
  position: relative;
  width: 100%;
  background: #333;
}
.image-area img{
  max-width: 100%;
  height: auto;
}
  .remove-image {
display: none;
position: absolute;
top: -10px;
right: -10px;
border-radius: 10em;
padding: 2px 6px 3px;
text-decoration: none;
font: 700 21px/20px sans-serif;
background: #555;
border: 3px solid #fff;
color: #FFF;
box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
  text-shadow: 0 1px 2px rgba(0,0,0,0.5);
  -webkit-transition: background 0.5s;
  transition: background 0.5s;
}
.remove-image:hover {
 background: #E54E4E;
  padding: 3px 7px 5px;
  top: -11px;
right: -11px;
}
.remove-image:active {
 background: #E54E4E;
  top: -10px;
right: -11px;
}
  </style>
</head>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/head.blade.php ENDPATH**/ ?>