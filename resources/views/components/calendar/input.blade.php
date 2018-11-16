<div class="icon-input position-relative">
	<input class="form-control cursor-pointer" style="position: relative; z-index: {{$z_index ?? 20}}" type="text" autocomplete="off" id="datepicker" data-now="{{request()->date ?? now()}}">
	<i class="text-teal fas fa-calendar-alt" style="z-index: 20"></i>
</div>