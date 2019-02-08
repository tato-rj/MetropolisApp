@if($workshop->hasFiles())
<div class="d-flex flex-wrap">
	@foreach($workshop->files as $file)	
		<div class="m-2 text-center position-relative" style="width: 6.25em">
			@if($removable)
			<div class="position-absolute cursor-pointer remove-file" 
				data-path="{{route('admin.workshops.file.destroy', [$workshop->slug, $file->id])}}" 
				title="Remover o arquivo" style="top: 0; right: 0">
				<i class="fas fa-times-circle text-red"></i>
			</div>
			@endif
			@if(auth()->guard('admin')->check() || (auth()->guard('web')->check() && auth()->guard('web')->user()->workshops->contains($workshop)))
				<a href="{{asset($file->download_path)}}" title="Baixar o arquivo" class="link-none">
					<img src="{{asset($file->icon)}}" width="60" class="mb-1">
					<label class="d-block text-truncate cursor-pointer">
						<small>{{$file->name}}</small>
					</label>
				</a>
			@else
				<img src="{{asset($file->icon)}}" width="60" class="mb-1">
				<label class="d-block text-truncate">
					<small>{{$file->name}}</small>
				</label>
			@endif

		</div>
	@endforeach
</div>
@endif