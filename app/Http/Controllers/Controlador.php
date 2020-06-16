<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Settings;
use Illuminate\Support\Facades\Redirect;
use App\Footer;
use App\Page;
use App\Contato;

class Controlador extends Controller
{
    //
    public function index()
    {
        
        $numeroPosts = Settings::where('key', 'configuracoes-de-post.numero')->first();
        $estiloP = Settings::where('key', 'configuracoes-de-post.paginacao')->first();
        $ordem = Settings::where('key', 'configuracoes-de-post.ordem')->first();
        if(!empty($numeroPosts->value)){
            if($estiloP->value ==='0'){
                 if($ordem->value ==='0'){
                    $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->simplepaginate($numeroPosts->value);
                 }else{
                    $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->simplepaginate($numeroPosts->value);
               
                 }
               
            }else{
                if($ordem->value ==='0'){
                    $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate($numeroPosts->value);
                }else{
                    $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->paginate($numeroPosts->value);
                }
            }
           
        }
        else{
            if($estiloP->value ==='0'){
                if($ordem->value ==='0'){
                    $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->simplepaginate(4);
                }else{
                    $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->simplepaginate(4);
                }
            }else{
                if($ordem->value ==='0'){
                    $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(4);
                }else{
                    $posts = Post::orderBy('id', 'ASC')->where('status', 'PUBLISHED')->paginate(4);
                }
            }
            
        }
        $tituloSite = Settings::where('key', 'site.title')->first();
        $subtituloSite = Settings::where('key', 'site.description')->first();
        $capaInicial = Settings::where('key', 'site.site.capa')->first();
        $capaInicialCor = Settings::where('key', 'site.site.capacor')->first();
        $on_off = Settings::where('key', 'site.on_off')->first();
        $footer = Footer::all();
        return view('welcome',['posts'=>$posts])->with(compact('on_off','footer','tituloSite','subtituloSite','capaInicial','capaInicialCor'));
    }
    public function i404()
    {
      
        return view('404');
    }
    public function paginas($slug)
    {
        $pagina = Page::where('slug',$slug)->first();
        $tituloSite = Settings::where('key', 'site.title')->first();
        $footer = Footer::all();
        if(!empty($pagina)){
            if($pagina->status ==="ACTIVE")
            return view('paginas',['pagina'=>$pagina])->with(compact('tituloSite','footer'));
            else
            return Redirect::route('404');
        }else{
            return Redirect::route('404');
        }
    }
    public function posts($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $tituloSite = Settings::where('key', 'site.title')->first();
        $disqus = Settings::where('key', 'site.disqus')->first();
        $footer = Footer::all();
        if(!empty($post)){
            if($post->status ==="PUBLISHED")
            return view('posts',['post'=>$post])->with(compact('tituloSite','footer','disqus'));
            else
            return Redirect::route('404');
        }else{
            return Redirect::route('404');
        }
       

    }
    public function contatos($slug)
    {
     
        $ConfereUrlRelativa = Settings::where('key', 'pagina-contato.slug')->first();
        
        $slug = "/{$slug}";
       
        if($ConfereUrlRelativa->value ===$slug){
            
           // $posts = Post::where('status', 'PUBLISHED')->simplepaginate(10);
            $tituloSite = Settings::where('key', 'site.title')->first();
            $tituloPagina = Settings::where('key', 'pagina-contato.titulo')->first();
            $subtituloSite = Settings::where('key', 'pagina-contato.subtitulo')->first();
            $capaInicial = Settings::where('key', 'pagina-contato.capac')->first();
            $capaInicialCor = Settings::where('key', 'pagina-contato.contatocor')->first();
            $on_offx = Settings::where('key', 'pagina-contato.on_onffx')->first();
            $intro =  Settings::where('key', 'pagina-contato.introducao')->first();
            $status = Settings::where('key', 'pagina-contato.status')->first();
            if($status->value ==='0'){
                $statuscontatos ='ACTIVE';
            }else{
                $statuscontatos ='INACTIVE';
            }
            
            $footer = Footer::all();
            return view('contato')->with(compact('intro','tituloPagina','on_offx','statuscontatos','footer','tituloSite','subtituloSite','capaInicial','capaInicialCor'));
       
        }else{
            return view('404');
        }
     }
    
    public function enviaContato(Request $request){
       
          $validator = \Validator::make($request->all(),[
            'nome'=>'required|max:200',
            'email'=> 'required|email',
            'telefone' => 'required|digits_between:7,12',
            'mensagem' => 'required|max:1000|min:5'
        ]);
          if($validator->fails()) {
            notify()->error('Não foi possivel enviar sua mensagem no momento. Confira os campos digitados ⚡️', 'Falha');
            return Redirect::back()->withErrors($validator)->with('autofocus', true);
        }
          $novoC = new Contato();
          $novoC->nome = $request->get('nome');
          $novoC->email = $request->get('email');
          $novoC->telefone = $request->get('telefone');
          $novoC->mensagem = $request->get('mensagem');
          $novoC->save();
          $verificaSeEhAdm = \App\Role::where('name','!=','user')->get();
          
          $pode = \App\Settings::where('key','site.moderadores-contatos')->first();
          if($verificaSeEhAdm){
              foreach($verificaSeEhAdm as $admModerator){
                $admin = \App\User::where('role_id',$admModerator->id)->first();
                
                if($admin){
                    $ehAdm = \App\Role::find($admin->role_id);
                    if($ehAdm->name ==="admin"){
                        $nome = $request->get('nome');
                            $email = $request->get('email');
                            
                            $textoMg = "Há uma nova mensagem de contato recebida de {$nome} - {$email}";
                            $details = [
                                    'subject' =>'Miniblog - Nova Mensagem de Contato Recebida',
                                    'greeting' => 'Nova mensagem de contato',
                                    'body' => $textoMg,
                                    'thanks' => '',
                            ];
                        
                            $admin->notify(new \App\Notifications\TarefaCompleta($details));
                    }else{
                        if($pode->value==="SIM"){
                            $nome = $request->get('nome');
                            $email = $request->get('email');
                            
                            $textoMg = "Há uma nova mensagem de contato recebida de {$nome} - {$email}";
                            $details = [
                                    'subject' =>'Miniblog - Nova Mensagem de Contato Recebida',
                                    'greeting' => 'Nova mensagem de contato',
                                    'body' => $textoMg,
                                    'thanks' => '',
                            ];
                        
                            $admin->notify(new \App\Notifications\TarefaCompleta($details));
                        }
                    }
                            
                            
                      
                   
                  }
              }
              
              
            }
         // $user9 = \App\User::find($deleta->author_id);
         notify()->success('Mensagem enviada com sucesso ⚡️', 'Sucesso');
             
        
          return redirect()->back();

    }
}
