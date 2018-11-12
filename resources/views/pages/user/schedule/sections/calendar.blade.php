<section class="mb-7 mt-6 container">
  <div class="row">
  	<div class="col-10 mx-auto">
  		<div id='calendar' data-events="{{auth()->user()->eventsArray}}" data-ajax="{{route('client.events.ajax')}}"></div>
  	</div>
  </div>
</section>