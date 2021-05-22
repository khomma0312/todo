{{-- classにcompletedをつけることで線が引かれる --}}
<li class="{{ $completed }}">
	<div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> {{ $todo }} <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
</li>