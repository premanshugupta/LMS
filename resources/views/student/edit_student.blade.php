
@extends('head.main_layout')
@section('title', 'Edit Staff')
@section('matt')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h5>Edit Student</h5>
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
                    <div class="mb-4">
                        <label for="multiple-select-clear-field" class="form-label">Assigned Batch</label>
                        <select class="form-select" name="batch_ids[]" id="multiple-select-clear-field" data-placeholder="Choose anything" multiple>

                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" 
                                @if (in_array($batch->id, $batchIds)) selected @endif>
                                {{ $batch->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="multiple-select-custom-field" class="form-label">Assigned Sub Batch</label>
                        <select class="form-select" name="sub_batches_ids[]" id="multiple-select-custom-field" data-placeholder="Choose anything" multiple>

                            @foreach ($subBatches as $subBatch)
                            <option value="{{ $subBatch->id }}" 
                                @if (in_array($subBatch->id, $subBatchIds)) selected @endif>
                                {{ $subBatch->name }}
                            </option>
                        @endforeach
                            
                            {{-- @foreach($subBatches as $subBatch)
                            <option value="{{ $subBatch->id }}" 
                                @if(in_array($subBatch->id, $student->getSubBatchIdsAttribute())) selected @endif>
                                {{ $subBatch->name }}
                            </option>
                        @endforeach --}}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('view_student') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection