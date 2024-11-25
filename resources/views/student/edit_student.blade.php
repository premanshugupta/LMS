
@extends('head.main_layout')
@section('title', 'Edit Staff')
@section('matt')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h5>Edit Staff</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update_student', $student->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('view_student') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection