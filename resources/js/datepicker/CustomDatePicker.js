class CustomDatePicker 
{
    constructor(element) {
    	this.element = $(element);
        this.today = moment(this.element.attr('data-now')).locale('pt').format("D [de] MMMM [de] YYYY");
    }

    create() {
        this.element.val(this.today).datepicker({
            onSelect: function(dateText, date) {
                let month = parseInt(date.selectedMonth)+1;
                let string = date.selectedYear + '-' + month + '-' + date.selectedDay;
                $('input[name="date"]').val(string).trigger('change');
            },
            beforeShowDay: $.datepicker.noWeekends
        });
    }

    enableTogglers(finders, toggleBg = true) {
    	let object = this;

        if ($(finders).is('select')) {
            $(finders).on('change', function() {
                let $this = $(this).find('option:selected');

                object._updateSelect($this.attr('data-target'));
            });
        } else {
    		$(finders).on('click', function() {
    		    let $this = $(this);

                if (toggleBg)
    		      object._updateBackground($this.attr('data-background'));
    			
                object._updateSelect($this.attr('data-target'));
                object._updateSpace($this.attr('data-target'));
    			object._updateButtons($this);
    		});
        }

		return this;
    }

    enableSelect(element) {
        let object = this;

        $(element).on('change', function() {
            let $this = $(this).find(':selected');
            
            object._updateSelect($this.attr('data-target'));
        });

        return this;
    }

    _updateSpace(space) {
        $('input[name="type"]').val(space);
    }

    _updateSelect(target) {
		$('select.participants').not('#select-participants-'+target).removeAttr('name').hide();
		$('#select-participants-'+target).attr('name', 'participants').show();
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