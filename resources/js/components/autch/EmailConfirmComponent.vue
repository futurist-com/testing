<template>
  <div>
    <v-container fluidalign-baseline="true" fill-height="true" align-center="true">
      <v-layout column >
        <v-flex xs12>
          <div class="resultContainer">
            <v-layout v-bind="layoutAttributes">
              <div class="item elevation-5">{{message}}</div>
              </v-layout>
          </div>
        </v-flex>
      </v-layout>
    </v-container>
    <footer-panel></footer-panel>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      message: null
    };
  },
  mounted() {
    console.log("Component mounted.");
    //axios.put('/api/', {token:$route.params.id}).then().catch();
    axios
      .put("/api/confirm-email", { token: this.$route.params.id })
      .then(resp => {
        this.message = resp.data.message;
        //console.log(resp.data.token);
        //auth.login(resp.data.token, resp.data.user);
        //this.$router.push("/dashboard");
      })
      .catch(({ response }) => {
        console.log(response);
        //if (resp.response.status==401){
        //({response}) => {
        // alert(response.data.message);
        //this.errorMes="Пара email и пароль не совпали. Проверьте правильность введёного email и пароля!!!";
        //this.errorMes = response.data.message;
        //this.errorShow = true;
        //}
      });
  }
};
</script>
