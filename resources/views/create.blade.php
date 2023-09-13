@extends('layouts.app')
@section('create')
<div class="container shadow p-3 mb-5 bg-body-tertiary rounded px-5">
    <h1 class="mb-5"> Add Student:</h1>
    <form class="row g-3" href="{{ route ('create')}} " method="POST"">
        @csrf
        <div class=" col-md-6">
        <label class="form-label">Student type:</label>
        <select class="form-select @error('student_type') input-error @enderror" name="student_type">
            <option value="">Select</option>
            <option value="local" {{old ('student_type') ==  'local' ? 'selected' : ''}}>local</option>
            <option value="foreign" {{old ('student_type') ==  'foreign' ? 'selected' : ''}}>foreign</option>
        </select>
        @error('student_type')
        <p class="text-danger">{{ $message }}</p>
        @enderror
</div>
<div class="col-md-6">
    <label class=" form-label">ID number</label>
    <input type="text" class="form-control @error('id_number') input-error @enderror" name="id_number"
        value="{{old ('id_number')}}">
    @error('id_number')
    <p class="text-danger">{{ $message }}</p>
    @enderror

</div>
<div class="col-md-6">
    <label class=" form-label">Name</label>
    <input type="text" class="form-control  @error('name') input-error @enderror" name="name" value="{{old ('name')}}">
    @error('name')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="col-md-6">
    <label class="form-label">Age</label>
    <input type="text" class="form-control @error('age') input-error @enderror" name="age" value="{{old ('age')}}">
    @error('age')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="col-md-6">
    <label class="form-label">Gender</label>
    <select class="form-select" name="gender">
        <option value="">Select</option>
        <option value="male" {{old ('gender') ==  'male' ? 'selected' : ''}}>Male</option>
        <option value="female" {{old ('gender') ==  'female' ? 'selected' : ''}}>Female</option>
    </select>
</div>
<div class="col-md-6">
    <label class="form-label">City</label>
    <input type="text" class="form-control @error('city') input-error @enderror" name="city" value="{{old ('city')}}">
    @error('city')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="col-md-6">
    <label class="form-label">Mobile number</label>
    <input type="text" class="form-control @error('mobile_number') input-error @enderror" name="mobile_number"
        value="{{old ('mobile_number')}}">
    @error('mobile_number')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="col-md-6">
    <label class="form-label">Grades</label>
    <input type="text" class="form-control" name="grades" value="{{old ('grades')}}">
</div>
<div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="text" class="form-control @error('email') input-error @enderror" name="email"
        value="{{old ('email')}}">
    @error('email')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="col-12">
    <button type="submit" class="btn btn-primary mt-3 submitButton">Add</button>
    <a href="{{route ('home')}}" class="btn btn-dark mt-3">Back</a>
</div>
</form>
</div>
@endsection