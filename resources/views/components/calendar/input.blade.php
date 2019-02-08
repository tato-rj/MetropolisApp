<div class="icon-input position-relative">
	<input type="hidden" name="date" value="@include('components.calendar.date-value')">
	<input class="form-control cursor-pointer" style="position: relative; z-index: {{$z_index ?? 20}}" type="text" 
		autocomplete="off" id="datepicker" data-now="@include('components.calendar.date-value')">
	<i class="text-teal fas fa-calendar-alt" style="z-index: {{$z_index ?? 20}}"></i>
</div>