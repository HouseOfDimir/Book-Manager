<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalDeleteLabel">Suppression {{ $data }}</h5>
				<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex justify-content-center">
                Vous êtes sur le point de supprimer: {{ $data }}
                <br /><br />
                Etes-vous sûr(e) ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-primary btnDeleteModal">Valider</button>
			</div>
		</div>
	</div>
</div>