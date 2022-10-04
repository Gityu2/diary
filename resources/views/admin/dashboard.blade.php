@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('style')
    <link href="{{ mix('css/table.css') }}" rel="stylesheet">
    <link href="{{ mix('css/dashboard.css') }}" rel="stylesheet">
@endsection
    
@section('content')
    <div class="container px-5 mt-3">
        <h1 class="mb-0">User list</h1>
        <div class="card text-center pb-0 mx-auto text-nowrap">
            <div class="card-body py-3 display-6 fw-bold"><span class="text-primary">{{ $users->total() }}</span> Users</div>
        </div>
        <div class="table-responsive">

            <table class="table small text-center mt-3 text-nowrap">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th class="col-2">Name</th>
                        <th class="col-3">Email</th>
                        <th class="col-1">Entries</th>
                        <th class="col-2">Start date</th>
                        <th class="col-1">Status</th>
                        <th class="col-2">Action</th>
                        <th class="col-1 text-danger">Danger</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }} </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->countEntry($user->id) }}</td>
                            <td>{{ date('Y-n-j', strtotime($user->created_at)) }}</td>
                            <td>
                                @if ($user->deleted_at)
                                    <p class="text-danger p-0 m-0">Deactive</p>
                                @else
                                    <p class="text-primary p-0 m-0">Active</p>
                                @endif
                            </td>
                            <td>
                                @if ($user->deleted_at)
                                    <a href="{{ route('admin.restore', $user->id) }}" class="text-primary p-0 m-0 ms-2 text-decoration-none"><i class="fa-solid fa-user-large me-1"></i>Activate</a>
                                @else
                                    <button class="text-danger bg-white border-0" data-bs-toggle="modal" data-bs-target="#delete-day-{{ $user->id }}">
                                        <i class="fa-solid fa-user-large-slash me-1"></i>Deactivate               
                                    </button>
                                    @include('admin.modal.status')
                                    @endif
                                </td>
                            <td>
                                <button class="text-danger bg-white border-0" data-bs-toggle="modal" data-bs-target="#force-delete-account">
                                    <i class="fa-sharp fa-solid fa-circle-exclamation me-1"></i>Delete            
                                </button>
                                @include('admin.modal.force')
    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
        @if (count($users) >0)
            <p>  
                {{  ($users->currentPage() -1) * $users->perPage() + 1}} - 
                {{ (($users->currentPage() -1) * $users->perPage() + 1) + (count($users) -1)  }} users display out of {{ $users->total() }}
            </p>   
        @endif
    </div>
    </div>
@endsection


