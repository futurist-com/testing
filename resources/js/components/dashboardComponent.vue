<template>
  <v-container>
    <v-app>
      <div class="card-body">
        <companies-component></companies-component>
      </div>
    </v-app>
  </v-container>
</template>

<script>
export default {
  data: null
  /*data: function() {
    return {
      authenticated: auth.check(),
      user: auth.user
    };
  },*/
  /*mounted() {
    Event.$on("userLoggedIn", () => {
      this.authenticated = true;
      this.user = auth.user;
    });
    if (!auth.check()) {
      this.$router.push("/");
    }
    //console.log(this.user);
    //console.log('Component mounted.')
  }*/
};
</script>
