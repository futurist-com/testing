<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Смена Пароля</v-toolbar-title>
                <v-spacer>
                  {{errorTokenMess}}
                  {{$route.token}}

                </v-spacer>
              </v-toolbar>
              <div v-if="errorToken">
                <v-alert :value="true"
                color="error">
                {{errorTokenMess}}
                </v-alert>
                </div>
              <div v-else>
                <v-card-text>
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
                  <v-btn color="primary" v-on:click="registr" :disabled="!valid">Сменить пароль</v-btn>
                </v-card-actions>
              </div>
            {{errorTokenMess}}
            </v-card>
            {{$route.token}}
            
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
      errorToken:false,
      errorTokenMess:'',
      password:null,
      valid: true,
      repassword: null,
      registSuccess: false,
      passRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов."
      ],
      rePassRules: [
        v => !!v || "Поле не может быть пустым",
        v => (v && v.length >= 3) || "Пароль не меньше 3 символов.",
        v => v == this.password || "Введенные пароли не совпадают."
      ]
    };
  },
  methods: {
    registr: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/register", {
            token: this.$route.token,
            password: this.password
          })
          .then(resp => {
            //auth.login(resp.data.token, resp.data.user);
            //показываем
            //this.$router.push("/dashboard");
            console.log(this.registSuccess);
            this.registSuccess = true;
            console.log(this.registSuccess);
          })
          .catch(({ response }) => {});
      }
    }
  },
  mounted:function(){
      axios
          .post("/api/reset/is-token", {
            token: this.$route.token,
            })
          .then(resp => {
            //auth.login(resp.data.token, resp.data.user);
            //показываем
            //this.$router.push("/dashboard");
            //console.log(this.registSuccess);
            this.errortoken = false;
            //console.log(this.registSuccess);
          })
          .catch(({ response }) => {
              this.errorToken = true;
              this.errorTokenMess=response.data.message;
          });
  }
};
</script>
