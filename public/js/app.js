$(function(){
	 $('#table').DataTable({
		dom: 'Bfrtip',
		buttons: [
			'excel', 'pdf'
		]
	});

	$('.paginate_button').addClass('btn btn-primary');
	$('.dt-button').addClass('btn btn-primary');
});

$(window).on("load",function(){
	$(".loaderC").fadeOut('slow');
	$('footer').css('position', 'absolute');
	$('.pageContainer').removeAttr('hidden');
});

$('.forAlert').fadeOut(4000);

$('.addSomething').on('click', function(){
    $('.superForm').attr('action', $(this).attr('data-route'));
})

$(".linkToEdit").on('click',function(){
    linktoEdit = $(this).attr('data-modif');
    $('.superForm').attr('action', linktoEdit);

    $.ajax({
       headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
       type:'POST',
       url:$(this).attr('data-route'),
       data:{fkUser:$(this).attr('data-id')},
       success:function(data){
          if(data['typeEdit'] == 'User'){
            changeBtn();
            $('superForm').attr('action', linktoEdit);
            $('.id').val(data['id']);
            $('.nom').val(data['nom']);
            $('.prenom').val(data['prenom']);
            $('.age').val(data['age']);
            $('.adresse').val(data['adresse']);
            $('.ville').val(data['ville']);
            $('.zipcode').val(data['zipcode']);

          }else if(data['typeEdit'] == 'Livre'){
            changeBtn();
            $('superForm').attr('action', linktoEdit);
            $('.id').val(data['id']);
            $('.code').val(data['code']);
            $('.titre').val(data['titre']);
            $('.auteur').val(data['auteur']);
            $('.genre').val(data['genre']);
            $('.appartenance').val(data['appartenance']);
            $('.etatActuel').val(data['etatActuel']);

          }else if(data['typeEdit'] == 'Jeu'){
            changeBtn();
            $('superForm').attr('action', linktoEdit);
            $('.id').val(data['id']);
            $('.libelle').val(data['libelle']);
            $('.age').val(data['age']);
            $('.type').val(data['type']);
          }
       }
    });
});

$('.btnDeleteModal').on('click', function(){
    $(location).attr('href', $('.linkToDel').attr('data-route'));
});

$('.btnSendModal').on('click', function(){
    $(location).attr('href', $('.linkToSend').attr('data-route'));
});

function changeBtn()
{
    $('.validateModal').removeClass('btn-primary');
    $('.validateModal').addClass('btn-warning');
    $('.validateModal').text('Modifier');    
}

$('.adherent').typeahead({
	delay : 500,
	source: function(query, process){
		return $.ajax({
			url: $('.adherent').attr('data-ajax'),
			headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
			type: 'post',
			data:{pattern:query},
			dataType: 'json',
			success: function(jsonResult){
				return typeof jsonResult == 'undefined' ? false : process(jsonResult)
			}
		});
	},
	updater: function(item){
		newItem = item.split('--');
		$('.idUser').val(newItem[1].trim());
		return newItem[0].trim();
	},
	minLength: 2
})

$('.jeu').typeahead({
	delay : 500,
	source: function(query, process){
		return $.ajax({
			url: $('.jeu').attr('data-ajax'),
			headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
			type: 'post',
			data:{pattern:query},
			dataType: 'json',
			success: function(jsonResult){
				return typeof jsonResult == 'undefined' ? false : process(jsonResult)
			}
		});
	},
	updater: function(item){
		newItem = item.split('--');
		$('.idJeu').val(newItem[1].trim());
		return newItem[0].trim();
	},
	minLength: 2
})

$('.livre').typeahead({
	delay : 500,
	source: function(query, process){
		return $.ajax({
			url: $('.livre').attr('data-ajax'),
			headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
			type: 'post',
			data:{pattern:query},
			dataType: 'json',
			success: function(jsonResult){
				return typeof jsonResult == 'undefined' ? false : process(jsonResult)
			}
		});
	},
	updater: function(item){
		newItem = item.split('--');
		$('.idLivre').val(newItem[1].trim());
		return newItem[0].trim();
	},
	minLength: 2
})