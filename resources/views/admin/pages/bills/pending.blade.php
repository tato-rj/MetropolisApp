@extends('admin.layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<p class="mb-4">Nós encontramos <strong>{{$pendingBills->count()}} {{ trans_choice('words.cobranças', $pendingBills->count()) }}</strong> {{ trans_choice('words.pendentes', $pendingBills->count()) }}.</p>
		<div class="card-columns">
			@foreach($pendingBills as $bill)

				@include('admin.components.cards.bill')

			@endforeach
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$('.to-preview').on('keyup', function() {
		target = '#preview-' + $(this).attr('name');

		$(target).text($(this).val());
	});
</script>
@endpush