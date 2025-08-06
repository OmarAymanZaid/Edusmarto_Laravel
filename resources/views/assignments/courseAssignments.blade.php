<x-teacherMain>
    <h1 class="text-4xl font-medium">Assignments</h1> <br>

    @if ($assignments->count() === 0)
        No Assignments Uploaded
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Uploaded By</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($assignments as $assignment)
                    <tr>
                        <td scope="row">{{ $assignment->studentID }}</td>
                        <td scope="row">{{ $assignment->name }}</td>
                        <td>
                            <form action="" method="POST" style="display: inline">
                                @csrf

                                <button class="btn btn-primary">Download</button>
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