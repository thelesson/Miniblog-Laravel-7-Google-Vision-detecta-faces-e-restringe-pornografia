<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Frontend desenvolvido por StartBootstrap e backend em Laravel desenvolvido por Thélesson de Souza">
    <meta name="author" content="Thélesson de Souza - Algoritmo9">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $titul = \App\Settings::where('key', 'site.title')->first(); @endphp
    @if(!empty($titul->value))
    <title>{{$titul->value}}</title>
    @else
    <title>{{ config('app.name', 'Miniblog') }}</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
   #btnstar {
	 display: flex;
	 justify-content: center;
	 align-items: center;
	 width: 45px;
	 height: 45px;
	 border-radius: 50%;
	 background: none;
	 border-style: initial;
	 border: 1px solid rgba(0, 0, 0, 0.15);
	 color: #ff3d60;
	 cursor: pointer;
	 transition: all 0.5s ease;
}
 #btnstar:focus {
	 outline: none;
}
 #btnstar:hover {
	 box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.15);
}
 #btnstar.liked {
	 border-color: #ff8299;
	 animation: shadow-grow 2s;
}
 #btnstar.liked svg {
	 animation: heart-grow 0.7s;
}
 #btnstar.liked .heart {
	 fill: #ff8299;
}
 #btnstar svg {
	 width: 20px;
	 height: auto;
}
 #btnstar svg .heart {
	 fill: rgba(0, 0, 0, 0.15);
}
 #btnstar svg .shine {
	 fill: #fff;
}
 @keyframes shadow-grow {
	 0% {
		 box-shadow: 0 0;
	}
	 50% {
		 box-shadow: 0 0 5px 20px rgba(255, 255, 255, 0);
	}
	 100% {
		 box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
	}
}
 @keyframes heart-grow {
	 0% {
		 transform: scale(3);
		 opacity: 0;
	}
	 50% {
		 opacity: 1;
	}
	 100% {
		 transform: scale(1);
	}
}
 
    </style>
    
<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template -->
<link href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<!-- Custom styles for this template -->
<link href="{{ asset('frontend/css/clean-blog.min.css') }}" rel="stylesheet">

@notifyCss
</head>
