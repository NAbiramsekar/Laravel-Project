<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Information Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .form-header h1 { font-size: 32px; margin-bottom: 10px; }
        .form-header p { font-size: 16px; opacity: 0.9; }

        .form-body { padding: 40px; }

        .form-group { margin-bottom: 26px; }

        .form-label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .required { color: #e53e3e; }

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea { resize: vertical; min-height: 100px; }

        .form-footer {
            padding: 0 40px 40px;
            display: flex;
            gap: 16px;
            justify-content: flex-end;
        }

        .btn {
            padding: 14px 32px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #2d3748;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="form-header">
        <h1>Business Information Form</h1>
        <p>Please fill all fields to proceed</p>
    </div>

    <!-- Form -->
    <form id="businessForm" method="POST" action="/form">

        @csrf

        <div class="form-body">

            {{-- Error Message if Python Server Fails --}}
            @if(session('error'))
                <div style="padding: 10px; background:#ffcccc; color:#8b0000; border-radius:8px; margin-bottom:20px;">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Success Message --}}
            @if(session('success'))
                <div style="padding: 10px; background:#d4f8d4; color:#1b5e20; border-radius:8px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 1: Website Domain -->
            <div class="form-group">
                <label class="form-label">What is your website domain? <span class="required">*</span></label>
                <input type="url" name="q1_domain" required placeholder="https://example.com">
            </div>

            <!-- 2: Industry -->
            <div class="form-group">
                <label class="form-label">What industry does your business operate in? <span class="required">*</span></label>
                <select name="q2_industry" required>
                    <option value="">-- Select Industry --</option>
                    <option value="technology">Technology</option>
                    <option value="retail">Retail</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="finance">Finance</option>
                    <option value="education">Education</option>
                </select>
            </div>

            <!-- 3: Email -->
            <div class="form-group">
                <label class="form-label">Primary contact email <span class="required">*</span></label>
                <input type="email" name="q3_contact_email" required>
            </div>

            <!-- 4: Employees -->
            <div class="form-group">
                <label class="form-label">How many employees do you have? <span class="required">*</span></label>
                <input type="number" name="q4_number_of_employees" min="1" required>
            </div>

            <!-- 5: Description -->
            <div class="form-group">
                <label class="form-label">Brief description of your business <span class="required">*</span></label>
                <textarea name="q5_description" required></textarea>
            </div>

            <!-- 6: Launch Year -->
            <div class="form-group">
                <label class="form-label">When was your business launched (year)? <span class="required">*</span></label>
                <input type="text" name="q6_launch_date" required maxlength="4">
            </div>

            <!-- 7: Primary Goal -->
            <div class="form-group">
                <label class="form-label">What is your primary goal? <span class="required">*</span></label>
                <select name="q7_primary_goal" required>
                    <option value="">-- Select Goal --</option>
                    <option value="lead_generation">Lead generation</option>
                    <option value="sales">Sales</option>
                    <option value="brand_awareness">Brand awareness</option>
                    <option value="user_research">User research</option>
                </select>
            </div>

            <!-- 8: Company Name -->
            <div class="form-group">
                <label class="form-label">What is your company name? <span class="required">*</span></label>
                <input type="text" name="q8_company_name" required minlength="2" maxlength="100">
            </div>

            <!-- 9: Industry Category -->
            <div class="form-group">
                <label class="form-label">Which industry does your company belong to? <span class="required">*</span></label>
                <select name="q9_industry_category" required>
                    <option value="">-- Select Industry Category --</option>
                    <option value="it">Information Technology</option>
                    <option value="finance">Finance</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="education">Education</option>
                    <option value="manufacturing">Manufacturing</option>
                </select>
            </div>

        </div>

        <!-- Footer -->
        <div class="form-footer">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit Form</button>
        </div>

    </form>
</div>

</body>
</html>
