<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobs-hub Mail</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .content {
            padding: 20px;
            background-color: #f4f4f4;
        }
    </style>

</head>
<body>
    <div class="content">
        <h1>{{$mailData['title']}}</h1>
        <p>{{$mailData['body']}}</p>
        <h3>A new user has applied for your job title: {{$mailData['jobTitle']}}</h3>
        <p>Job Description: {{$mailData['jobDescription']}}</p>
        <p>Job Link: <a href="{{$mailData['jobUrl']}}">{{$mailData['jobUrl']}}</a></p>
        <p>Best Regards</p>
        <p>Thank you! <b> {{$mailData['userFirstName']}} {{$mailData['userLastName']}} </b>!</p>
    </div>
</body>
</html>