<template>
  <div>
    <h1>Upload Image</h1>
    <form @submit.prevent="uploadImage">
      <input type="file" @change="onFileChange" />
      <button type="submit">Upload</button>
    </form>
    <div v-if="image">
      <h2>Uploaded Image:</h2>
      <img :src="image.filepath" :alt="image.filename" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      image: null,
      selectedFile: null,
    };
  },
  methods: {
    onFileChange(event) {
      this.selectedFile = event.target.files[0];
    },
    async uploadImage() {
      const formData = new FormData();
      formData.append('image', this.selectedFile);

      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.post('/upload', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${token}`
          }
        });
        this.image = response.data.image;
      } catch (error) {
        console.error('Error uploading image:', error);
      }
    }
  }
};
</script>

<style scoped>
</style>
