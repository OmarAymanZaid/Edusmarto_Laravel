<x-studentMain>
    <h1 class="text-4xl font-medium">Upload Assignments</h1> <br>

    @if ($courses->count() === 0)
        No Enrolled Courses
    
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Course</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($courses as $course)
                    <tr>
                        <td scope="row">{{ $course->name }}</td>
                        <td scope="row">{{ $course->description }}</td>
                        <td>
                            <form action="{{ route('assingments.store', $course->ID) }}" method="POST" style="display: inline" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <input class="form-control" type="file" id="formFile" name='assignment' required>
                                </div>       

                                <button class="btn btn-primary">Upload</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
</x-studentMain>