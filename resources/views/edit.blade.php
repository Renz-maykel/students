@extends('layouts.app')
@section('update')
<div class="container shadow p-3 mb-5 bg-body-tertiary rounded px-5">
    <h1 class="mb-5"> Update student</h1>
    <form class="row g-3" action="{{route ('update', [$Students->id, $Students->student_type])}}" method="POST">
        @csrf
        @method('PUT')
        <div class=" col-md-6">
            <label class="form-label">Student type:</label>
            <select class="form-select @error('student_type') input-error @enderror" name="student_type">
                <option  @if($Students->student_type == 'local') selected @endif>local</option>
                <option  @if($Students->student_type == 'foreign') selected @endif>foreign</option>
            </select>
            @error('student_type')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label class=" form-label">ID number</label>
            <input type="text" class="form-control  @error('id_number') input-error @enderror" name="id_number" value="{{ $Students->id_number}}" >
            @error('id_number')
                 <p class="text-danger">{{ $message }}</p>
            @enderror 
        </div>
        <div class="col-md-6"> 
            <label class=" form-label ">Name</label>
            <input type="text" class="form-control  @error('name') input-error @enderror" name="name" value="{{ $Students->name }}">
            @error('name')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Age</label>
            <input type="text" class="form-control" name="age" value="{{ $Students->age }}" >
            @error('age')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select class="form-select" aria-label="Default select example " name="gender">
                <option {{old('gender') ==  'male' ? 'selected' : ''}}>Male</option>
                <option {{old('gender') ==  'female' ? 'selected' : ''}}>Female</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">City</label>
            <input type="text" class="form-control @error('city') input-error @enderror" name="city" value="{{ $Students->city }}" >
            @error('city')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Mobile number</label>
            <input type="text" class="form-control @error('mobile_number') input-error @enderror" name="mobile_number" value="{{ $Students->mobile_number }}">
            @error('mobile_number')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Grades</label>
            <input type="text" class="form-control" name="grades" value="{{  number_format($Students->grades, 2) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="text" class="form-control  @error('email') input-error @enderror" name="email" value="{{ $Students->email }}">
            @error('email')
                 <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3">update</button>
            <a href="{{route ('home')}}" class="btn btn-dark mt-3">Back</a>
        </div>
    </form>
</div>

@endsection