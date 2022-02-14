<template>
  <main>

    
        <div v-if="success" class="container display">
            <div>

                <h1>{{title}}</h1>

                <PostItem 
                v-for="post in posts"
                :key="post.id"
                :post="post"
                />
            <div class="navigation" v-if="globalPost">

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
            </div>
            <Sidebar 
            :tags="tags"
            :categories="categories"
            @getPostCategory="getPostCategory"
            @getPostTag="getPostTag"
            @getAllPosts="getPosts"
            />


        </div>
    <div v-else>
        <h2>{{error_msg}}</h2>
    </div>

    
  </main>
</template>

<script>

import PostItem from '../partials/PostItem.vue';
import Sidebar from '../partials/Sidebar.vue';


export default {
    name: 'Posts',

    components:{
        PostItem,
        Sidebar
    },

    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts',
            posts: null,
            pages: {},
            tags: [],
            categories: [],
            success: true,
            error_msg: '',
            title: 'I MIEI POST',
            globalPost: true
        }
    },
    mounted(){
        this.getPosts();
    },

    methods:{

        getPostTag(slug_tag){
            this.reset();
            axios.get(this.apiUrl + '/posttag/' + slug_tag)
            .then(res=> {
                this.posts = res.data.tag.posts;
                this.globalPost = false;
                this.title = 'I MIEI POST DIVISI PER TAG: ' + res.data.tag.name;
                if(!res.data.success){
                    this.error_msg = res.data.error;
                    this.success = false;
                }
                
            })
        },

        getPostCategory(slug_category){
            this.reset();
            axios.get(this.apiUrl + '/postcategory/' + slug_category)
            .then(res=> {
                this.posts = res.data.category.posts;
                this.globalPost = false;
                this.title = 'I MIEI POST DIVISI PER CATEGORIA: ' + res.data.category.name;
                if(!res.data.success){
                    this.error_msg = res.data.error;
                    this.success = false;
                }
                
            })
            
        },

        getPosts(page = 1){
            this.reset();
            
            axios.get(this.apiUrl + '?page=' + page)
            .then(res=>{
                this.posts = res.data.posts.data;
    
                this.categories = res.data.categories;
                this.tags = res.data.tags;
                console.log(this.posts);
                this.pages = {
                    current: res.data.posts.current_page,
                    last: res.data.posts.last_page
                }
            })
        },

        reset(){
            this.error_msg = '';
            this.success = true;
            this.posts = null;
            this.title = 'I MIEI POST';
            this.globalPost = true;
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
    .display{
        display: flex;
    }
}

</style>