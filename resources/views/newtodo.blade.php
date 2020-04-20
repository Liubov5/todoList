<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
	<script src="https://kit.fontawesome.com/65c315c965.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="/js/app.js"></script>
<link rel="stylesheet" href="/css/app.css">
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

	<style>
		.lol{
			text-decoration: line-through;
		
		}
	</style>
</head>
<body>
	
	
		<div id="app">	
				<v-app>
					<v-container>
						<v-row>
							<v-col md="3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem ducimus placeat molestiae, animi dolorum. Quibusdam rem, ullam esse perferendis, doloremque amet veritatis nostrum. Esse reiciendis, dignissimos mollitia maiores eligendi accusamus?</v-col>
							<v-col md="9">
								<v-row v-if="show">
									<v-col md="6">
												
										<v-text-field label="Важное дело"  v-model="deal"></v-text-field> 	
												    																		
									</v-col>
									<v-col md="6">
										 <v-menu
								          v-model="menu"
								          :close-on-content-click="false"
								          :nudge-right="40"
								          transition="scale-transition"
								          offset-y
								          min-width="290px"
								        >
							          	<template v-slot:activator="{ on }">
								            <v-text-field
								              v-model="picker"
								              label="Выбери дату"
								              prepend-icon="event"
								              readonly
								              v-on="on"
								            ></v-text-field>
							          	</template>

					          			<v-date-picker @input="menu = false" v-model="picker" locale="ru"  :first-day-of-week="1" color="teal darken-4"></v-date-picker>
					        			</v-menu>
									</v-col>
								</v-row>
							
									
						
									<v-btn @click="newItem" color="teal darken-4">Добавить</v-btn>
					

									
				
								
								<!--вывод дел-->
								<!--update дел, перенос дела по датам, чтобы выходило по датам, по категориям-->
								<v-list
								        subheader
								        two-line
								        flat
								>
									<v-subheader>Твои дела</v-subheader>

									<v-list-item-group>
											
										<v-list-item v-for="item in groceryList">
								            <template v-slot:default="{ active, toggle }">
									              <v-list-item-action>
									                <v-checkbox
									                  v-model="active"
									                  color="primary"
									                  @click="deleteItem(item.id)"
									                ></v-checkbox>
									              </v-list-item-action>
								  
									              <v-list-item-content>
									                <v-list-item-title>@{{item.text}}</v-list-item-title>
									                <v-list-item-subtitle>@{{item.date}}</v-list-item-subtitle>
									              </v-list-item-content>
								            </template>
										</v-list-item>

									</v-list-item-group>
								</v-list>

								<!--list todos-->
								<!--<div v-for="item in groceryList">
									<div class="row">
										<div class="col-11 ">
											<input v-if="!item.status" :value = "item.id" type="checkbox" v-model="status">	
											<span v-bind:class="{ lol: item.status}"> @{{item.text}} </span>
										</div>
										<div class="col-1">
											<i class="fas fa-times-circle" v-on:click="deleteItem(item.id)"></i>
										</div>
									</div>			
									<hr>			
								</div>-->


							</v-col>
						</v-row>
				
				
					
				</v-app>			
			</v-container>	
		</div>
	
		
	<script>	

	

	var app = new Vue({
		el:"#app",
		vuetify:new Vuetify(),		
		data() {
			return{
				groceryList: {!! json_encode($deals) !!},	
				status: [],
				show:false,
				deal:null,	
				picker: new Date().toISOString().substr(0,10),
				menu:false,
			}		
							
		},
		methods:{
			
			lol:function(arg){
				alert(arg);
			},
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
		    		
		    		let item = {
		    			date:this.picker,
		    			deal:this.deal
		    		}
		    		axios.post('/create', {body:item}).then(({data})=>{
						this.groceryList = data;
						this.deal="";
						this.date=""
						
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
			},
			check:function(arg){
				console.log(arg)
			},
			picker:function(arg){
				
			}
		}
	});

	
	</script>

</body>
</html>