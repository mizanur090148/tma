@extends('backend.layout')
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">
        <h6 class="m-0">Task</h6>
      </div>
      <span class="js-response-message text-center"></span>
      <div class="card-body p-0 pb-3">
        <div class="row p-3">
        <div class="col-sm-4 offset-sm-4">
          {!! Form::model($task, ['url' => $task ? 'api/task/'.$task->id : 'api/task', 'method' => $task ? 'PUT' : 'POST','id' => 'taskForm']) !!}
            <div class="form-group">
              <label class="">Parent Task</label>
              {!! Form::select('parent_id', $tasks ?? [], null, ['class' => 'form-control', 'placeholder' => 'Select a task']) !!} 
              <span class="parent_id"></span>           
            </div>
            <div class="form-group">
              <label class="">Title</label>
              {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter a title']) !!}
              <span class="title"></span>
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Points</strong>
              {!! Form::text('points', null, ['class' => 'form-control', 'placeholder' => 'Enter points']) !!}
              <span class="points"></span>
            </div>            
            <div class="form-group">
              <label class="">User</label>
              {!! Form::select('user_id', $users ?? [], null, ['class' => 'form-control', 'placeholder' => 'Select a user']) !!}
              <span class="user_id"></span>
            </div>
            @if($task)
              <div class="form-group">
                <label class="">Is Done?</label>
                {!! Form::select('is_done', [0 => 'Not Done', 1 => 'Done'], null, ['class' => 'form-control', 'placeholder' => 'Select a user']) !!}
                <span class="user_id"></span>
              </div>
            @endif
            <div class="form-group">        
              {!! Form::button('Submit', ['class' => 'btn btn-primary task-save-btn']) !!}
            </div>
          {!! Form::close() !!}
        </div>
        </div>      
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).on('click', '.task-save-btn', function() {
      let current = $(this);
      current.attr('disabled', true);      
      let method = $("#taskForm").attr('method');
      let action = $("#taskForm").attr('action');
      let input = $("#taskForm").serialize();

      $.ajax({
        method: method,
        url: action,
        data: input,
        success: function (data, textStatus, xhr) {
          current.removeAttr('disabled');
          if (xhr.status == 201 || xhr.status == 200) {
            $('.js-response-message').html(getMessage('Operation successfully done', 'success')).fadeIn().delay(2000).fadeOut(2000);
            window.location.href = "/tasks";
          }
        },error: function(response) {
          current.removeAttr('disabled');
          $('.text-danger').empty();
          $.each(response.responseJSON.errors, function(key, index) {
            let inputFieldAndRow = key.split(".");            
            $('.'+key).addClass('text-danger').html(index);            
          });
        }
      });
    });  
  </script>
@endsection