
<script setup>
    import TopTripLine from '@/components/TopTripLine.vue';
    import TripCard from '@/components/TripCard.vue'
    import PlaceCard from '@/components/PlaceCard.vue'
</script>

<template>
    <div class="background-op">
        <header class="block base-color w-full h-20 pt-7 pl-5 align-middle items-center content-center">
            <img src="@/assets/logos/Zephyr.svg" class="w-24 inline" alt="">
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
                        <div class="line bg-black mr-5"></div>
                    </div>
                    <p class="mb-6 text-2xl">Вам это понравилось.</p>

                    <div class="grid gap-6 grid-cols-3 grid-flow-row">
                        <PlaceCard v-for="i in 6"></PlaceCard>
                    </div>
                    
                    <div class="mt-10 flex align-middle items-center content-center">
                        <p class=" font-bold text-3xl mr-5">ИЗБРАННЫЕ НАПРАВЛЕНИЯ</p>
                        <div class="line bg-black mr-5"></div>
                    </div>
                    <p class="mb-6 text-2xl">Вас это заинтересовало.</p>
                    
                    <div>
                        <TripCard class="mb-5 ml-" v-for="i in 2"></TripCard>
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
    
    li{
        color: white;
        text-transform: uppercase;
        margin-right: 20px;
    }
    .main-container{
        width: 963px;
    }
</style>