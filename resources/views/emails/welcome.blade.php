<!-- resources/views/emails/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ExamPassGen</title>
    <style>
        /* Your inline styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        ol {
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            background-color: #823ed5;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to ExamPassGen!</h1>
        <p>Dear {{ $fullName }},</p>
        <p>Thank you for joining ! We're thrilled to have you on board.</p>
        <p>Here's what you need to do:</p>
        <ol>
            <li>Submit the required documents for exam pass generation.</li>
            <li>Our admin team will verify your documents, ensuring a secure and fair process.</li>
            <li>Check back after verification to print your approved exam pass.</li>
        </ol>
        <p>Feel free to reach out if you have any questions or need assistance. Best of luck with your exams!</p>
        <a href="{{ url('/login') }}" class="button">Login to ExamPassGen</a>
    </div>
</body>

</html>