<x-adminMain>
    <div class="card mb-4" style="max-width: 900px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid rounded-start" alt="course-image" style="height: 100%; object-fit: cover; border:1px solid black;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title text-3xl font-medium">{{ $course->name }}</h5>
                    <div>
                        <p class="card-text text-xl">{{ $course->description }}</p>
                        <br>
                        <p class="card-text text-lg"> Category: {{ $course->category?->name ?? 'missing' }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
</x-adminMain>