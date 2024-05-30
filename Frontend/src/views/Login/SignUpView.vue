<template>
<div class="contntent">
  <div class="content">
    <form @submit.prevent="register">
      <h1>KILL GANG</h1>
      <div class="input-container">
        <label for="name">Name</label>
        <input v-model="name" type="text" id="name" class="Name" placeholder="Name" required aria-required="true">
        <div v-if="errors.includes('Name field must be filled')" class="error-message">Name field must be filled</div>

        <label for="email">E-mail</label>
        <input v-model="email" type="email" id="email" class="Login-email" placeholder="E-mail" required aria-required="true">
        <div v-if="errors.includes('Email field must be filled')" class="error-message">Email field must be filled</div>

        <label for="password">Password</label>
        <input v-model="password" type="password" id="password" class="Login-password" placeholder="Password" required aria-required="true">
        <div v-if="errors.includes('Password field must be filled')" class="error-message">Password field must be filled</div>

        <label for="passwordConfirmation">Confirm Password</label>
        <input v-model="passwordConfirmation" type="password" id="passwordConfirmation" class="Login-password" placeholder="Confirm Password" required aria-required="true">
        <div v-if="errors.includes('Confirm Password field must be filled')" class="error-message">Confirm Password field must be filled</div>
        <div v-if="errors.includes('Passwords do not match')" class="error-message">Passwords do not match</div>

        <div v-if="registrationError" class="error-message">{{ registrationError }}</div>
      </div>
      <div class="button-container">
        <RouterLink to="/">
          <button type="button" class="login-btn">LOGIN</button>
        </RouterLink>
        <button type="submit" class="signup-btn">SIGN UP</button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'SignupComponent',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirmation: '',
      errors: [],
      registrationError: ''
    };
  },
  methods: {
    register() {
      this.errors = [];
      this.registrationError = '';

      if (!this.name) {
        this.errors.push('Name field must be filled');
      }
      if (!this.email) {
        this.errors.push('Email field must be filled');
      }
      if (!this.password) {
        this.errors.push('Password field must be filled');
      }
      if (!this.passwordConfirmation) {
        this.errors.push('Confirm Password field must be filled');
      }
      if (this.password && this.passwordConfirmation && this.password !== this.passwordConfirmation) {
        this.errors.push('Passwords do not match');
      }
      if (this.errors.length === 0) {
        axios.post('api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
        })
          .then(response => {
            this.$router.push({ name: 'login' });
          })
          .catch(error => {
            this.registrationError = error.response.data.message || 'Something went wrong';
          });
      }
    }
  }
};
</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 10px;
  text-align: center;
}

.contntent{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.content {
  height: auto;
  overflow: hidden;
  margin: auto;
  padding: 30px;
  width: 100%;
  max-width: 500px;
  background: rgba(3, 3, 3, 0.45);
  border-radius: 3%;
  box-shadow: 0 0 238px 70px rgba(82, 10, 10, 1);
  overflow: hidden;
}

h1 {
    font-size: 80px;
    font-weight: bold;
    justify-content: center;
    align-content:center; 
    display:flex;
}

.input-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 20px;
}

.Login-email,
.Name,
.Login-password {
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45); ;
    margin-top: 20px;
    margin-bottom: 20px;
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
    text-indent: 10px;
    
}

.login-btn,
.signup-btn {
  border-radius: 5px;
  color: #ffffff;
  background-color: #4a0000;
  border: none;
  cursor: pointer;
  padding: 10px 20px;
  transition: background-color 0.2s ease-in;
  margin: 20px 10px;
}

.login-btn:hover,
.signup-btn:hover {
    background-color: #d5d5d5;
    box-shadow: 0 0 30px #4a0000;
}

@media (max-width: 768px) {
    .content {
    margin-top: 0;
    border-radius: 0%;
    height: 100vh;
    overflow: hidden;
    width: 100%;
    font-size: 18px;
    margin-bottom: 0;
    overflow: auto;
    }

    .input-container{
      margin-top: 1px;
    }

    h1 {
      font-size: 2em;
      font-weight: bold;
      text-align: center;
    }
}

@media (min-width: 1200px) {
    .content {
    overflow: hidden;
    font-size: 24px;
    }
}
.button-container {
  margin: 0;
  position: relative;
  justify-content: center;
  display: flex;
  width: 100%;
}
</style>
