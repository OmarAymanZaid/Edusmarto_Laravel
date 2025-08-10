<x-adminMain>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <h1 class="text-3xl font-medium mb-3">Update</h1>
    <hr class="mb-3">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="User Name . . ." name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="user@gmail.com" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="roleID">Role</label>
            <select id="roleID" name="roleID" required>
                <option value="" disabled selected>Select your role</option>
                <option {{ old('roleID', $user->roleID) == '1' ? 'selected' : '' }} value="1">Admin</option>
                <option {{ old('roleID', $user->roleID) == '2' ? 'selected' : '' }} value="2">Student</option>
                <option {{ old('roleID', $user->roleID) == '3' ? 'selected' : '' }} value="3">Teacher</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-adminMain>