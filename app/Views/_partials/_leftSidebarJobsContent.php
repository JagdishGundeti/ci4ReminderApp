		<li class="nav-item">
			<?= anchor(route_to('employee'), '<i class="far fa-circle nav-icon"></i> Employee', ['class' => 'nav-link'.($currentModule == strtolower('employee') ? ' active' : '')]); ?>

		</li>
		<li class="nav-item">
			<?= anchor(route_to('hrTask'), '<i class="far fa-circle nav-icon"></i> HR Task', ['class' => 'nav-link'.($currentModule == strtolower('hrTask') ? ' active' : '')]); ?>

		</li>

		<li class="nav-item">
			<?= anchor(route_to('hrSubTask'), '<i class="far fa-circle nav-icon"></i> HR Sub Task', ['class' => 'nav-link'.($currentModule == strtolower('hrSubTask') ? ' active' : '')]); ?>

		</li>
