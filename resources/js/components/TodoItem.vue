<template>
	<div class="mt-2">
		<p :class="{ lol: active }" > @{{ pic }} </p>				
		<input  type="checkbox" v-model="active"/>
		<button v-on:click="delet()" class="btn btn-danger">Удалить</button>
	 </div>
</template>

<script>
	export default{
		props:['pic', 'active'],
		data(){
			return{

			}
		}
	}
</script>