		<li class="nav-item">
			<?= anchor(route_to('countries'), '<i class="far fa-circle nav-icon"></i> Countries', ['class' => 'nav-link'.($currentModule == strtolower('countries') ? ' active' : '')]); ?>

		</li>
		<li class="nav-item">
			<?= anchor(route_to('cities'), '<i class="far fa-circle nav-icon"></i> Cities', ['class' => 'nav-link'.($currentModule == strtolower('cities') ? ' active' : '')]); ?>

		</li>
		<li class="nav-item">
			<?= anchor(route_to('people'), '<i class="far fa-circle nav-icon"></i> People', ['class' => 'nav-link'.($currentModule == strtolower('people') ? ' active' : '')]); ?>

		</li>
		<li class="nav-item">
			<?= anchor(route_to('hrTask'), '<i class="far fa-circle nav-icon"></i> HR Task', ['class' => 'nav-link'.($currentModule == strtolower('hrTask') ? ' active' : '')]); ?>

		</li>

		<li class="nav-item">
			<?= anchor(route_to('hrSubTask'), '<i class="far fa-circle nav-icon"></i> HR Sub Task', ['class' => 'nav-link'.($currentModule == strtolower('hrSubTask') ? ' active' : '')]); ?>

		</li>
