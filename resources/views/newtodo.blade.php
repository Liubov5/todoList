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
<body >	
	

	@guest
		   <p>нет доступа</p>
	@endguest
	
	@auth
		<div id="app" >	
				<v-app >
					<v-container>
						 <v-row>
						 	<v-col md="9"></v-col>	
						 	<v-col md="3">
						 		<ul class="navbar-nav ">
		                            <li class="nav-item dropdown">
		                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
		                                   Привет,  {{ Auth::user()->name }} <span class="caret"></span>
		                                </a>

		                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		                                    <a class="dropdown-item" href="{{ route('logout') }}"
		                                       onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                        {{ __('Logout') }}
		                                    </a>

		                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                        @csrf
		                                    </form>
		                                </div>
		                            </li>
                        		</ul>
						 	</v-col>		
						 </v-row>
						
						<v-row>
							<!--левая колонка-->
								<v-col md="3">
									<p>Ближайшие планы</p>

									<v-hover v-slot:default="{ hover }"  close-delay="200">
										<v-card :elevation="hover ? 16 : 2"> 									
											<v-menu transition="slide-x-transition" bottom right>
												<template v-slot:activator="{ on }" >
													<v-col dark v-on="on">
														@{{ nextDays(1,"ru") }}
													</v-col>
												</template>
												<v-list>
													<v-list-item
											            v-for="item in groceryList"
											           	v-if="item.date == nextDays(2, 'isos')"									            
											          >
											            	<v-list-item-title>@{{ item.text }}</v-list-item-title>
											         </v-list-item>
												</v-list>
											</v-menu>

										</v-card>
									</v-hover>

									<v-hover v-slot:default="{ hover }"  close-delay="200">
										<v-card class="mt-4" :elevation="hover ? 16 : 2"> 
											
											
											<v-menu transition="slide-x-transition" bottom right>
												<template v-slot:activator="{ on }" >
													<v-col dark v-on="on">
														@{{ nextDays(2,"ru") }}
													</v-col>
												</template>
												<v-list>
													<v-list-item
											            v-for="item in groceryList"
											            v-if="item.date == nextDays( 3, 'isos') "
											           
											          >
											            	<v-list-item-title>@{{ item.text }}</v-list-item-title>
											         </v-list-item>
												</v-list>
											</v-menu>

										</v-card>
									</v-hover>

									<v-hover v-slot:default="{ hover }"  close-delay="200">
										<v-card class="mt-4" :elevation="hover ? 16 : 2"> 
											
											
											<v-menu transition="slide-x-transition" bottom right>
												<template v-slot:activator="{ on }" >
													<v-col dark v-on="on">
														@{{ nextDays(3,"ru") }}
													</v-col>
												</template>
												<v-list>
													<v-list-item
											            v-for="item in groceryList"
											            v-if="item.date == nextDays(4, 'isos') "
											           
											          >
											            	<v-list-item-title>@{{ item.text }}</v-list-item-title>
											         </v-list-item>
												</v-list>
											</v-menu>
										</v-card>
									</v-hover>
									<div class="mt-5">
										<p>Невыполненные дела</p>
										<div v-for="item in groceryList">
											<v-alert border="left" color="orange" v-if="old_deals(item)"> 											
										         <v-row>
										         	<v-col md="6">
										         		<div>@{{item.text}}</div>
										        		<div>@{{item.date}}</div>
										         	</v-col>
										         	<v-col md="3"></v-col>
										         	<v-col md="2">
										         		<v-icon @click="deleteItem(item.id)">fas fa-trash</v-icon>
														
										         	</v-col>
										         	
										         </v-row>											        						      		
											</v-alert>
										</div>
									</div>		
									
								</v-col> 
							<!--правая колонка-->
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
									<v-subheader class="font-weight-bold title teal--text text--lighten-3">Твои дела на @{{today_ru}}</v-subheader>

									<v-list-item-group>
											
										
										<v-list-item color="teal darken-4" v-for="item in groceryList" v-if="item.date == new Date().toISOString().substr(0,10)">
										
											
									            <template v-slot:default="{ active, toggle }" class="teal darken-4">
													

												        <v-list-item-action>
												                <v-checkbox
												                 
												                  :value="item.id"
												                  color="primary"
													                 v-model="id"
													                 v-if="!item.status"
												                ></v-checkbox>
												        </v-list-item-action>

															
									  				
										              <v-list-item-content>
										                <v-list-item-title v-bind:class="{ lol: item.status}">@{{item.text}}</v-list-item-title>
										                <v-list-item-subtitle></v-list-item-subtitle>
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
	@endauth
		
	<script>	
	

	var options = {
 
		  year: 'numeric',
		  month: 'long',
		  day: 'numeric',
		  weekday: 'long',
		  timezone: 'UTC',

	};

	var app = new Vue({
		el:"#app",
		vuetify:new Vuetify({
			icons: {
		    	iconfont: 'mdi',
		  },
		}),		
		data() {
			return{
				groceryList: {!! json_encode($deals) !!},	
				show:false,
				deal:null,	
				picker: new Date().toISOString().substr(0,10),
				menu:false,
				today_ru:new Date().toLocaleString("ru", options),
				day:0,
				id:0,
				today_isos:new Date().toISOString().substr(0,10),
			}									
		},
		methods:{
			
			
			deleteItem:function(arg){
				axios.post('/deleteItem', {body:arg}).then(({data})=>{
					this.groceryList = data;		
				});
			},
			nextDays(arg, arg2){
				let dayy = new Date().getDate() + arg;
				let month = new Date().getMonth();
				let year = new Date().getFullYear();
					
				var options = { 
					  month: 'long',
					  day: 'numeric',
					  weekday: 'long',
					 
				};
				
				let newDate = new Date(year, month, dayy);

				if(arg2 == "ru"){

					return newDate.toLocaleString("ru", options);

				}

				if(arg2 == "isos"){
					return  newDate.toISOString().substr(0,10);
						
					
				}			
			},
    		

		    newItem: function(){
		    	this.show = !this.show;
		    	if(!this.show){
		    		
		    		let item = {
		    			date:this.picker,
		    			deal:this.deal,
		    			user_id: {!! Auth::user()->id  !!},
		    		}
		    		axios.post('/create', {body:item}).then(({data})=>{
						this.groceryList = data;
						this.deal="";
						this.date="";
						console.log(data)

						
					});
		    	}
		    },
		   
			old_deals(arg){
				if(!arg.status && arg.date < this.today_isos){
					return true;
				}
			}
		},
		computed:{

		},
		created(){
			this.groceryList.sort(function(a,b){
				var dateA = new Date(a.date), dateB = new Date(b.date);
				return dateA-dateB;
			})
		},
		watch:{
			id:function(arg){
				axios.post('/updateStatus', { body:arg }).then(({data})=>{
					this.groceryList = data;	
					
					console.log()			
				});

				console.log(arg)
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