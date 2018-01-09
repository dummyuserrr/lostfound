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
						<option selected>All</option>
						<option>Gadget</option>
						<option>Document</option>
						<option>ID</option>
						<option>Person</option>
						<option>Others</option>
					</select>
				</div>
				<div class="form_group">
					<button type="submit" style="max-width: 100px; font-size: 14px;">Search</button>
				</div>
			</form>
		</div>
	</div>
</div>