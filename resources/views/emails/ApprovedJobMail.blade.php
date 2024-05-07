<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Approval Notification</title>
</head>
<body>
    <div style="background-color: #f4f4f4; padding: 20px;">
        <p>Hello {{ $mailData['name'] }},</p>
        <p>Your job "<strong>{{ $mailData['job']->title }}</strong>" has been approved.</p>
        <p>Thank you for using our platform.</p>
        <p>Best regards,</p>
        <p>The Job Portal Team</p>
    </div>
</body>
</html>
