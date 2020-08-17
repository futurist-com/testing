<template>
    <v-app-bar app color="primary" dark>
      <v-app-bar-nav-icon>
        <v-icon>fas fa-list</v-icon>
      </v-app-bar-nav-icon>
      <v-toolbar-title light>Test.lr</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-sm-and-down">
        <div class="m-auto" v-if="authenticated && user">
          <span>{{ user.name }}</span>
          <v-btn v-on:click="logout" light>Выход</v-btn>
        </div>
        <div v-else class="m-auto">
          <v-icon>fas fa-list</v-icon>
          <v-btn light>
            <router-link to="/registration">Регистрация</router-link>
          </v-btn>
          <v-btn light>
            <router-link to="/login">Войти</router-link>
          </v-btn>
        </div>
      </v-toolbar-items>
    </v-app-bar>
  </template>

<script>
export default {
  data: function() {
    return {
      //islogin: null,
      authenticated: auth.check(),
      user: auth.user
    };
  },
  mounted() {
    Event.$on("userLoggedIn", () => {
      this.authenticated = true;
      this.user = auth.user;
      //console.log(this.user);
    });
    //console.log(auth.token);
    /*let access_token = Vue.cookie.get('XSRF-TOKEN');
     console.log(access_token);
     if (access_token!=null)
     {
       this.islogin=false;
       //this.$router.push('/workspase');
     }
     else{
         this.islogin=true;
     }*/
  },
  methods: {
    logout: function() {
      auth.logout();
      this.$router.push("/");
    }
  }
};
</script>
