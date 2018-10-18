class CustomDatePicker 
{
    constructor(element) {
    	this.element = $(element);
        this.today = moment().locale('pt').format("dddd, D [de] MMMM [de] YYYY");
    }

    create() {
        this.element.val(this.today).datepicker({
            onSelect: function(dateText, date) {
                $('input[name="date"]').val(date.selectedYear + '-' + date.selectedMonth + '-' + date.selectedDay);
            }
        });
    }

    enableTogglers(finders) {
    	let object = this;
		$(finders).on('click', function() {
		    let $this = $(this);

		    object._updateBackground($this.attr('data-background'));
			object._updateSelect($this.attr('data-target'));
            object._updateSpace($this.attr('data-target'));
			object._updateButtons($this);
		});

		return this;
    }

    _updateSpace(space) {
        $('input[name="space"]').val(space);
    }

    _updateSelect(target) {
		$('select.capacity').not('#select-'+target).hide();
		$('#select-'+target).show();
    }

    _updateButtons(button) {
		button.addClass('btn-light').removeClass('btn-dark opacity-6').find('i').addClass('text-teal');
		button.siblings().addClass('btn-dark opacity-6').removeClass('btn-light').find('i').removeClass('text-teal');   	
    }

    _updateBackground(background) {
	    if (background)
		    $('#lead').css('background-image', background);
    }
}

window.CustomDatePicker = CustomDatePicker;