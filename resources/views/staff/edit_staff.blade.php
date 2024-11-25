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
                <form action="{{ route('update_staff', $teacher->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" required>
                    </div>
                    <!-- Batch Multi-Select -->
                    <div class="mb-4">
                        <label for="multiple-select-clear-field" class="form-label">Assign Batches</label>
                        <select class="form-select" id="multiple-select-clear-field" name="batches[]" data-placeholder="Choose anything" multiple>
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" 
                                {{ in_array($batch->id, $teacher->batches->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $batch->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub-Batch Multi-Select -->
                    <div class="mb-4">
                        <label for="subBatches" class="form-label">Assign Sub-Batches</label>
                        <select class="form-select" id="subBatches" name="sub_batches[]" data-placeholder="Choose anything" multiple>
                            @foreach ($subBatches as $subBatch)
                            <option value="{{ $subBatch->id }}" 
                                data-batch-id="{{ $subBatch->batch_id }}" 
                                {{ in_array($subBatch->id, $teacher->subBatches->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $subBatch->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('view_staff') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for dynamic sub-batch filtering --}}


@endsection
