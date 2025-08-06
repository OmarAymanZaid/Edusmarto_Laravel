<x-studentMain>

    <h1 class="text-3xl font-medium mb-3">Evalulate Teacher</h1>
    <hr class="mb-3">

    @if ($questions->count() === 0)

        No Evaluation Questions
    
    @else

        <form action="{{ route('teachers.storeEvaluation', $teacherID) }}" method="POST">
        @csrf

            @php $i = 1; @endphp

            @foreach ($questions as $question)
                    
                <div class="m-2 p-3" style="border: 1px solid black">
                    <label for="question-evaluation-form" class="form-label">{{ $i . '. ' . $question->questionText }}</label>

                    @php
                        $options = [
                            1 => 'Strongly Disagree',
                            2 => 'Disagree',
                            3 => 'Neutral',
                            4 => 'Agree',
                            5 => 'Strongly Agree',
                        ];
                    @endphp

                    @foreach ($options as $value => $label)
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="evaluationResponse[{{ $i }}]" 
                                id="question{{ $i }}_option{{ $value }}" 
                                value="{{ $value }}"
                                {{ old("evaluationResponse.$i") == $value ? 'checked' : '' }}
                                required
                            >
                            <label class="form-check-label" for="question{{ $i }}_option{{ $value }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>

                @php $i++; @endphp

            @endforeach
        
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
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
    @endif
    
</x-studentMain>