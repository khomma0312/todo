<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	{{-- Add CSRF Token --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Todo</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/assets/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
</head>
<body>
	<div class="page-content page-container" id="page-content">
		<div class="padding">
			<div class="row container d-flex justify-content-center">
				<div class="col-md-12">
					<div class="card px-3">
						<div class="card-body">
							<h4 class="card-title">Awesome Todo list</h4>
							@yield('error')
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

  <script src="https://kit.fontawesome.com/e3c22ed780.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
