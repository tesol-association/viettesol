<div>
	<h2> Dear {{ $first_name }} {{ $middle_name }} {{ $last_name }}, </h2>
	<h2> We are glad to inform you that a new conference called "{{ title }}" will be held soon. </h2>
	<h2> As planned, the conference will take place from {{ $start_time }} to {{ $end_time }} and the venue will be {{ $venue }}. </h2>
	<h2> No furthur information is needed to be shown here because everything you need to know is in the following link. </h2>
	<a href="{{ $link }}"> <b style="color: blue; font-size: 18px;"> Click here to follow the provided link! </b> </a>
	<h2> We hope to see you there. </h2>
	<h2><i> {{ $slogan }} </i></h2>
</div>