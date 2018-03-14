<div class="left">
	<div class="box">
		<div class="header">
			FILTER
		</div>
		<div class="body">
			<form method="get" action="/found-something/search">
				<div class="form_group">
					<label>Query: </label>
					<input type="text" name="q" placeholder="Search" value="@if(!empty($q)){{ $q }}@endif">
				</div>
				<div class="form_group">
					<label>Category: </label>
					<select name="category">
						@if(empty($categorySelected))
							<option selected>All</option>
							<option>Gadget</option>
							<option>License (ID, Passport, etc)</option>
							<option>Pet</option>
							<option>Jewelry</option>
							<option>Person</option>
							<option>Others</option>
						@else
							<option @if($categorySelected == 'All') selected @endif>All</option>
							<option @if($categorySelected == 'Gadget') selected @endif>Gadget</option>
							<option @if($categorySelected == 'License (ID, Passport, etc)') selected @endif>License (ID, Passport, etc)</option>
							<option @if($categorySelected == 'Pet') selected @endif>Pet</option>
							<option @if($categorySelected == 'Jewelry') selected @endif>Jewelry</option>
							<option @if($categorySelected == 'Person') selected @endif>Person</option>
							<option @if($categorySelected == 'Others') selected @endif>Others</option>
						@endif
					</select>
				</div>
				<div class="form_group checkbox_form">
					<input type="checkbox" class="checkbox" id="pang_only" name="pangasinan_only" value="true" @if(\Request::get('pangasinan_only') == 'true') checked @endif>
					<label for="pang_only">Pangasinan Only </label>
				</div>
				<div class="form_group">
					<button type="submit" style="max-width: 100px; font-size: 14px;">Search</button>
				</div>
			</form>
		</div>
	</div>
</div>