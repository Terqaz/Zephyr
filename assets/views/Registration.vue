<script setup>
    import {ref} from 'vue'
    import axios from 'axios'

    let login = ref('')
    let password = ref('')

    function submit(){
        makeRequest()
    }

    function makeRequest(){
        let clientInfo = {
            login: login.value,
            password: password.value,
        }
        // some request with clientInfo (Body)
    }

</script>

<template>
  <div>
    <div class="plane-image lscreen">
      
    </div>
    <img class="absolute w-52 left-10 bottom-10" src="../assets/logos/Zephyr.svg" alt="">
    <div class="lscreen">
      <div class="login-box">
        <header class="mb-6">РЕГИСТРАЦИЯ</header>
        <div class="default-text mb-6">
          Получите доступ к моментальной информации по авиабилетам и выбирайте самые выгодные варианты
        </div>
        <div class="mb-20">
          <span class="default-text mb-10">Уже имеете аккаунт? </span>
          <RouterLink class="default-text route-text " to="/login">
            Войти.
          </RouterLink>
        </div>
        <div class="inputs-div">
          <v-text-field variant="underlined" class="w-full" prepend-inner-icon="mdi-account" label="Логин" v-model="login"></v-text-field>
          <v-text-field variant="underlined" class="w-full" prepend-inner-icon="mdi-account" label="Пароль" v-model="password"></v-text-field>
          <v-btn rounded=""  class="" color="#4F3F6A" @click="submit">Зарегистрироваться</v-btn>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.lscreen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.mbot {
  margin-bottom: 25px;
}
.default-text {
  font-size: 24px;
}
.route-text {
  color: blueviolet;
}
.blur {
  z-index: 1;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(10px);
}
header {
  font-size: 48px;
  font-weight: bold;
}
.login-box {
  padding-left: 25px;
  padding-right: 25px;
  padding-top: 50px;
  width: 600px;
  height: 100%;
  float: right;
  background-color: white;
}
.inputs-div{
  margin-top: 100px;
}
@media (max-width: 600px) { 
  .login-box{
    width: 100vw;
    height: 100vh;
  }
  .inputs-div{
    margin-top: 20px;
  }
}
.plane-image {
  background-image: url('../assets/loginBackground.png');
  background-size: cover;
  backdrop-filter: blur(2px);
}
</style>
