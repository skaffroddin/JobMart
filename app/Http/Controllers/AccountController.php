<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\User;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class AccountController extends Controller
{
    public function registration()
    {
        return view('fornt.account.registration');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        
            session()->flash('success', 'You have registered successfully.');
        
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function login()
    {
        return view('fornt.account.login');
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error', 'Either Email/Password is Incorrect');
            }
        } else {
            return redirect()->route('account.login')->withErrors($validator)->withInput($request->only('email'));
        }
    }
    public function profile(){
        $id = Auth::user()->id;

        $user = User::where('id',$id)->first();
        
       return view('fornt.account.profile',[
        'user'=>$user
       ]);
    }
    public function updateProfile(Request $request) {
        // dd($request->all());
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
        ]);
    
        if ($validator->passes()) {
            $user = User::find($id); 
            $user->name = $request->name;
            $user->email = $request->email;
            $user->desgination = $request->desgination; 
            $user->mobile = $request->mobile;
            $user->save();
    
            session()->flash('success', 'Profile Update Successful.');
    
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
    

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
    public function updateProfilePic(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'image' => "required|image"
        ]);
    
        if ($validator->passes()) {

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName =  $id.'-'.time().'-'.$ext;
            $image->move(public_path('/profile_pic'),$imageName);

            $sourcePath = public_path('/profile_pic/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_pic/'.$imageName));
            User::where('id', $id)->update(['image'=>$imageName]);

            session()->flash('success', 'Profile Picture Update Succesfuul');
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
    public function createJob(){

        
           $categories = Category::where('status', 1) 
           ->orderBy('name', 'ASC')
           ->get();

           $jobtypes = JobType::where('status', 1) 
          ->orderBy('name', 'ASC')
          ->get();

         return view('fornt.account.job.create', [
          'categories' => $categories,
          'jobtypes' => $jobtypes
]);

    }
    public function saveJob(Request $request)
{
    $rules = [
        'title' => 'required|min:5|max:20',
        'category' => 'required',
        'jobType' => 'required',
        'vacancy' => 'required|integer',
        'salary' => 'nullable|string', 
        'location' => 'required|max:50',
        'description' => 'required',
        'benefits' => 'nullable|string',
        'responsibility' => 'nullable|string',
        'qualifications' => 'nullable|string',
        'keywords' => 'nullable|string', 
        'experience' => 'required|integer', 
        'company_name' => 'required|min:3|max:75',
        'company_location' => 'required|max:50', 
        'company_website' => 'nullable|url',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->passes()) {
        $job = new Job();
        $job->title = $request->title;
        $job->category_id = $request->category;
        $job->job_type_id = $request->jobType;
        $job->user_id = Auth::user()->id;
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
        
        
        $job->save();

        session()->flash('success', 'Job added Successfully.');

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

public function myJobs() {
    $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->get();  
    return view('fornt.account.job.my-jobs', [
        'jobs' => $jobs
    ]);
}
public function editJobs(Request $request, $id) {
    $categories = Category::where('status', 1)->orderBy('name', 'ASC')->get();
    $jobtypes = JobType::where('status', 1)->orderBy('name', 'ASC')->get();
    $job = Job::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

    if ($job == null) {
        abort(404);
    }

    return view('fornt.account.job.edit', [
        'categories' => $categories,
        'jobtypes' => $jobtypes,
        'job' => $job
    ]);
}

public function updateJob(Request $request, $id)
{
   
    $rules = [
        'title' => 'required|min:5|max:20',
        'category' => 'required',
        'jobType' => 'required',
        'vacancy' => 'required|integer',
        'salary' => 'nullable|string',
        'location' => 'required|max:50',
        'description' => 'required',
        'benefits' => 'nullable|string',
        'responsibility' => 'nullable|string',
        'qualifications' => 'nullable|string',
        'keywords' => 'nullable|string',
        'experience' => 'required|integer',
        'company_name' => 'required|min:3|max:75',
        'company_location' => 'required|max:50',
        'company_website' => 'nullable|url',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->passes()) {
        $job = Job::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$job) {
            return response()->json(['status' => false, 'errors' => ['job' => 'Job not found.']]);
        }

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

        // Save the job
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

public function deleteJob(Request $request){
    $job = Job::where([
        'user_id' => Auth::user()->id,
        'id' => $request->jobId
    ])->first();
    
    if ($job == null){
        session()->flash('error', 'Job not found or already deleted.');
        return response()->json([
            'status' => false 
        ]);
    }
    Job::where('id', $request->jobId)->delete();
    session()->flash('success', 'Job deleted successfully.');
    return response()->json([
        'status' => true
    ]);
   }
   public function appliedJob()
   {
       $jobApplications = JobApplication::where('user_id', Auth::id())
           ->with(['job', 'job.jobType', 'job.applications'])
           ->paginate(9);

       return view('fornt.account.job.my-jobs-application', [
           'jobApplications' => $jobApplications
       ]);
}



public function removeJob(Request $request){
    $jobApplication = JobApplication::where(['id'=>$request->id, 'user_id' => Auth::user()->id])->first();

    if ($jobApplication == null){
        session()->flash('error', 'Job application not found');
        return response()->json([
            'status'=>false
        ]);
    }
    JobApplication::find($request->id)->delete();

    session()->flash('message', 'Job Deleted Successfull.');
        return response()->json([
            'status'=>true
        ]);

}
public function updatePassword(Request $request) {
    $validator = Validator::make($request->all(), [
        'old_password' => 'required',
        'new_password' => 'required|min:5',
        'confirm_password' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
    if (Hash::check($request->old_password, Auth::user()->password) == false){
        session()->flash('error', 'Your Old Password is Incorrect.');

        return response()->json([
            'status'=>true
        ]);
    }
    $user = User::find(Auth::user()->id);
    $user->password = Hash::make($request->new_password);
    $user->save();

     return response()->json([
    'status' => true,
    'message' => 'Password Updated Successfully.'
]);


}


   
}
