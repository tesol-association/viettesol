<!-- Start: Paper Info-->
<div class="box box-solid">
    <div class="box-header with-border">
        <i class="fa fa-text-width"></i>
        <h3 class="box-title">TITLE AND ABSTRACT</h3>
    </div>
    <div class="box-body">
        <dl class="dl-horizontal">
            <dt>Author</dt>
            <dd>
                @foreach($paper->authors as $author)
                    {{ $author->first_name }} {{ $author->last_name }} ,
                @endforeach
            </dd>
            <dt>Title</dt>
            <dd>{{ $paper->title }}</dd>
            <dt>Track</dt>
            <dd>{{ $paper->track->name }}</dd>
            <dt>Review Form</dt>
            <dd>
                @if($paper->track->review_form_id)
                    {{ $paper->track->reviewForm->name }}
                @else
                    No Review Form
                @endif
            </dd>
            <dt>Session Type</dt>
            <dd>{{ $paper->sessionType->name }}</dd>
            <dt>Track Director</dt>
            <dd>
                @if (isset($users) && count($users))
                    @foreach ($users as $user)
                        {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }},
                    @endforeach
                @endif
            </dd>
            <dt>Abstract</dt>
            <dd>{!! $paper->abstract !!}</dd>
        </dl>
    </div>
</div>
<!-- End: Paper Info-->
