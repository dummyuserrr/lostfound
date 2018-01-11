@if(session()->has('promptMessage'))
<div class="success_message prompt_message">
	<ul style="list-style: none;">
		<li>{{ session('promptMessage')}}</li>
	</ul>
</div>
@endif