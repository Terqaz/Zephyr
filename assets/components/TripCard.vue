<script setup>
    import {ref} from 'vue'
    const favorite = ref(false)
    
</script>

<template>
    <div>
        <div class="flex">
            <div class="flex flex-grow">
                <div class="text-blue-950 text-2xl w-1/2">Tiny Airlines</div>
                <div class="mr-auto">
                    <div class="text-2xl">00:00 - 21:00</div>
                    <div class="text-lg">Время в полете: 21 час</div>
                </div>
                <div @click="favorite = !favorite">
                    <v-icon v-if="!favorite" icon="mdi-heart-outline"></v-icon>
                    <v-icon v-else icon="mdi-heart"></v-icon>
                </div>
                
            </div>
        </div>
        <div class="flex mb-2">
            <div class="text-2xl text-blue-950 w-1/2">Цена: 83.000 Р</div>
            <div class="mr-auto">
                <div class="font-bold">Липецк -> Москва</div>
            </div>
        </div>
        <div class="line"></div>
    </div>
    
</template>

<style scoped>
    .line{
        height: 2px;
        width: auto;
        border-radius: 2px;
        background-color: gray;
    }
</style>