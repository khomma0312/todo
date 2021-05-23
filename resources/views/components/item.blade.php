{{-- classにcompletedをつけることで線が引かれる --}}
<li class="todo {{ $item->getCompleted() }}" data-id="{{ $item->id }}">
	<div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> {{ $item->todo }} <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
</li>