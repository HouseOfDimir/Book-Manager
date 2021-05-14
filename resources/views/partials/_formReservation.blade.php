
	<div class="mb-1 mt-2">
		<div class="form-outline">
			<input type="text" id="adherent" autocomplete="off" class="form-control verifyText adherent" data-ajax="{{ route('ajax.getUser') }}" value=""/>
			<label class="form-label" for="adherent">Adhérent</label>
		</div>
		<input type="hidden" value="" class="idUser" name="fkUser">
	</div>
	<div class="mb-1 mt-2 toAppend">
		<div class="form-outline">
			<input type="text" id="livre" autocomplete="off" class="form-control verifyText livre" data-ajax="{{ route('ajax.getLivre') }}" value=""/>
			<label class="form-label" for="livre">Livre</label>
		</div>
		<input type="hidden" value="" class="idLivre" name="fkLivre">
	</div>
	<div class="form-outline datepicker mb-1 mt-2">
		<input type="text" class="form-control" id="datePicker" name="date"/>
		<label for="datePicker" class="form-label"> A rendre le:</label>
	</div>

