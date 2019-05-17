<template>
</template>
export default{
	created(){
		Axios.get('api/delete/post',this.$route.params.id).then((response)=>{
			console.log('created');
			router.push('/posts');
		})
	}
}