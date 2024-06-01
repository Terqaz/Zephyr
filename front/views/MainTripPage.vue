<script setup>
    import {ref} from 'vue'
    import TripCard from '@/components/TripCard.vue'
    import PlaceCard from '@/components/PlaceCard.vue'
    import TopTripLine from '@/components/TopTripLine.vue'

    const placeFrom = ref()
    const placeTo = ref()
    function swapPlaces(){
        const placeTmp = placeFrom.value
        placeFrom.value = placeTo.value
        placeTo.value = placeTmp
    }

    function clearPlaces(){
      placeTo.value = ''
      placeFrom.value = ''
    }
    function changeInputs(from,to){
      scrollToStart()
      placeFrom.value = from
      placeTo.value = to
    }

    const start = ref()
    function scrollToStart(){
      start.value.scrollIntoView({behavior:'smooth'})
    }
</script>

<template>
    <div ref="start" class="">
        <header class="block base-color w-full h-20 pt-7 pl-5 align-middle items-center content-center">
            <img src="@/assets/logos/Zephyr.svg" class="w-24 inline" alt="">
            <ul class="flex float-right">
                <li><router-link to="/profile">Профиль</router-link> </li>
                <li><router-link to="/login">Войти</router-link> </li>
                <li><router-link to="/registration">Зарегистрироваться</router-link></li>
            </ul>
        </header>
        <main class="flex justify-center mb-10">
            <div class="main-container pt-8 ">
                <div class="text-5xl font-bold mb-10">ВАШЕ ПУТЕШЕСТВИЕ</div>

                <div class="flex align-middle items-center content-center">
                    <p class=" font-bold text-3xl mr-5">ПУНКТ НАЗНАЧЕНИЯ</p>
                    <div class="line bg-black mr-5"></div>
                    <p @click="clearPlaces" class="cursor-pointer text-blue-700">СБРОСИТЬ</p>
                </div>
                <p class="mb-6 text-2xl">Уверяю все будет хорошо!</p>
               
                <div class="flex mb-5">
                    <v-text-field v-model="placeFrom" class="mr-20" label="Начальная точка" variant="underlined" prepend-inner-icon="mdi-magnify"></v-text-field>
                    <div class="anim cursor-pointer" @click="swapPlaces">
                        <v-icon class="mr-20 mt-5" size="x-large" icon="mdi-swap-horizontal"></v-icon>
                    </div>
                    <v-text-field v-model="placeTo" label="Конечная точка" class="h-14" variant="underlined" prepend-inner-icon="mdi-magnify"></v-text-field>
                </div>
                <TripCard class="mb-5 ml-" v-for="i in 2"></TripCard>

                <div class="mt-10 flex align-middle items-center content-center">
                    <p class=" font-bold text-3xl mr-5">ПОПУЛЯРНЫЕ МЕСТА</p>
                    <div class="line bg-black mr-5"></div>
                </div>
                <p class="mb-6 text-2xl">Вам может понравиться!</p>

                <div class="grid gap-6 grid-cols-3 grid-flow-row">
                  <PlaceCard v-for="i in 6"></PlaceCard>
                </div>
                
                <div class="mt-10 flex align-middle items-center content-center">
                    <p class=" font-bold text-3xl mr-5">ТОП НАПРАВЛЕНИЙ</p>
                    <div class="line bg-black mr-5"></div>
                </div>
                <p class="mb-6 text-2xl">Возможно вас это заинтересует!</p>
                
                <div>
                  <TopTripLine @checkTrip="changeInputs" class="mb-5" v-for="(i,index) in 10" :index="index"></TopTripLine>
                </div>
              </div>
        </main>
        <footer class="block base-color w-full h-20 pt-7 pl-5 align-middle items-center content-center">
            <ul class="flex float-right">
                <li>© TOCAMOE4YBCTBO</li>
            </ul>
        </footer>
    </div>
</template>

<style>

  li{
    color: white;
    text-transform: uppercase;
    margin-right: 20px;
  }
  .line{
    display: block;
    height: 2px;
    width: auto;
  }
  .main-container{
    width: 963px;
  }
</style>