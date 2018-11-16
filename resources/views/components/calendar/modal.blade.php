<div class="modal p-4 fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="    background: rgba(0,0,0,0.8);">
  <div class="modal-dialog position-relative d-flex justify-content-center align-items-center" role="document">
    <div class="absolute-top-right">
        <h1 class="ti-close text-white"></h1>
    </div>
    <div class="modal-content bg-transparent w-100">
      <div class="modal-body">
      	<div class="container text-white z-10">
      		<div class="row">
      			<div class="col-10 mx-auto">
      				<h3 class="mb-5">Para quando precisa deste espaço?</h3>
      			</div>
      		</div>
      		@include('components.calendar.finder', ['z_index' => 1051])
      	</div>
      </div>
    </div>
  </div>
</div>