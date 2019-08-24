<template>
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
                    prepend-icon="person"
                    name="email"
                    label="email"
                    type="text"
                    v-model="email"
                    :rules="emailRules"
                    required
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="lock"
                    name="password"
                    label="Пароль"
                    id="password"
                    type="password"
                    v-model="password"
                    :rules="passRules"
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
                <v-btn v-on:click="login" color="primary" :disabled="!valid">Войти</v-btn>
              </v-card-actions>
              <v-card-text>
                <router-link to="/register/forget-password">Востановить пароль</router-link>
              </v-card-text>
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
      valid: true,
      errorShow: false,
      email: null,
      emailRules: [
        v => !!v || "Поле не может быть пустым",
        v => /.+@.+/.test(v) || "Не подходит под формат e-mail."
      ],
      password: null,
      passRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов."
      ],
      errorMes: ""
    };
  },
  mounted: function() {
    let access_token = Vue.cookie.get("XSRF-TOKEN");
    //console.log(access_token);
    /*if (access_token!=null)
     {
       this.$router.push('/workspase');
     }*/
  },
  methods: {
    login: function() {
      //this.errorMes="";
      this.errorShow = false;
      let data = {
        username: this.email,
        password: this.password
      };
      if (this.$refs.form.validate()) {
        this.snackbar = true;
        axios
          .post("/api/login", data)
          .then(resp => {
            console.log('login');
            auth.login(resp.data.token, resp.data.user);
            this.$router.push("/dashboard");
          })
          .catch(({ response }) => {
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
