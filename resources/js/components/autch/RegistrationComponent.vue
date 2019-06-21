<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Регистрация</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form v-model="valid" ref="form" lazy-validation>
                  <v-text-field
                    prepend-icon="person"
                    name="name"
                    label="Имя"
                    type="text"
                    v-model="user.name"
                    :rules="nameRules"
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="person"
                    name="email"
                    label="email"
                    type="text"
                    v-model="user.email"
                    :rules="emailRules"
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="lock"
                    name="password"
                    label="Пароль"
                    id="password"
                    type="password"
                    v-model="user.password"
                    :rules="passRules"
                  ></v-text-field>
                  {{user.password}}
                  <v-text-field
                    prepend-icon="lock"
                    name="repassword"
                    label="Повторите пароль"
                    id="repassword"
                    type="password"
                    v-model="repassword"
                    :rules="rePassRules"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" v-on:click="registr" :disabled="!valid">Регистрация</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
//import { truncateSync } from 'fs';
export default {
  data: function() {
    return {
      user: {
        name: null,
        email: null,
        password: null
      },
      isUniqueEmail:true,
      //email: null,
      valid: true,
      repassword: null,
      nameRules: [v => !!v || "Поле не может быть пустым"],
      emailRules: [
        v => !!v || "Поле не может быть пустым",
        v => /.+@.+/.test(v) || "Не подходит под формат e-mail.",
        v => this.isUnique(v) || "e-mail уже зарегистрирован."
      ],
      passRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов."
      ],
      rePassRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов.",
        v => v == this.user.password || "Введенные пароли не совпадают."
      ]
    };
  },
  methods: {
    registr() {
      //
      //alert(v);
    },
    isUnique(value) {
      axios
        .get("/api/get-email?email=" + value)
        .then(resp => {
           this.isUniqueEmail = true;
        })
        .catch(({response}) => {
           console.log(this.isUniqueEmail);
           return this.isUniqueEmail = false;
           console.log(this.isUniqueEmail);
           //
        });
      console.log(this.isUniqueEmail);
      return this.isUniqueEmail;
    }
  }
};
</script>
