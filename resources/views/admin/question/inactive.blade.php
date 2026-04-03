@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card shadow">

                <div class="card-header bg-success text-center text-white">
                    <h4>Inactive Category' List</h4>
                </div>

                <div class="card-body">
                    <table class="table table-dark table-striped my-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Question</th>
                                <th>Option A</th>
                                <th>Option B</th>
                                <th>Option C</th>
                                <th>Option D</th>
                                <th>Correct Answer</th>
                                <th>Exam Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td> 
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->a }}</td>
                                <td>{{ $question->b }}</td> 
                                <td>{{ $question->c }}</td>
                                <td>{{ $question->d }}</td>
                                <td>{{ $question->correct_answer }}</td> 
                                <td>{{ $question->exam->title }}</td>
                                <td>
                                    <form action="{{route('question.status',$question->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-primary">Activate</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('questions.index')}}" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection