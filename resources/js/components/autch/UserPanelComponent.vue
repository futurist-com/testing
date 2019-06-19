<template>
  <div>
    <div v-if="authenticated && user">
      <p>Hello, {{ user.name }}</p>
      <v-btn v-on:click="logout">logout</v-btn>
      <router-link to="/logout">Logout</router-link>
    </div>
    <div v-else>
      <router-link to="/login">Login</router-link>
    </div>
  </div>
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
      console.log(this);
      auth.logout();
      this.$router.push("/");
    }
  }
};
</script>
