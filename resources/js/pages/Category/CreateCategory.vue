<template>
<div id="create-categories">
    <div id="contact-us">
      <h1>Create New Category!</h1>
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        Category created successfully
      </div>
      <div class="contact-form">
        <form @submit.prevent="submit" >
          <label for="name"><span>Name</span></label>
          <input type="text" id="name" v-model="fields.name">
          <span class="error" v-if="errors.name">{{ errors.name[0] }}</span>

          <input type="submit" value="Submit" />
        </form>
      </div>
      <div class="create-categories">
        <router-link :to="{name:'CategoryList'}">Categories list</router-link>
         <span>&#8594;</span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
    export default {
        name:'CreateCategory',
        data(){
            return{
                fields:{
                    name:''
                },
                errors:{},
                success:false
            }
        },
        methods:{
            async submit(){
                await axios.post('/api/categories/create',this.fields)
                .then((response)=>{
                    this.fields={}
                    this.errors={}
                    this.success=true

                    setInterval(()=>{
                        this.success=false
                    },2000)
                })
                .catch((error)=>{
                    this.errors=error.response.data.errors
                })
            }
        }

    }
</script>

<style scoped>
#create-categories {
  background-color: #f3f4f6;
  height: 90vh;
  padding: 50px;
}
</style>