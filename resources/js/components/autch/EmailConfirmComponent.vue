<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">I'm an component EmailConfirm.{{$route.params.id}}</div>
          {{message}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
        message:null,
    };
  },
  mounted() {
    console.log("Component mounted.");
    //axios.put('/api/', {token:$route.params.id}).then().catch();
    axios
      .put("/api/confirm-email", { token: this.$route.params.id })
      .then(resp => {
        this.message=resp.data.message;
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
