<template>
  <main>

    <div class="container">

        <h1>POSTS</h1>

        <PostItem 
            v-for="post in posts"
            :key="post.id"
            :post="post"
        />
        
        <button
        @click="getPosts(pages.current -1)"
        :disabled="pages.current === 1"
        >Prev
        </button>

        <button
        v-for="page in pages.last"
        :key="`button${page}`"
        @click="getPosts(page)"
        :disabled="page.current === page"
        >
        {{page}}
        </button>

        <button
        @click="getPosts(pages.current +1)"
        :disabled="pages.current === pages.last"
        >Next
        </button>
    </div>
  </main>
</template>

<script>

import PostItem from '../partials/PostItem.vue';


export default {
    name: 'Posts',

    components:{
        PostItem
    },

    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts?page=',
            posts: null,
            pages: {}
        }
    },
    mounted(){
        this.getPosts();
    },

    methods:{
        getPosts(page = 1){
            axios.get(this.apiUrl + page)
            .then(res=>{
                this.posts = res.data.data
                console.log(this.posts);
                this.pages = {
                    current: res.data.current_page,
                    last: res.data.last_page
                }
            })
        }
    }

}
</script>

<style lang="scss">

main{
    padding: 50px 0px;
    h1{
        margin-bottom: 20px;
    }
    button{
        margin: 10px 2px 40px 2px;
        padding: 5px 7px;
    }
}

</style>