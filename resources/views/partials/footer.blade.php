<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
          @if(!empty($footer))
          @foreach($footer as $f)
            <li class="list-inline-item">
              <a href="{{$f->url}}" @if(!empty($f->target)) target="_blank" @endif>
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="{{$f->icone}} fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            @endforeach
            @endif
          </ul>
          <p class="copyright text-muted">Copyright &copy; 2020 - Frontend by Start Bootstrap and Backend by Thélesson de Souza</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('frontend/js/clean-blog.min.js') }}"></script>
  @notifyJs

