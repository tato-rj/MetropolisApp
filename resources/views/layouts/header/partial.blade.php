<section id="lead" class="bg-align-center h-60vh position-relative" style="background-image: url({{asset("images/{$background}.jpg")}})">
	<div class="overlay-darkest"></div>
	<div class="d-flex flex-center flex-column h-100 pt-5">
		{{$slot}}
	</div>
</section>
<div id="scroll-mark"></div>