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
                        <!-- Teacher Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $teacher->name }}" required>
                        </div>

                        <!-- Teacher Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $teacher->email }}" required>
                        </div>

                        <!-- Batch Multi-Select -->
                        <div class="mb-4">
                            <label for="multiple-select-clear-field" class="form-label">Assign Batches</label>
                            <select class="form-select" onchange="onChange()" id="multiple-select-clear-field"
                                name="batch_ids[]" multiple>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        {{ in_array($batch->id, $batchIds) ? 'selected' : '' }}>
                                        {{ $batch->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('batch_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Sub-Batch Multi-Select -->
                        <div class="mb-4">
                            <label for="multiple-select-custom-field" class="form-label">Assigned Sub Batch</label>
                            <select class="form-select" id="multiple-select-custom-field" name="sub_batches_ids[]" multiple>
                                @foreach ($subBatches as $subBatch)
                                    <option value="{{ $subBatch->id }}"
                                        {{ in_array($subBatch->id, $subBatchIds) ? 'selected' : '' }}>
                                        {{ $subBatch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_batches_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success bg-success bg-gradient"> <i class="lni lni-cloud-upload"></i> Update</button>
                        <a href="{{ route('view_staff') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const batchSelect = document.getElementById('multiple-select-clear-field');
        const subBatchSelect = document.getElementById('multiple-select-custom-field');

        function onChange() {
            const selectedOptions = Array.from(batchSelect.selectedOptions);
            const selectedBatchIds = selectedOptions.map(option => option.value).join(',');

            console.log('Selected Batch IDs:', selectedBatchIds);

            // Fetch sub-batches based on selected batch IDs
            fetch(`/get-sub-batches-by-batch?batch_ids=${encodeURIComponent(selectedBatchIds)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Fetched sub-batches:', data);

                    subBatchSelect.innerHTML = ''; // Clear existing options

                    if (data.length) {
                        data.forEach(subBatch => {
                            const option = document.createElement('option');
                            option.value = subBatch.id;
                            option.textContent = subBatch.name;
                            subBatchSelect.appendChild(option);
                        });
                        console.log('Sub-batches updated successfully.');
                    } else {
                        console.warn('No sub-batches found for the selected batches.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching sub-batches:', error);
                });
        }
    </script>

@endsection
