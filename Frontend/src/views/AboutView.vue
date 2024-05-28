<template>
  <div>
    <navbar></navbar>
    <div class="text-div">
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
            <img :src="getImagePath(member.image.filepath)" alt="Member Profile">
          </div>
          <div class="members-text">
            <h2>{{ member.name }}</h2>
            <p>{{ member.description }}</p>
            <div v-if="isAdmin">
              <button @click="editMember(member)">Edit</button>
              <button @click="deleteMember(member)">Delete</button>
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
        <button @click="toggleAddMemberForm">Add New Member</button>
        <div v-if="showAddMemberForm" class="add-member-form">
          <h2>Add New Member</h2>
          <form @submit.prevent="addMember">
            <label for="name">Name:</label>
            <input v-model="newMember.name" id="name" required>
            <label for="description">Description:</label>
            <textarea v-model="newMember.description" id="description" required></textarea>
            <button type="submit">Save</button>
            <button type="button" @click="cancelAdd">Cancel</button>
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

@media screen and (max-width: 768px) {
    .text-div {
      padding: 0 20px;
      max-width: none;
      margin-left: none;
      margin-right: none;
    }
  
  }

  @media screen and (min-width: 768px) {
  .text-div{
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
  .text-box{
    width: 80%;
  }

  .text-box p{
    text-align: center;
    font-weight: 500;
  }
}
  
  .kill-gang {
    margin-top: 10%;
    text-align: center;
    font-weight:800;
    font-size: 70px;
  }
  
  strong {
    font-weight:650;
  }
  
  .interests{
    margin-top: 30px;
    font-weight: 750;
    font-size: 25px;
    margin-bottom: 5px;
  }
  
  .list {
      margin-bottom: 10px;
      list-style-type:disc;
  }
  
  .members{
    margin-bottom: 3vh;
    margin-top: 10vh;
     text-align: center;
     font-weight:800;
     font-size: 60px;
  }
  
  
  .members-container {
    display: flex;
    flex-direction: column;
  }

  .member-pfp img {
    width: 200px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
  }

/* asdasdasdasdasdasd */

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

button {
  border-radius: 4%;
  background-color: rgba(3, 3, 3, 0.45);
  width: 90px;
  border-radius: 5px;
  color: #ffffff;
  background-color: #4a0000;
  border: none;
  cursor: pointer;
  padding: 8px 0px;
  transition: background-color 0.2s ease-in;
  margin: 0 5px;
}

button:hover {
  background-color: #d5d5d5;
  box-shadow: 0 0 30px #4a0000;
}

input {
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45);
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
}

textarea{
  width: 5rem;
}

  </style>

