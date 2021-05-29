{{-- classにcompletedをつけることで線が引かれる --}}
<li class="todo{{ $item->isDone() ? ' completed' : '' }}" data-id="{{ $item->id }}">
	<div class="form-check">
		<label class="form-check-label">
		<input class="checkbox" name="status" type="checkbox" {{ $item->isDone() ? 'checked' : '' }}>
		{{ $item->todo }}
		<i class="input-helper"></i>
		</label>
	</div>
	<i class="remove mdi mdi-close-circle-outline"></i>
</li>