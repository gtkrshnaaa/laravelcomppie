<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Job Application</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f4f4f4; padding: 20px; border-radius: 8px;">
        <h2 style="color: #18181b; margin-top: 0;">New Job Application</h2>
        
        <div style="background: white; padding: 20px; border-radius: 4px; margin-top: 20px;">
            <p><strong>Position:</strong> {{ $application->job->title }}</p>
            <p><strong>Applicant:</strong> {{ $application->full_name }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $application->email }}">{{ $application->email }}</a></p>
            <p><strong>Phone:</strong> {{ $application->phone ?? 'N/A' }}</p>
            <p><strong>Tracking Code:</strong> {{ $application->tracking_code }}</p>
            
            <hr style="border: 1px solid #e4e4e7; margin: 20px 0;">
            
            <p><strong>Cover Letter:</strong></p>
            <p style="white-space: pre-wrap;">{{ $application->cover_letter ?? 'No cover letter provided' }}</p>
        </div>
        
        <p style="margin-top: 20px; font-size: 14px; color: #71717a;">
            Submitted on {{ $application->created_at->format('F d, Y at h:i A') }}
        </p>
    </div>
</body>
</html>
