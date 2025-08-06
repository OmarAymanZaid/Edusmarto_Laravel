@php
    if(Auth::user()->roleID == config('constants.role.ADMIN'))
        $view = 'adminMain';
    elseif(Auth::user()->roleID == config('constants.role.STUDENT'))
        $view = 'studentMain';
    elseif(Auth::user()->roleID == config('constants.role.TEACHER'))
        $view = 'teacherMain';
@endphp

<x-dynamic-component :component="$view">

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-image">
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Image">
                <form action="{{ route('user.profileChangeImage') }}" method="POST" enctype="multipart/form-data" style="display:inline-block;">
                    @csrf
                    <label for="photo-upload" class="btn btn-primary" style="margin-top: 14px">Change Photo</label>
                    <input type="file" id="photo-upload" name="photo" style="display: none;" onchange="this.form.submit()">
                </form>
                <form action="{{ route('user.profileRemoveImage') }}" method="POST" enctype="multipart/form-data" style="display:inline-block;">
                    @csrf
                    <input type="hidden" name="photo" value="images/anonymousIcon.jpg">
                    <button type="submit" class="btn btn-danger" style="margin-top: 14px;">Remove Photo</button>
                </form>


            </div>
            <div class="profile-info">
                <h2>{{ Auth::user()->name }}</h2>
                <p>Email: {{ Auth::user()->email }}</p>
                <p>Role: {{ Auth::user()->role?->name ?? 'missing' }}</p>

                <form action="{{ route('user.profileChangeName') }}" method="POST" class="name-form">
                    @csrf
                    <input type="text" name="name" value="{{ Auth::user()->name }}">
                    <button type="submit">Update Name</button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

</x-dynamic-component>