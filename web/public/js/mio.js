$( document ).ready(function() {

	$check = $('#fos_user_registration_form_tipo_1');
	if($check[0].checked == true){
			$label = $('label[for="fos_user_registration_form_apellido"]');
            $label[0].innerHTML = 'Razón social';
            $label = $('label[for="fos_user_registration_form_nombre"]');
            $label[0].innerHTML = 'Nombre de la empresa';
            $label = $('label[for="fos_user_registration_form_dni"]');
            $label[0].innerHTML = 'CUIT';

            $label = $('#fos_user_registration_form_sexo');
            $label.parent().parent().hide();
	};

	/* cambiar label de corporativo o particular */
    $('#fos_user_registration_form_tipo_0').click(function () {
        if ($(this).is(':checked')) {
        	$label = $('#fos_user_registration_form_sexo');
            $label.parent().parent().attr('style', 'display:block');
            $label = $('label[for="fos_user_registration_form_apellido"]');
            $label[0].innerHTML = 'Apellido';
            $label = $('label[for="fos_user_registration_form_nombre"]');
            $label[0].innerHTML = 'Nombre';
            $label = $('label[for="fos_user_registration_form_dni"]');
            $label[0].innerHTML = 'Cuil';
        }
    });

    $('#fos_user_registration_form_tipo_1').click(function () {
        if ($(this).is(':checked')) {
            $label = $('label[for="fos_user_registration_form_apellido"]');
            $label[0].innerHTML = 'Razón social';
            $label = $('label[for="fos_user_registration_form_nombre"]');
            $label[0].innerHTML = 'Nombre de la empresa';
            $label = $('label[for="fos_user_registration_form_dni"]');
            $label[0].innerHTML = 'CUIT';

            $label = $('#fos_user_registration_form_sexo');
            $label.parent().parent().hide();
        }
    });
});