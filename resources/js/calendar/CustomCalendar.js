class CustomCalendar
{
	constructor(element) {
		this.element = $(element);
		this.isEditable = false;
		this.createButton = null;
		this.defaultView = 'month';
		this.defaultHeader = {
	    	left: 'prev,next today',
	    	center: 'title',
	    	right:  'newEvent month,agendaWeek,agendaDay'
	    }
	}

	create() {
		let object = this;
		let createButton = object.createButton;
		let schedule = this.element.attr('data-events');
		let ajaxUrl = this.element.attr('data-ajax');

	  this.element.fullCalendar({
	    minTime: '08:00',
	    defaultView: object.defaultView,
	    navLinks: true,
	    maxTime: '18:00',
	    allDaySlot: false,
	    eventLimit: 3,
	    businessHours: {
	      start: app.office.day_starts_at+':00',
	      end: app.office.day_ends_at+':00',
	    },
	    customButtons: createButton,
	    header: object.defaultHeader,
	    selectConstraint: "businessHours",
	    views: {
	      month: {
	        titleFormat: 'MMMM YYYY'
	      },
	      week: {
	        titleFormat: 'D MMMM YYYY',
	      },
	      day: {
	        titleFormat: '[Dia] D[,] MMMM YYYY',
	      }
	    },
	    events: JSON.parse(schedule),
	    eventClick: function(event, jsEvent, view) {
			let modalId = $(this).attr('data-modal');
			let $modal = $(modalId);

			$modal.modal('show');
	    	
			$.post(ajaxUrl, {event_id: event.id, user_type: app.user.type},
				function(data, status){
					$modal.find('.modal-body > div:first-child').html(data);

					$modal.find('.modal-footer input[name="event_id"]').val(event.id);

					fullDatePT($modal.find('.date'));

					$modal.find('#loading').hide();

					if ($modal.find('#participants').attr('data-participants') > 1)
						$modal.find('.modal-footer').show();

				}).fail(function() {
					$modal.find('.modal-body > div:first-child').html('<p class="text-center my-4 text-red">Não foi possível processar o seu pedido nesse momento</p>');

					$modal.find('#loading').hide();
				});
	    },

	    eventRender: function( event, element, view ) {
	    	if (event.end.isBefore(moment({hour: 0})) || event.statusForUser == 'Cancelado') {
	    		$(element).addClass('btn-grey');
	    	} else if (event.has_conflict) {
	    		$(element).addClass('btn-red');
	    	} else if (event.statusForUser != 'Confirmado' && event.statusForUser != 'Cancelado') {
	    		$(element).addClass('btn-yellow');
	    	} else {
	    		$(element).addClass('btn-teal');
	    	}

	      if (event.plan_id === null) {
	        $(element).attr('data-modal', '#event-modal');
	      } else {
	        $(element).attr('data-modal', '#plan-modal');
	      }
	    },
	    eventAfterAllRender: function (view) {
	        $('#calendar-loading').remove();
	        $('.fc-day-number').attr('title', 'Ver agenda nesse dia');
	    },
	    eventDrop: function(event, delta, revertFunc) {
	    	if (! object.isEditable) {
	    		alert('Você não tem autorização para editar os eventos.');
	    		revertFunc();
	    	} else if (!confirm("Tem certeza de que deseja atualizar esse evento?")) {
	    		revertFunc();
	    	} else {
	    		object._updateDatetime(event.id, event.start.format(), event.end.format())
	    	}
	    },
	    eventResize: function(event, delta, revertFunc) {
	    	if (! object.isEditable) {
	    		alert('Você não tem autorização para editar os eventos.');
	    		revertFunc();
	    	} else if (!confirm("Tem certeza de que deseja atualizar esse evento?")) {
	    		revertFunc();
	    	} else {
	    		object._updateDatetime(event.id, event.start.format(), event.end.format())
	    	}
	    }
	  })
	}

	creatable() {
		let object = this;
		
		this.createButton = {	      
			newEvent: {
		        text: 'Criar reserva',
		        click: function() {
		          window.location.href = object.createEventUrl;
		        }
	      	}
	  	};

		return this;
	}

	editable() {
		this.isEditable = true;
		this.updateDatetimeUrl = this.element.attr('data-update-datetime');
		this.createEventUrl = this.element.attr('data-create-event');

		return this;
	}

	view(view) {
		this.defaultView = view;
		this.defaultHeader = false;

		return this;
	}

	_updateDatetime(event_id, starts_at, ends_at) {
		let object = this;
		let $overlay = $('#loading-overlay');

		$overlay.fadeIn('fast');

		$.post(object.updateDatetimeUrl, {event_id: event_id, starts_at: starts_at, ends_at: ends_at},
			function(data, status){
				$overlay.fadeOut('fast');
				$('body').append(data);
			}).fail(function() {
				alert('Não foi possível realizar esse pedido agora.');
				$overlay.fadeOut('fast');
			});
	}
}

window.CustomCalendar = CustomCalendar;