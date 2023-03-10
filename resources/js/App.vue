<template>
   <div id="wrapper">
      <!-- header -->
  

      <!-- sidebar -->
      <div class="sidebar" :class="{showOverlay:toggleDisplay}">
        <span class="closeButton" @click="closeSidebar()">&times;</span>
        <p class="brand-title"><a href="">Alphayo Blog</a></p>

        <div class="side-links">
          <ul>
           <li ><router-link   class="active" @click="closeSidebar" :to="{name:'HomeView'}">Home</router-link></li> 
            <li ><router-link @click="closeSidebar" :to="{name:'BlogView'}">Blog</router-link></li>
            <li ><router-link @click="closeSidebar" :to="{name:'AboutView'}">About</router-link></li>
            <li ><router-link @click="closeSidebar" :to="{name:'ContactView'}">Contact</router-link></li>
            <li v-if="!loggedIn"><router-link @click="closeSidebar" :to="{name:'LoginView'}">Login</router-link></li>
            <li v-if="!loggedIn"><router-link @click="closeSidebar" :to="{name:'RegisterView'}">Register</router-link></li>
            <li v-if="loggedIn"><router-link @click="closeSidebar" :to="{name:'DashboardView'}">Dashboard</router-link></li>


          </ul>
        </div>

        <!-- sidebar footer -->
        <footer class="sidebar-footer">
          <div>
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
          </div>

          <small>&copy 2021 Alphayo Blog</small>
        </footer>
      </div>
      <!-- Menu Button -->
      <div class="menuButton" @click="openSidebar">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- main -->
      <main class="container">
         <!-- Component rendering -->
         <router-view @update-sidebar="updateSidebar" :editSuccess="editSuccess" :key="$route.path" @show-edit-success="showEditSuccess"></router-view>
      </main>

      <!-- Main footer -->
      <footer class="main-footer">
        <div>
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
        </div>
        <small>&copy 2021 Alphayo Blog</small>
      </footer>
    </div>

</template>

<script>
    export default {
        name:'App',
        data(){
            return{
                toggleDisplay:false,
                loggedIn:false,
                editSuccess:false
            }
        },
        methods:{
            openSidebar(){
                this.toggleDisplay=true
            },
            closeSidebar(){
                this.toggleDisplay=false
            },
            updateSidebar(){
                this.loggedIn=!this.loggedIn;
            },
            showEditSuccess(){
                 this.editSuccess=true
                 setTimeout(()=>{
                  this.editSuccess=false
                 },2500)
            }
        },
        mounted(){
          if(localStorage.getItem('authenticated')){
            this.loggedIn=true;
          }else{
            this.loggedIn=false;
          }
        }
    }
</script>

<style  scoped>
.showOverlay{
    width: 100%;
    z-index: 5;
}
</style>