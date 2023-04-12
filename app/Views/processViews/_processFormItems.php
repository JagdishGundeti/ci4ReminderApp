		<div class="row">
			<div class="col-md-6 pl-4 pr-4">

				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label">
						Process Name
					</label>
					<div class="col-md-8">
						<input type="text" id="name" name="name" required maxLength="255" class="form-control" value="<?=old('name', $processItem->name) ?>" readonly>
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="department" class="col-md-4 col-form-label">
						Department
					</label>
					<div class="col-md-8">
						<input type="text" id="department" name="department" maxLength="40" class="form-control" value="<?=old('department', $processItem->department) ?>" readonly>
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="task_name" class="col-md-4 col-form-label">
						Task
					</label>
					<div class="col-md-8">
						<input type="text" id="task_name" name="task_name" maxLength="40" class="form-control" value="<?=old('task_name', $processItem->task_name) ?>" readonly>
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="subtask_name" class="col-md-4 col-form-label">
						Sub Task
					</label>
					<div class="col-md-8">
						<input type="text" id="subtask_name" name="subtask_name" maxLength="40" class="form-control" value="<?=old('subtask_name', $processItem->subtask_name) ?>" readonly>
					</div><!--//.col -->
				</div><!--//.form-group -->

				<div class="form-group row">
					<label for="status_info_id" class="col-md-4 col-form-label">
						Status Info
					</label>
					<div class="col-md-8">
						<select id="status_info_id" name="status_info_id" class="form-control select2bs" style="width: 100%;" >
							<option value="">Please select a status...</option>

							<?php foreach($statusInfoList as $item) : ?>
							<option value="<?=$item->status_info_id ?>"<?=$item->status_info_id==$process->status_info_id ? ' selected':'' ?>>
								<?=$item->text ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div><!--//.col -->
				</div><!--//.form-group -->


				<div class="form-group row">
					<label for="note" class="col-md-4 col-form-label">
						Note
					</label>
					<div class="col-md-8">
						<textarea rows="3" id="note" name="note" class="form-control"><?=old('note', $processItem->note) ?></textarea>
					</div><!--//.col -->
				</div><!--//.form-group -->


			</div><!--//.col -->

		</div><!-- //.row -->