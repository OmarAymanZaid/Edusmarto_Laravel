<x-adminMain>
    <h1 class="text-4xl font-medium">Courses</h1>

    <a href="{{ route('courses.create') }}" class="btn btn-success my-4">Add Course</a> <br>

    <div class="mb-8">
        @if ($courses->isEmpty())
            There is no courses available        
        
        @else
            <div class="d-flex flex-wrap gap-3">
                @foreach ($courses as $course)
                    <div class="card" style="width: 22rem; height: 100%;">
                        {{ $course->photo }}
                        <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top object-fit-cover" alt="course-image" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-xl font-medium">{{ $course->name }}</h5>
                            
                            <div class="mt-3">
                                <a href="{{ route('courses.show' , $course->ID ) }}" class="btn btn-outline-success mt-auto">View</a>
                                <a href="{{ route('courses.edit', $course->ID) }}" class="btn btn-outline-primary mt-auto">Update</a>
                                <div style="display: inline;">
                                    <button type="button"
                                            class="btn btn-outline-danger open-delete-modal"
                                            data-form="#deleteCourseForm{{ $course->ID }}"
                                            data-name="User '{{ $course->name }}'"
                                            >
                                        Delete
                                    </button>
                                    <form id="deleteCourseForm{{ $course->ID }}" action="{{ route('courses.destroy', $course->ID) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-deleteModal />
    
</x-adminMain>