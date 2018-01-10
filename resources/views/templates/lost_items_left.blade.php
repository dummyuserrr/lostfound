<div class="left">
	<div class="box">
		<div class="header">
			FILTER
		</div>
		<div class="body">
			<form method="get" action="/lost-something/search">
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
							<option>Document</option>
							<option>ID</option>
							<option>Person</option>
							<option>Others</option>
						@else
							<option @if($categorySelected == 'All') selected @endif>All</option>
							<option @if($categorySelected == 'Gadget') selected @endif>Gadget</option>
							<option @if($categorySelected == 'Document') selected @endif>Document</option>
							<option @if($categorySelected == 'ID') selected @endif>ID</option>
							<option @if($categorySelected == 'Person') selected @endif>Person</option>
							<option @if($categorySelected == 'Others') selected @endif>Others</option>
						@endif
					</select>
				</div>
				<div class="form_group">
					<button type="submit" style="max-width: 100px; font-size: 14px;">Search</button>
				</div>
			</form>
		</div>
	</div>
</div>