@if ($bootcamps->count())
	@foreach ($bootcamps as $i => $bootcamp)
		<tr>
			<td>{{ $bootcamps->firstItem() + $i }}</td>
			<td>{{ $bootcamp->nama_bootcamp }}</td>
			<td>{{ $bootcamp->pelaksanaan }}</td>
			<td>{{ $bootcamp->jenis_bootcamp }}</td>
			<td><a href="{{ $bootcamp->link }}">{{ $bootcamp->link }}</a></td>
			<td>
				<img src="{{ asset('storage/' . $bootcamp->preview) }}" width="120" alt="{{ $bootcamp->nama_bootcamp }}">
			</td>
			<td>
				<div class="action-buttons">
					<a class="btn-action" href="{{ route('admin.bootcamp.show', $bootcamp->id) }}"><i class="bi bi-pencil-square"></i></a>

					<form action="{{ route('admin.bootcamp.destroy', $bootcamp->id) }}" method="POST" class="form-hapus">
						@csrf
						@method('DELETE')
						<button class="btn-action delete" type="submit"><i class="bi bi-trash"></i></button>
					</form>
				</div>
			</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan="7">
			<div class=" text-center">Bootcamp Tidak Ada</div>
		</td>
	</tr>
@endif
