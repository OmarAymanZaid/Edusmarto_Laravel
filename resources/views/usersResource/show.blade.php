<x-dynamic-component :component="$userView">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-image">
                <img src="{{ asset('storage/' . $user->photo) }}" alt="User Image">
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p>Email: {{ $user->email }}</p>
                <p>Role: {{ $user->role?->name ?? 'missing' }}</p>
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