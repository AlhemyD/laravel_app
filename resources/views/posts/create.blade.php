<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Создание записи</title>
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4 text-center">Создать запись</h1>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Содержимое:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>
			<div class="form-group">
                <label for="publish_at">Дата публикации:</label>
				<input type="datetime-local" id="publish_at" name="publish_at"class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Создать</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Отменить</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
