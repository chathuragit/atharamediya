@if (Session::has('message') && Session::get('message'))
    <div class="alert alert-{{(Session::get('is_error')) ? 'danger' : 'success'}} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>{!!  (Session::get('is_error')) ? '<i class="icon fa fa-close"></i> An error occurred!' : '<i class="icon fa fa-check"></i> Success!'  !!}</h4>
        {{Session::get('message')}}
    </div>
@endif