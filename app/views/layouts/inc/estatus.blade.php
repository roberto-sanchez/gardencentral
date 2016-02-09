   @if(Session::has('messageOK'))
      <div class="alert alert-success fade in">
      <button class="close" data-dismiss="alert" type="button">
          <span class="glyphicon glyphicon-remove"></span>
      </button>
        {{ Session::get('messageOK') }}
      </div>
    @endif

   @if(Session::has('messageDanger'))
      <div class="alert alert-danger fade in">
      <button class="close" data-dismiss="alert" type="button">
          <span class="glyphicon glyphicon-remove"></span>
      </button>
        {{ Session::get('messageDanger') }}
      </div>
    @endif

  