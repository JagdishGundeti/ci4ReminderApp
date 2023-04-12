		<div class="row">
			<div class="col-md-6 pl-4 pr-4">

				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label">
						Name
					</label>
					<div class="col-md-8">
						<input type="text" id="name" name="name" required maxLength="40" class="form-control" value="<?=old('name', $candidateHist->name) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="email" class="col-md-4 col-form-label">
						Email
					</label>
					<div class="col-md-8">
						<input type="text" id="email" name="email" maxLength="40" class="form-control" value="<?=old('email', $candidateHist->email) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="phone" class="col-md-4 col-form-label">
						Phone
					</label>
					<div class="col-md-8">
						<input type="text" id="phone" name="phone" required maxLength="50" class="form-control" value="<?=old('phone', $candidateHist->phone) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="start_date" class="col-md-4 col-form-label">
						Joining Date
					</label>
					<div class="col-md-8">
						<input type="text" id="start_date" name="start_date" maxLength="20" class="form-control" value="<?=old('start_date', $candidateHist->start_date) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="department" class="col-md-4 col-form-label">
						Department
					</label>
					<div class="col-md-8">
						<input type="department" id="department" name="department" maxLength="50" class="form-control" value="<?=old('department', $candidateHist->department) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

			</div><!--//.col -->

		</div><!-- //.row -->