
		<li class="nav-item">
			<?= anchor(route_to('hrTask'), '<i class="far fa-circle nav-icon"></i> HR Task', ['class' => 'nav-link'.($currentModule == strtolower('hrTask') ? ' active' : '')]); ?>

		</li>

		<li class="nav-item">
			<?= anchor(route_to('hrSubTask'), '<i class="far fa-circle nav-icon"></i> HR Sub Task', ['class' => 'nav-link'.($currentModule == strtolower('hrSubTask') ? ' active' : '')]); ?>

		</li>

		<li class="nav-item">
			<?= anchor(route_to('candidate'), '<i class="far fa-circle nav-icon"></i> Candidate', ['class' => 'nav-link'.($currentModule == strtolower('candidate') ? ' active' : '')]); ?>
		</li>

		<li class="nav-item">
			<?= anchor(route_to('candidateHist'), '<i class="far fa-circle nav-icon"></i> Candidate History', ['class' => 'nav-link'.($currentModule == strtolower('candidateHist') ? ' active' : '')]); ?>

		</li>

		<li class="nav-item">
			<?= anchor(route_to('process'), '<i class="far fa-circle nav-icon"></i> Process', ['class' => 'nav-link'.($currentModule == strtolower('process') ? ' active' : '')]); ?>
		</li>