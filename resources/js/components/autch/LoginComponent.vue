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
                  </v-btn>
                  <span>Source</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form v-model="valid" lazy-validation> 
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
            <span>{{errorMes}}</span>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn v-on:click="login" color="primary" :disabled="!valid">Войти</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import { METHODS } from "http";
import { totalmem } from 'os';
export default {
  data:function(){
    return {
      valid:true,
      email:null,
      emailRules: [
      v => !!v || 'Поле не может быть пустым',
      v => /.+@.+/.test(v) || 'Не подходит под формат e-mail'
    ],
      password:null,
      passRules: [
      v => !!v || 'Поле не может быть пустым',
    ],
    errorMes:'',
    }
  },
  methods: {
    login: function() {
      console.log(this.$refs);
      this.$refs.form.reset()
        //this.snackbar = true
        
           axios
      .get("/api/login"+'?email='+this.email+"&password="+this.password)
      .then((resp)=> {
        this.$router.push('/workspase');
        //console.log(resp);
        //alert(resp.data.token);
      })
      .catch((resp)=>{
        console.log(resp)
        //if (resp.data.error=='UnAuthorised'){
          this.errorMes="Пара логин пароль не совпали";
        //}
      //@todo продумать обработку  не правильно введенных данных и валидацию   
      //alert(resp.password);
    });
      },
    }
  
};
</script>
