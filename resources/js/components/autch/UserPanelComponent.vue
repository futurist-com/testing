<template>
  <div>
    <div v-if="islogin">
    <router-link to="/login" class="btn btn-xs btn-default">Войти</router-link>
    <router-link to="/registration" class="btn btn-xs btn-default">Регистрация</router-link>
    </div>
    <div v-if="islogin==false">
        <v-btn>выйти</v-btn>
    </div>
  </div>
</template>

<script>
export default {
  data:function(){
      return {
          islogin:null,
      }
  },
  mounted() {
    console.log(" user panel componnent.");
    let access_token = Vue.cookie.get('XSRF-TOKEN');
     console.log(access_token);
     if (access_token!=null)
     {
       this.islogin=false;
       //this.$router.push('/workspase');
     }
     else{
         this.islogin=true;
     }
  }
};
</script>
