fullDatePT = function($element)
{
	$element.text(
		moment(
			$element.attr('data-date')
			).locale('pt').format("D [de] MMMM [de] YYYY")
		);
}

jQuery.fn.cleanVal = function() {
	return this.val().replace(/\D/g,'');
};