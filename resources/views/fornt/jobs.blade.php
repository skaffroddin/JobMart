@extends('fornt.layouts.app')

@section('main')

<section class="section-3 py-5 bg-2 ">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option value="1">Latest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="" name="searchForm" id="searchForm">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input type="text" name="keywords" id="keywords" placeholder="Keywords" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" name="location" id="location" placeholder="Location" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @if ($jobTypes->isNotEmpty())
                                @foreach ($jobTypes as $jobType)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" name="jobType[]" type="checkbox" value="{{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
                                        <label class="form-check-label" for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <select name="experience" id="experience" class="form-control">
                                <option value="">Select Experience</option>
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                                <option value="6">6 Years</option>
                                <option value="7">7 Years</option>
                                <option value="8">8 Years</option>
                                <option value="9">9 Years</option>
                                <option value="10">10 Years</option>
                                <option value="10+">10+ Years</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{route('jobs')}}" class="btn btn-secondary mt-3">Reset</a>
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($jobs->isNotEmpty())
                                @foreach ($jobs as $job)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{$job->title}}</h3>
                                                <p>{{Str::words($job->description, $words=10, '...')}}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{$job->location}}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{$job->jobType->name}}</span>
                                                    </p>
                                                    <p>{{$job->keywords}}</p>
                                                    <p>{{$job->category->name}}</p>
                                                    <p>Experience: {{$job->experience}}</p>
                                                    @if (!is_null($job->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $job->salary }}</span>
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{route('jobDetail', $job->id)}}" class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">Jobs Not Found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customjs')

<script>
    // Form submission logic
    $("#searchForm").submit(function(e) {
    e.preventDefault();  // Prevent the form from submitting the traditional way

    var url = '{{ route("jobs") }}'; // Base URL for the jobs route

    var keyword = $("#keywords").val();
    var location = $("#location").val();
    var category = $("#category").val();
    var experience = $("#experience").val();
    var sort = $("#sort").val();
    
    var checkedJobType = $("input:checkbox[name='jobType[]']:checked").map(function() {
        return $(this).val();
    }).get();

    var query = [];

    // Add parameters to the query array if they are filled
    if (keyword) query.push('keyword=' + encodeURIComponent(keyword));
    if (location) query.push('location=' + encodeURIComponent(location));
    if (category) query.push('category=' + encodeURIComponent(category));
    if (experience) query.push('experience=' + encodeURIComponent(experience));
    if (checkedJobType.length > 0) query.push('jobType=' + encodeURIComponent(checkedJobType.join(',')));
    if (sort) query.push('sort=' + encodeURIComponent(sort));

    // Add the query parameters to the URL
    if (query.length > 0) {
        url += '?' + query.join('&');
    }

    // Redirect the browser to the new URL with the query string
    window.location.href = url;
});


</script>

@endsection
