<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Восстановление пароля</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <v-icon large>code</v-icon>
                  <span>Source</span>
                </v-tooltip>
              </v-toolbar>
              <div v-if="!message">
                <v-card-text>
                  <v-form v-model="valid" ref="form" lazy-validation>
                    <v-text-field
                      prepend-icon="person"
                      name="email"
                      label="email"
                      type="text"
                      v-model="email"
                      :rules="emailRules"
                      required
                    ></v-text-field>
                  </v-form>
                  <transition name="slide-fade">
                    <div class="error-messages red--text mx-4" v-if="errorShow">
                      <span>{{errorMes}}</span>
                    </div>
                  </transition>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn v-on:click="forgetPass" color="primary" :disabled="!valid">Сменить пароль</v-btn>
                </v-card-actions>
              </div>
              <div v-else>
                <v-alert
                  :value="true"
                  color="success"
                  icon="new_releases"
                >{{message}}</v-alert>
              </div>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
import { METHODS } from "http";
import { totalmem } from "os";
import { setTimeout } from "timers";
//import { access } from 'fs';
//import { truncateSync } from 'fs';
export default {
  data: function() {
    return {
      message: false,
      valid: true,
      errorShow: false,
      email: null,
      emailRules: [
        v => !!v || "Поле не может быть пустым",
        v => /.+@.+/.test(v) || "Не подходит под формат e-mail."
      ],
      errorMes: ""
    };
  },
  mounted: function() {},
  methods: {
    forgetPass: function() {
      //
      if (this.$refs.form.validate()) {
        this.snackbar = true;
        axios
          .post("/api/reset-password", { email: this.email })
          .then(resp => {
            //console.log(resp.data.token);
            this.message = resp.data.message;
          })
          .catch(({ response }) => {
            console.log(response);
            //if (resp.response.status==401){
            //({response}) => {
            // alert(response.data.message);
            //this.errorMes="Пара email и пароль не совпали. Проверьте правильность введёного email и пароля!!!";
            this.errorMes = response.data.message;
            this.errorShow = true;
            //}
          });
      }
    }
  }
};
</script>
<style>
.error-mesage {
  color: red;
}
.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active до версии 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>
