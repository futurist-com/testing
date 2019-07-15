<template>
  <v-app id="inspire">
        <v-layout align-top justify-center>
        <v-flex xs12 sm8 md4>
        <v-snackbar
      v-model="shackbarSuccess"
      :color="success"
      :multi-line="'multi-line'"
      :timeout="5000"
      :vertical="'vertical'"
    >{{message}}</v-snackbar>
    <v-snackbar
      v-model="shackbarError"
      :color="error"
      :multi-line="'multi-line'"
      :timeout="5000"
      :vertical="'vertical'"
    >{{errorMes}}</v-snackbar>
        <v-alert
      :value="errorMes"
      color="error">
      {{errorMes}}
    </v-alert>
    <v-alert
      :value="message"
      color="success">
      {{message}}
    </v-alert>
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
                <v-toolbar-title>Подтверждение проверочного  кода</v-toolbar-title>
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
                  <v-btn v-on:click="codeCheck" color="primary" :disabled="!valid">Отправить код</v-btn>
                </v-card-actions>
              </v-card>
          </div>
          <!--step 3-->
          <div v-if="step==3">
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Смена Пароля</v-toolbar-title>
                <v-spacer>
                  </v-spacer>
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
                  <v-btn color="primary" v-on:click="resetPassword" :disabled="!valid">Сменить пароль</v-btn>
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
      step:1,
      email:'',
      password:null,
      valid: true,
      repassword: null,
      registSuccess: false,
      shackbarSuccess:false,
      shackbarError:false,
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
      reCode: [
        v => !!v || "Поле не может быть пустым",
      ], 
      errorMes:'',
      message:'',
    };
  },
  methods: {
    forgetPass: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/reset-password", { email: this.email })
          .then(resp => {
            this.shackbarSuccess=true;
            this.shackbarError=false;
            this.message = resp.data.message;
            this.step=2;
          })
          .catch(({ response }) => {
            console.log(response);
             this.shackbarSuccess=false;
            this.shackbarError=true;
            this.errorMes = response.data.message;
            this.errorShow = true;
            //}
          });
      }
    },
    codeCheck: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/reset/check-code-password", { email: this.email,
              code:this.code})
          .then(resp => {
            this.shackbarSuccess=true;
            this.message = resp.data.message;
            this.token=resp.data.token;
            this.step=3;
          })
          .catch(({ response }) => {
            console.log(response);
             this.shackbarSuccess =false;
             this.shackbarError=true,
            this.errorMes = response.data.message;
            this.errorShow = true;
            //}
          });
      }
    },
    resetPassword: function() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/reset/password", { email: this.email,
              token:this.token,
              password:this.password})
          .then(resp => {
            //this.message = resp.data.message;
              this.$router.push("/login");
            })
          .catch(({ response }) => {
            console.log(response);
            this.errorMes = response.data.message;
            this.errorShow = true;
            //}
          });
      }
    },

  },
  mounted:function(){
     // 
     console.log(this.step);
  }
};
</script>
