<!-- resources/views/emails/document_rejected.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Rejection Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        p {
            margin: 0;
        }

        h1 {
            color: #d9534f;
        }

        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .rejection-reason {
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            color: #a94442;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .action-message {
            background-color: #d9edf7;
            border: 1px solid #bce8f1;
            color: #31708f;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Document Rejection Notification</h1>

        <p>Dear {{ $user->full_name }},</p>

        <p>We regret to inform you that your document submission has been rejected.</p>

        @if ($rejectionReason)
        <div class="rejection-reason">
            <strong>Rejection Reason:</strong>
            <p>{{ $rejectionReason }}</p>
        </div>
        @else
        <p>No specific reason provided for rejection.</p>
        @endif

        <div class="action-message">
            <p>Please correct your document and re-upload for verification.</p>
        </div>

        <p>If you have any questions or concerns, please contact us.</p>

        <div class="signature">
            <p>Thank you.</p>
        </div>
    </div>
</body>

</html>