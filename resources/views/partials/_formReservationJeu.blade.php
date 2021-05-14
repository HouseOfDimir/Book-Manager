
	<div class="mb-1 mt-2">
		<div class="form-outline">
			<input type="text" id="adherent" autocomplete="off" class="form-control verifyText adherent" data-ajax="{{ route('ajax.getUser') }}" value=""/>
			<label class="form-label" for="adherent">Adhérent</label>
		</div>
		<input type="hidden" value="" class="idUser" name="fkUser">
	</div>
	<div class="mb-1 mt-2 toAppend">
		<div class="form-outline">
			<input type="text" id="jeu" autocomplete="off" class="form-control verifyText jeu" data-ajax="{{ route('ajax.getJeu') }}" value=""/>
			<label class="form-label" for="jeu">Jeu</label>
		</div>
		<input type="hidden" value="" class="idJeu" name="fkJeu">
	</div>
	<div class="form-outline datepicker mb-1 mt-2">
		<input type="text" class="form-control" id="datePicker" name="date"/>
		<label for="datePicker" class="form-label"> A rendre le:</label>
	</div>

