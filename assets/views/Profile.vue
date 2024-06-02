
<script setup>
    import '../assets/main.css';
    import TopTripLine from '../components/TopTripLine.vue';
    import TripCard from '../components/TripCard.vue'
    import PlaceCard from '../components/PlaceCard.vue'
    import {ref} from 'vue'

    const tripDefault = {
      from: "Москва",
      to: "Липецк",
      price: 10000,
      company: "Tiny Airlines",
      isFavorite: true,
      timeStart: "00:00",
      timeEnd: "21:30",
      flightTime: "21ч 30м"
    }

    const placeDefault = {
      name : "ЖАRA",
      stars : 5.00,
      isFavorite : true,
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

</script>

<template>
    <div class="background-op">
        <header class="block base-color w-full h-20 pt-2 pl-5 align-middle items-center content-center">
            <img src="../assets/logos/Zephyr.svg" class="w-24 inline" alt="">
            <ul class="flex float-right">
                <li><router-link to="/trip">Главная</router-link></li>
                <li><router-link to="/login">Войти</router-link> </li>
                <li><router-link to="/registration">Зарегистрироваться</router-link></li>
            </ul>
        </header>

        <main class="flex justify-center mb-10">
            <div class="main-container pt-8 ">
                <div class="text-5xl font-bold mb-10">ВАШ ПРОФИЛЬ</div>
                <div class="text-3xl font-bold mb-10">ЛИЧНАЯ ИНФОРМАЦИЯ</div>
                <div class="block items-center justify-center w-full text-center">
                    <v-img class="block mr-auto ml-auto mb-5" width="300" :aspect-ratio="1/1" cover  rounded="circle" src="/src/assets/logos/avatar.jpg"></v-img>
                    <div class="mr-auto ml-auto text-3xl text-base-color italic">Иванов Иван Иванович</div>
                </div>
                <div>
                    <div class="mt-10 flex align-middle items-center content-center">
                        <p class=" font-bold text-3xl mr-5">ИЗБРАННЫЕ МЕСТА</p>
                        <div class="line bg-black"></div>
                    </div>
                    <p class="mb-6 text-2xl">Вам это понравилось.</p>

                    <div class="grid-card">
                        <PlaceCard v-if="placeList.length != 0" 
                            v-for="place in placeList" 
                            :name="place.name" 
                            :stars="place.stars" 
                            :isFavorite="place.isFavorite">
                        </PlaceCard>
                    </div>
                    
                    <div class="mt-10 flex align-middle items-center content-center">
                        <p class=" font-bold text-3xl mr-5">ИЗБРАННЫЕ НАПРАВЛЕНИЯ</p>
                        <div class="line bg-black"></div>
                    </div>
                    <p class="mb-6 text-2xl">Вас это заинтересовало.</p>
                    
                    <div>
                        <TripCard class="mb-5" 
                            v-for="trip in tripList" 
                            :from="trip.from"
                            :to="trip.to"
                            :price="trip.price"
                            :company="trip.company"
                            :isFavorite="trip.isFavorite"
                            :timeStart="trip.timeStart"
                            :timeEnd="trip.timeEnd"
                            :flightTime="trip.flightTime">
                        </TripCard>
                    </div>
                    
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


<style scoped>
    .line{
        display: flex;
        height: 3px;
        width: 100vw;
        background-color: black;
    }
    li{
        color: white;
        text-transform: uppercase;
        margin-right: 20px;
    }
    .main-container{
        width: 963px;
      }
    @media (max-width: 963px) { 
        .main-container{
            width: 90vw;
        }
    }
</style>