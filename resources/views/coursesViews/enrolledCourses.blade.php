<x-studentMain>
    <h1 class="text-4xl font-medium">Enrolled Courses</h1>

    <a href="{{ route('courses.studentsIndex') }}" class="btn btn-success my-4">Discover More</a> <br>

    @if ($courses->isEmpty())
        No Courses Enrolled        
    
    @else
        <div class="d-flex flex-wrap gap-3">
            @foreach ($courses as $course)
                <div class="card" style="width: 22rem; height: 100%;">

                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top object-fit-cover" alt="course-image" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-xl font-medium">{{ $course->name }}</h5>
                        
                        <div class="mt-3">
                            <a href="{{ route('material.courseMaterial', $course->ID) }}" class="btn btn-outline-success mt-auto">Material</a>
                            <form action="{{ route('courses.drop', $course->ID) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger mt-auto">Drop</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-6" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
</x-studentMain>