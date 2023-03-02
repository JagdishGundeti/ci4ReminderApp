		<div class="row">
			<div class="col-md-6 pl-4 pr-4">

				<div class="form-group row">
					<label for="task_name" class="col-md-4 col-form-label">
						Task Name
					</label>
					<div class="col-md-8">
						<input type="text" id="task_name" name="task_name" required maxLength="40" class="form-control" value="<?=old('task_name', $hrTask->task_name) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="start_date" class="col-md-4 col-form-label">
						Start Date
					</label>
					<div class="col-md-8">
						<input type="text" id="start_date" name="start_date" maxLength="40" class="form-control" value="<?=old('start_date', $hrTask->start_date) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="end_date" class="col-md-4 col-form-label">
						End Date
					</label>
					<div class="col-md-8">
						<input type="text" id="end_date" name="end_date" maxLength="50" class="form-control" value="<?=old('end_date', $hrTask->end_date) ?>">
					</div><!--//.col -->
				</div><!--//.form-group -->



			</div><!--//.col -->

		</div><!-- //.row -->