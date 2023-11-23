<template>
        <div class="Award-pic">
            <img :src="image" alt="Award Picture">
        </div>
        <div class="award-text">
            <h2>{{ name }}</h2>
            <p class="date">{{ date }}</p>
            <p>{{ description }}</p>
        </div>

</template>

<script>
export default {
  props: ['name', 'date', 'description', 'image']
}
</script>

<style>

h2{
    font-weight:600;
    font-size: 50px;
}

 .date{
    font-weight:500;
    font-size: 30px;
    margin-bottom: 5px;
}

.award-text{
    font-weight: 200;
    width: 100%;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 40px;
}
 .Award-pic img {
    margin-top: 100px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    max-width: 1000px; 
    height: auto;
    margin-bottom: 20px;
 }
</style>