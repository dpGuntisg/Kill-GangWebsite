<template>
  <div>
    <navbar></navbar>
    <div>
      <div class="content">
        <h1>AWARDS</h1>
        <div class="awards">
          <div v-for="award in awards" :key="award.id" class="award">
            <div class="award-pic">
              <img :src="getImagePath(award.image.filepath)" alt="Award Picture">
            </div>
            <div class="award-text">
              <h2>{{ award.name }}</h2>
              <p class="date">{{ award.date }}</p>
              <p class="description">{{ award.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from '../components/Navbar.vue';

export default {
  name: 'Home',
  components: {
    Navbar,
  },
  data() {
    return {
      awards: []
    };
  },
  mounted() {
    this.fetchAwards();
  },
  methods: {
    async fetchAwards() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/awards', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.awards = response.data;
      } catch (error) {
        console.error('Error fetching awards:', error);
      }
    },
    getImagePath(filepath) {
      return `http://localhost:8000/storage/${filepath}`;
    }
  }
};
</script>

<style scoped>
@media screen and (max-width: 768px) {
  .content {
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
  .content {
    background-color: #00000026;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: left;
    padding: 0 20px;
    width: 80%;
    height: 100vh;
    margin-left: 10%;
  }
}

h1 {
  margin-top: 40px;
  font-weight: 800;
  font-size: 60px;
}

.date {
  font-weight: 500;
  font-size: 30px;
  margin-bottom: 5px;
}

.award-text {
  font-weight: 200;
  width: 80%;
  text-align: center;
  margin-top: 20px;
  margin-bottom: 40px;
}

.award-pic img {
  margin-top: 100px;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  max-width: 1000px;
  height: auto;
  margin-bottom: 20px;
}
</style>