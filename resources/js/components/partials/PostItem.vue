<template>
<article>
    <h3>
        <a href="#">{{post.title}}</a>
    </h3>
    <p
    class="category">
    {{ post.category.name }}
    </p>

    <div v-if="post.tags">
        
        <span
        v-for="(tag, index) in post.tags"
        :key="`tag${index}`"
        >
        {{tag.name}}
        </span>

    </div>

    <p class="date"> {{formatDate}} </p>
    <p>{{truncateText}}</p>
</article>
</template>

<script>
export default {
    name: 'PostItem',
    props:{
        'post': Object
    },
    computed:{
        truncateText(){
            return this.post.content.substr(0, 50) + '...';
        },

        formatDate(){
            const d = new Date(this.post.created_at);
            let day = d.getDate();
            let month = d.getMonth() + 1;
            const year = d.getFullYear();
            if (day < 10) day = '0'+day;
            if (month < 10) month = '0'+month;

            return `${day}/${month}/${year}`;
        }
    }
}
</script>

<style lang="scss" scoped>

article{
    margin: 10px;
    .date{
        font-size: 12px;
        font-style: italic;
    }
    .testo{
        padding: 10px 0px;
    }
    a{
        color: black;
        text-decoration: none;
        &:hover{
            color: red;
        }
    }
    span{
        background-color: orange;
        display: inline-block;
        margin: 5px 5px 5px 0px;
        padding: 3px 7px;
        font-size: 9px;
        border-radius: 15px;
    }
}

</style>