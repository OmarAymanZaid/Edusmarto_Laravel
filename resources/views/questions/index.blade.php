<x-adminMain>
    <h1 class="text-4xl font-medium">Questions</h1>

    <a href="{{ route('questions.create') }}" class="btn btn-success my-4">Add Evaluation Question</a> <br>


    @if ($questions->count() === 0)
        No Questions Added
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Text</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($questions as $question)
                    <tr>
                        <th scope="row">{{ $question->ID }}</th>
                        <td>{{ $question->questionText }}</td>
                        <td>
                            <a href="{{ route('questions.edit', $question->ID) }}" class="btn btn-primary">Update</a>
                            <div style="display: inline-block">
                                <button type="button"
                                        class="btn btn-danger open-delete-modal"
                                        data-form="#deleteQuestionForm{{ $question->ID }}"
                                        data-name="this question"
                                        >
                                    Delete
                                </button>
                                <form id="deleteQuestionForm{{ $question->ID }}" action="{{ route('questions.destroy', $question->ID) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
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

    <x-deleteModal />
    
</x-adminMain>