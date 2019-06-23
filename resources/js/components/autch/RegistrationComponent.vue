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
                    v-model="email"
                    :rules="emailRules"
                    :error-messages="errorsEmail"
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
      email: null,
      errorsEmail: [],
      valid: true,
      repassword: null,
      nameRules: [v => !!v || "Поле не может быть пустым"],
      emailRules: [
        v => !!v || "Поле не может быть пустым",
        v => /.+@.+/.test(v) || "Не подходит под формат e-mail."
        //v => this.isUnique(v) || "e-mail уже зарегистрирован."
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
    registr: function() {
      if (this.$refs.form.validate()) {
        axios.post("/api/register", {
          name: this.user.name,
          email: this.email,
          password: this.user.password
        }).then(resp=>{
          this.$router.push("/dashboard");
        }).catch(({response})=>{

        });
      }
    }
  },
  watch: {
    email: function(val) {
      axios
        .get("/api/get-email?email=" + val)
        .then(resp => {
          //this.errorsEmail = resp.status == 200 ? [] : [];
          this.errorsEmail=[];
        })
        .catch(({ response }) => {
          this.errorsEmail =
            response.status == 422 ? [response.data.message] : [];
        });
    }
  }
};
</script>
