<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\JobType;
use Illuminate\Http\Request;
use App\Models\Job;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //
    public function index(){
        $jobs = Job::orderBy('created_at', 'DESC')->with('user')->paginate(10);
        //dd($jobs);
        return view('admin.jobs.list-job',[
            'jobs'=>$jobs
        ]);
    }
    public function edit($id){
        $job = Job::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->get();
        return view('admin.jobs.edit',[
            'job'=>$job,
            'categories'=> $categories,
            'jobtypes'=> $jobTypes
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|min:5|max:20',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->passes()) {
            $job = Job::find($id);
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
    
            $job->status = $request->status;
            $job->isFeatured = !empty($request->isFeatured) ? $request->isFeatured : 0;
    
            $job->save();
            session()->flash('success', 'Job updated Successfully.');
    
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
          
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    


    public function destroy(Request $request){
        $id = $request->id;
        $job = Job::find($id);
    
        if ($job == null){
            session()->flash('error', "Either Job is not found.");
    
            return response()->json([
                'status'=>false
            ]);
        }
    
        $job->delete();
        session()->flash('message', 'Job Delete Successfull..');
        return response()->json([
            'status'=>true
        ]);
    }

}
