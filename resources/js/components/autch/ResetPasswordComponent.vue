<template>
  <v-app id="inspire">
    <v-content>
      <v-layout align-top justify-center>
        <v-flex xs12 sm8 md4>
          <v-snackbar
            v-model="shackbar"
            :color="colorShackbar"
            :timeout="5000"
            :top="true"
          >{{message}}</v-snackbar>
        </v-flex>
      </v-layout>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <!--step 1-->
          <v-flex xs12 sm8 md4>
            <div v-if="step==1">
              <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                  <v-toolbar-title>Восстановление пароля</v-toolbar-title>
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
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn v-on:click="forgetPass" color="primary" :disabled="!valid">Сменить пароль</v-btn>
                </v-card-actions>
              </v-card>
            </div>

            <!--step 2-->
            <div v-if="step==2">
              <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                  <v-toolbar-title>Подтверждение проверочного кода</v-toolbar-title>
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
                      name="code"
                      label="Проверочный Код"
                      type="text"
                      v-model="code"
                      required
                      :rules="reCode"
                    ></v-text-field>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn v-on:click="codeCheck" color="primary" :disabled="!valid">Отправить код</v-btn>
                </v-card-actions>
              </v-card>
            </div>
            <!--step 3-->
            <div v-if="step==3">
              <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                  <v-toolbar-title>Смена Пароля</v-toolbar-title>
                  <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                  <v-form v-model="valid" ref="form" lazy-validation>
                    <v-text-field
                      prepend-icon="lock"
                      name="password"
                      label="Новый пароль"
                      id="password"
                      type="password"
                      v-model="password"
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
                  <v-btn
                    color="primary"
                    v-on:click="resetPassword"
                    :disabled="!valid"
                  >Сменить пароль</v-btn>
                </v-card-actions>
              </v-card>
            </div>
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
      step: 1,
      email: "",
      password: null,
      valid: true,
      repassword: null,
      registSuccess: false,
      shackbar: false,
      colorShackbar: "",
      emailRules: [
        v => !!v || "Поле не может быть пустым",
        v => /.+@.+/.test(v) || "Не подходит под формат e-mail."
      ],
      passRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов."
      ],
      rePassRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов.",
        v => v == this.password || "Введенные пароли не совпадают."
      ],
      reCode: [v => !!v || "Поле не может быть пустым"],
      message: ""
    };
  },
  methods: {
    forgetPass: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/reset-password", { email: this.email })
          .then(resp => {
            this.shackbarRun(resp.data.message, "success");
            this.step = 2;
          })
          .catch(({ response }) => {
            this.shackbarRun(response.data.message, "error");
            
          });
      }
    },
    codeCheck: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/reset/check-code-password", {
            email: this.email,
            code: this.code
          })
          .then(resp => {
            this.token = resp.data.token;
            this.shackbarRun(resp.data.message, "success");
            this.step = 3;
          })
          .catch(({ response }) => {
            this.shackbarRun(response.data.message, "error");
            //}
          });
      }
    },
    resetPassword: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/reset/password", {
            email: this.email,
            token: this.token,
            password: this.password
          })
          .then(resp => {
            //this.message = resp.data.message;
            this.shackbarRun(resp.data.message, "success");
            this.$router.push("/login");
          })
          .catch(({ response }) => {
            this.shackbarRun(response.data.message, "error");
          
          });
      }
    },
    shackbarRun:function(message, color){
            this.colorShackbar = color;
            this.shackbar = true;
            this.message = message;
    }
  },
  mounted: function() {
    //
    console.log(this.step);
  }
};
</script>
