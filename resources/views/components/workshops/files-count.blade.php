@if($workshop->hasFiles())
<div class="text-muted my-2 small">
	<i class="fas fa-cloud-download-alt mr-1"></i><strong>{{$workshop->files_count}}</strong> {{str_plural('arquivo', $workshop->files_count)}} para download
</div>
@endif