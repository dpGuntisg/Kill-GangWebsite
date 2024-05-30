<template>
  <div>
    <navbar></navbar>
    <div class="content">
      <div class="text-box">
        <h1 class="kill-gang">KILL GANG</h1>
        <p>At Kill Gang, we're passionate about a diverse range of interests that bring together the best of the digital age.
          Our organization is committed to fostering creativity, entertainment, and innovation across various domains, making us a dynamic force in the modern world.</p>
        <p class="interests">Our Interests:</p>
        <ul>
          <li class="list"> <strong>E-Sports:</strong> We are avid supporters of the e-sports industry, where gamers showcase their skills and compete at the highest level. 
            We believe in the power of competitive gaming to build communities, connect people, and drive the evolution of digital sports. </li>
          <li class="list"><strong>Music Creation:</strong> Music is the universal language that transcends borders and cultures. We celebrate the art of music creation,
              offering platforms and resources to help aspiring musicians realize their dreams and connect with audiences worldwide.</li>
          <li class="list"><strong>Content Creation:</strong> In an era of digital storytelling, content creation is at the heart of our organization. 
            We empower content creators across various platforms to express themselves, share their passions, and engage with audiences through captivating content.</li>
          <li class="list"><strong>Gambling:</strong> We acknowledge the excitement and thrill that gambling brings to the lives of many.
              Our responsible gambling initiatives promote a safe and enjoyable environment for those who choose to engage in this form of entertainment.</li>
          <li class="list"><strong>World Dominance:</strong> While the term "world dominance" may sound ambitious, we are dedicated to making a global impact.
            Our commitment to excellence, innovation, and community engagement drives us to expand our influence positively and ethically in the digital realm.</li> 
        </ul>
      </div>
      <h1 class="members">MEMBERS</h1>
      <div class="members-container">
        <div v-for="member in members" :key="member.id" class="member1">
          <div class="member-pfp">
            <img :src="getImagePath(member.image.filepath)" alt="Member Profile" aria-label="Member Profile">
          </div>
          <div class="members-text">
            <h2>{{ member.name }}</h2>
            <p>{{ member.description }}</p>
            <div v-if="isAdmin">
              <button class="editMember" @click="editMember(member)" aria-label="Edit Member">Edit</button>
              <button class="DeleteMember" @click="deleteMember(member)" aria-label="Delete Member">Delete</button>
              <div v-if="selectedMember && selectedMember.id === member.id">
                <form @submit.prevent="updateMember">
                  <label for="editName">Name:</label>
                  <input v-model="selectedMember.name" id="editName" required>
                  <label for="editDescription">Description:</label>
                  <textarea v-model="selectedMember.description" id="editDescription" required></textarea>
                  <button type="submit">Save</button>
                  <button type="button" @click="cancelEdit">Cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="isAdmin">
        <button class="addMember" @click="toggleAddMemberForm">Add New Member</button>
        <div v-if="showAddMemberForm" class="add-member-form">
          <h2>Add New Member</h2>
          <form @submit.prevent="addMember">
            <label for="name">Name:</label>
            <input v-model="newMember.name" id="name" required>
            <label for="description">Description:</label>
            <textarea v-model="newMember.description" id="description" required></textarea>
            <button class="submitButton" type="submit" aria-label="SubmitButton" >Save</button>
            <button class="cancelButton" type="button" @click="cancelAdd" aria-label="cancelButton" >Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  name: 'AboutUsView',
  components: {
    Navbar,
  },
  data() {
    return {
      members: [],
      selectedMember: null,
      isAdmin: false,
      showAddMemberForm: false,
      newMember: {
        name: '',
        description: '',
      },
    };
  },
  mounted() {
    this.fetchMembers();
    this.checkAdmin();
  },
  methods: {
    async fetchMembers() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/members', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.members = response.data;
      } catch (error) {
        console.error('Error fetching members:', error);
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
    toggleAddMemberForm() {
      this.showAddMemberForm = !this.showAddMemberForm;
    },
    async addMember() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.post('/members', this.newMember, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchMembers();
        this.newMember = { name: '', description: '' };
        this.showAddMemberForm = false;
      } catch (error) {
        console.error('Error adding member:', error);
      }
    },
    editMember(member) {
      this.selectedMember = { ...member };
    },
    async updateMember() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.put(`/members/${this.selectedMember.id}`, {
          name: this.selectedMember.name,
          description: this.selectedMember.description
        }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchMembers();
        this.selectedMember = null;
      } catch (error) {
        console.error('Error updating member:', error);
      }
    },
    cancelEdit() {
      this.selectedMember = null;
    },
    async deleteMember(member) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.delete(`/members/${member.id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchMembers();
      } catch (error) {
        console.error('Error deleting member:', error);
      }
    },
    getImagePath(filepath) {
      return `http://localhost:8000/${filepath}`;
    },
    cancelAdd() {
      this.showAddMemberForm = false;
      this.newMember = { name: '', description: '' };
    }
  }
};
</script>

<style scoped>
.content {
  background-color: #00000026;
  padding: 20px;
  width: 80%;
  margin: 0 auto;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}


@media screen and (max-width: 768px) {
    .content {
      width: 100%;
      padding: 0 20px;
      max-width: none;
      margin-left: none;
      margin-right: none;
    }
  
  }

.kill-gang {
  text-align: center;
  font-weight: 800;
  font-size: 2.5rem;
  margin: 1rem 0;
}

.editMember, .deleteMember{
  margin-right: 5px;
}



.text-box p {
  text-align: center;
  font-weight: 500;
}

.interests {
  font-weight: 700;
  font-size: 1.2rem;
  margin: 1.5rem 0 1rem;
}

.list {
  margin-bottom: 0.5rem;
  list-style-type: disc;
}

.members {
  text-align: center;
  font-weight: 800;
  font-size: 2rem;
  margin: 2rem 0 1rem;
}

.members-container {
  display: flex;
  flex-direction: column;
}

.member1 {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-bottom: 1.5rem;
  padding: 1rem;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.member-pfp img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin-right: 1rem;
}

.members-text {
  flex: 1;
}

.members-text h2 {
  margin: 0;
  font-weight: 700;
  font-size: 1.5rem;
}

.members-text p {
  margin: 0.5rem 0;
  font-size: 1rem;
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
.submitButton, .cancelButton{
  border-radius: 0;
}

.add-member-form {
  margin-top: 2rem;
  background-color: #00000026;
  padding: 1.5rem;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.add-member-form form {
  display: flex;
  flex-direction: column;
}

.add-member-form label {
  margin-bottom: 0.5rem;
  font-weight: 600;
}

.add-member-form input,
.add-member-form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ffffff;
  border-radius: 4px;
  background-color: rgba(255, 255, 255, 0.1);
  color: #ffffff;
}

input:focus, textarea:focus {
  outline: none;
  border-color: #4a0000;
  background-color: rgba(255, 255, 255, 0.2);
}


</style>

