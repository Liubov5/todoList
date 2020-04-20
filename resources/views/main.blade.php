<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<script src="/js/app.js"></script>
<body>
	<div id="app">	
		
		@foreach($sections as $section)
		<h3>{{ $section->name }}</h3>
		<p>The most popular: </p>
			@foreach($section->challenges as $challenge)	
				@if($challenge->joins >= 80)
					<form action="/showChallenge/{{$challenge->id}}" method="GET">
						<button type="submit" style="background: none; border:none">
							<span>{{ $challenge->text }}</span>
						</button>
					</form>
						
				
				@endif
			@endforeach
		@endforeach
	</div>
<script>
	var app = new Vue({
		el:"#app",	

		data:{

		},
		methods:{
			viewChallenge:function(arg){
				axios.get('/showChallenge', {body:arg}).then(({data})=>{
						console.log(data)	
				});
			}
		}
	});
</script>
</body>
</html>