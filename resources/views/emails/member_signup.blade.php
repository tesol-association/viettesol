<div>
	<h2> Dear {{ $first_name }} {{ $middle_name }} {{ $last_name }}, </h2>
	<p style="font-size: 16px;">
		Thank you for your subcription to become one of our many beloved members.
		We send you this message as a feedback to your registration, as well as provide you details about your membership.
	</p>
	<ul>
		<li> Membership Type: {{ $type }} </li>
		<li> Membership Code: {{ $mscode }} </li>
		<li> Due Date: {{ $end_date }} </li>
	</ul>
</div>