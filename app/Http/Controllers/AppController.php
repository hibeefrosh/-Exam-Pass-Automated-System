<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Submission;
use App\Models\Document;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;




class AppController extends Controller
{


    private function updateUserStatusBasedOnDocumentStatus($user)
    {
        // Check if all required documents are submitted
        $allRequiredDocumentsSubmitted = DB::table('verification_requirements')
            ->where('level', $user->program)
            ->whereNotExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                    ->from('documents')
                    ->whereRaw('documents.document_name = verification_requirements.document_type and documents.user_id = ?', [$user->id]);
            })
            ->doesntExist();

        // Check if all user documents are approved
        $allDocumentsApproved = $user->documents()->where('status', '!=', 'approved')->doesntExist();

        // Update the user status based on document and required document status
        $user->update(['status' => $allDocumentsApproved && $allRequiredDocumentsSubmitted ? 'approved' : 'not approved']);
    }

    private function upgradeUserLevel($user)
    {
        $currentDate = Carbon::now();

        // Get the active session
        $activeSession = Session::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        if ($activeSession) {
            // Check and upgrade user level based on program and part-time/full-time
            if ($user->program == 'ND 1 fulltime' ) {
                $user->update(['program' => 'ND 2 fulltime']);
            } elseif ($user->program == 'ND 1 partime') {
                $user->update(['program' => 'ND 2 partime']);
            } elseif ($user->program == 'HND 1 fulltime') {
                $user->update(['program' => 'HND 2 fulltime']);
            } elseif ($user->program == 'HND 1 partime') {
                $user->update(['program' => 'HND 2 partime']);
            }
        }
    }
    public function index()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();
        $session = Session::first();
        $submission = Submission::first();

        // Get counts for completed and pending submissions
        $completedSubmissionsCount = Document::where('user_id', $user->id)->where('status', 'approved')->count();
        $pendingSubmissionsCount = Document::where('user_id', $user->id)->where('status', 'pending')->count();

        // Get counts for required and submitted documents
        $requiredDocumentsCount = DB::table('verification_requirements')
            ->where('level', $user->program) 
            ->count();

        $submittedDocumentsCount = $user->documents()->count();

        // Upgrade user level if within the active session
        $this->upgradeUserLevel($user);
        // Call the function to update user status based on document status
        $this->updateUserStatusBasedOnDocumentStatus($user);

        return view('app.index', compact('user', 'session', 'submission', 'completedSubmissionsCount', 'pendingSubmissionsCount', 'requiredDocumentsCount', 'submittedDocumentsCount'));
    }



    public function documents()
    {
        $user = Auth::user();
        $requiredDocuments = DB::table('verification_requirements')
        ->where('level', $user->program)
        ->get();
        $submissionDeadline = Submission::first()->deadline;
        // Call the function to update user status based on document status
        $this->updateUserStatusBasedOnDocumentStatus($user);

        return view('app.submitdocuments', compact('user','requiredDocuments', 'submissionDeadline'));

    }

    public function showDocumentstatus()
    {
        $user = Auth::user();
        $submittedDocuments = $user->documents()->get();
        // Call the function to update user status based on document status
        $this->updateUserStatusBasedOnDocumentStatus($user);
        return view('app.documentstatus', compact('user', 'submittedDocuments'));
    }

    public function notification()
    {
        return view('app.notifications');
    }

    public function faqs()
    {
        return view('app.faqs');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('app.profile', compact('user'));
    }

    public function showeditprofile()
    {
        $user = Auth::user();

        return view('app.editprofile', compact('user'));

    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        request()->validate([
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'matric_no' => 'required|string|max:255',
            'level' => 'string|max:255',
            // Add validation rules for other fields as needed
        ]);

        // Update user profile with the provided data
        $user->update(request()->only(['full_name', 'department', 'matric_no', 'level']));

        return redirect()->route('showeditprofile')->with('success', 'Profile updated successfully');
    }

    public function uploadDocument(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Adjust max file size as needed
            'document_type' => 'required', // Adjust the allowed document types
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save the uploaded document
        $uploadedFile = $request->file('document_file');
        $fileExtension = $uploadedFile->getClientOriginalExtension();
        $fileName = 'document_' . time() . '.' . $fileExtension;

        // Store the document in the storage disk (e.g., public disk)
        $filePath = $uploadedFile->storeAs('documents', $fileName, 'public');

        // Create a new document record in the database
        $document = new Document([
            'user_id' => $user->id,
            'document_name' => $request->input('document_type'), // Use the document type from the form
            'path' => $filePath,
            'status' => 'pending', // Set the initial status as pending, adjust as needed
        ]);

        $document->save();

        return redirect()->back()->with('success', 'Document uploaded successfully.');
    }

    public function enrollInCourse(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Enroll the authenticated user in the course
        $user->courses()->attach($request->input('course_id'));

        return redirect()->route('student.courses')->with('success', 'Enrolled in the course successfully.');
    }

    public function showCourses()
    {
        $user = Auth::user();

        $courses = $user->courses;
        $availableCourses = Course::all();

        return view('app.courses', compact('courses', 'availableCourses'));
    }

    public function deleteEnrolledCourse($courseId)
    {
        // Find the course
        $course = Course::findOrFail($courseId);

        // Detach the course from the authenticated user
        Auth::user()->courses()->detach($course);

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

    public function showCourseForm()
    {
        // Retrieve the authenticated user, courses, and session
        $user = Auth::user();
        $courses = $user->courses; 
        $session = Session::first(); 

        // Return the course form view with user details, enrolled courses, and session
        return view('app.course_form', compact('user', 'courses', 'session'));
    }


}
