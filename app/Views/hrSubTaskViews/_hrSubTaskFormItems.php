		<div class="row">
			<div class="col-md-6 pl-4 pr-4">

				<div class="form-group row">
					<label for="subtask_name" class="col-md-4 col-form-label">
						Task Name
					</label>
					<div class="col-md-8">
						<input type="text" id="subtask_name" name="subtask_name" required maxLength="40" class="form-control" value="<?=old('subtask_name', $hrSubTask->subtask_name) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="start_date" class="col-md-4 col-form-label">
						Start Date
					</label>
					<div class="col-md-8">
						<input type="text" id="start_date" name="start_date" maxLength="40" class="form-control" value="<?=old('start_date', $hrSubTask->start_date) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="end_date" class="col-md-4 col-form-label">
						End Date
					</label>
					<div class="col-md-8">
						<input type="text" id="end_date" name="end_date" maxLength="50" class="form-control" value="<?=old('end_date', $hrSubTask->end_date) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->



			</div><!--//.col -->

		</div><!-- //.row -->