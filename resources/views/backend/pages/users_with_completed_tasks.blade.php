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
        {{-- <div class="card-header border-bottom">   
          <a class="btn btn-sm btn-info" href="{{ url('deposit/create') }}">
            <i class="glyphicon glyphicon-plus"></i> New Task
          </a>
        </div> --}}
        @include('backend.partials.response_message')

        <div class="card-body p-0 pb-3 text-center">
          {{-- <ul style="width:300px">
            @foreach ($all_parent_tasks as $parent)
                <li>{{ $parent->title }}
                  <ul>
                  @foreach ($parent->sub_tasks as $sub_tasks)
                      @include('backend.pages.sub_tasks', ['sub_tasks' => $sub_tasks])
                  @endforeach
                  </ul>
                </li>
            @endforeach
          </ul> --}}

          <table class="table table-bordered" style="width:600px">
            <thead class="bg-light">
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



          {{-- <table class="table table-sm">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">First Name</th>     
                <th scope="col" class="border-0">Last Name</th>
                <th scope="col" class="border-0">E-mail</th>
              </tr>
            </thead>
            <tbody id="user-list">
              
          </table> --}}
        </div>
      </div>
    </div>
  </div>
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