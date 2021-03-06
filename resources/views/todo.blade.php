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
			
			<new-todo-item></new-todo-item>
		
			<todo-item  v-for="item in groceryList"
						v-bind:pic="item.text"
						v-bind:active="item.status"	
						v-bind:key="item.id"									
			></todo-item>	
		</div>
	</div>
	
	

	
	<script>	
	Vue.component('todo-item',{
		props:['pic', 'active','key'],
		data(){
			return{
			
			}
		},
		methods:{		
			delet:function(arg){
				
				axios.post('/deleteItem', {body:arg.key}).then(({data})=>{
					 this.$forceUpdate();			
				});
			}			
		},
		watch:{
			
		},
		template:`<div class="mt-2">
					<p :class="{ lol: active }" > @{{ pic }} </p>
							
					<input  type="checkbox" v-model="active"/>
					<button v-on:click="delet({ idd })" class="btn btn-danger">Удалить</button>
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
		},
		methods:{
			
		},
		mounted(){
			this.groceryList =  {!! json_encode($deals) !!}
			//console.log(this.groceryList)
		}
	});
	</script>

</body>
</html>