<template>
    <div class="sidebar"> 
            <div class="box">
                <h3>Categorie</h3>
                <div class="category">

                    <span 
                     v-for="category in categories"
                     :key="`category${category.id}`"
                     @click="$emit('getPostCategory', category.slug)"
                    >{{category.name}}</span>
                    

                </div>
            </div>
            <div class="box">
                <h3>Tag</h3>
                <div class="tag">

                    <span
                    v-for="tag in tags"
                     :key="`tags${tag.id}`"
                     @click="$emit('getPostTag', tag.slug)"
                    >{{tag.name}}</span>
                    

                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props:{
        'tags': Array,
        'categories': Array
    }
}
</script>

<style lang="scss" scoped>
.sidebar{
    max-width: 25%;
    .box{
        
        text-align: center;
        border: 2px solid gray;
        border-radius: 10px;
        padding: 20px 10px;
        margin-bottom: 10px;
        h3{
            margin-bottom: 10px;
        }
        span{
            display: inline-block;
            background-color: green;
            padding: 3px 6px;
            color: white;
            font-size: 11px;
            border-radius: 9px;
            cursor: pointer;
            margin: 5px;
            &:hover{
                background-color: blue;
            }
        }
        .tag span{
            background-color: red;
            &:hover{
                background-color: blue;
            }
        }
        
    }
}
</style>