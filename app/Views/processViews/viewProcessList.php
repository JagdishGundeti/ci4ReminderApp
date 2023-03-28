<?=$this->include('Themes/_commonPartialsBs4/datatables') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?=$this->section('content');  ?>
<div class="row">
	<div class="col-md-12">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Pending Assignmnet</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>

					<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fas fa-times"></i>
					</button>

				</div><!--//.card-tools -->

			</div><!--//.card-header -->
			<div class="card-body">
				<?= view('Themes/_commonPartials/_alertBoxes'); ?>

					<table id="tableOfTask2Process" class="table table-striped table-hover using-data-table">
						<thead>
							<tr>
								<th class="text-nowrap">Action</th>
								<th>ID</th>
								<th>Name</th>
								<th>Department</th>
								<th>Phone</th>
								<th>Task</th>
								<th>Sub Task</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($pendingAssignmnet as $item ) : ?>
							<tr>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('addEntries', $item->id, $item->candidate_id), '<i class="fas fa-plus"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
								</td>
								<td class="align-middle text-center">
									<?=$item->id ?>
								</td>
								<td class="align-middle">
									<?= esc($item->name) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->department) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->phone) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->task_name) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->subtask_name) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->start_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->end_date) ?>
								</td>

								<td class="align-middle text-center text-nowrap">
								<!--
									<?=anchor(route_to('newProcess', $item->id), '<i class="fas fa-plus"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
								-->
									<?=anchor(route_to('addEntries', $item->id, $item->candidate_id), '<i class="fas fa-plus"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
								</td>
							</tr>

						<?php endforeach; ?>
						</tbody>
					</table>
			</div><!--//.card-body -->
			<div class="card-footer">
			</div><!--//.card-footer -->
		</div><!--//.card -->
	</div><!--//.col -->
</div><!--//.row -->

<?=$this->endSection() ?>