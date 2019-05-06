<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Conference: {{ $conference->title }}</h1>
    <div style="margin: 25px">
        <p class="text-center text-uppercase" style="color:blue; font-size: 24px">TimeLine</p>
        <ul>
            <li>Author Registration Opened: {{ $timeLine->author_registration_opened }}</li>
            <li>Author Registration Closed: {{ $timeLine->author_registration_closed }}</li>
            <li>Submission Accepted: {{ $timeLine->submission_accepted }}</li>
            <li>Submission Closed: {{ $timeLine->submission_closed }}</li>
            <li>Reviewer Registration Opened: {{ $timeLine->reviewer_registration_opened }}</li>
            <li>Reviewer Registration Opened: {{ $timeLine->reviewer_registration_closed }}</li>
            <li>Review Paper Deadline: {{ $timeLine->review_deadline }}</li>
        </ul>
    </div>
    <div style="margin: 25px">
        <p class="text-center text-uppercase" style="color:blue; font-size: 24px">Directors</p>
        <ul>
            @foreach($directors as $director)
                <li>{{ $director->full_name }} - {{ $director->affiliation }}</li>
            @endforeach
        </ul>
        <p class="text-center text-uppercase" style="color:blue; font-size: 24px">Track Directors</p>
        <ul>
            @foreach($trackDirectors as $trackDirector)
                <li>{{ $trackDirector->full_name }} - {{ $trackDirector->affiliation }}</li>
            @endforeach
        </ul>
        <p class="text-center text-uppercase" style="color:blue; font-size: 24px">Reviewers</p>
        <ul>
            @foreach($reviewers as $reviewer)
                <li>{{ $reviewer->full_name }} - {{ $reviewer->affiliation }}</li>
            @endforeach
        </ul>
    </div>
    <div style="margin: 25px">
        <p class="text-center text-uppercase" style="color:blue; font-size: 24px">SPONSORS</p>
        <div class="row">
        @foreach($conference->sponsers as $sponser)
            <div class="display: block">
                <div class="card" style="width:400px">
                    <img class="card-img-top" height="150" width="150" src="{{ asset('/storage/' . $sponser->logo) }}" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title"> {{ $sponser->name }}</h4>
                        <p class="card-text">{{ $sponser->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</body>
</html>