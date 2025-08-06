<x-main>

    <h1 class="text-4xl font-medium">Users</h1>

    <button class="btn btn-success my-4">Add Users</button>

    @if (empty($users))
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
                        <td>{{ $user->roleID }}</td>
                        <td>
                            <a href="" class="btn btn-info">View</a>
                            <a href="" class="btn btn-primary">Edit</a>
                            <a href="" class="btn btn-warning">Notifiy</a>
                            <form action="" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif

</x-main>