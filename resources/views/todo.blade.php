<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="/js/app.js"></script>
	<style>
		.lol{
			text-decoration: line-through;
		
		}
	</style>
</head>
<body>
	<div class="container">
		<div id="app">
			@{{ test }}
			<new-todo-item></new-todo-item>
		
			<todo-item  v-for="item in groceryList"
						v-bind:pic="item.text"
						v-bind:active="item.status"										
			></todo-item>	
		</div>
	</div>
	
	

	
	<script>	
	Vue.component('todo-item',{
		props:['pic', 'active'],
		data(){
			return{
			
			}
		},
		methods:{		
			delet:function(){
				 alert()
			}			
		},
		watch:{
			
		},
		template:`<div class="mt-2">
					<p :class="{ lol: active }" > @{{ pic }} </p>				
					<input  type="checkbox" v-model="active"/>
					<button v-on:click="delet()" class="btn btn-danger">Удалить</button>
				 </div>`
	});

	Vue.component('new-todo-item',{
		data(){
			return{
				deal:null,
			}
		},
		methods:{
			createDeal(){
				axios.post('/create', {body:this.deal}).then(({data})=>{
					console.log(data);			
				});
			}
		},
		template:`<div class="mt-2">
					<textarea v-model="deal" class="form-control" placeholder="Новое дело"></textarea>
					<br>
					<button class="btn btn-success" v-on:click="createDeal()">Создать важное дело</button>
				</div>`
	});



	var app = new Vue({
		el:"#app",	

		data: {		
			groceryList: {!! json_encode($deals) !!},					
			test: "s",
		},
		methods:{
			
		},
		mounted(){
			//this.groceryList =  {!! json_encode($deals) !!}
			console.log(this.groceryList)
		}
	});
	</script>

</body>
</html>