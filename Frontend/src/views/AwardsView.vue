<template>
    <navbar></navbar>
    <div class="content">
        <h1>AWARDS</h1>
            <award
                v-for="award in awards"
                :key="award.name"
                :name="award.name"
                :date="award.date"
                :description="award.description"
                :image="award.image"
             />
    </div>
</template>
   
   <script>
   import navbar from '../components/Navbar.vue'
   import award from '../components/award.vue'
   export default{
     name: "home",
     components:{
       navbar,
       award,
     },
     data() {
      return {
        awards: [
          {
            name: 'Kaindorf Spring Games',
            date: '2022 Spring',
            description: 'In the intense arena of the Kaindorf Spring Games CS:GO tournament, Kill Gang, a team renowned for their precision and teamwork, emerged victorious against formidable adversaries. With exceptional coordination and unyielding determination, they navigated through intense matches, showcasing their skill and adaptability. In the final showdown, Kill Gang faced off against a favored opponent. The match was a nail-biter, filled with heart-stopping moments. However, Kill Gangs unwavering resolve and remarkable plays led them to triumph. With unmatched precision, they secured crucial rounds, clinching the victory and the tournament title. Their win stands as a testament to the power of teamwork and dedication in the world of esports, inspiring gamers worldwide to pursue their passion and strive for greatness.',
            image: '/assets/award.png'
          },
          {
            name: 'Kaindorf Spring Games',
            date: '2022 Spring',
            description: 'In the intense arena of the Kaindorf Spring Games CS:GO tournament, Kill Gang, a team renowned for their precision and teamwork, emerged victorious against formidable adversaries. With exceptional coordination and unyielding determination, they navigated through intense matches, showcasing their skill and adaptability. In the final showdown, Kill Gang faced off against a favored opponent. The match was a nail-biter, filled with heart-stopping moments. However, Kill Gangs unwavering resolve and remarkable plays led them to triumph. With unmatched precision, they secured crucial rounds, clinching the victory and the tournament title. Their win stands as a testament to the power of teamwork and dedication in the world of esports, inspiring gamers worldwide to pursue their passion and strive for greatness.',
            image: '/assets/award.png'
          }
        ]
      }
    }
   }
   </script>
   
   <style scoped>

   @media screen and (max-width: 768px) {
    .content{
      background-color: #00000026;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: left;
    padding: 0 20px;
    max-width: none;
    height: 100%;
    
      
    }
  
  }

  @media screen and (min-width: 768px) {
  .content{
    background-color: #00000026;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: left;
    padding: 0 20px;
    width: 80%;
    height: 100%;
    margin-left: 10%;
  }
}

h1{
  margin-top: 40px;
  font-weight: 800;
  font-size: 60px;
}

   </style>
   