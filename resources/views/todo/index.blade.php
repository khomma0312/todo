@extends('layouts.app')

@section('content')
<div class="page-content page-container" id="page-content">
	<div class="padding">
		<div class="row container d-flex justify-content-center">
			<div class="col-md-12">
				<div class="card px-3">
					<div class="card-body">
						<h4 class="card-title">Awesome Todo list</h4>
							@include('components.error', ['errors' => $errors])
						<div class="add-items">
							<form action="/add" method="post" class="d-flex">
								@csrf
								<input type="text" class="form-control todo-list-input" name="todo" placeholder="What do you need to do today?">
								<input type="submit" class="add btn btn-primary font-weight-bold todo-list-add-btn" value="Add">
							</form>
						</div>
						<div class="status-tab">
							<ul class="nav nav-tabs">
								<li class="nav-item" data-status="all"><a class="nav-link active" href="#">All</a></li>
								<li class="nav-item" data-status="completed"><a class="nav-link" href="#">Completed</a></li>
								<li class="nav-item" data-status="uncompleted"><a class="nav-link" href="#">Uncompleted</a></li>
							</ul>
						</div>
						<div class="list-wrapper">
							<ul class="d-flex flex-column-reverse todo-list">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
