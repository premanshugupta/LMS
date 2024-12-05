@extends('head.main_layout')
@section('title', 'Add Staff')
@section('matt')


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add Staff</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New Staff</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('view_staff') }}">
                            <button type="button" class="btn btn-primary">View Staff</button>
                        </a>

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
             <!-- Display Success/Error Messages -->
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
            <div class="row">
                <div class="col-xl-6 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" action="{{ route('add_staff.post') }}" method="POST"
                                novalidate>
                                @csrf
                                <div class="col-md-12">
                                    <label for="input25 bsValidation2" class="form-label"> Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <input type="text" class="form-control" name="name" id="input25 bsValidation2"
                                            placeholder="Name">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation4" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                        <input type="email" class="form-control" name="email" id="bsValidation4"
                                            placeholder="Email">
                                        <div class="invalid-feedback">
                                            Please provide a valid email.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                                        <input type="password" class="form-control" name="password" id="bsValidation5"
                                            placeholder="Password">
                                        <div class="invalid-feedback">
                                            Please choose a password.
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{-- Batch start --}}
                                <div class="">
                                    <label for="multiple-select-clear-field" class="form-label">Assign Batch</label>
                                    <select class="form-select" id="multiple-select-clear-field" onchange="onChange()" name="batches[]"
                                        data-placeholder="Select Batch" multiple>
                                        @foreach ($activeBatches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                        @endforeach
                                        {{-- <option>Christmas Island</option>
                                        <option>South Sudan</option> --}}
                                    </select>
                                </div>
                                {{-- Batch end  --}}

                                {{-- SubBatch start --}}
                                <div class="">
                                    <label for="multiple-select-custom-field" class="form-label">Assign Sub-Batch</label>
                                    <select class="form-select" id="multiple-select-custom-field"
                                        data-placeholder="Select Sub-Batch" name="sub_batches[]" multiple>

                                        @foreach ($activeSubBatches as $subBatch)
                                            <option value="{{ $subBatch->id }}">{{ $subBatch->name }}</option>
                                        @endforeach

                                        {{-- <option>Christmas Island</option>
                                        <option>South Sudan</option> --}}
                                    </select>
                                </div>
                                {{-- SubBatch end --}}
                                <input type="hidden" name="role" value="Teacher">


                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-outline-primary px-4">Submit</button>
                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->


            <!--end row-->


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
