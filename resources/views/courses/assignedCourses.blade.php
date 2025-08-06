<x-teacherMain>
    <h1 class="text-4xl font-medium">Assinged Courses</h1>

    <a href="{{ route('courses.toApplyList') }}" class="btn btn-success my-4">Discover More</a> <br>

    @if ($courses->isEmpty())
        No Courses Assigned To You        
    
    @else
        <div class="d-flex flex-wrap gap-3">
            @foreach ($courses as $course)
                <div class="card" style="width: 22rem; height: 100%;">

                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top object-fit-cover" alt="course-image" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-xl font-medium">{{ $course->name }}</h5>
                        
                        <div class="mt-3">

                            <a href="{{ route('announcements.showAnnouncementForm', $course->ID) }}" class="btn btn-outline-success my-4">Announce</a>
                            <form action="{{ route('courses.cancelTeaching', $course->ID) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger mt-auto">Cancel</button>
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
    
</x-teacherMain>