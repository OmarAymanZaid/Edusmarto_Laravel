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
                            <form action="" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')

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
    
</x-studentMain>