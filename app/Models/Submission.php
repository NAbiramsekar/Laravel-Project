<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'q1_domain',
        'q2_industry',
        'q3_contact_email',
        'q4_number_of_employees',
        'q5_description',
        'q6_launch_date',
        'q7_primary_goal',
        'q8_company_name',
        'q9_industry_category',
        'llm_response'
    ];
}
