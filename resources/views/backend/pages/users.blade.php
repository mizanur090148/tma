@extends('backend.layout')
@section('content')
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <h3 class="page-title">User List</h3>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        {{-- <div class="card-header border-bottom">   
          <a class="btn btn-sm btn-info" href="{{ url('user/create') }}">
            <i class="glyphicon glyphicon-plus"></i> New User
          </a>
        </div> --}}
        @include('backend.partials.response_message')

        <div class="card-body p-0 pb-3 text-center">
          <table class="table table-sm">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">First Name</th>     
                <th scope="col" class="border-0">Last Name</th>
                <th scope="col" class="border-0">E-mail</th>
              </tr>
            </thead>
            <tbody id="user-list">             
              @forelse ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->first_name }}</td>
                  <td>{{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-danger">Not found</td>
                </tr>
              @endforelse
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection