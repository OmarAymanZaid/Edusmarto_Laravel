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
                        <td scope="row">{{ $assignment->assignmentUploader?->name ?? 'Missing' }}</td>
                        <td scope="row">{{ $assignment->name }}</td>
                        <td>
                            <form action="{{ route('assignments.download', $assignment->ID) }}" method="POST" style="display: inline">
                                @csrf

                                <button class="btn btn-primary">Download</button>
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
    
</x-teacherMain>