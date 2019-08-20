<template>
  <v-toolbar  app>
    <v-toolbar-side-icon></v-toolbar-side-icon>
    <v-toolbar-title>Test.lr</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">
      <div class="m-auto" v-if="authenticated && user">
        <span>{{ user.name }}</span>
        <v-btn v-on:click="logout">Выход</v-btn>
      </div>
      <div v-else class="m-auto">
        <v-btn>
          <router-link to="/registration">Регистрация</router-link>
        </v-btn>
        <v-btn>
          <router-link to="/login">Войти</router-link>
        </v-btn>
      </div>
    </v-toolbar-items>
  </v-toolbar>
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
