<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\Flare;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{

    public function index(Request $request)
{
    $categories = Category::where('status', 1)->orderBy('name')->get();
    $jobTypes = JobType::where('status', 1)->get();

    $jobs = Job::with(['jobType', 'category'])->where('status', 1);

    $jobTypeArray = [];

    if (!empty($request->keyword)) {
        $jobs = $jobs->where(function($query) use ($request) {
            $query->where('title', 'like', '%'.$request->keyword.'%')
                  ->orWhere('keywords', 'like', '%'.$request->keyword.'%');
        });
    }

    if (!empty($request->location)) {
        $jobs = $jobs->where('location', 'like', '%'.$request->location.'%');
    }

    if (!empty($request->category)) {
        $jobs = $jobs->where('category_id', $request->category);
    }

    if (!empty($request->jobType)) {
        $jobTypeArray = (array) $request->jobType;
        $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
    }

    if (!empty($request->experience)) {
        $experience = $request->experience;

        if ($experience == '10+') {
            $jobs = $jobs->where('experience', '>=', 10);  
        } else {
            $jobs = $jobs->where('experience', '=', (int) $experience);
        }
    }

    if (!empty($request->sort) && (int) $request->sort === 1) {
        $jobs = $jobs->orderBy('created_at', 'DESC');
    } else {
        $jobs = $jobs->orderBy('created_at', 'ASC');
    }

    $jobs = $jobs->paginate(25);

    return view('fornt.jobs', compact('categories', 'jobTypes', 'jobs', 'jobTypeArray'));
}

    

    public function detail($id) {
        $job = Job::where(['id' => $id, 'status' => 1])
        ->with(['jobType', 'category']) 
        ->first();
  
        if ($job == null) {
            abort(404);
        }

        if (isset($id)) {
            $application = JobApplication::where('job_id', $id)->with('user')->get();
        } else {
            dd('Job ID is not set');
        }
        
    
        return view('fornt.jobDetail', ['job' => $job, 'application'=>$application]);
    }
    public function applyJob(Request $request) {
        $id = $request->id;
        $job = Job::where('id', $id)->first();
        $message = 'Job does not exist';
    
        if ($job == null) {
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }
    
        $employer_id = $job->user_id;
    
        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_data = now();
        $application->save();


        $message = 'You have successfully applied';
        session()->flash('success', $message);
    
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
    
    
}