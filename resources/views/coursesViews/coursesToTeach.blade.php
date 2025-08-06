<x-teacherMain>
    <h1 class="text-4xl font-medium">Courses</h1> <br>

    <a href="{{ route('courses.assignedCourses') }}" class="btn btn-success mb-4">Assigned Courses</a> <br>

    @if ($courses->count() === 0)
        No courses available        
    
    @else
        <div class="d-flex flex-wrap gap-3">
            @foreach ($courses as $course)
                <div class="card" style="width: 22rem; height: 100%;">
                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top object-fit-cover" alt="course-image" style="height: 200px; object-fit: cover; border: 1px solid black;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-xl font-medium">{{ $course->name }}</h5>
                        
                        <div class="mt-3">
                            <form action="{{ route('courses.teach', $course->ID) }}" method="POST" style="display: inline">
                                @csrf

                                <button class="btn btn-outline-primary mt-auto">Teach</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
</x-teacherMain>