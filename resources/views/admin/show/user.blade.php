@extends('layouts.app')

@section('title', 'Admin Dashboard')
    
@section('content')
    <div class="container px-5 mt-3">
        <h1>User list</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Entries</th>
                    <th>Start date</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th class="text-danger">Danger</th>
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
        {{ $users->links() }}
    </div>
@endsection


