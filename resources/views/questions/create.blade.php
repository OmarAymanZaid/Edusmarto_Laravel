<x-adminMain>
    <form action="{{ route('questions.store') }}" method="POST">
    @csrf

    <h1 class="text-3xl font-medium mb-3">Add Evaluation Question</h1>
    <hr class="mb-3">

        <div class="mb-3">
            <label for="add-evaluation-question" class="form-label">Text</label>
            <input type="text" class="form-control h-32" id="add-evaluation-question" name="questionText" value="{{ old('questionText') }}" required>
        </div>     

        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-adminMain>