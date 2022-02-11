<template>
  <div class="container">
      
      <h1>{{post.title}}</h1>
      <h3
      v-if="post.category"
      >
      {{post.category.name}}
      </h3>
      <h4
      v-for="(tag, index) in post.tags"
      :key="`tag${index}`"
      >
      {{tag.name}}
      </h4>
      <p>{{post.content}}</p>
  </div>
</template>

<script>
export default {
    name: 'PostDetail',

    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts/',
            post: {
                title: '',
                category: {},
                tags: [],
                content: '',
            }
        }
    },

    methods: {
        getApi(){
            axios.get(this.apiUrl + this.$route.params.slug)
            .then(res => {
                console.log('2');
                this.post = res.data;
                console.log('post', this.post);
            })
        }
    },

    mounted(){
        console.log('1');
        this.getApi();
    }
    
}
</script>

<style lang="scss" scoped>

</style>