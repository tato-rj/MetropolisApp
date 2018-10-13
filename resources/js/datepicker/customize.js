class CustomDatePicker 
{
    constructor(element) {
    	this.element = $(element);
        this.today = moment().locale('pt').format("dddd, D [de] MMMM [de] YYYY");
    }

    create() {
        this.element.val(this.today).datepicker();
    }

    enableTogglers(finders) {
		$(finders).on('click', function() {
		    let $this = $(this);
		    let background = $this.attr('data-background');

		    if (background)
			    $('#lead').css('background-image', background);

		    $this.addClass('btn-light').removeClass('btn-dark opacity-6').find('i').addClass('text-teal');
		    $this.siblings().addClass('btn-dark opacity-6').removeClass('btn-light').find('i').removeClass('text-teal');
		});

		return this;
    }
}

window.CustomDatePicker = CustomDatePicker;