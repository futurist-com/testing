<template>
  <v-container>
    <user-panel></user-panel>
          <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Форма входа</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <v-icon large>code</v-icon>
                  <span>Source</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form v-model="valid" ref="form" lazy-validation>
                  <v-text-field
                    prepend-icon=""
                    name="name"
                    label="Название компании"
                    type="text"
                    v-model="name"
                    required
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="lock"
                    name="description"
                    label="Описание"
                    id="description"
                    v-model="description"
                    
                    required
                  ></v-text-field>
                </v-form>
                
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn v-on:click="login" color="primary" :disabled="!valid">Создать</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app> 
         
      <footer-panel></footer-panel>
    
  </v-container>
</template>

<script>
export default {
  data:null,
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
