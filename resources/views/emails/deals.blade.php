<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Дела</title>
</head>
<body>
	<h1>Пропущенные дела за сегодня</h1>
	@foreach($deals as $deal)
	<p>{{ $deal->text }}</p>
	@endforeach
	<p>Зайди в кабинет и поменяй дату</p>
</body>
</html>