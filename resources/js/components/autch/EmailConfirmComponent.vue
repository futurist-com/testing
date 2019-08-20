<template>
  <div>
    <v-app id="inspire">
      <v-content>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                  <v-toolbar-title>Подтверждения адреса email</v-toolbar-title>
                  <v-spacer></v-spacer>
                </v-toolbar>
                <div v-if="error">
                  <v-card-text class="title error">{{message}}</v-card-text>
                </div>
                <div v-else>
                  <v-card-text class="title">{{message}}</v-card-text>
                  <br>
                  <v-card-text>
                    <router-link to="/dashboard">Перейти в рабочее пространство</router-link>
                  </v-card-text>
                </div>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
    </v-app>
    <footer-panel></footer-panel>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      message: null,
      error: false
    };
  },
  mounted() {
    //axios.put('/api/', {token:$route.params.id}).then().catch();
    axios
      .put("/api/confirm-email", { token: this.$route.params.id })
      .then(resp => {
        this.message = resp.data.message;
        this.error = false;
        auth.login(resp.data.token, resp.data.user);
      })
      .catch(({ response }) => {
        this.error = true;
        this.message = response.data.message;
        console.log(response);
      });
  }
};
</script>
