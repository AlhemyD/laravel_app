<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Неодобренные комментарии</title>
    <style>
        body {
            padding: 20px;
        }
        table {
            margin-top: 20px;
        }
        .btn-approve {
            background-color: #28a745; /* Зеленый цвет для кнопки "Одобрить" */
            color: white;
        }
    </style>
</head>
<body>
	<div class="text-right mb-3">
        <a href="{{ route('posts.index') }}" class="btn btn-success">Страница блога</a>
    </div>
    <div class="container">
        <h1 class="text-center">Неодобренные комментарии</h1>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Автор</th>
                    <th>Комментарий</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->author }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>
                            <form action="{{ route('comments.approve', $comment) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-approve">Одобрить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
