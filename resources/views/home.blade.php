@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container home-container shadow p-3 mb-5 bg-body-tertiary rounded px-5">
    <h1 class="text-center">Students list</h1>
    <h1 class="text-center">Students list</h1>

    <div class="add-filter-container">
        <div>
            <a type="button" href="{{ route('createView')}}" class="btn btn-success mt-5">Add student</a>
        </div>
        <div class="d-flex mt-3">
            <div>
                <label for="" class="form-label">filter students:</label>
                <form action="{{ route('home')}}" method="get">
                    <select class="form-select" aria-label="Default select example" name="filter">
                        <option value="allStudents" @if ($filter=='allStudents' ) selected @endif>All students</option>
                        <option value="localStudents" @if ($filter=='localStudents' ) selected @endif>Local students
                        </option>
                        <option value="foreignStudents" @if ($filter=='foreignStudents' ) selected @endif>Foreign
                            students</option>
                    </select>
            </div>
            <div>
                <button class="btn-sbmt btn btn-secondary" type="submit">filter</button>
            </div>
            </form>
        </div>
    </div>
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">Student_type</th>
                <th scope="col">ID_number</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">City</th>
                <th scope="col">Mobile_number</th>
                <th scope="col">Grades</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student['student_type'] }}</td>
                <td>{{ $student['id_number'] }}</td>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['age'] }}</td>
                <td>{{ $student['gender'] }}</td>
                <td>{{ $student['city'] }}</td>
                <td>{{ $student['mobile_number'] }}</td>
                <td>{{ number_format($student['grades'],2) }}</td>
                <td>{{ $student['email'] }}</td>
                <td class="d-flex">
                    <a type="button" href="{{ route('edit', [$student['student_type'], $student['id']]) }}"
                        class="btn btn-outline-primary mr-2">Edit</a>
                    <form action="{{ route('delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" value="{{ $student['id'] }}" name="id">
                        <input type="hidden" value="{{ $student['student_type'] }}" name="student_type">
                        <button type="submit" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete it?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection