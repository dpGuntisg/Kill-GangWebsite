<template>
  <div class="member1">
    <div class="member-pfp">
      <img :src="image" alt="Member Profile">
    </div>
    <div class="members-text">
      <h2>{{ name }}</h2>
      <p>{{ description }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ['name', 'description', 'image']
}
</script>

<style scoped>
.member1 {
  display: flex;
  flex-direction: row; 
  flex-wrap: wrap; 
  align-items: center;
  margin-bottom: 20px;
}

.member-image {
  width: 200px;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
}


@media screen and (max-width: 768px) {
  .member1 {
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
  }

  .member-image {
    width: 200px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
  }

  .members-text {
    width: 100%;
    text-align: center;
    margin-top: 20px; 
  }
}


@media screen and (min-width: 1156px) {

  .member-pfp img{
    margin-right: 2vw;
  }
  .member1 {
    margin-left: 100px;
    flex-direction: row; 
    align-items: flex-start;
    margin-bottom: 5vh;
  }

  .member-image {
    width: 200px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 20px;
  }

  .members-text {
    flex: 1;
    text-align: left;
    margin-top: 0;
    margin-bottom: 20px; 
  }
}
</style>

  