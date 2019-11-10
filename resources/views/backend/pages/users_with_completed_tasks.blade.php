@extends('backend.layout')
@section('content')
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <h3 class="page-title">Users with tasks details</h3>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-body p-0 pb-3 text-center">
          <table class="table table-bordered" >
            <thead class="bg-light">
              <tr>
                <th>User</th>
                <th>Task Details</th>
              </tr>
              @foreach ($users_with_tasks as $user)
              <tr>
                <th width="30%">
                    {{ $user->first_name. " " . $user->last_name }} 
                    ({{ $user->completed_task_point . '/'. $user->total_task_point }})
                </th>                
                <th>
                    {!! $user->task_details !!}
                </th>
              </tr>
               @endforeach
            </thead>
          </table>         
        </div>
      </div>
    </div>
  </div>
  <style type="text/css">
    ul > li {
      text-align: left;

    }
  </style>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      /*$.ajax({
        method: "GET",
        url: '/user-list',
      }).done(function( response ) { console.log(response);
          let tr;
          $.each(response, function(index, user) {console.log(user);
          tr  += [
            '<tr>',
              '<td>' + user.first_name + '</td>',
              '<td>' + user.first_name + '</td>',
              '<td>' + user.first_name + '</td>',
              '<td>' + user.first_name + '</td>',
            '</tr>'
            ].join('');               
          });
          $('#user-list').html(tr);
      }).fail(function( jqXHR, textStatus ) {
          console.log( "Request failed: " + textStatus );
      });*/
    });
  </script>
@endsection