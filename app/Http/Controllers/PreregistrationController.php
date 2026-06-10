<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PreregistrationController extends Controller
{
    /**
     * Show the pre-registration form
     */
    public function index()
    {
        // Fetch admission levels for the form
        $admissionLevels = DB::table('admission_levels')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch colleges for course selection
        $colleges = DB::table('colleges')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Fetch courses for selection
        $courses = DB::table('courses')
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();

        // Fetch admission contacts
        $admissionContacts = DB::table('admission_contacts')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('title', 'asc')
            ->get();

        return view('preregistration.index', compact('admissionLevels', 'colleges', 'courses', 'admissionContacts'));
    }

    /**
     * Store the pre-registration data
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'admission_level_id' => 'required|exists:admission_levels,id',
            'college_id' => 'required|exists:colleges,id',
            'course_id' => 'required|exists:courses,id',
            'school_graduated' => 'required|string|max:255',
            'year_graduated' => 'required|integer|min:1950|max:' . (date('Y') + 1),
            'gpa' => 'nullable|numeric|min:1.0|max:4.0',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'how_did_you_hear' => 'required|string|max:255',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        try {
            // Store the pre-registration data
            $preregistrationId = DB::table('preregistrations')->insertGetId([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'zip_code' => $request->zip_code,
                'admission_level_id' => $request->admission_level_id,
                'college_id' => $request->college_id,
                'course_id' => $request->course_id,
                'school_graduated' => $request->school_graduated,
                'year_graduated' => $request->year_graduated,
                'gpa' => $request->gpa,
                'parent_name' => $request->parent_name,
                'parent_phone' => $request->parent_phone,
                'parent_email' => $request->parent_email,
                'how_did_you_hear' => $request->how_did_you_hear,
                'additional_info' => $request->additional_info,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Get course and college information for email
            $course = DB::table('courses')->where('id', $request->course_id)->first();
            $college = DB::table('colleges')->where('id', $request->college_id)->first();
            $admissionLevel = DB::table('admission_levels')->where('id', $request->admission_level_id)->first();

            // Send confirmation email (if email is configured)
            try {
                // You can implement email sending here
                // Mail::to($request->email)->send(new PreregistrationConfirmation($preregistrationId));
            } catch (\Exception $e) {
                // Log email error but don't fail the registration
                \Log::error('Failed to send pre-registration email: ' . $e->getMessage());
            }

            return redirect()->route('preregistration.success')->with([
                'success' => 'Your pre-registration has been submitted successfully!',
                'preregistration_id' => $preregistrationId,
                'course_name' => $course->name,
                'college_name' => $college->name,
                'admission_level' => $admissionLevel->name,
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while submitting your pre-registration. Please try again.'])->withInput();
        }
    }

    /**
     * Show success page
     */
    public function success()
    {
        if (!session('success')) {
            return redirect()->route('preregistration');
        }

        return view('preregistration.success');
    }
}
