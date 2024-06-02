<script setup>
    import '../assets/main.css';
    import {ref} from 'vue'
    import TripCard from '../components/TripCard.vue'
    import PlaceCard from '../components/PlaceCard.vue'
    import TopTripLine from '../components/TopTripLine.vue'
    const tripDefault = {
      from: "Москва",
      to: "Липецк",
      price: 10000,
      company: "Tiny Airlines",
      isFavorite: false,
      timeStart: "00:00",
      timeEnd: "21:30",
      flightTime: "21ч 30м"
    }

    const placeDefault = {
      name : "ЖАRA",
      stars : 5.00,
      isFavorite : false,
    }

    const topTripDefault = {
      to : "Москва",
      views : "20",
    }

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

    let tripList = ref([])
    tripList.value = getTripList(placeFrom.value,placeTo.value)
    function getTripList(from,to){
      //
      const tripListTmp = []
      tripListTmp.push(tripDefault)
      return tripListTmp
    }

    let placeList = ref([])
    placeList.value = getPlaceList(placeTo.value)
    function getPlaceList(to){
      const placeListTmp = []
      placeListTmp.push(placeDefault)
      placeListTmp.push(placeDefault)
      return placeListTmp
    }    
    
    let topTripList = ref([])
    topTripList.value = getTopTripList()
    function getTopTripList(){
      const placeListTmp = []
      placeListTmp.push(topTripDefault)
      return placeListTmp
    }


    const start = ref()
    function scrollToStart(){
      start.value.scrollIntoView({behavior:'smooth'})
    }
</script>

<template>
    <div ref="start" class="">
        <header class="block base-color w-full h-20 pt-2 pl-5 align-middle items-center content-center">
            <img src="../assets/logos/Zephyr.svg" class="w-24 inline" alt="">
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
                    <v-text-field v-model="placeFrom" class="mr-20 max-lg:mr-1" label="Начальная точка" variant="underlined" prepend-inner-icon="mdi-magnify"></v-text-field>
                    <div class="anim cursor-pointer" @click="swapPlaces">
                        <v-icon class=" max-lg:mr-1 mr-20  mt-5" size="x-large" icon="mdi-swap-horizontal"></v-icon>
                    </div>
                    <v-text-field v-model="placeTo" label="Конечная точка" class="h-14" variant="underlined" prepend-inner-icon="mdi-magnify"></v-text-field>
                </div>
                <TripCard v-if="tripList.length != 0" class="mb-5" 
                  v-for="trip in tripList" 
                  :from="trip.from" 
                  :to="trip.to" 
                  :company="trip.company" 
                  :price="trip.price" 
                  :isFavorite="trip.isFavorite" 
                  :timeStart="trip.timeStart" 
                  :timeEnd="trip.timeEnd" 
                  :flightTime="trip.flightTime">
                </TripCard>

                <div class="mt-10 flex align-middle items-center content-center">
                    <p class=" font-bold text-3xl mr-5">ПОПУЛЯРНЫЕ МЕСТА</p>
                    <div class="line bg-black"></div>
                </div>
                <p class="mb-6 text-2xl">Вам может понравиться!</p>

                <div class="card-grid">
                  <PlaceCard v-if="placeList.length != 0" 
                    v-for="place in placeList" 
                    :name="place.name" 
                    :stars="place.stars" 
                    :isFavorite="place.isFavorite">
                  </PlaceCard>
                </div>
                
                <div class="mt-10 flex align-middle items-center content-center">
                    <p class=" font-bold text-3xl mr-5">ТОП НАПРАВЛЕНИЙ</p>
                    <div class="line bg-black"></div>
                </div>
                <p class="mb-6 text-2xl">Возможно вас это заинтересует!</p>
                
                <div>
                  <TopTripLine @checkTrip="changeInputs" class="mb-5" v-if="topTripList.length != 0"
                    v-for="(topTrip,index) in topTripList" 
                    :index="index" 
                    :to="topTrip.to" 
                    :views="topTrip.views">
                  </TopTripLine>

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
  

</style>