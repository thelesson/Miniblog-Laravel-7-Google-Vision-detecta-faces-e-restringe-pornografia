<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use App\Post;
use App\Page;
use App\User;
use Jahondust\ModelLog\Models\ModelLog;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use App\Role;
use App\Contato;

use Illuminate\Support\Facades\Hash;


use Google\Cloud\Vision\V1\ImageAnnotatorClient;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   // private $GoogleCredencial = 'C:/xampp/htdocs/miniblog/miniblog-google-vision-b9d402fd687d.json';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subheader="Visão Geral do Blog";
        $contatos = Contato::orderBy('id', 'DESC')->take(3)->get();
        $tituloDashboard = Settings::where('key', 'admin.title')->first();
        $postsTotais = Post::all()->count();
        $postsPublicados = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->count();
        $paginasPublicadas = Page::where('status', 'ACTIVE')->count();
        $paginasTotais = Page::all()->count();
        $usuariosTotais = User::all()->count();
        //$sessions = Tracker::currentSession();
        $sessaoAtual = Tracker::currentSession();
        $favoritos = Auth::user()->favoritos()->paginate(8);
        $favoritosC = Auth::user()->favoritos()->count();
        $sessaoTodasDoLogado = \PragmaRX\Tracker\Vendor\Laravel\Models\Session::where('user_id',Auth()->user()->id)->paginate(5);
       
        if(config('tracker.enabled') ===true){
            $usersOnline = Tracker::onlineUsers()->count();
        }else{
            $usersOnline= false;
        }
        $dias = User::whereDate('created_at', '>', Carbon::now()->subDays(30))->count();
        //usuarios totais 30 dias atras e usuarios criados por cada dia
        $start = Carbon::now()->subDays(30);
        $dispositivosWindows = \PragmaRX\Tracker\Vendor\Laravel\Models\Device::where('platform','Windows')->where('is_mobile',0)->count();
        $dispositivosOther = \PragmaRX\Tracker\Vendor\Laravel\Models\Device::where('platform','Other')->where('is_mobile',0)->count();
        $dispositivosMobile = \PragmaRX\Tracker\Vendor\Laravel\Models\Device::where('platform','Other')->where('is_mobile',1)->count();
        $dispositivo[] = $dispositivosWindows;
        $dispositivo[] = $dispositivosOther;
        $dispositivo[] = $dispositivosMobile;


foreach (range(0, 30) as $day) {
   //usuarios criados nos ultimos 30 dias 
    $dxUsersPorDia[] =User::whereDate('created_at', '=', $start->copy()->addDays($day))->count();
    //$dxUsersPorDia[] =  $dxUsersPorDia;
  //  {{ $loop->last() ? '' : ',' }}
    //usuarios totais nos ultimos 30 dias
    $array = $dxUsersPorDia;
$keys = array_keys($array);
$array = array_values($array);

$newArr = array();

foreach ($array as $key=>$val) {
    $newArr[] = array_sum(array_slice($array, 0, $key+1));
}
$newArr = array_combine($keys, $newArr);

    
   
}
            
        return view('home')->with(compact('favoritosC','favoritos','contatos','subheader','dispositivo','sessaoTodasDoLogado','newArr','dxUsersPorDia','dias','sessaoAtual','usuariosTotais','usersOnline','paginasTotais','tituloDashboard','postsTotais','postsPublicados','paginasPublicadas'));
    }
    
//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//
//Método helper para enviar notificações por e mail e para o sistema//
    public function notificacoesBase($subject,$greeting,$body,$thanks,$usuarioId){
        $user9 = \App\User::find($usuarioId);
        $details = [
            'subject' =>$subject,
            'greeting' => $greeting,
            'body' => $body,
            'thanks' => $thanks,
    ];
    return $user9->notify(new \App\Notifications\TarefaCompleta($details));
    }
//end método

//metodo deletaIMGtempAoCarregar
public function delTempImg(){
    $filename = 'temp'.Auth()->user()->id.'.jpg';
    
    //png
    $filenameP = 'temp'.Auth()->user()->id.'.png';
    
      $usersImage =storage_path('app/public/tempupload/'.$filename);
       $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
       if (File::exists($usersImage)) { 
        File::delete($usersImage);
       }
    if (File::exists($usersImageP)) { 
        File::delete($usersImageP);
      
    }
}

//

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER POST DEPOIS**************************** *//
//**********************CONTROLLER POST ********************//

//esta função exibe no dashboard todas as postagens que estejam com  o status PUBLISHED  
     public function listaBlog(){
         $subheader="Exibindo postagens ";
         //abaixo carrega as configurações setadas no dashboard do superadmin em configurações - configurações de posts
         $numeroPosts = Settings::where('key', 'configuracoes-de-post.numerodash')->first();
        $estiloP = Settings::where('key', 'configuracoes-de-post.paginacao')->first();
        $ordem = Settings::where('key', 'configuracoes-de-post.ordem')->first();
        if(!empty($numeroPosts->value)){
            if($estiloP->value ==='0'){
                 if($ordem->value ==='0'){
                    $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
                    if(!empty($verificaUsuarioLog)){
                        if ($verificaUsuarioLog->name !=="user"){
                            $posts = Post::orderBy('id', 'DESC')->simplepaginate($numeroPosts->value);
                
                        }else{
                            $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->simplepaginate($numeroPosts->value);
                
                        }
                    }
                     }else{
                        if(!empty($verificaUsuarioLog)){
                            if ($verificaUsuarioLog->name !=="user"){
                                $posts = Post::orderBy('id', 'ASC')->simplepaginate($numeroPosts->value);
               
                            }else{
                                $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->simplepaginate($numeroPosts->value);
               
                            }
                        }
                    
                 }
               
            }else{
                if($ordem->value ==='0'){
                    if(!empty($verificaUsuarioLog)){
                        if ($verificaUsuarioLog->name !=="user"){
                            $posts = Post::orderBy('id', 'DESC')->paginate($numeroPosts->value);
              
                        }else{
                            $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate($numeroPosts->value);
              
                        }
                        }
                     }else{
                        if(!empty($verificaUsuarioLog)){
                            if ($verificaUsuarioLog->name !=="user"){
                                $posts = Post::orderBy('id', 'ASC')->paginate($numeroPosts->value);
            
                            }else{
                                $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->paginate($numeroPosts->value);
            
                            }
                            }
                        }
            }
           
        }
        else{
            if($estiloP->value ==='0'){
                if($ordem->value ==='0'){
                    if(!empty($verificaUsuarioLog)){
                        if ($verificaUsuarioLog->name !=="user"){
                            $posts = Post::orderBy('id', 'DESC')->simplepaginate(4);
              
                        }else{
                            $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->simplepaginate(4);
              
                        }
                        }
                     }else{
                        if(!empty($verificaUsuarioLog)){
                            if ($verificaUsuarioLog->name !=="user"){
                                $posts = Post::orderBy('id', 'ASC')->simplepaginate(4);
               
                            }else{
                                $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->simplepaginate(4);
               
                            }
                            }
                     }
            }else{
                if($ordem->value ==='0'){
                    if(!empty($verificaUsuarioLog)){
                        if ($verificaUsuarioLog->name !=="user"){
                            $posts = Post::orderBy('id', 'DESC')->paginate(4);
            
                        }else{
                            $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(4);
            
                        }
                        }
                       }else{
                        if(!empty($verificaUsuarioLog)){
                            if ($verificaUsuarioLog->name !=="user"){
                                $posts = Post::orderBy('id', 'ASC')->paginate(4);
                            }else{
                                $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->paginate(4);
                            }
                            }
                   
                }
            }
            
        }
        return view('lista-blogs-logado',['posts'=>$posts])->with(compact('subheader'));
 
     }
     
//**********************END*****************************//

//*********************LEMBRAR DE EXPORTAR PARA NOVO CONTROLLER POST DEPOIS**************************** *//
//**********************CONTROLLER POST ********************//

//função abaixo exibe a página de cadastro de nova postagem
    public function addPost()
    {
        $subheader="Cadastrar nova Postagem";
        $verifica =0;
        $filename = 'temp'.Auth()->user()->id.'.jpg';
    
      $usersImage =storage_path('app/public/tempupload/'.$filename);
        //** lembrar de criar método helper para dinamizar extensão da imagem de acordo permitido : jpg/png/gif */
      
         //end
         $tituloDashboard = Settings::where('key', 'admin.title')->first();
         $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
         if(!empty($verificaUsuarioLog)){
             //se não for usuário, será admin/moderador
            if ($verificaUsuarioLog->name !=="user"){
              //end
              //este tracho abaixo serve para verificar se existe imagem temporária para o usuário logado
              //caso true, eliminará sempre que esta rota for executada
            self::delTempImg();
                 
                //end
                return view('add-post')->with(compact('subheader','usersImage','tituloDashboard'));
            
            }else{
                //aqui cai na condição do usuário normal
                //abaixo verifica se existe alguma postagem pendente para o usuário logado
                // e bloqueia acesso caso o usuário possua mais de 2 postagens pendente de aprovação
                $postA= Post::where('author_id',Auth()->user()->id)->where('status','PENDING')->count();
                if($postA>1){
                    notify()->error('Ainda Estamos analisando sua última postagem enviada para aprovação. Por favor aguarde!⚡️', 'Accesso Negado');
                    return redirect('/home')->with('autofocus', true);
                }else{
                    //caso esteja dentro do limite, apaga qualquer imagem temporária que houver para o usuário logado
                    self::delTempImg();
                   
                        
                    return view('add-post')->with(compact('subheader','usersImage','tituloDashboard'));
                }
            }
            }else{
                return redirect('/home');
            }
       }

       //end

    //funcao para criar nova postagem
    public function salvaPost(Request $request){
        
       


        $validator = \Validator::make($request->all(),[
            'title' => 'required|string|min:5|max:100',
            'subtitle' => 'string|min:5|max:200',
            'excerpt' => 'required|string|min:5|max:200',
            'body' => 'required|string|max:3000',
            'slug' =>'required|string|unique:posts|min:5|max:100',
            'status'=>'required|string|max:20',
            'visibilidade'=>'required|string|max:10',
            'restrito'=>'required|string|max:20',
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000',
            'metadescricao' =>'required|string|max:100',
            'keywords'=>'required|string|max:100',
            'tituloseo' =>'required|string|max:100',
            'exclusivo' =>'max:1'

        ]);
       // $slug= Str::slug($validator['title'], '-');
    
          if($validator->fails()) {
            notify()->error('Um erro ocorreu ao salvar este post⚡️', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
        }
      /*   if(is_null( $request->image)) {
            notify()->error('O servidor negou o upload da imagem por não respeitar nossos termos de uso. Por favor, remova a imagem ou insira outra', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
        }
        */
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
                //este if é executado sempre que o usuário logado não 
                // é um usuário comum
                $postagem = new Post();
                $postagem->author_id = Auth()->user()->id;
                $postagem->title = $request->get('title');
                $postagem->subtitle = $request->get('subtitle');
                $postagem->excerpt = $request->get('excerpt');
                $postagem->body = $request->get('body');
                $postagem->slug = $request->get('slug');
                $postagem->status = $request->get('status');
                $filename = 'temp'.Auth()->user()->id.'.jpg';
                $filename2 = 'posts'.Auth()->user()->id.'-'.time().'0'.'.jpg';
            //  $image_path = app_path("images/news/{$news->photo}");
               $usersImage =storage_path('app/public/tempupload/'.$filename);
               $new_path = storage_path('app/public/posts/'.$filename2);
               $new_path2 = 'posts/'.$filename2;
               //trecho abaixo mova a imagem temporária para  a pasta de posts
               if (File::exists($usersImage)) { // unlink or remove previous image from folder
                  $move = File::move($usersImage, $new_path);
                  $postagem->image = $new_path2;
              }
              //end
              //este trecho verifica se a nova postagem criada deve ser restrido 
              //apenas para membros(usuários logados) ou para o público em geral
                if($request->get('visibilidade') ==="logado"){
                    $postagem->featured = 1;
                }else{
                    $postagem->featured = 0;
                }
               //end
                $postagem->seo_title = $request->get('tituloseo');
                $postagem->meta_description = $request->get('metadescricao');
                $postagem->meta_keywords = $request->get('keywords');
                $postagem->save();
               

                notify()->success('Postagem salva com sucesso ⚡️', 'Sucesso');
                return redirect()->back();
            }else{
                //caso o usuário logado seja um usuário comum
                //este bloco é executado
                $postagem = new Post();
                $postagem->author_id = Auth()->user()->id;
                $postagem->title = $request->get('title');
                $postagem->subtitle = $request->get('subtitle');
                $postagem->excerpt = $request->get('excerpt');
                $postagem->body = $request->get('body');
                $postagem->slug = $request->get('slug');
                $postagem->status = 'PENDING';
                $filename = 'temp'.Auth()->user()->id.'.jpg';
                $filename2 = 'posts'.Auth()->user()->id.'-'.time().'0'.'.jpg';
            //  $image_path = app_path("images/news/{$news->photo}");
               $usersImage =storage_path('app/public/tempupload/'.$filename);
               $new_path = storage_path('app/public/posts/'.$filename2);
               $new_path2 = 'posts/'.$filename2;
               if (File::exists($usersImage)) { // unlink or remove previous image from folder
                  $move = File::move($usersImage, $new_path);
                  $postagem->image = $new_path2;
              }
                
                $postagem->featured = 0;
                $postagem->seo_title = $request->get('tituloseo');
                $postagem->meta_description = $request->get('metadescricao');
                $postagem->meta_keywords = $request->get('keywords');
                $postagem->save();
                $user9 = \App\User::find(Auth()->user()->id);
               //trecho abaixo envia notificação para o badge e para o email do usuario
               // que criou a postagem 
                $til = $request->get('title');
                $textoMg = "Sua postagem:{$til} foi enviada para aprovação.";
                $details = [
                        'subject' =>'Miniblog - Postagem  enviada para aprovação',
                        'greeting' => 'Postagem Enviada para moderação',
                        'body' => $textoMg,
                        'thanks' => ':)',
                ];
            
                $user9->notify(new \App\Notifications\TarefaCompleta($details));

                //admin notification
                //este trecho informa para todos os moderadores e admins que existe uma postagem
                //pendente de aprovação
                $verificaSeEhAdm = Role::where('name','!=','user')->get();
                if($verificaSeEhAdm){
                   
                        foreach($verificaSeEhAdm as $admModerator){
                          $admin = \App\User::where('role_id',$admModerator->id)->first();
                          if($admin){
                               $til = $request->get('title');
                                $nome= $admin->name;
                                $email = $admin->email;
                                $id99 = $admin->id;
                                $textoMg = " Nova Postagem pendente para aprovação. Usuário {$nome}, email: {$email}, id: {$id99} , enviou a postagem: {$til} para sua aprovação.";
                                $details = [
                                        'subject' =>'Miniblog - Novo Pedido de Aprovação',
                                        'greeting' => 'Novo Pedido para aprovação de postagem',
                                        'body' => $textoMg,
                                        'thanks' => ':)',
                                ];
                            
                                $admin->notify(new \App\Notifications\TarefaCompleta($details));
                            
                            
                           
                        }
                        }
                   
                }
                //end
               
                notify()->success('Postagem salva com sucesso ⚡️', 'Sucesso');
                return redirect()->back();
            }
        }
          
    }

    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER HELPER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//

//esta função é responsavel por criar uma imagem em pasta temporaria,
//para que o Google vision faça a verificação se a imagem contém pornografia/etc
//chamada via ajax
    public function uploadTemporario(Request $request){
        //verifica se o google vision deve ser executado nesta imagem, verificando 
        //a configuração setada no dashboard do superadmin
        $googleVisionCheck = Settings::where('key', 'configuracoes-de-post.google-vision')->first();
        
          $file = $request->file('image');
        //  $file = $request->file('image');
          $getFileExt   = $file->getClientOriginalExtension();
          $uploadedFile =   'temp'.Auth()->user()->id.'.'.$getFileExt;

        //não utilizar uma imagem com este nome abaixo: ca.jpg
        // iremos causar um erro proposital para a biblioteca do pondUpload exibir uma imagem negada
          $filename = 'ca.jpg';
           

          $gCredencial = \App\Settings::where('key', 'site.gcredenciais')->first();
           //$this->GoogleCredencial;
          
$imageAnnotator = new ImageAnnotatorClient(['credentials' => $gCredencial->value]);


# annotate the image
$image = file_get_contents($request->file('image'));
$response = $imageAnnotator->safeSearchDetection($image);
$safe = $response->getSafeSearchAnnotation();

$adult = $safe->getAdult();
$medical = $safe->getMedical();
$spoof = $safe->getSpoof();
$violence = $safe->getViolence();
$racy = $safe->getRacy();

# names of likelihood from google.cloud.vision.enums
$likelihoodName = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY',
'POSSIBLE','LIKELY', 'VERY_LIKELY'];
$out = new \Symfony\Component\Console\Output\ConsoleOutput();
$out->writeln("Hello from Terminal");
//carrega a variavel $adult para verificar pornografia, caso quissesse verificar violencia poderia 
//chamar a variavel $violence acima declarada
$ver = $likelihoodName[$adult];
if($ver ==="POSSIBLE" || $ver ==="LIKELY" || $ver ==="VERY_LIKELY" ){
    $usersImage =storage_path('app/public/tempupload/'.$filename);
  //  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
       $verifica =1;
    //  return pond.addFile($usersImage);
    // return $request.removeFile();
    $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
    if(!empty($verificaUsuarioLog)){
        if ($verificaUsuarioLog->name !=="user"){
            //admins não sao afetados pela verificacao e qualquer imagem enviada será enviada para 
            // pasta temporária
            return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
   
        }else{
            
           if($googleVisionCheck->value ==='SIM') {
               //caso usuário e o painel do superadmin está setado como sim
               // impedimos a criação da imagem na pasta temporária e 
               // criamos um erro intencial para o filePond exibir falha de upload para o usuário
            return pond.addFile($usersImage);}
            else{
                //de outro modo, usuários conseguirão enviar imagem para a pasta temporária
                return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
   
            }
            
        }

    }
}else{
   // $pornografia="nao";
 
 return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
       
}


$imageAnnotator->close(); 


      
   
    }

    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//

// função para upload do avatar e verificação do google vision - 
//semelhante ao método de uploadtempoário, com a inserção de verificação de faces.
// caso no painel do super admin esteja habilitado para verificar se imagem enviada contém 
//faces, o método irá impedir qualquer imagem que não contenha, caso o usuário seja um usuário normal
//chamada deste método via ajax
    public function uploadTemporarioAvatar(Request $request){
        
        $googleVisionCheck = Settings::where('key', 'site.google-vision-avatar2')->first();
        $googleVisionCheck2 = Settings::where('key', 'site.google-vision-avatar')->first();
        
          $file = $request->file('image');
        //  $file = $request->file('image');
          $getFileExt   = $file->getClientOriginalExtension();
          $uploadedFile =   'temp'.Auth()->user()->id.'.'.$getFileExt;


          $filename = 'ca.jpg';
           

$gCredencial = \App\Settings::where('key', 'site.gcredenciais')->first();
 //$this->GoogleCredencial;
$imageAnnotator = new ImageAnnotatorClient(['credentials' => $gCredencial->value]);


# annotate the image
$image = file_get_contents($request->file('image'));
$response = $imageAnnotator->safeSearchDetection($image);
$response2 = $imageAnnotator->faceDetection($image);
$safe = $response->getSafeSearchAnnotation();
$faces = $response2->getFaceAnnotations();
$quantasFaces = count($faces);

$adult = $safe->getAdult();
$medical = $safe->getMedical();
$spoof = $safe->getSpoof();
$violence = $safe->getViolence();
$racy = $safe->getRacy();

$verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
# names of likelihood from google.cloud.vision.enums
$likelihoodName = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY',
'POSSIBLE','LIKELY', 'VERY_LIKELY'];

$ver = $likelihoodName[$adult];
if($ver ==="POSSIBLE" || $ver ==="LIKELY" || $ver ==="VERY_LIKELY" ){
    $usersImage =storage_path('app/public/tempupload/'.$filename);
  //  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
       $verifica =1;
    //  return pond.addFile($usersImage);
    // return $request.removeFile();
    if(!empty($verificaUsuarioLog)){
        if ($verificaUsuarioLog->name !=="user"){
          
            return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
   
        }else{
           if($googleVisionCheck->value ==='SIM') {
            return pond.addFile($usersImage);
        }
            else{
                if($quantasFaces===0){
                    if($googleVisionCheck2->value ==='SIM') {
                        return pond.addFile($usersImage);
                    }else{
                        return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
   
                    }
                }else{
                    return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));
   
                }
                
                
            }
            
        }

    }
}else{
   // $pornografia="nao";
   if ($verificaUsuarioLog->name !=="user"){
    return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));

}else{
    if($quantasFaces===0){
        if($googleVisionCheck2->value ==='SIM') {
            return pond.addFile($usersImage);
        }else{
            return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));

        }
    }else{
        return  Storage::disk(config('voyager.storage.disk'))->put('tempupload/'.$uploadedFile, file_get_contents($file));

    }
}
       
}


$imageAnnotator->close(); 


      
   
    }

    
//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//
//função para cancelar upload quando o usuário no front-end desiste de realizar upload
//chamada via ajax
    public function cancelaUpload(){
        
        $filename = 'temp'.Auth()->user()->id.'.jpg';
          $usersImage =storage_path('app/public/tempupload/'.$filename);
          
         if (File::exists($usersImage)) { // unlink or remove previous image from folder
              File::delete($usersImage);
              //unlink($usersImage);
              
          }
          $valor = 1;
          return response()->json(array('valor'=> $valor), 200);
  
    }

    public function loadRetorno(){
        $verifica =1;
        return $verifica;
      //  return $fileId = request()->getContent();
    }

    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER POST ********************//
//metodo para deletar postagens
    public function postDeletar($id){
        
        $deleta = Post::findOrFail($id);
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
                $usersImage =storage_path('app/public/'.$deleta->image);
                if (File::exists($usersImage)) { // unlink or remove previous image from folder
                    File::delete($usersImage);
                 
                }
                $deleta->delete();
                $user9 = \App\User::find($deleta->author_id);
               if($user9){
                $user9 = \App\User::find($deleta->author_id);
                $til = $deleta->title;
                $textoMg = "Sua postagem:{$til} foi deletada permanentemente  pela moderação do site";
                $details = [
                        'subject' =>'Miniblog - Postagem  Deletada Permanentemente',
                        'greeting' => 'Postagem Deletada',
                        'body' => $textoMg,
                        'thanks' => ':)',
                ];
            
                $user9->notify(new \App\Notifications\TarefaCompleta($details));
               }else{
                $deletadoUsuario  = \App\User::onlyTrashed()->find($deleta->author_id);
                if(!empty($deletadoUsuario)){
                    notify()->success('Postagem deletada com sucesso ⚡️', 'Sucesso');
                    return redirect()->back();
                }else{
                    notify()->error('Autor do Post não identificado⚡️', 'Falha');
                    return Redirect::back();
                }
            }
                notify()->success('Deletado com Sucesso ⚡️', 'Sucesso');
                return redirect()->back();
            }else{
                notify()->error('Você não possui privilégios para executar esta ação ⚡️', 'Erro');
                return redirect()->back();
            }
           
            }else{
                notify()->error('Credenciais Inválidas ⚡️', 'Erro');
                return redirect()->back();
            }
         

    }

    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER POST ********************//
// método para exibir a página de edição de postagens
    public function editPost($id)
    {
        
        $filename = 'temp'.Auth()->user()->id.'.jpg';
    
      $usersImage =storage_path('app/public/tempupload/'.$filename);
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
                $postEdit = Post::find($id);

        $subheader="Editar Postagem";
        $verifica =0;
        //metodo abaixo para eliminar qualquer imagem temporária 
        //que existir para o usuário logado ao acessar a rota desta função
        self::delTempImg();
          //end
        
       
        $tituloDashboard = Settings::where('key', 'admin.title')->first();
      
        return view('add-post')->with(compact('postEdit','subheader','usersImage','tituloDashboard'));
    
            }else{
                 $postEdit = Post::findorfail($id);
                 if($postEdit->status==="PENDING"){
                     //habilita edição para usuários comuns se e somente se estiverem com postagens pendentes
                     //em outro caso, usuário comum não conseguirá editar suas postagens que forem aprovadas ou rejeitadas pelos admins
                    $subheader="Editar Postagem";
                    $verifica =0;
                    self::delTempImg();
                      
                    $tituloDashboard = Settings::where('key', 'admin.title')->first();
                  
                    return view('add-post')->with(compact('postEdit','subheader','usersImage','tituloDashboard'));
                
                 }else{
                    notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                    return redirect('/home')->with('autofocus', true);
                 }
                
            }
            }else{
                return view('403');
            }
        }

        //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER POSTS ********************//
//método para efetivamente realizar a atualização da postagem
    public function updatePost(Request $request, $id){

        //função para salvar a edição de uma postagem
        $postagem = Post::find($id);
        if(is_null($postagem))
         {
            notify()->error('Não identificamos este post em nossa base⚡️', 'Falha');
            return Redirect::back();
         }
        $validator = \Validator::make($request->all(),[
            'title' => 'required|string|min:5|max:100',
            'subtitle' => 'string|min:5|max:200',
            'excerpt' => 'required|string|min:5|max:200',
            'body' => 'required|string|max:3000',
            'slug' =>($request->slug != $postagem->slug) ? 'required|string|unique:posts|min:5|max:100': '',
            'status'=>'required|string|max:20',
            'visibilidade'=>'required|string|max:10',
            'restrito'=>'required|string|max:20',
            'image'=>'mimes:jpeg,jpg,png,gif|max:10000',
            'metadescricao' =>'required|string|max:100',
            'keywords'=>'required|string|max:100',
            'tituloseo' =>'required|string|max:100',
            'exclusivo' =>'max:1',
            'removidoOunao' =>'max:1'

        ]);
       // $slug= Str::slug($validator['title'], '-');
    
          if($validator->fails()) {
            notify()->error('Um erro ocorreu ao salvar este post⚡️', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
        }
      /*   if(is_null( $request->image)) {
            notify()->error('O servidor negou o upload da imagem por não respeitar nossos termos de uso. Por favor, remova a imagem ou insira outra', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
        }
        */
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
                $postagem = Post::find($id);

                if(!is_null($postagem)){
                 //   $postagem->author_id = Auth()->user()->id;
                 $postagemOLD = $postagem->status;
                    $postagem->title = $request->get('title');
                    $postagem->subtitle = $request->get('subtitle');
                    $postagem->excerpt = $request->get('excerpt');
                    $postagem->body = $request->get('body');
                    $postagem->slug = $request->get('slug');
                    $postagem->status = $request->get('status');
                    $filename = 'temp'.Auth()->user()->id.'.jpg';
                    $filename2 = 'posts'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                    $filenameP = 'temp'.Auth()->user()->id.'.png';
                    $filename2P = 'posts'.Auth()->user()->id.'-'.time().'0'.'.png';
                //  
                //  $image_path = app_path("images/news/{$news->photo}");
                   $usersImage =storage_path('app/public/tempupload/'.$filename);
                   $new_path = storage_path('app/public/posts/'.$filename2);
                   $new_path2 = 'posts/'.$filename2;

                   $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                   $new_pathP = storage_path('app/public/posts/'.$filename2P);
                   $new_path2P = 'posts/'.$filename2P;
                   
                   $valorIm = $request->get('removidoOunao');
                   if($valorIm === "0"){
                    if (File::exists($usersImage)) {
                        
                        $usersImageDELX =storage_path('app/public/'.$postagem->image);
                        if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                            File::delete($usersImageDELX);
                         
                        }
                        $move = File::move($usersImage, $new_path);
                        $postagem->image = $new_path2;
                    }elseif(File::exists($usersImageP)) {
                        $usersImageDELX =storage_path('app/public/'.$postagem->image);
                        if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                            File::delete($usersImageDELX);
                         
                        }
                        $move = File::move($usersImageP, $new_pathP);
                            $postagem->image = $new_path2P;
                        
                    }
                   }else{
                    $usersImageDELX =storage_path('app/public/'.$postagem->image);
                    if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                        File::delete($usersImageDELX);
                     
                    }
                    $postagem->image = null;
                   }
                  
                    if($request->get('visibilidade') ==="logado"){
                        $postagem->featured = 1;
                    }else{
                        $postagem->featured = 0;
                    }
                   
                    $postagem->seo_title = $request->get('tituloseo');
                    $postagem->meta_description = $request->get('metadescricao');
                    $postagem->meta_keywords = $request->get('keywords');
                    $postagem->save();
                    $user9 = \App\User::find($postagem->author_id);
                    if($user9){
                      
                     $user9 = \App\User::find($postagem->author_id);
                     $til = $postagem->title;
                   
                        if($request->get('status') ==="PUBLISHED" && $postagemOLD==="PENDING"){
                            $textoMg = "Sucesso! Sua postagem:{{$til}} foi aprovada pela nossa equipe de Moderação";
                            $details = [
                                'subject' =>'Miniblog - Postagem Aprovada',
                                    'greeting' => 'Postagem Aprovada!',
                                    'body' => $textoMg,
                                    'thanks' => ':)',
                            ];
                            $user9->notify(new \App\Notifications\TarefaCompleta($details));
                         }else if($request->get('status') ==="DRAFT" && $postagemOLD !=="DRAFT"){
                        $textoMg = "Infelizmente sua postagem:{$til} não atendeu aos nossos critérios e foi rejeitada pela moderação";
                        $details = [
                            'subject' =>'Miniblog - Postagem Rejeitada',
                                'greeting' => 'Postagem Rejeitada :(',
                                'body' => $textoMg,
                                'thanks' => ':)',
                        ];
                        $user9->notify(new \App\Notifications\TarefaCompleta($details));
                     }else if($request->get('status') ==="PUBLISHED" && $postagemOLD==="DRAFT"){
                        $textoMg = "Sua postagem:{$til} foi reavaliada pela moderação e foi aprovada!";
                        $details = [
                                'subject' =>'Miniblog - Postagem Reavaliada',
                                'greeting' => 'Postagem Reavaliada',
                                'body' => $textoMg,
                                'thanks' => ':)',
                        ]; 
                        $user9->notify(new \App\Notifications\TarefaCompleta($details));
                     }
                     
                    
                    }else{
                        $deletadoUsuario  = \App\User::onlyTrashed()->find($postagem->author_id);
                        if(!empty($deletadoUsuario)){
                            notify()->success('Postagem salva com sucesso ⚡️', 'Sucesso');
                            return redirect()->back();
                        }else{
                            notify()->error('Autor do Post não identificado⚡️', 'Falha');
                            return Redirect::back();
                        }
                    }
                   
                    notify()->success('Postagem salva com sucesso ⚡️', 'Sucesso');
                    return redirect()->back();
                }else{
                    notify()->error('Não identificamos em nossa base de dados este post⚡️', 'Falha');
                    return Redirect::back();
                }
            
            }else{
                $postagem = Post::find($id);
                if(!is_null($postagem)){
                    $postagem->author_id = Auth()->user()->id;
                    $postagem->title = $request->get('title');
                    $postagem->subtitle = $request->get('subtitle');
                    $postagem->excerpt = $request->get('excerpt');
                    $postagem->body = $request->get('body');
                    $postagem->slug = $request->get('slug');
                    $postagem->status = 'PENDING';
                    $filename = 'temp'.Auth()->user()->id.'.jpg';
                    $filename2 = 'posts'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                //  $image_path = app_path("images/news/{$news->photo}");
                   $usersImage =storage_path('app/public/tempupload/'.$filename);
                   $new_path = storage_path('app/public/posts/'.$filename2);
                   $new_path2 = 'posts/'.$filename2;
                 //png
                 $filenameP = 'temp'.Auth()->user()->id.'.png';
                 $filename2P = 'posts'.Auth()->user()->id.'-'.time().'0'.'.png';
              $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                $new_pathP = storage_path('app/public/posts/'.$filename2P);
                $new_path2P = 'posts/'.$filename2P;
                
                 //end
                   $valorIm = $request->get('removidoOunao');
                   if($valorIm === "0"){
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        $usersImageDELX =storage_path('app/public/'.$postagem->image);
                    if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                        File::delete($usersImageDELX);
                     
                    }
                        $move = File::move($usersImage, $new_path);
                        $postagem->image = $new_path2;
                    }elseif(File::exists($usersImageP)) { // unlink or remove previous image from folder
                        $usersImageDELX =storage_path('app/public/'.$postagem->image);
                    if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                        File::delete($usersImageDELX);
                     
                    }
                        $move = File::move($usersImageP, $new_pathP);
                        $postagem->image = $new_path2P;
                    }else{
                        $usersImageDELX =storage_path('app/public/'.$postagem->image);
                        if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                            File::delete($usersImageDELX);
                         
                        }
                        $postagem->image = null;
                    }
                   }else{
                    $usersImageDELX =storage_path('app/public/'.$postagem->image);
                    if (File::exists($usersImageDELX)) { // unlink or remove previous image from folder
                        File::delete($usersImageDELX);
                     
                    }
                    $postagem->image = null;
                   }
                   
                    
                    $postagem->featured = 0;
                    $postagem->seo_title = $request->get('tituloseo');
                    $postagem->meta_description = $request->get('metadescricao');
                    $postagem->meta_keywords = $request->get('keywords');
                    $postagem->save();
                    $user9 = \App\User::find($postagem->author_id)->count();
                    if($user9>0){
                     $user9 = \App\User::find($postagem->author_id);
                     $til = $postagem->title;
                      $textoMg = "Sucesso! Sua postagem:{$til} foi enviada novamente para aprovação, contendo os novos dados inseridos";
                        $details = [
                                'subject' =>'Miniblog - Postagem Reenviada',
                                'greeting' => 'Postagem Reenviada!',
                                'body' => $textoMg,
                                'thanks' => ':)',
                        ];
                        $user9->notify(new \App\Notifications\TarefaCompleta($details));
                    
                    
                    }
                    notify()->success('Postagem salva com sucesso ⚡️', 'Sucesso');
                    return redirect()->back();
                }else{
                    notify()->error('Não identificamos em nossa base de dados este post⚡️', 'Falha');
                    return Redirect::back();
            
                }
                
            }
        }
    }
    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//
//desloga usuário logado
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER TABELA ********************//
//função para exibir o registro de atividades dos usuários - Permitido apenas para usuários 
//admins ou que não seja um usuário comum
 
    public function logs () {
        //logout user
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
                $logs = ModelLog::paginate(10);
                $subheader="Atividades dos Usuários no site";
       
        return view('logs')->with(compact('logs','subheader'));
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER TABELA ********************//
//função para exibir as atividades do usuário logado

    public function minhasAtv(){
          //logout user
        //  $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
          if(Auth::check()){
              
                  $logs = ModelLog::where('user_id',Auth()->user()->id)->paginate(10);
                  $subheader="Minhas atividades no site";
                  $cambio = 1;
          return view('logs')->with(compact('logs','subheader','cambio'));
              
          }else{
              return redirect('/');
          }
    }

    //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER POST ********************//
//este metodo exibe a lista de postagens no dashboard do usuário logado.
//caso usuário tenha a permissão de acesso de usuário comum, ele apenas poderá 
//editar postagens que encontram-se pendentes. Não há permissão para usuário comum deletar postagem ou 
//editar postagens aprovadas ou rejeitadas pelo admin
//admin/moderadores livre acesso para o crud
    public function minhasPostagens(){
        //logout user
      //  $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
      $subheader="Exibindo minhas postagens ";
      $numeroPosts = Settings::where('key', 'configuracoes-de-post.numerodash')->first();
      $cambio=1;
     $estiloP = Settings::where('key', 'configuracoes-de-post.paginacao')->first();
     $ordem = Settings::where('key', 'configuracoes-de-post.ordem')->first();
     if(!empty($numeroPosts->value)){
         if($estiloP->value ==='0'){
              if($ordem->value ==='0'){
                
                   $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'DESC')->simplepaginate($numeroPosts->value);
              }else{
                    
                   $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'ASC')->simplepaginate($numeroPosts->value);
            
                 
              }
            
         }else{
             if($ordem->value ==='0'){
                
                  $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'DESC')->paginate($numeroPosts->value);
           
                  }else{
                   
                             $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'ASC')->paginate($numeroPosts->value);
         
                         
                     }
         }
        
     }
     else{
         if($estiloP->value ==='0'){
             if($ordem->value ==='0'){
                
                         $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'DESC')->simplepaginate(4);
           
                     
                  }else{
                    
                             $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'ASC')->simplepaginate(4);
            
                        
                  }
         }else{
             if($ordem->value ==='0'){
                
                         $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'DESC')->paginate(4);
         
                    }else{
                   
                             $posts = Post::where('author_id',Auth()->user()->id)->orderBy('id', 'ASC')->paginate(4);
                         
                
             }
         }
         
     }
     return view('lista-blogs-logado',['posts'=>$posts])->with(compact('subheader','cambio'));

  }

  //*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER TABELA ********************//
//metodo para exibir a lista de visitantes nas ultimas 24 h
//visivel apenas para admins/moderadores ou outra regra de acesso que não seja user
  public function visitantes(){
        //  $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(Auth::check()){
            $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
            if(!empty($verificaUsuarioLog)){
                if ($verificaUsuarioLog->name !=="user"){
                    $sessions = Tracker::sessions(60 * 24); 
                    $users = Tracker::users(60 * 24);
                    // $logs = ModelLog::where('user_id',Auth()->user()->id)->paginate(10);
                     $subheader="Visitantes do Site";
                     $visitantesTracker = 1;
                     return view('logs')->with(compact('sessions','subheader','visitantesTracker','users'));
                 
                }else{
                        notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                        return redirect('/home')->with('autofocus', true);
                    }
          
    }else{
        return redirect('/');
    }
  }
}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER CONTATOS ********************//
//metodo que exibe a lista de mensagem de contatos recebidas
//usuário comum não possue privilégios para acessar esta rota. 
//caso no dashboard do superadmin esteja setado para habilitar que moderadores possam ler mensagens de contato do sistema,
//moderadores poderão acessar esta rota

public function listaContatos(){
    //  $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
    if(Auth::check()){
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
                $subheader="Lista de Contatos";
                $contatos = Contato::orderBy('id', 'DESC')->paginate(10);
                $contatosTracker = 1;
                 $pode = \App\Settings::where('key','site.moderadores-contatos')->first();
                if($pode){
                    if($pode->value==="SIM"){
                        return view('logs')->with(compact('contatos','subheader','contatosTracker'));
                  
                    }else{
                        if($verificaUsuarioLog->name ==="admin"){
                            return view('logs')->with(compact('contatos','subheader','contatosTracker'));
                        }else{
                            notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                            return redirect('/home')->with('autofocus', true);
                        
                        }
                    }
                
                }else{
                    if($verificaUsuarioLog->name ==="admin"){
                        return view('logs')->with(compact('contatos','subheader','contatosTracker'));
                     }else{
                        notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                        return redirect('/home')->with('autofocus', true);
                     }
                }
               
                // $logs = ModelLog::where('user_id',Auth()->user()->id)->paginate(10);
                
               
            }else{
                    notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                    return redirect('/home')->with('autofocus', true);
                }
      
}else{
    return redirect('/');
}
}
}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER CONTATO ********************//

 //função para deletar mensagens de contato recebidas
 //caso no painel do super admin esteja setado para permitir que moderadores
 //tenham acesso, eles estarão habilitados para deletar qualquer msg de contato
 //admins possuem total acesso
 //usuários normal não possuem qulaquer provilégios

public function contatosDeletar($id){
    
    $deleta = Contato::findOrFail($id);
        $verificaUsuarioLog = Role::where('id',auth()->user()->role_id)->first();
        if(!empty($verificaUsuarioLog)){
            if ($verificaUsuarioLog->name !=="user"){
               
                $deleta->delete();
                notify()->success('Deletado com Sucesso ⚡️', 'Sucesso');
                return redirect()->back();
            }else{
                notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                return redirect('/home')->with('autofocus', true);
            }
           
            }else{
             notify()->error('Você não possui permissão para executar esta operação!⚡️', 'Accesso Negado');
                    return redirect('/home')->with('autofocus', true);
            }
         

}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//
//metodo que lista todas as notificações para o usuário logado

public function listaNotificacoes(){
    $subheader="Minhas Notificações";
    $notificacoesTracker = 1;
    auth()->user()->unreadNotifications->markAsRead();
    $notificacoes2 = \App\Notification::where('notifiable_id',Auth()->user()->id)->paginate(1);
    $notificacoes = auth()->user()->Notifications();
    
    return view('logs')->with(compact('notificacoes','notificacoes2','subheader','notificacoesTracker'));
}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//
//widget que permite enviar notificações badge e emails
// para todos, por email especifico ou id especifico
//usuários comuns não possuem privilégios para este widget
//admins possuem acesso irrestrito
//moderadores possuirão acesso apenas se no painel do super usuário esteja setado para permitir
//que moderadores possam enviar notificacoes
public function widgetEnviaNotificacao(Request $request){
    $validator = \Validator::make($request->all(),[
        'selNot' => 'required|max:2',
        'emailNot' => 'email',
        'idNot' => 'min:1|max:5',
        'tituloNot' =>'required|string|max:100',
        'msgNot' =>'required|string|max:200'
       

    ]);

    if($validator->fails()) {
        notify()->error('Um erro ocorreu ao salvar esta  notificação⚡️', 'Falha');
        return Redirect::back()->withErrors($validator)->with('autofocus', true);
    }
        
    if($request->get('selNot') ==="0"){
        $user9 = \App\User::all()->count();
        if($user9>0){
         $user9 = \App\User::all();
         foreach ($user9 as $u9){
          $til =  $request->get('tituloNot');
          $textoMg = $request->get('msgNot');
          $sub = 'Miniblog - Notificação do Sistema';
          self::notificacoesBase($sub,$til,$textoMg,':)',$u9->id);
                               
        }
            notify()->success('Notificação enviada com sucesso ⚡️', 'Sucesso');
            return redirect()->back();
        }else{
            notify()->error('Erro interno. Por favor tente mais tarde⚡️', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
      
        }
        

    }else if($request->get('selNot') ==="1"){
         $verifica = $request->get('emailNot');
         $user9 = User::where('email',$verifica)->first();
         
         if($user9){
            $user9 = User::where('email',$verifica)->first(); 
            $til =  $request->get('tituloNot');
            $textoMg = $request->get('msgNot');
            $sub = 'Miniblog - Notificação do Sistema';
            self::notificacoesBase($sub,$til,$textoMg,':)',$user9->id);
             notify()->success('Notificação enviada com sucesso ⚡️', 'Sucesso');
            return redirect()->back();
        
        }else{
            notify()->error('Não conseguimos localizar usuários em nossa base com o email informado⚡️', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
      
        }
       

        

    }else if($request->get('selNot') ==="2"){
        $verifica = $request->get('idNot');
        $user9 = User::find($verifica);
        
        if($user9){
           $user9 = User::find($verifica); 
           $til =  $request->get('tituloNot');
           $textoMg = $request->get('msgNot');
           $sub = 'Miniblog - Notificação do Sistema';
           self::notificacoesBase($sub,$til,$textoMg,':)',$user9->id);
           notify()->success('Notificação enviada com sucesso ⚡️', 'Sucesso');
           return redirect()->back();
       
       }else{
           notify()->error('Não conseguimos localizar usuários em nossa base com o id informado⚡️', 'Falha');
           return Redirect::back()->withErrors($validator)->with('autofocus', true);
     
       }
    }else{
        notify()->error('Operação ilegal, envio de notificação cancelada!⚡️', 'Falha');
        return Redirect::back()->withErrors($validator)->with('autofocus', true);
  
    }
}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER HELPER ********************//

// metodo para favoritar post quando usuário estiver logado
public function favoritaPost(Post $post){
    Auth::user()->favoritos()->attach($post->id);

    return back();
}
//desfavoita post
public function desfavoritaPost(Post $post){
    Auth::user()->favoritos()->detach($post->id);

    return back();
}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER TABELA ********************//

//lista favoritos

public function listaFavoritos(){
    $subheader="Meus Favoritos";
    $favoritosTracker = 1;
    $favoritos = Auth::user()->favoritos()->paginate(10);
    $favoritosC = Auth::user()->favoritos()->count();
   
    return view('logs')->with(compact('favoritos','favoritosC','subheader','favoritosTracker'));

}

//error do sistema
public function errosSistema(){
    $subheader="Erros do Sistema em 24 hs";
    $errosTracker = 1;
    $erros = Tracker::errors(60 * 24);
   
    return view('logs')->with(compact('erros','subheader','errosTracker'));

}
//end

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER PERFIL ********************//
//exibe a página de perfil do usuário e apaga qualquer imagem temporária que 
// existir para o usuário logado

public function perfil(){
    self::delTempImg(); //chama metodo para verificar se existe imagem temporaria e apaga
    $subheader="Meu Perfil";
    $usuario= User::find(Auth()->user()->id);
  
    return view('perfil-update')->with(compact('subheader','usuario'));

}

//*********************LEMBRAR DE CRIAR NOVO CONTROLLER DEPOIS**************************** *//
//**********************CONTROLLER PERFIL ********************//
// método para alterar dados do usuário como nome, email, avatar, senha;
// Google vision poderá ser executado se houver no dashboard do superadmin 
// restrição ativa de pornografia e/ou restrição de imagens que não contenha faces;
//Método encontra-se com código redudante que poderá ser encurtado 
// ao criar novos métodos parametizados e /ou nova lógica ;
// o usuário poderá alterar nome e avatar sem a necessidade de confirmar a senha atual.
// Em caso de alteração de nome junto com a criação de nova senha ou email, sem a confirmação da senha atual,
// o nome será alterado mas a senha e/ou email não sofrerão alterações. Uma mensagem será exibida ao usuário
// informando tal condição;
// Para o email e/ou nova senha, o usuário será obrigado a inserir senha atual para efetivação da alteração;
// necessita de novos casos de testes para verificar a consistência deste  método;

public function updatePerfil(Request $request, $id){
    
    $validator = \Validator::make($request->all(),[
        'nome' => 'required|string|min:5|max:100',
        'tk' => 'required|max:3',
        'email' => 'required|email|max:255',
        'senha' => 'required_if:tk,1|required_if:tk,1 min:6|max:20',
        'senha-antiga' => 'max:20'
       

    ]);
   // $slug= Str::slug($validator['title'], '-');

      if($validator->fails()) {
        notify()->error('Um erro ocorreu ao salvar suas credenciais⚡️', 'Falha');
        return Redirect::back()->withErrors($validator)->with('autofocus', true);
    }
    $naoAlteraMail = 0;
    $emailUsuario = 1;
    $img =0;
    //notificacoesTxtvar
    $ip = $_SERVER['REMOTE_ADDR'];
    setlocale(LC_TIME, 'ptb');
    $hoje = Carbon::now();
    $hojeFormatado = $hoje->formatLocalized('%A %d %B %Y');
    $sub ="Miniblog - Nova alteração no perfil";
    $gree = "Nova Alteração no Perfil";
  
    //end
    $usuario = User::findorfail(Auth::id());

    if($usuario->email === $request->get('email')){
        $emailUsuario = 0;
    }else{
        $confereEmail = User::where('email',$request->get('email'))->count();
        if($confereEmail>0){
            $naoAlteraMail = 1;
        }else{
            $naoAlteraMail = 0;
        }
    }
    $hashedPassword = Auth::user()->password;
  //  $countS= count($request->get('senha-antiga'));
    if ($request->filled('senha-antiga')) {
       
            if($usuario){
                if(Hash::check($request->get('senha-antiga'),$hashedPassword)){
                    if($naoAlteraMail > 0){
                        notify()->error('Erro ao completar sua operação - Email em uso⚡️', 'Falha');
                        return Redirect::back()->withErrors($validator)->with('autofocus', true);
                    }else{
                        if ($request->filled('senha')) {
                            $usuarioCLIreset = User::find(Auth::id());
                            $usuarioCLIreset->name = $request->get('nome');
                            $usuarioCLIreset->password = Hash::make($request->get('senha'));
                            $usuarioCLIreset->email = $request->get('email');
                            //image
                                      //image
                                       //jpg
                                       $filename = 'temp'.Auth()->user()->id.'.jpg';
                                       $filename2 = 'user'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                                       $usersImage =storage_path('app/public/tempupload/'.$filename);
                                       $new_path = storage_path('app/public/users/'.$filename2);
                                       $new_path2 = 'users/'.$filename2;
                                       //png
                                       $filenameP = 'temp'.Auth()->user()->id.'.png';
                                       $filename2P = 'user'.Auth()->user()->id.'-'.time().'0'.'.png';
                                       $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                                       $new_pathP = storage_path('app/public/users/'.$filename2P);
                                       $new_path2P = 'users/'.$filename2P;
                            
                                       $usersImageDEL =storage_path('app/public/'.$usuarioCLIreset->avatar);
                                       if (File::exists($usersImageDEL)) { // unlink or remove previous image from folder
                                           File::delete($usersImageDEL);
                                        
                                       }
                              
                              if (File::exists($usersImage)) { // unlink or remove previous image from folder
                                  $move = File::move($usersImage, $new_path);
                                  $usuarioCLIreset->avatar = $new_path2;
                                  $img =1;
                              }
                              
                              if (File::exists($usersImageP)) { // unlink or remove previous image from folder
                                $move = File::move($usersImageP, $new_pathP);
                                $usuarioCLIreset->avatar = $new_path2P;
                                $img =1;
                            }
                           
                          //endimg
                            $usuarioCLIreset->save();
                             
                            if($img === 1){
                                $textoMg = "Nosso sistema confirmou a criação de uma nova senha, alteração de email e novo avatar no dia de {$hojeFormatado} através do ip:{$ip}";
                                self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                               
                                notify()->success('Senha, email e avatar alterados com sucesso ⚡️', 'Sucesso');
                           
                            }else{
                                if($usuario->email !== $request->get('email')){
                                    $textoMg = "Nosso sistema confirmou a criação de uma nova senha e alteração de email no dia de {$hojeFormatado} através do ip:{$ip}";
                                    notify()->success('Senha e email alterados com sucesso ⚡️', 'Sucesso');
                           
                                }else{
                                    $textoMg = "Nosso sistema confirmou a criação de uma nova senha no dia de {$hojeFormatado} através do ip:{$ip}";
                                    notify()->success('Senha alterado com sucesso ⚡️', 'Sucesso');
                           
                                }
                               self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                               
                            }
                          //  return redirect()->back();
                          Auth::logout();
                          return redirect('/login');
                        }else{
                            $usuarioCLIreset = User::find(Auth::id());
                            $usuarioCLIreset->name = $request->get('nome');
                           $usuarioCLIreset->email = $request->get('email');
                                        //image
                                       //jpg
                                       $filename = 'temp'.Auth()->user()->id.'.jpg';
                                       $filename2 = 'user'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                                       $usersImage =storage_path('app/public/tempupload/'.$filename);
                                       $new_path = storage_path('app/public/users/'.$filename2);
                                       $new_path2 = 'users/'.$filename2;
                                       //png
                                       $filenameP = 'temp'.Auth()->user()->id.'.png';
                                       $filename2P = 'user'.Auth()->user()->id.'-'.time().'0'.'.png';
                                       $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                                       $new_pathP = storage_path('app/public/users/'.$filename2P);
                                       $new_path2P = 'users/'.$filename2P;

                                       $usersImageDEL =storage_path('app/public/'.$usuarioCLIreset->avatar);
                                       if (File::exists($usersImageDEL)) { // unlink or remove previous image from folder
                                           File::delete($usersImageDEL);
                                        
                                       }
                              
                              if (File::exists($usersImage)) { // unlink or remove previous image from folder
                                  $move = File::move($usersImage, $new_path);
                                  $usuarioCLIreset->avatar = $new_path2;
                                  $img =1;
                              }
                              
                              if (File::exists($usersImageP)) { // unlink or remove previous image from folder
                                $move = File::move($usersImageP, $new_pathP);
                                $usuarioCLIreset->avatar = $new_path2P;
                                $img =1;
                            }
                             
                            //endimg
                            $usuarioCLIreset->save();
                            if ($request->filled('nome')) {
                                if($usuario->name !== $request->get('nome') && $usuario->email !== $request->get('email')){
                                    if($img === 1){
                                        $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário, email e avatar no dia de {$hojeFormatado} através do ip:{$ip}";
                                        self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                        notify()->success('Nome, email e avatar alterados com sucesso ⚡️', 'Sucesso');
                                   
                                    }else{
                                        $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário e email no dia de {$hojeFormatado} através do ip:{$ip}";
                                        self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                       
                                        notify()->success('Nome e email alterado com sucesso ⚡️', 'Sucesso');
                            
                                    }
                                   
                                   
                                }else{
                                    if($usuario->name !== $request->get('nome')){
                                        if($img === 1){
                                            $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário e avatar no dia de {$hojeFormatado} através do ip:{$ip}";
                                            self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                           
                                            notify()->success('Nome e avatar alterado com sucesso ⚡️', 'Sucesso');
                           
                                        }else{
                                            $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário no dia de {$hojeFormatado} através do ip:{$ip}";
                                            self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                           
                                            notify()->success('Nome  alterado com sucesso ⚡️', 'Sucesso');
                           
                                        }
                                       
                                    } else if($usuario->email !== $request->get('email')){
                                        if($img === 1){
                                            $textoMg = "Nosso sistema confirmou a alteração email e avatar no dia de {$hojeFormatado} através do ip:{$ip}";
                                            self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                           
                                            notify()->success('Email e avatar alterado com sucesso ⚡️', 'Sucesso');
                           
                                        }else{
                                            $textoMg = "Nosso sistema confirmou a alteração do email no dia de {$hojeFormatado} através do ip:{$ip}";
                                            self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                           
                                            notify()->success('Email  alterado com sucesso ⚡️', 'Sucesso');
                           
                                        }
                                       
                                    }
                                    else{
                                        notify()->error('Operação cancelada - Nada para salvar ⚡️', 'Sucesso');
                           
                                    }
                                   
                                }
                            }
                            
                            return redirect()->back();
                        }
                       
                    }
                   
                }else{
                    notify()->error('Erro ao confirmar senha atual na base de dados⚡️', 'Falha');
                    return Redirect::back()->withErrors($validator)->with('autofocus', true);
                  
                }
           
           
           
    
        }else{
            notify()->error('Operação ilegal⚡️', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
         
        }
        }else{
            
            if ($request->filled('email')){
                if($naoAlteraMail>0){
                    notify()->error('Erro ao completar sua operação - Email em uso⚡️', 'Falha');
                    return Redirect::back()->withErrors($validator)->with('autofocus', true);
                }else{
                    if($emailUsuario>0){
                        notify()->error('Para sua segurança o sistema negou esta operação. Você deve confirmar sua senha atual antes ⚡️', 'Falha');
                        return Redirect::back()->withErrors($validator)->with('autofocus', true);
        
                       
                       }else{
                        if ($request->filled('senha')){ 
                            if ($request->filled('nome')){
                                if($usuario->name !== $request->get('nome')){
                                    $usuarioCLIreset = User::find(Auth::id());
                                    $usuarioCLIreset->name = $request->get('nome');
                                         //image
                                       //jpg
                                       $filename = 'temp'.Auth()->user()->id.'.jpg';
                                       $filename2 = 'user'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                                       $usersImage =storage_path('app/public/tempupload/'.$filename);
                                       $new_path = storage_path('app/public/users/'.$filename2);
                                       $new_path2 = 'users/'.$filename2;
                                       //png
                                       $filenameP = 'temp'.Auth()->user()->id.'.png';
                                       $filename2P = 'user'.Auth()->user()->id.'-'.time().'0'.'.png';
                                       $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                                       $new_pathP = storage_path('app/public/users/'.$filename2P);
                                       $new_path2P = 'users/'.$filename2P;
                            
                                       $usersImageDEL =storage_path('app/public/'.$usuarioCLIreset->avatar);
                                       if (File::exists($usersImageDEL)) { // unlink or remove previous image from folder
                                           File::delete($usersImageDEL);
                                        
                                       }

                              if (File::exists($usersImage)) { // unlink or remove previous image from folder
                                  $move = File::move($usersImage, $new_path);
                                  $usuarioCLIreset->avatar = $new_path2;
                                  $img =1;
                              }
                              
                              if (File::exists($usersImageP)) { // unlink or remove previous image from folder
                                $move = File::move($usersImageP, $new_pathP);
                                $usuarioCLIreset->avatar = $new_path2P;
                                $img =1;
                            }
                             
                            //endimg
                                    $usuarioCLIreset->save();
                                    
                                    if($img === 1){
                                        $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário e seu avatar e rejeitou a criação de uma nova senha(Senha atual inválida) no dia de {$hojeFormatado} através do ip:{$ip}";
                                        self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                       
                                        notify()->success('Nome  e avatar alterados com sucesso -* Nova senha não foi cadastrada pois você não confirmou a senha atual ⚡ ⚡️', 'Sucesso');
                                   
                                    }else{
                                        $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário e rejeitou a criação de uma nova senha(Senha atual inválida) no dia de {$hojeFormatado} através do ip:{$ip}";
                                        self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                       
                                        notify()->success('Nome alterado com sucesso -* Nova senha não foi cadastrada pois você não confirmou a senha atual ⚡️', 'Sucesso');
                                  
                                    }
                                    return redirect()->back();
                                }else{
                                    notify()->error('Para sua segurança o sistema não autorizou esta operação. Você não confirmou sua senha atual', 'Falha');
                                    return Redirect::back()->withErrors($validator)->with('autofocus', true);
                    
                                }
                            }
                                else{
                                    notify()->error('Para sua segurança o sistema não autorizou esta operação. Você não confirmou sua senha atual', 'Falha');
                                    return Redirect::back()->withErrors($validator)->with('autofocus', true);
                    
                                }
                            
                        }else{
                            if ($request->filled('nome')){
                                if($usuario->name !== $request->get('nome')){
                                    $usuarioCLIreset = User::find(Auth::id());
                                    $usuarioCLIreset->name = $request->get('nome');
                                         //image
                                       //jpg
                                       $filename = 'temp'.Auth()->user()->id.'.jpg';
                                       $filename2 = 'user'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                                       $usersImage =storage_path('app/public/tempupload/'.$filename);
                                       $new_path = storage_path('app/public/users/'.$filename2);
                                       $new_path2 = 'users/'.$filename2;
                                       //png
                                       $filenameP = 'temp'.Auth()->user()->id.'.png';
                                       $filename2P = 'user'.Auth()->user()->id.'-'.time().'0'.'.png';
                                       $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                                       $new_pathP = storage_path('app/public/users/'.$filename2P);
                                       $new_path2P = 'users/'.$filename2P;
                            
                                       $usersImageDEL =storage_path('app/public/'.$usuarioCLIreset->avatar);
                                       if (File::exists($usersImageDEL)) { // unlink or remove previous image from folder
                                           File::delete($usersImageDEL);
                                        
                                       }

                              if (File::exists($usersImage)) { // unlink or remove previous image from folder
                                  $move = File::move($usersImage, $new_path);
                                  $usuarioCLIreset->avatar = $new_path2;
                                  $img =1;
                              }
                              
                              if (File::exists($usersImageP)) { // unlink or remove previous image from folder
                                $move = File::move($usersImageP, $new_pathP);
                                $usuarioCLIreset->avatar = $new_path2P;
                                $img =1;
                            }
                             
                            //endimg
                                    $usuarioCLIreset->save();
                                    
                                    if($img === 1){
                                        $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário e seu avatar no dia de {$hojeFormatado} através do ip:{$ip}";
                                        self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                       
                                        notify()->success('Nome  e avatar alterados com sucesso⚡️', 'Sucesso');
                                   
                                    }else{

                                        $textoMg = "Nosso sistema confirmou a alteração do seu nome de usuário no dia de {$hojeFormatado} através do ip:{$ip}";
                                        self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                        notify()->success('Nome alterado com sucesso ⚡️', 'Sucesso');
                                   
                                    }
                                    return redirect()->back();
                                }else{
                                    $usuarioCLIreset = User::find(Auth::id());
                                       //image
                                       //jpg
                                       $filename = 'temp'.Auth()->user()->id.'.jpg';
                                       $filename2 = 'user'.Auth()->user()->id.'-'.time().'0'.'.jpg';
                                       $usersImage =storage_path('app/public/tempupload/'.$filename);
                                       $new_path = storage_path('app/public/users/'.$filename2);
                                       $new_path2 = 'users/'.$filename2;
                                       //png
                                       $filenameP = 'temp'.Auth()->user()->id.'.png';
                                       $filename2P = 'user'.Auth()->user()->id.'-'.time().'0'.'.png';
                                       $usersImageP =storage_path('app/public/tempupload/'.$filenameP);
                                       $new_pathP = storage_path('app/public/users/'.$filename2P);
                                       $new_path2P = 'users/'.$filename2P;
                            
                                       $usersImageDEL =storage_path('app/public/'.$usuarioCLIreset->avatar);
                                       if (File::exists($usersImageDEL)) { // unlink or remove previous image from folder
                                           File::delete($usersImageDEL);
                                        
                                       }
                              if (File::exists($usersImage)) { // unlink or remove previous image from folder
                                  $move = File::move($usersImage, $new_path);
                                  $usuarioCLIreset->avatar = $new_path2;
                                  $img =1;
                              }
                              
                              if (File::exists($usersImageP)) { // unlink or remove previous image from folder
                                $move = File::move($usersImageP, $new_pathP);
                                $usuarioCLIreset->avatar = $new_path2P;
                                $img =1;
                            }
                             
                            //endimg
                            $usuarioCLIreset->save();
                            if($img === 1){
                                $textoMg = "Nosso sistema confirmou a alteração do seu avatar no dia de {$hojeFormatado} através do ip:{$ip}";
                                self::notificacoesBase($sub,$gree,$textoMg,':)',Auth()->user()->id);
                                       
                                notify()->success('Avatar salvo com sucesso!⚡️', 'Sucesso');
                                return redirect()->back();
                             
                            }else{
                                notify()->error('Erro ao completar sua operação- Nada para salvar ⚡️', 'Falha');
                                return Redirect::back()->withErrors($validator)->with('autofocus', true);
                     
                            }
                                   
                                }
                            }else{
                                notify()->error('Erro ao completar sua operação- Nada para salvar3⚡️', 'Falha');
                                return Redirect::back()->withErrors($validator)->with('autofocus', true);
                        
                            }
                           
                        }
                        
                    }
                   
                }
            }else{
                notify()->error('Erro ao completar sua operação - Não há novo email ou senha para salvar⚡️', 'Falha');
                return Redirect::back()->withErrors($validator)->with('autofocus', true);
            
            }
          
        }
    
   
    
   
}
}
