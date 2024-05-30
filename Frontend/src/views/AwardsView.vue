<template>
  <div>
    <navbar></navbar>
    <div class="content">
      <h1>AWARDS</h1>
      <div v-if="isAdmin">
        <button class="addButton" @click="toggleAddAwardForm">Add New Award</button>
        <div v-if="showAddAwardForm" class="add-award-form">
          <h2>Add New Award</h2>
          <form @submit.prevent="addAward">
            <label for="name">Name:</label>
            <input v-model="newAward.name" id="name" required>
            <label for="date">Date:</label>
            <input v-model="newAward.date" type="date" id="date" required>
            <label for="description">Description:</label>
            <textarea v-model="newAward.description" id="description" required></textarea>
            <button class="saveButton" type="submit">Save</button>
            <button class="cancelButton" @click="cancelAdd">Cancel</button>
          </form>
        </div>
      </div>
      <div class="awards">
        <div v-for="award in awards" :key="award.id" class="award">
          <div class="award-pic">
            <img :src="getImagePath(award.image.filepath)" alt="Award Picture">
          </div>
          <div class="award-text">
            <h2 class ="awardName">{{ award.name }}</h2>
            <p class="date">{{ award.date }}</p>
            <p class="description">{{ award.description }}</p>
            <div v-if="isAdmin">
              <button class="editButton" @click="editAward(award)">Edit</button>
              <button class="deleteButton" @click="deleteAward(award)">Delete</button>
            </div>
            <div v-if="selectedAward && selectedAward.id === award.id" class="edit-award-form">
              <h2>Edit Award</h2>
              <form @submit.prevent="updateAward">
                <label for="name">Name:</label>
                <input v-model="selectedAward.name" id="name" required>
                <label for="date">Date:</label>
                <input v-model="selectedAward.date" type="date" id="date" required>
                <label for="description">Description:</label>
                <textarea v-model="selectedAward.description" id="description" required></textarea>
                <button class="saveButton" type="submit">Save</button>
                <button class="cancelButton" @click="cancelEdit">Cancel</button>
              </form>
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
  name: 'Awards',
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
    cancelAdd() {
    this.newAward = { name: '', date: '', description: '' }; 
    this.showAddAwardForm = false; 
  },
    
  }
  
};
</script>

<style scoped>
.content {
  background-color: #00000026;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  max-width: 80%;
  margin: 0 auto;
  border-radius: 8px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.award {
  background-color: #00000026;
  border-radius: 8px;
}

@media screen and (max-width: 768px) {
    .content {
      width: 100%;
      padding: 0 20px;
      max-width: none;
      margin-left: none;
      margin-right: none;
    }
    .award {
    background: none;
    border-radius: 8px;
  }
  .saveButton, .cancelButton{
    margin-bottom: 5px;
  }

  .edit-award-form {
    background: none !important;
    width: 100% !important; 
    max-width: none !important;
  }

}

h1 {
  margin-top: 40px;
  font-weight: 800;
  font-size: 48px;
  color: #ffffff;
  text-align: center;
}

button{
  margin-right: 5px;
}

.date,
.description,
.button {
  color: #ffffff;
}

.date {
  font-weight: 300;
  font-size: 15px;
  margin-bottom: 10px;
}

.description {
  font-weight: 300;
  font-size: 18px;
  margin-bottom: 20px;
}



.awardName {
  font-weight: 900;
}

.award-text {
  width: 100%;
  text-align: center;
  margin-top: 20px;
  margin-bottom: 40px;
  padding: 20px;
  border-radius: 8px;
}

.award-pic img {
  margin-top: 1rem;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  max-width: 1000px;
  height: auto;
  border-radius: 5px;
}


.add-award-form,
.edit-award-form {
  background-color: #00000026;
  width: 100%;
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  border-radius: 8px;
}

.add-award-form h2,
.edit-award-form h2 {
  color: #ffffff;
  font-size: 32px;
  margin-bottom: 20px;
}

</style>
