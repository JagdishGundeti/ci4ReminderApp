<?=$this->include('Themes/_commonPartialsBs4/datatables') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>

<?=$this->section('content');  ?>



<div id="1" class="row">
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

					<table id="pendingAssignmnet" class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="text-nowrap">Action</th>
								<th>ID</th>
								<th>Name</th>
								<th>Department</th>
								<th>Phone</th>
								<th>Task</th>
								<th>Sub Task</th>
								<th>Joining Date</th>
								<th>Action Before/After</th>
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
									<?= esc($item->joining_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->task_date) ?>
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


<div id="2" class="row">
	<div class="col-md-12">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Process List</h3>
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

					<table id="processList" class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="text-nowrap">Action</th>
								<th>ID</th>
								<th>Name</th>
								<th>Department</th>
								<th>Phone</th>
								<th>Task</th>
								<th>Sub Task</th>
								<th>Joining Date</th>
								<th>Action Before/After</th>
								<th>Status</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($processList as $item ) : ?>
							<tr>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('editProcess', $item->id), '<i class="fas fa-pencil-alt"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
									<?=anchor('#confirm2delete', '<i class="fas fa-trash"></i>', ['class'=>'btn btn-sm btn-danger ml-1', 'data-href'=>route_to('deleteProcess', $item->id), 'data-toggle'=>'modal', 'data-target'=>'#confirm2delete']); ?>
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
									<?= esc($item->joining_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->task_date) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->status_text) ?>
								</td>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('editProcess', $item->id), '<i class="fas fa-pencil-alt"></i>', ['class'=>'btn btn-sm btn-warning mr-1', 'data-id'=>$item->id]); ?> 
									<?=anchor('#confirm2delete', '<i class="fas fa-trash"></i>', ['class'=>'btn btn-sm btn-danger ml-1', 'data-href'=>route_to('deleteProcess', $item->id), 'data-toggle'=>'modal', 'data-target'=>'#confirm2delete']); ?>
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

            let lastColNr = $("#pendingAssignmnet").find("tr:first th").length - 1;
            
            
            $('#pendingAssignmnet, #processList').DataTable({
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
                ],
                "createdRow": function( row, data, dataIndex){
                	//let currentDate = new Date().toJSON().slice(0, 10);
                	let currentDate = new Date();
                	var rowDate = new Date(data[8]);
	                if( rowDate < currentDate){
	                //if( data[8] == "2023-03-14"){
	                    $(row).css("background-color", "red");
	                }
	            }
            });
            
         
</script>

<?=$this->endSection() ?>