<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
	<script src="https://kit.fontawesome.com/65c315c965.js" crossorigin="anonymous"></script>
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
			<div class="my-3">
				<i class="fas fa-pencil-alt"></i>
				<transition 
							v-on:enter="enter"
						    v-bind:css="false">					
						<input class="form-control" type="text" v-if="show" v-model="deal">					
				</transition>	
				<span class="text text-success" @click="newItem">Добавить </span>
					
			</div>
		
			<div v-for="item in groceryList">
				<div class="row">
					<div class="col-11 px-0">
						<input v-if="!item.status" :value = "item.id" type="checkbox" v-model="status">	
						<span v-bind:class="{ lol: item.status}"> @{{item.text}} </span>
					</div>
					<div class="col-1">
						<i class="fas fa-times-circle" v-on:click="deleteItem(item.id)"></i>
					</div>
				</div>			
				<hr>			
			</div>

		</div>
	</div>
	
	

	
	<script>	

	

	var app = new Vue({
		el:"#app",	

		data: {		
			groceryList: {!! json_encode($deals) !!},	
			status: [],
			show:false,
			deal:null,
				
		},
		methods:{
			deleteItem:function(arg){
				axios.post('/deleteItem', {body:arg}).then(({data})=>{
					this.groceryList = data;		
				});
			},
			
    		enter: function (el, done) {
		      Velocity(el, { opacity: 1, fontSize: '1.4em' }, { duration: 300 })
		      Velocity(el, { fontSize: '1em' }, { complete: done })
		    },

		    newItem: function(){
		    	this.show = !this.show;
		    	if(!this.show){
		    		axios.post('/create', {body:this.deal}).then(({data})=>{
						this.groceryList = data;
					});
		    	}
		    }

		},
		mounted(){
			
		},
		watch:{
			status:function(arg){
				axios.post('/updateStatus', { body:arg[0] }).then(({data})=>{
					this.groceryList = data;	
					
					console.log()			
				});
			}
		}
	});
	</script>

</body>
</html>