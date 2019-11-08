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
        @include('backend.partials.response_message')

        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TaskModalLong">
          Launch demo modal
        </button> --}}

        <div class="card-body p-0 pb-3 text-center">
          <table class="table table-sm">
            <thead class="bg-light">
              <tr>
                <th>#</th>
                <th>Parent</th>
                <th>Title</th>
                <th>Point</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="task-list">
              @forelse($tasks as $task)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $task->parent->title }}</td>
                  <td>{{ $task->title }}</td>
                  <td>{{ $task->points }}</td>
                  <td><a href="{{ url('/task/'.$task->id.'/edit') }}">Edit</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-danger">Not Found</td>
                </tr>
              @endforelse
            </tbody>            
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="TaskModalLong" tabindex="-1" role="dialog" aria-labelledby="TaskModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TaskModalLongTitle">Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <alert-error :form="form" class="text-center"></alert-error>            
                    <div class="form-group">
                        <label>Name</label>
                        <input v-model="form.name" type="text" name="name"
                        class="form-control">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="form.email" type="email" name="email"
                        class="form-control">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input v-model="form.phone" type="tel" name="phone"
                        class="form-control">
                        <has-error :form="form" field="phone"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea v-model="form.address" name="address"
                        class="form-control"></textarea>
                        <has-error :form="form" field="address"></has-error>
                    </div>

                    <div class="form-group">
                        <label>Total</label>
                        <input v-model="form.total" type="text" name="total"
                            class="form-control">
                            <has-error :form="form" field="total"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button :disabled="form.busy" type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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
  </script>
@endsection