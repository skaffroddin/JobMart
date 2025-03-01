@extends('fornt.layouts.app')


@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <!-- Breadcrumb -->
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Job Listings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body">
                        <h3 class="fs-4 mb-1">Available Jobs</h3>
                        
                        <!-- Job Table -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->jobType->name }}</td>
                                        <td>{{ $job->location }}</td>
                                        <td>
                                            @if ($job->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Blocked</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach                                
                                    @else
                                        <tr>
                                            <td colspan="5">No jobs available at the moment.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('customjs')
<script type="text/javascript">
    function removeJob(id) {
        if (confirm("Are you sure you want to delete this job?")) {
            $.ajax({
                url: '{{ route("account.removeJob") }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token
                    id:id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = '{{ route("account.appliedJob") }}';
                    } else {
                        alert('Error: Job could not be deleted.');
                    }
                }
            });
        }
    }
</script>
@endsection

{{-- @extends('fornt.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('fornt.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('fornt.message')

                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <h3 class="fs-4 mb-1">Jobs Applied</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Applied</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($jobApplications->isNotEmpty())
                                        @foreach ($jobApplications as $jobApplication)
                                            <tr class="active">
                                                <td>
                                                    <div class="job-name fw-500">{{ $jobApplication->job->title }}</div>
                                                    <div class="info1">{{ $jobApplication->job->jobType->name }}. {{ $jobApplication->job->location }}</div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($jobApplication->applied_data)->format('d, M, Y') }}</td>
                                                <td>{{ $jobApplication->job->applications->count() }} Applications</td>
                                                <td>
                                                    <div class="job-status text-capitalize">{{ $jobApplication->job->status == 1 ? 'Active' : 'Blocked' }}</div>
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('jobDetail', $jobApplication->job_id) }}">
                                                                    <i class="fa fa-eye"></i> View
                                                                </a>
                                                            </li>
                                                            @php
                                                                $isApplied = \App\Models\JobApplication::where([
                                                                    ['user_id', Auth::id()],
                                                                    ['job_id', $jobApplication->job_id]
                                                                ])->exists();
                                                            @endphp
                                                            @if($isApplied)
                                                                <li>
                                                                    <button class="dropdown-item" disabled>
                                                                        <i class="fa fa-check"></i> Already Applied
                                                                    </button>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('applyJob', $jobApplication->job_id) }}">
                                                                        <i class="fa fa-paper-plane"></i> Apply
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="removeJob({{ $jobApplication->id }})">
                                                                    <i class="fa fa-trash"></i> Remove
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">No jobs found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('customjs')
<script type="text/javascript">
    function removeJob(id) {
        if (confirm("Are you sure you want to delete this job?")) {
            $.ajax({
                url: '{{ route("account.removeJob") }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = '{{ route("account.appliedJob") }}';
                    } else {
                        alert('Error: Job could not be deleted.');
                    }
                }
            });
        }
    }
</script>
@endsection --}}
