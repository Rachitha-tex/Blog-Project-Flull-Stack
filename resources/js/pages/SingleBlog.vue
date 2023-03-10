<template>
    <section class="single-blog-post">
       <h1>{{ post.title }}</h1>

       <p class="time-and-author">
        {{ post.created_at }}
         <span>Written By {{ post.user }}</span>
       </p>

       <div class="single-blog-post-ContentImage" data-aos="fade-left">
         <img :src="`/${post.imagepath}`" alt="" />
       </div>

       <div class="about-text">
         <p>
        {{ post.body }}
         </p>
       </div>
     </section>
     <section class="recommended">
       <p>Related</p>
       <div class="recommended-cards">
        <router-link :to="{name:'SingleBlog',params:{slug:relatedpost.slug} }" v-for="relatedpost in relatedPost" :key="relatedpost.id"> 
           <div class="recommended-card">
             <img :src="`/${relatedpost.imagepath}`" alt="" loading="lazy" />
             <h4>
           {{ relatedpost.title }}
             </h4>
           </div>
          </router-link>
    

       </div>
     </section>
</template>

<script>
import axios from 'axios';

export default{
    name:'SingleBlog',
    emits:['updateSidebar'],
    props:['slug'],
    data(){
      return{
        post:{},
        relatedPost:[]
      }
    },
    mounted(){
      axios.get('/api/posts/'+this.slug)
      .then((response)=>{
        this.post=response.data.data
       // console.log(response.data.data);
      })
      .catch((error)=>{
        console.log(error);
      })


      axios.get('/api/related-posts/'+this.slug)
      .then((response)=>{
        this.relatedPost=response.data.data
      })
      .catch((error)=>{
        console.log(error);
      })
    }
}
</script>

<style scoped>

</style>