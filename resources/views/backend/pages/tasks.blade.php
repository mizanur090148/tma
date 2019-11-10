@extends('backend.layout')
@section('content')
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">      
      <h3 class="page-title">task</h3>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          {{-- <h6 class="m-0">Fund Transfer List</h6> --}}
          <a class="btn btn-sm btn-info" href="{{ url('task/create') }}">
            <i class="glyphicon glyphicon-plus"></i> New task
          </a>
        </div>
        <span class="js-response-message text-center"></span>

        <div class="card-body p-0 pb-3 text-center">
          <table class="table table-sm">
            <thead class="bg-light">
              <tr>
                <th>#</th>
                <th style="color: green">Parent</th>
                <th>Title</th>
                <th>Point</th>
                <th>User</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="task-list">
              @forelse($tasks as $task)
                <tr>
                  <td>{{ $loop->iteration }}</td> 
                  <td style="color: green">{{ $task->parent->title ?? '' }}</td>
                  <td>{{ $task->title }}</td>
                  <td>{{ $task->points }}</td>
                  <td>{{ $users[$task->user_id] }}</td>
                  <td>
                    <button type="button" class="btn btn-sm {{ ($task->is_done == 0) ? 'btn-info task-done-btn' : 'btn-success' }}" value="{{ $task->id }}">{{ ($task->is_done == 0) ? 'Click To Done' : 'Done' }} </button>
                  </td>
                  <td>
                    <a class="btn btn-info btn-sm" href="{{ url('/task/'.$task->id.'/edit') }}">Edit</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-danger">Not Found</td>
                </tr>
              @endforelse
            </tbody>            
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    /*$(document).ready(function() {
      $.ajax({
        method: "GET",
        url: 'api/task',
      }).done(function( response ) { console.log(response);
          let tr;
          $.each(response.data, function(index, user) {
          tr  += [
            '<tr>',
              '<td>' + user.title + '</td>',
              '<td>' + user.title + '</td>',
              '<td>' + user.title + '</td>',
              '<td>' + user.points + '</td>',
            '</tr>'
            ].join('');
          });
          $('#task-list').html(tr);
      }).fail(function( jqXHR, textStatus ) {
          console.log( "Request failed: " + textStatus );
      });
    });*/
    $(document).on('click', '.task-done-btn', function() {
      let current = $(this);      
      let id = current.val();
      var token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        method: 'PUT',
        url: '/api/task-status-update/' + id,
        data: { status: 1, _token: token },
        success: function (response, textStatus, xhr) {
          if (xhr.status == 200) {
            current.removeClass('btn-info task-done-btn').addClass('btn-success').html('Done');
            $('.js-response-message')
              .html(getMessage('Successfully updated', 'success'))
              .fadeIn()
              .delay(2000)
              .fadeOut(2000);
          }
        },error: function(response) {
          $('.js-response-message').html(getMessage('Not successfully updated', 'error')).fadeIn().delay(2000).fadeOut(2000);
        }
      });
    });  
  </script>
@endsection