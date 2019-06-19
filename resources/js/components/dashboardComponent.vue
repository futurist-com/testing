<template>
  <div class="container">
    <user-panel></user-panel>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">I'm an dashboard component.</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    /*return {
      authenticated: auth.check(),
      user: auth.user
    };*/
  },
  mounted() {
    /*Event.$on("userLoggedIn", () => {
      this.authenticated = true;
      this.user = auth.user;
    });
    if (!auth.check()) {
      this.$router.push("/");
    }*/
    //console.log(this.user);

    //console.log('Component mounted.')
  }
};
</script>
