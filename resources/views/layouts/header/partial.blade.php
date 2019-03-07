<section id="lead" class="bg-align-center position-relative" style="background-image: url('{{asset($background)}}')">
	<div class="overlay-darkest"></div>
	<div class="d-flex flex-center flex-column h-100 pb-6" style="padding-top: {{$size ?? 9}}em">
		{{$slot}}
	</div>
</section>
<div id="scroll-mark"></div>