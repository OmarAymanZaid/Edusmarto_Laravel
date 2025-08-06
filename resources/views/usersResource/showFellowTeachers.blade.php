<x-teacherMain>
    <h1 class="text-4xl font-medium">Teachers</h1> <br>

    @if ($teachers->count() === 0)
        There Are No Teachers        
    
    @else
        <div class="d-flex flex-wrap gap-3">
            @foreach ($teachers as $teacher)
                <div class="card" style="width: 22rem; height: 100%;">
                    <img src="{{ asset('storage/' . $teacher->photo) }}" class="card-img-top object-fit-cover" alt="teacher-image" style="height: 390px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-xl font-medium">{{ $teacher->name }}</h5>
                        
                        <div class="mt-3">
                            <a href="{{ route('fellowTeachers.show', $teacher->id) }}" class="btn btn-outline-primary mt-auto">Profile</a>
                            <a href="{{ route('fellowTeachers.evaluate', $teacher->id) }}" class="btn btn-outline-primary mt-auto">Evaluate</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
</x-teacherMain>