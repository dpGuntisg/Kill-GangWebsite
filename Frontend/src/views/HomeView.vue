<template>
  <div>
    <navbar></navbar>
    <div class="content">
      <h1>NEWEST KILL GANG CONTENT</h1>
      <div class="Video-box">
        <div class="video-container">
          <vue-plyr :options="options">
            <div class="plyr__video-embed">
              <iframe
                :src="youtubeVideoUrl"
                allowfullscreen
                allowtransparency
                allow="autoplay"
                @error="handleIframeError"
              ></iframe>
            </div>
          </vue-plyr>
        </div>
        <div class="comment-container">
          <comment-section class="CommentSection" />
        </div>
      </div>
      <div class="Song-Box"></div>
      <div v-if="isAdmin" class="admin-panel">
        <h2>Admin Panel</h2>
        <form @submit.prevent="updateYoutubeLink">
          <label for="youtubeLink">YouTube Link:</label>
          <input type="text" v-model="newYoutubeLink" />
          <button type="submit">Update Link</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import VuePlyr from 'vue-plyr';
import 'vue-plyr/dist/vue-plyr.css';
import Navbar from '../components/Navbar.vue';

export default {
  name: 'HomeView',
  components: {
    Navbar,
    VuePlyr,
  },
  data() {
    return {
      youtubeVideoUrl: '',
      options: {},
      isAdmin: false,
      newYoutubeLink: ''
    };
  },
  mounted() {
    this.fetchYoutubeLink();
    this.checkAdmin();
  },
  methods: {
    async fetchYoutubeLink() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/youtube-link', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.youtubeVideoUrl = response.data.youtubeLink;
        this.newYoutubeLink = this.youtubeVideoUrl;
      } catch (error) {
        console.error('Error fetching YouTube link:', error);
        if (error.response && error.response.status === 401) {
          console.error('Unauthenticated: Please log in.');
        }
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
        if (error.response && error.response.status === 401) {
          console.error('Unauthenticated: Please log in.');
        }
      }
    },
    async updateYoutubeLink() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.put('/youtube-link', { youtubeLink: this.newYoutubeLink }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.youtubeVideoUrl = this.newYoutubeLink;
      } catch (error) {
        console.error('Error updating YouTube link:', error);
        if (error.response && error.response.status === 401) {
          console.error('Unauthenticated: Please log in.');
        }
      }
    },
    handleIframeError() {
      window.open(this.youtubeVideoUrl, '_blank');
    }
  }
};
</script>
<style scoped>
h1 {
  margin-top: 50px;
  text-align: center;
  font-weight: 800;
  font-size: 70px;
  display: block;
}

.Video-box {
  margin-top: 50px;
  display: flex;
  justify-content: space-between;
  background-color: #220909b2;
}

.video-container {
  width: 65%;
}

.CommentSection {
  width: 30%;
  text-align: center;
}

.content {
  background-color: #00000026;
  margin-left: 10%;
  margin-right: auto;
  text-align: left;
  max-width: 80vw;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.admin-panel {
  margin-top: 20px;
  text-align: center;
}

@media screen and (max-width: 1400px) {
  .content {
    max-width: none;
    margin-left: 0;
    margin-right: 0;
  }
  .Video-box {
    flex-direction: column;
    align-items: center;
  }
}

@media screen and (max-width: 768px) {
  .video-container {
    width: 100%;
  }
}
</style>
