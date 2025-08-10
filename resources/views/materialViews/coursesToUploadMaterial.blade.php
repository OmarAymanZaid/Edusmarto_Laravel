<x-teacherMain>
    <h1 class="text-4xl font-medium">Courses</h1> <br>

    @if ($courses->count() === 0)
        No Courses Available
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($courses as $index => $course)
                    <tr>
                        <td scope="row">{{ $index + 1 }}</th>
                        <td scope="row">{{ $course->name }}</th>
                        <td scope="row">{{ $course->description }}</th>
                        <td>
                            <form action="{{ route('materials.upload', $course->ID) }}" method="POST" style="display: inline" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <input class="form-control" type="file" id="formFile" name='material' required>
                                </div>       

                                <button class="btn btn-primary">Upload</button>
                            </form>
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