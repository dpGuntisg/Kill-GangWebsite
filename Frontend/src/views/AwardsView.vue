<template>
  <div>
    <navbar></navbar>
    <div>
      <div class="content">
        <h1>AWARDS</h1>
        <div v-if="isAdmin">
          <button @click="toggleAddAwardForm">Add New Award</button>
          <div v-if="showAddAwardForm" class="add-award-form">
            <h2>Add New Award</h2>
            <form @submit.prevent="addAward">
              <label for="name">Name:</label>
              <input v-model="newAward.name" id="name" required>
              <label for="date">Date:</label>
              <input v-model="newAward.date" type="date" id="date" required>
              <label for="description">Description:</label>
              <textarea v-model="newAward.description" id="description" required></textarea>
              <button type="submit">Save</button>
              <button @click="cancelAdd">Cancel</button>
            </form>
          </div>
        </div>
        <div class="awards">
          <div v-for="award in awards" :key="award.id" class="award">
            <div class="award-pic">
              <img :src="getImagePath(award.image.filepath)" alt="Award Picture">
            </div>
            <div class="award-text">
              <h2>{{ award.name }}</h2>
              <p class="date">{{ award.date }}</p>
              <p class="description">{{ award.description }}</p>
              <div v-if="isAdmin">
                <button @click="editAward(award)">Edit</button>
                <button @click="deleteAward(award)">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="isAdmin && selectedAward">
          <h2>Edit Award</h2>
          <form @submit.prevent="updateAward">
            <label for="name">Name:</label>
            <input v-model="selectedAward.name" id="name" required>
            <label for="date">Date:</label>
            <input v-model="selectedAward.date" id="date" required>
            <label for="description">Description:</label>
            <textarea v-model="selectedAward.description" id="description" required></textarea>
            <button type="submit">Save</button>
            <button @click="cancelEdit">Cancel</button>
          </form>
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
      awards: [],
      selectedAward: null,
      isAdmin: false,
      showAddAwardForm: false,
      newAward: {
        name: '',
        date: '',
        description: ''
      }
    };
  },
  mounted() {
    this.fetchAwards();
    this.checkAdmin();
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
    editAward(award) {
      this.selectedAward = { ...award };
    },
    cancelEdit() {
      this.selectedAward = null;
    },
    async updateAward() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.put(`/awards/${this.selectedAward.id}`, this.selectedAward, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchAwards();
        this.selectedAward = null;
      } catch (error) {
        console.error('Error updating award:', error);
      }
    },
    async checkAdmin() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/profile', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.isAdmin = response.data.data.role === 'admin';
      } catch (error) {
        console.error('Error checking admin role:', error);
      }
    },
    toggleAddAwardForm() {
      this.showAddAwardForm = !this.showAddAwardForm;
    },
    getImagePath(filepath) {
      return `http://localhost:8000/${filepath}`;
    },
    async addAward() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.post('/awards', this.newAward, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.fetchAwards();
        this.newAward = { name: '', date: '', description: '' };
        this.showAddAwardForm = false;
      } catch (error) {
        console.error('Error adding award:', error);
      }
    },
    async deleteAward(award) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.delete(`/awards/${award.id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchAwards(); 
      } catch (error) {
        console.error('Error deleting award:', error);
      }
    },
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
    height: 100%;
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

button{
  border-radius: 4%;
  background-color: rgba(3, 3, 3, 0.45); 
  width: 100px ;
  border-radius: 5px;
  color: #ffffff;
  background-color: #4a0000; 
  border: none;
  cursor: pointer;
  padding: 10px 20px;
  transition: background-color 0.2s ease-in;
  margin: 0 30px;
  margin-top: 20px;
}

button:hover{
  background-color: #d5d5d5;
  box-shadow: 0 0 30px #4a0000;
}



</style>
