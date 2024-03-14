<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Form</title>
    <style>
        /* Add your custom styles for the printable content here */
        body {
            font-family: Arial, sans-serif;
            color: black;
        }

        .container {
            width: 100%;
            max-width: 800px;
            /* Adjust based on your design */
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        h2 {
            color: black;
        }

        .btn {
            /* Display the button by default */
            display: inline-block;
            background-color: #28a745;
            /* Green color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .btn:hover {
            background-color: #218838;
            /* Darker green color on hover */
        }

        @media print {

            /* Additional styles for printing */
            body {
                color: black;
            }

            .btn {
                /* Hide the button during printing */
                display: none !important;
            }
        }
    </style>

</head>

<body>

    <!-- Content of the course form -->
    <div class="container">
        <!-- Display user details -->
        <h2>Student Details:</h2>
        <p>Name: {{ Auth::user()->full_name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Department: {{ Auth::user()->department }}</p>
        <p>Session: {{ $session->name }}</p>




        <!-- Display enrolled courses -->
        <h2>Enrolled Courses:</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Display session information -->
        <h2>Session Information:</h2>
        <p>Start Date: {{ $session->start_date }}</p>
        <p>End Date: {{ $session->end_date }}</p>
    </div>

    <!-- Button to trigger printing the course form -->
    <button type="button" class="btn btn-success" onclick="printCourseForm()">
        Print Course Form
    </button>

    <!-- JavaScript to handle printing -->
    <script>
        function printCourseForm() {
            window.print();
        }
    </script>

</body>

</html>