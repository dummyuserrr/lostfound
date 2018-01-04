@extends('templates.template')
@section('content')
<div class="lost_container">
	<div class="container">
		<div class="left">
			<div class="box">
				sadsa
			</div>
		</div>
		<div class="right">
			<div class="box">
				<form method="post" action="/lost" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="column">
						<div class="form_group">
							<label>Category: <i>*</i></label>
							<select name="category" required>
								<option selected disabled>Select Category</option>
								<option>saa</option>
								<option>saa</option>
							</select>
						</div>
					</div>
					<div class="column">
						<div class="form_group">
							<label>Photo(s): <i>*</i></label>
							<input required type="file" name="name" multiple>
						</div>
					</div>
					<div class="form_group">
						<label>Place Where You Lost It: <i>*</i></label>
						<input required type="text" name="name">
					</div>
					<div class="form_group">
						<label>Other Details: <i>*</i></label>
						<textarea name="description" rows="4" required></textarea>
					</div>
					<div class="form_group" style="text-align: left; margin-top: -10px;">
						<button style="max-width: 100px; font-size: 14px;">Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop