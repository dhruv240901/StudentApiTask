<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
</head>
<body>
    <p>Dear {{ $student->parent_name }},</p>

    <p>I trust this message finds you well. I am writing to inform you of the recent examination results for {{ $student->name }} in the exam.</p>

    <p>Attached to this email, you will find the detailed result sheet outlining {{ $student->name }}'s performance in each subject.</p>

    <p>If you have any questions or require further clarification regarding the results, please do not hesitate to reach out to us. We are more than happy to provide any additional information or assistance you may need.</p>

    <p>Thank you for your attention, and please feel free to contact us if you have any inquiries.</p>

    <p>Best regards,</p>
    <p>{{ env('APP_NAME') }}<br>
</body>
</html>
