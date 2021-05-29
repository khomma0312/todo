export default class Todo {
	constructor() {
		// URLs
		this.todosUrl = '/api/todos';
		this.deleteUrl = '/delete';
		this.updateUrl = '/update';

		// status
		this.doneStatus = 1;

		// HTML class
		this.completedClass = 'completed';

		// Ajax Setup
		this.ajaxSetup();
	}

	/**
	 * Run all event registering functions.
	 */
	registerAllEvents() {
		this.registerDeleteEvent();
		this.registerUpdateEvent();
		this.registerStatusTabEvent();
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

	/**
	 * Ajax for POST request.
	 * パラメータでクリック対象と、POSTするdataのオブジェクトを受け取る
	 * @param {string} url Ajax先URL
	 * @param {Object} data Postで送るデータ
	 * @param {string} type HTTP通信の種類
	 * @returns jqXHR
	 */
	baseAjax(type, url, data = null) {
		let option = {
			type: type,
			url: url,
			dataType: 'json'
		};
		if (data) option.data = data;

		return $.ajax(option);
	}

	/**
	 * Ajax for POST request.
	 * パラメータでクリック対象と、POSTするdataのオブジェクトを受け取る
	 * @param {string} url Ajax先URL
	 * @param {Object} data Postで送るデータ
	 * @returns jqXHR
	 */
	postAjax(url, data) {
		return this.baseAjax('POST', url, data);
	}

	/**
	 * Ajax for GET request.
	 * パラメータでクリック対象と、POSTするdataのオブジェクトを受け取る
	 * @param {string} url Ajax先URL
	 * @returns jqXHR
	 */
	getAjax(url, data = null) {
		return this.baseAjax('GET', url, data);
	}

	/**
	 * 削除処理
	 * @param {*} clickElm 
	 */
	ajaxToRemoveItem(clickElm) {
		const id = clickElm.closest('.todo').data('id');
		this.postAjax(this.deleteUrl, {id})
		.done(function(data){
			const id = data.id;
			$('.todo-list .todo[data-id="' + id + '"]').remove();
		})
		.fail(function(){
			alert('削除に失敗しました。');
		});
	}

	registerDeleteEvent() {
		// clickイベント内の関数ではthisの指すものが変わるので、この時点でのthisを保存
		const classThis = this;

		$('.todo-list').on('click', '.todo .remove', function() {
			if ( confirm('Are you sure you want to remove?') === false ) {
				return;
			}
			classThis.ajaxToRemoveItem($(this));
		});
	}

	/**
	 * ステータス更新処理
	 * @param {*} clickElm 
	 */
	ajaxToUpdateStatus(clickElm) {
		const todo = clickElm.closest('.todo');
		const id = todo.data('id');
		const status = todo.hasClass(this.completedClass) ? 1 : 0;
		this.postAjax(this.updateUrl, {id, status})
		.done((data) => {
			const id = data.id;
			const todo = $('.todo-list .todo[data-id="' + id + '"]');
			if ( data.status === this.doneStatus && !todo.hasClass(this.completedClass) ) {
				todo.addClass(this.completedClass);
			} else {
				todo.removeClass(this.completedClass);
			}
		})
		.fail(() => {
			alert('ステータス更新に失敗しました。');
		});
	}

	registerUpdateEvent() {
		const classThis = this;

		$('.todo-list').on('change', '.todo .checkbox[name="status"]', function() {
			classThis.ajaxToUpdateStatus($(this));
		});
	}

	/**
	 * ステータスごとのTodoを取得
	 * @param {*} clickElm
	 */
	ajaxToGetItemsByStatus(clickElm = null) {
		const status = clickElm ? clickElm.closest('.nav-item').data('status') : null;
		this.getAjax(this.todosUrl, {status})
		.done((data) => {
			const todoList = $('.todo-list');

			// 削除処理
			todoList.empty();
			// 追加処理
			const newItems = data.todos.map((item) => this.getItemTemplate(item)).join('');
			todoList.append(newItems);
		})
		.fail(() => {
			alert('対象データの取得に失敗しました。');
		});
	}

	registerStatusTabEvent() {
		const classThis = this;

		$('.status-tab').on('click', '.nav-link', function(e) {
			e.preventDefault();
			classThis.ajaxToGetItemsByStatus($(this));
		});
	}

	/**
	 * TodoのHTMLテンプレート文字列を返す
	 * @param {Object} item
	 * @returns string
	 */
	getItemTemplate(item) {
		return (
		`<li class="todo${ item.status === '1' ? ' completed' : '' }" data-id="${ item.id }">
			<div class="form-check">
				<label class="form-check-label">
				<input class="checkbox" name="status" type="checkbox" ${ item.status === '1' ? 'checked' : '' }>
				${ item.todo }
				<i class="input-helper"></i>
				</label>
			</div>
			<i class="remove mdi mdi-close-circle-outline"></i>
		</li>`);
	}

}