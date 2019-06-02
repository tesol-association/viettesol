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
	<p style="font-size: 16px;">
		In order to maintain your membership, a maintainance fee has to be paid. We highly recommend you make the deal as soon as possible. Your contribution will help us a lot in improving more high quality service.
		Go to our website, hit "Member Fee" to check it out with your Membership Code.
	</p>
</div>