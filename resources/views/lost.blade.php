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
				<div class="column">
					<div class="form_group">
						<label>Category: <i>*</i></label>
						<select required name="category">
							<option selected disabled>Select Category</option>
							<option>saa</option>
							<option>saa</option>
						</select>
					</div>
				</div>
				<div class="column">
					<div class="form_group">
						<label>Photo(s): <i>*</i></label>
						<input required type="file" name="name">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop