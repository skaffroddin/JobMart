@extends('fornt.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <!-- Breadcrumb and Sidebar -->
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
        
        <!-- Main Content -->
        <div class="row">
            <div class="col-lg-3">
                @include('fornt.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('fornt.message')
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <h3 class="fs-4 mb-1">My Jobs</h3>
                            <a href="{{ route('account.createJob') }}" class="btn btn-primary" style="margin-top: -10px;">Post a Job</a>
                        </div>
                        
                        <!-- Job Table -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($jobs->isNotEmpty())
                                        @foreach ($jobs as $job)
                                            <tr class="active">
                                                <td>
                                                    <div class="job-name fw-500">{{ $job->title }}</div>
                                                    <div class="info1">{{ $job->jobType->name }}. {{ $job->location }}</div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d, M, Y') }}</td>
                                                <td>0 Applications</td>
                                                <td>
                                                    <div class="job-status text-capitalize">{{ $job->status == 1 ? 'Active' : 'Blocked' }}</div>
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                       </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{route("jobDetail", $job->id)}}"><i class="fa fa-eye"></i> View</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('account.editJobs', $job->id) }}"><i class="fa fa-edit"></i>Update</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="deleteJob({{ $job->id }})"><i class="fa fa-trash"></i>Delete</a></li>
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
                        {{-- Uncomment to enable pagination --}}
                        {{-- {{ $jobs->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customjs')
<script type="text/javascript">
    function deleteJob(jobId) {
        if (confirm("Are you sure you want to delete this job?")) {
            $.ajax({
                url: '{{ route("account.deleteJob") }}',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token
                    jobId: jobId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = '{{ route("account.myJobs") }}';
                    } else {
                        alert('Error: Job could not be deleted.');
                    }
                }
            });
        }
    }
</script>
@endsection
