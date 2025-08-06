<x-teacherMain>
    <h1 class="text-4xl font-medium">Courses</h1> <br>

    @if ($courses->count() === 0)
        No Assigned Courses
    
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($courses as $course)
                    <tr>
                        <td scope="row">{{ $course->name }}</td>
                        <td scope="row">{{ $course->description }}</td>
                        <td scope="row">
                            <a href="{{ route('courses.showUploadedAssignments', $course->ID) }}" class="btn btn-primary">Show Uploaded Assignments</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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