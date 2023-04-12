		<div class="row">
			<div class="col-md-6 pl-4 pr-4">

				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label">
						Name
					</label>
					<div class="col-md-8">
						<input type="text" id="name" name="name" required maxLength="40" class="form-control" value="<?=old('name', $candidate->name) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="email" class="col-md-4 col-form-label">
						Email
					</label>
					<div class="col-md-8">
						<input type="text" id="email" name="email" maxLength="40" class="form-control" value="<?=old('email', $candidate->email) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="phone" class="col-md-4 col-form-label">
						Phone
					</label>
					<div class="col-md-8">
						<input type="text" id="phone" name="phone" required maxLength="50" class="form-control" value="<?=old('phone', $candidate->phone) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="joining_date" class="col-md-4 col-form-label">
						Joining Date
					</label>
					<div class="col-md-8">
						<input type="date" id="joining_date" name="joining_date" maxLength="10" class="form-control" value="<?=old('joining_date', $candidate->joining_date) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->
					

				<div class="form-group row">
					<label for="department" class="col-md-4 col-form-label">
						Department
					</label>
					<div class="col-md-8">
						<input type="department" id="department" name="department" maxLength="50" class="form-control" value="<?=old('department', $candidate->department) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->
				

				<div class="form-group row">
					<label for="job_title" class="col-md-4 col-form-label">
						Job Title
					</label>
					<div class="col-md-8">
						<input type="job_title" id="job_title" name="job_title" maxLength="50" class="form-control" value="<?=old('job_title', $candidate->job_title) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->


			</div><!--//.col -->

		</div><!-- //.row -->