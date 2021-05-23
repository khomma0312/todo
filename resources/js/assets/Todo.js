export default class Todo {
	constructor() {
		this.ajaxSetup();
	}

	/**
	 * Run all event registering functions.
	 */
	registerAllEvents() {
		this.registerDeleteEvent();
	}

	/**
	 * Setup token for Ajax request
	 */
	ajaxSetup() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	}

	ajaxToDelete(clickElm) {
		let id = clickElm.parent().data('id');
		$.ajax({
			type: 'POST',
			url: '/delete',
			dataType: 'json',
			data: {
				id
			}
		})
		.done(function(data){
			let id = data.id;
			$('.todo-list .todo[data-id="' + id + '"]').remove();
		})
		.fail(function(){
			alert('削除に失敗しました。');
		});
	}

	registerDeleteEvent() {
		const classThis = this;

		$('.todo .remove').on('click', function() {
			if ( confirm('Are you sure you want to remove?') === false ) {
				return;
			}

			classThis.ajaxToDelete($(this));
		});
	}

}