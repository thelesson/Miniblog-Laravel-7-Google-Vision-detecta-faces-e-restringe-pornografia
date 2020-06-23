
@foreach($items as $menu_item)
         <li class="nav-item">
         @php $page =  \App\Page::where('slug',$menu_item->url)->first(); @endphp
          @if(!empty($page))
          @if($page->status ==='ACTIVE')
            <a class="nav-link" target="{{ $menu_item->target }}" href="/pagina/{{ $menu_item->url }}">{{ $menu_item->title }}</a>
            @endif
            @endif
           
           
          </li>
          
        @php $status = \App\Settings::where('key', 'pagina-contato.status')->first();
             $slugz   = \App\Settings::where('key', 'pagina-contato.slug')->first();
         @endphp
          @if(!empty($status) && !empty($slugz))
          
            @if($status->value ==='ACTIVE' && $menu_item->url ===$slugz->value)
            
            <li class="nav-item">
            <a class="nav-link" target="{{ $menu_item->target }}" href="/paginas{{ $menu_item->url }}">{{ $menu_item->title }}</a>

            </li>
            @endif
           @endif

           
           @if(empty($page) )
           @if($menu_item->url !==$slugz->value)
           <li class="nav-item">
            <a class="nav-link" target="{{ $menu_item->target }}" href="{{ $menu_item->url }}">{{ $menu_item->title }}</a>

            </li>
            @endif
           @endif
    @endforeach