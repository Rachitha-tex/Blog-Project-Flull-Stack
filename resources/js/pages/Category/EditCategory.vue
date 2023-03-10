<template>
    <div id="create-categories">
        <div id="contact-us">
          <h1>Edit Category!</h1>
          <!-- success message -->
          <div class="success-msg" v-if="success">
            <i class="fa fa-check"></i>
            Category Edited successfully
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
            props:['id'],
            data(){
                return{
                    fields:{},
                    errors:{},
                    success:false
                }
            },
            methods:{
                async submit(){
                    await axios.put('/api/categories/'+this.id,this.fields)
                    .then(()=>{
                        this.fields={}
                        this.errors={}
                        this.success=true
    
                        setTimeout(()=>{
                            this.success=false
                        },2000)
                    })
                    .catch((error)=>{
                        this.errors=error.response.data.errors
                    })
                }
            },
            mounted(){
            axios.get('/api/categories/'+this.id)
            .then((response)=>{
                this.fields=response.data
            })
            .catch((error)=>{
                console.log(error);
            })
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