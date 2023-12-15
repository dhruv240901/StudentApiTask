<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Marksheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Student Result Marksheet</h2>
    <table>
        <tr>
            <th>Student Name</th>
            <td>{{ $stu->name }}</td>
        </tr>
        <tr>
            <th>Student Code</th>
            <td>{{ $stu->student_code }}</td>
        </tr>
        <tr>
            <th>Standard</th>
            <td>{{ $stu->standard }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $stu->result->result }}</td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Marks Obtained</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Science</td>
                <td>{{ $stu->result->science }}</td>
            </tr>
            <tr>
                <td>Maths</td>
                <td>{{ $stu->result->maths }}</td>
            </tr>
            <tr>
                <td>English</td>
                <td>{{ $stu->result->english }}</td>
            </tr>
            <tr>
                <td>Gujarati</td>
                <td>{{ $stu->result->gujarati }}</td>
            </tr>
            <tr>
                <td>Hindi</td>
                <td>{{ $stu->result->hindi }}</td>
            </tr>
            <tr>
                <th>Total Marks</th>
                <th>{{ $stu->result->total_marks }}</th>
            </tr>
            <tr>
                <th>Percentage</th>
                <th>{{ $stu->result->percentage }}%</th>
            </tr>
            <tr>
                <th>Percentile</th>
                <th>{{ $stu->result->percentile }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
