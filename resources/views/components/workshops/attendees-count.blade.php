@if(! $workshop->attendees->isEmpty())
<div class="text-muted my-2 small">
	<i class="fas fa-users mr-1"></i><strong>{{$workshop->attendees_count}}</strong> {{str_plural('pessoas', $workshop->attendees_count)}} confirmadas
</div>
@endif