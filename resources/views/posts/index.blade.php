<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Блог</title>
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4 text-center">Записи блога</h1>
		<div class="text-left mb-3">
            <a href="{{ route('comments.index') }}" class="btn btn-success">Модерирование комментариев</a>
        </div>
        <div class="text-right mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Создать запись</a>
        </div>
        <ul class="list-group">
            @foreach ($posts as $post)
				
                <li class="list-group-item">
                    <h5 class="mb-1">{{ $post->title }}</h5>
                    <p class="mb-1">{{ Str::limit($post->content, 100) }}</p>
					@if($post->published)
						<small>{{ $post->published_at }}</small>
						<br>
					@endif
                    <form action="{{ route($post->published ? 'posts.unpublish' : 'posts.publish', $post) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm">{{ $post->published ? 'Снять с публикации' : 'Опубликовать' }}</button>
                    </form>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
					<h3>Комментарии</h3>
					<div id="comments-section"  style="max-height: 200px; overflow-y:auto;">						
						@foreach($comments as $comment)
							@if($comment->is_approved && $comment->post_id == $post->id)
								<div class="comment">
									<strong>{{ $comment->author }}</strong>
									<p>{{ $comment->content }}</p>
									<small>{{ $comment->created_at->diffForHumans() }}</small>
								</div>
							@endif
						@endforeach
					</div>
					<h4>Добавить комментарий</h4>
					<form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="author">Имя:</label>
							<input type="text" id="author" name="author" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="content">Комментарий:</label>
							<textarea id="content" name="content" class="form-control" required></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Отправить</button>
					</form>
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
