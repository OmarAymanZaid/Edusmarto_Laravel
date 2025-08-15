<x-studentMain>
    <h1 class="text-4xl font-medium">Material</h1> <br>

    @if ($materials->count() === 0)
        No Material Uploaded
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($materials as $material)
                    <tr>
                        <th scope="row">{{ $material->name }}</th>
                        <td>
                            <form action="{{ route('materials.download', $material->ID) }}" method="POST" style="display: inline">
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
    
</x-studentMain>