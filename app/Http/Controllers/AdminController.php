<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Submission;
use App\Models\DocType;
use App\Models\Document;
use App\Models\Course;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentRejected;
use Illuminate\Support\Facades\DB;


use App\Models\VerificationRequirement;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    private function updateStatusIfAllDocumentsApproved($user)
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

        // If not all required documents are submitted, or not all user documents are approved, return
        if (!$allRequiredDocumentsSubmitted || !$allDocumentsApproved) {
            return;
        }

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Update the user status to 'approved'
            $user->update(['status' => 'approved']);

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log or handle the exception
            throw new \Exception('Error updating user status.');
        }
    }
    public function index()
    {
        // Get all students
        $students = User::where('role', 'student')->get();

        // Iterate through each student and update their status if all documents are approved
        foreach ($students as $student) {
            $this->updateStatusIfAllDocumentsApproved($student);
        }

        $totalStudents = User::where('role', 'student')->count();
        $approvedStudents = User::where('role', 'student')->where('status', 'approved')->count();
        $unapprovedStudents = User::where('role', 'student')->where('status', '!=', 'approved')->count();
        $session= Session::first();
        $submission = Submission::first();

        return view('admin.index', compact('totalStudents', 'approvedStudents', 'unapprovedStudents','session', 'submission'));
    }

    Public function viewStudent()
    {

        return view ('admin.users');
    }
    public function viewGensettings()
    {
        $session = Session::first();
        $submission = Submission::first();

        return view('admin.gensettings', compact('session', 'submission'));
    }



    public function viewVerificationreq()
    {
        $docTypes = DocType::all();

        // Assuming you have a model named VerificationRequirement
        $verificationRequirements = VerificationRequirement::all();

        return view('admin.verificationreq', compact('docTypes', 'verificationRequirements'));
    }

    public function course()
    {
        // Retrieve all courses
        $courses = Course::all();
        return view('admin.course', compact('courses'));
    }

    public function course_store(Request $request)
    {
        // Validate the request
        $request->validate([
            'courseNameAdd' => 'required',
        ]);

        // Create a new course
        Course::create([
            'name' => $request->input('courseNameAdd'),
        ]);

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

    public function course_destroy($id)
    {
        // Find the course
        $course = Course::findOrFail($id);

        // Detach the course from all users
        $course->users()->detach();

        // Delete the course
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function reports()
    {
        $totalStudentsCount = User::where('role', 'student')->count();
        $approvedStudentsCount = User::where('role', 'student')->where('status', 'approved')->count();
        $unapprovedStudentsCount = User::where('role', 'student')->where('status', '!=', 'approved')->count();

        $departments = [
            "Accountancy",
            "Agricultural Technology",
            "Architectural Technology",
            "Art and Design",
            "Business Administration and Management",
            "Chemical Engineering Technology",
            "Computer Engineering",
            "Computer Science",
            "Electrical / Electronic Engineering",
            "Estate Mangement And Valuation",
            "Food Technology",
            "Hospitality Management",
            "Leisure And Tourism management",
            "Mass Communication",
            "Mechanical Engineering Technology",
            "Nutrition and Dietetics",
            "Office Technology And Management",
            "Pharmaceutical Technology",
            "Quantity Surveying",
            "Science Laboratory Technology",
            "Statistics",
            "Surveying and Geo-Informatics",
            "Urban and Regional Planning",
        ];


        $departmentApprovals = [];

        foreach ($departments as $department) {
            $totalDepartmentStudents = User::where('role', 'student')->where('department', $department)->count();
            $approvedDepartmentStudents = User::where('role', 'student')->where('department', $department)->where('status', 'approved')->count();

            $approvalPercentage = ($totalDepartmentStudents > 0) ? (($approvedDepartmentStudents / $totalDepartmentStudents) * 100) : 0;

            $departmentApprovals[$department] = [
                'totalStudents' => $totalDepartmentStudents,
                'approvedStudents' => $approvedDepartmentStudents,
                'approvalPercentage' => $approvalPercentage,
            ];
        }

        return view('admin.reports', compact('totalStudentsCount', 'approvedStudentsCount', 'unapprovedStudentsCount', 'departmentApprovals'));
    }


    public function viewfetchUsers()
    {
        return view('admin.fetchuser');
    }

    public function fetchUsers(Request $request)
    {
        $request->validate([
            'department' => 'required|in:Accountancy,Agricultural Technology,Architectural Technology,Art and Design,Business Administration and Management,Chemical Engineering Technology,Computer Engineering,Computer Science,Electrical / Electronic Engineering,Estate Mangement And Valuation,Food Technology,Hospitality Management,Leisure And Tourism management,Mass Communication,Mechanical Engineering Technology,Nutrition and Dietetics,Office Technology And Management,Pharmaceutical Technology,Quantity Surveying,Science Laboratory Technology,Statistics,Surveying and Geo-Informatics,Urban and Regional Planning',
        ]);

        $department = $request->input('department');
        $users = User::where('department', $department)
        ->where('status', '!=', 'approved')
        ->get();

        return view('admin.studentdocuments', ['users' => $users, 'department' => $department]);

    }

    public function showReviewDetails($id)
    {
        $decryptedId = decrypt($id);
        // Use $decryptedId to retrieve the User model

        // Example:
        $user = User::find($decryptedId);

        return view('admin.reviewdetails', ['user' => $user]);
    }

    // SessionController.php

    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);

        // Validate and update session data
        $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $session->update($request->all());

        return redirect()->route('sessions.index')->with('success', 'Session updated successfully');
    }

    // SubmissionController.php
    public function manageDeadline(Request $request)
    {
        // Validate and update submission deadline
        $request->validate([
            'submission_deadline' => 'required|date',
        ]);


        Submission::truncate();
        Submission::create(['deadline' => $request->submission_deadline]);

        return redirect()->route('viewGensettings')->with('success', 'Submission deadline updated successfully');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:doc_types',
        ]);

        DocType::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Document added successfully');
    }

    public function destroy($id)
    {
        $docType = DocType::findOrFail($id);
        $docType->delete();

        return redirect()->back()->with('success', 'Document deleted successfully');
    }

    public function storeRequirement(Request $request)
    {
        // Validate form data
        $request->validate([
            'levelAdd' => 'required',
            'documentTypeAdd' => 'required|string',
        ]);

        // Create a new requirement
        VerificationRequirement::create([
            'level' => $request->input('levelAdd'),
            'document_type' => $request->input('documentTypeAdd'),
            // Add other fields if needed
        ]);

        return redirect()->back()->with('success', 'Requirement added successfully');
    }

    public function destroyrequirement($id)
    {
        // Find and delete the requirement based on the ID
        VerificationRequirement::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Requirement deleted successfully');
    }

    public function updatesession(Request $request, $id)
    {
        // Add validation and update logic as needed
        $session = Session::find($id);

        if ($session) {
            $session->update([
                'name' => $request->input('sessionName'),
                'start_date' => $request->input('startDate'),
                'end_date' => $request->input('endDate'),
            ]);

            return redirect()->back()->with('success', 'Session updated successfully');
        } else {
            return redirect()->back()->with('error', 'Session not found');
        }
    }

    public function updatedeadline(Request $request)
    {
        $request->validate([
            'submissionDeadline' => 'required|date',
        ]);

        $submission = Submission::first();

        if ($submission) {
            $submission->update([
                'deadline' => $request->input('submissionDeadline'),
            ]);

            return redirect()->back()->with('success', 'Submission deadline updated successfully');
        } else {
            return redirect()->back()->with('error', 'Submission not found');
        }
    }

   


    public function view($document_id)
    {
        $document = Document::findOrFail($document_id);

        $filePath = "public/{$document->path}";

        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Return the file as a response for display in a new tab
            return response()->file(Storage::path($filePath));
        } else {
            // Handle the case when the file does not exist
            abort(404, 'File not found');
        }
    }

   

    public function approve($document_id)
    {
        $document = Document::findOrFail($document_id);
        $document->update(['status' => 'approved']);

        // Call the private function to update user status
        $this->updateStatusIfAllDocumentsApproved($document->user);

        return redirect()->back()->with('success', 'Document approved successfully.');
    }

    public function reject(Request $request, $document_id)
    {
        $document = Document::findOrFail($document_id);

        // Validate the input
        $request->validate([
            'rejection_reason' => 'required|string|max:255', // Adjust the validation rules as needed
        ]);

        $rejectionReason = $request->input('rejection_reason');

        // Implement logic to send rejection email with the reason
        Mail::to($document->user->email)->send(new DocumentRejected($document->user, $rejectionReason));

        // Implement logic to delete the document record
        $document->delete();

        // Call the private function to update user status
        $this->updateStatusIfAllDocumentsApproved($document->user);


        return redirect()->back()->with('success', 'Document rejected and user notified.');
    }
}


