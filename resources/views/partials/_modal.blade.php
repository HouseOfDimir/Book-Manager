<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="createModalLabel">Ajout {{ $data }}</h5>
				<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="" method="POST" class="superForm">
				@csrf
				<div class="modal-body">
					@switch($data)
						@case('Livre')
							@include('partials._formBook')
							@break
						@case('User')
							@include('partials._formUser')
							@break
						@case('Jeu')
							@include('partials._formJeu')
							@break
						@case('Réservation Jeu')
							@include('partials._formReservationJeu')
							@break
						@case('Réservation Livre')
							@include('partials._formReservation')
							@break
					@endswitch
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-primary validateModal">Valider</button>
				</div>
			</form>
		</div>
	</div>
</div>