<?=$this->include('Themes/_commonPartialsBs4/datatables') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?=$this->section('content');  ?>
<div id="1" class="row">
	<div class="col-md-12">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Candidate List</h3>
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

					<table id="tableOfCandidate" class="table table-striped table-hover ">
						<thead>
							<tr>
								<th class="text-nowrap">Action</th>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Joining Date</th>
								<th>Department</th>
								<th>Job Title</th>
								<th>Manager</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($candidateHistList as $item ) : ?>
							<tr>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('candidateHistview', $item->id), '<i class="fa fa-eye"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
								</td>
								<td class="align-middle text-center">
									<?=$item->id ?>
								</td>
								<td class="align-middle">
									<?= esc($item->name) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->email) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->phone) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->joining_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->department) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->job_title) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->manager_id) ?>
								</td>

								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('candidateHistview', $item->id), '<i class="fa fa-eye"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
								</td>
							</tr>

						<?php endforeach; ?>
						</tbody>
					</table>
			</div><!--//.card-body -->
			<div class="card-footer">
				<?=anchor(route_to('newCandidate'), 'Add a New Candidate', ['class'=>'btn btn-primary']); ?>
			</div><!--//.card-footer -->
		</div><!--//.card -->
	</div><!--//.col -->
</div><!--//.row -->

<div id="2" class="row">
	<div class="col-md-12">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Candidate History</h3>
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

					<table id="tableOfCandidate2" class="table table-striped table-hover ">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Department</th>
								<th>Phone</th>
								<th>Task</th>
								<th>Sub Task</th>
								<th>Joining Date</th>
								<th>Action Before/After</th>
								<th>Completed On</th>
								<th>Notes</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>

						<?php foreach ($candidateHist as $item ) : ?>
							<tr>
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
									<?= esc($item->joining_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->task_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->updated_at) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->note) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->status_text) ?>
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

<?=$this->section('js') ?>
    <script type="module">

            let lastColNr = $("#tableOfCandidate").find("tr:first th").length - 1;
            $('#tableOfCandidate, #tableOfCandidate2').DataTable({
                "responsive": true,
                "paging": true,
                "lengthMenu": [ 5, 10, 25, 50, 75, 100, 250, 500, 1000, 2500 ],
                "pageLength": 10,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "scrollX": true,
                "stateSave": true,
                "columnDefs": [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0,lastColNr]
                    }
                ]
            });
            
         
</script>

<?=$this->endSection() ?>