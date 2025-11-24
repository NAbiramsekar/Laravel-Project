<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubmissionController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // STEP 1 — Validate input
        $request->validate([
            'q1_domain' => 'required|url',
            'q2_industry' => 'required',
            'q3_contact_email' => 'required|email',
            'q4_number_of_employees' => 'required|integer|min:1',
            'q5_description' => 'required|string',
            'q6_launch_date' => 'required|digits:4',
            'q7_primary_goal' => 'required',
            'q8_company_name' => 'required|string|min:2|max:100',
            'q9_industry_category' => 'required',
        ]);

        // STEP 2 — Save submission
        $submission = Submission::create($request->all());

        // STEP 3 — Build prompt
        $prompt = "
        Analyze this customer submission and write a neat description:

        Company Name: {$submission->q8_company_name}
        Domain: {$submission->q1_domain}
        Industry: {$submission->q2_industry}
        Category: {$submission->q9_industry_category}
        Contact Email: {$submission->q3_contact_email}
        Employees: {$submission->q4_number_of_employees}
        Launch Year: {$submission->q6_launch_date}
        Primary Goal: {$submission->q7_primary_goal}
        Description: {$submission->q5_description}

        Provide a clean, business-friendly analysis and recommendation.
        ";

        // STEP 4 — Call Python MCP on port 8002
        $response = Http::post('http://127.0.0.1:8002/analyze', [
            'prompt' => $prompt
        ]);

        // STEP 5 — Error check
        if ($response->failed()) {
            return back()->with('error', 'Python MCP server is not running on port 8002.');
        }

        // STEP 6 — Extract AI output
        $description = $response->json()['description'] ?? "No description returned.";

        // STEP 7 — Send to result page
        return view('result', compact('description'));
    }
}
