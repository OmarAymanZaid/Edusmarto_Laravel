<x-adminMain>
    <h1 class="text-4xl font-medium">Users</h1>

    <a href="{{ route('user.create') }}" class="btn btn-success my-4">Add Users</a>

    @if ($users->count() === 0)
        There is no users available        
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{$user->email }}</td>
                        <td>{{ $user->role?->name ?? 'missing' }}</td>
                        <td>
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('notifications.edit', $user->id) }}" class="btn btn-warning">Notifiy</a>
                            <button type="button"
                                    class="btn btn-danger open-delete-modal"
                                    data-form="#deleteUserForm{{ $user->id }}"
                                    data-name="User '{{ $user->name }}'">
                                Delete
                            </button>
                            <form id="deleteUserForm{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-deleteModal />
    
</x-adminMain>