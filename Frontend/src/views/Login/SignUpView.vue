<template>
  <div class="contntent">
    <div class="content">
      <form @submit.prevent="register">
        <h1>KILL GANG</h1>
        <div class="input-container">
          <label for="name">Name</label>
          <input v-model.trim="name" type="text" id="name" class="Name" placeholder="Name" required aria-required="true" @input="validateName">
          <div v-if="errors.includes('Name field must be filled')" class="error-message">Name field must be filled</div>
          <div v-if="errors.includes('Name can only contain letters and spaces.')" class="error-message">Name can only contain letters and spaces.</div>

          <label for="email">E-mail</label>
          <input v-model.trim="email" type="email" id="email" class="Login-email" placeholder="E-mail" required aria-required="true" @input="validateEmail">
          <div v-if="errors.includes('Email field must be filled')" class="error-message">Email field must be filled</div>
          <div v-if="errors.includes('Please enter a valid email address.')" class="error-message">Please enter a valid email address.</div>

          <label for="password">Password</label>
          <input v-model="password" type="password" id="password" class="Login-password" placeholder="Password" required aria-required="true" @input="validatePassword">
          <div v-if="errors.includes('Password field must be filled')" class="error-message">Password field must be filled</div>
          <div v-if="errors.includes('Password must be at least 8 characters and include uppercase, lowercase, and number.')" class="error-message">Password must be at least 8 characters and include uppercase, lowercase, and number.</div>

          <label for="passwordConfirmation">Confirm Password</label>
          <input v-model="passwordConfirmation" type="password" id="passwordConfirmation" class="Login-password" placeholder="Confirm Password" required aria-required="true" @input="validatePasswordConfirmation">
          <div v-if="errors.includes('Confirm Password field must be filled')" class="error-message">Confirm Password field must be filled</div>
          <div v-if="errors.includes('Passwords do not match')" class="error-message">Passwords do not match</div>

          <div v-if="registrationError" class="error-message">{{ registrationError }}</div>
        </div>
        <div class="button-container">
          <RouterLink to="/login">
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
    validateName() {
      if (!this.name) {
        this.addError('Name field must be filled');
      } else if (!/^[a-zA-Z\s]+$/.test(this.name)) {
        this.addError('Name can only contain letters and spaces.');
      } else {
        this.removeError('Name field must be filled');
        this.removeError('Name can only contain letters and spaces.');
      }
    },
    validateEmail() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!this.email) {
        this.addError('Email field must be filled');
      } else if (!emailRegex.test(this.email)) {
        this.addError('Please enter a valid email address.');
      } else {
        this.removeError('Email field must be filled');
        this.removeError('Please enter a valid email address.');
      }
    },
    validatePassword() {
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
      if (!this.password) {
        this.addError('Password field must be filled');
      } else if (!passwordRegex.test(this.password)) {
        this.addError('Password must be at least 8 characters and include uppercase, lowercase, and number.');
      } else {
        this.removeError('Password field must be filled');
        this.removeError('Password must be at least 8 characters and include uppercase, lowercase, and number.');
      }
    },
    validatePasswordConfirmation() {
      if (!this.passwordConfirmation) {
        this.addError('Confirm Password field must be filled');
      } else if (this.password !== this.passwordConfirmation) {
        this.addError('Passwords do not match');
      } else {
        this.removeError('Confirm Password field must be filled');
        this.removeError('Passwords do not match');
      }
    },
    addError(error) {
      if (!this.errors.includes(error)) {
        this.errors.push(error);
      }
    },
    removeError(error) {
      const index = this.errors.indexOf(error);
      if (index > -1) {
        this.errors.splice(index, 1);
      }
    },
    register() {
      // Trigger all validations
      this.validateName();
      this.validateEmail();
      this.validatePassword();
      this.validatePasswordConfirmation();

      if (this.errors.length === 0) {
        axios.post('/api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
        })
          .then(response => {
            if (response.data.status) {
              this.$router.push('/login');
            } else {
              this.registrationError = response.data.message;
            }
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
  font-size: 2em;
  font-weight: bold;
  text-align: center;
}

.input-container {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}

label {
  color: #ffffff;
  margin-bottom: 5px;
}

input {
  border-radius: 4%;
  background-color: rgba(3, 3, 3, 0.45);
  margin: 10px 0;
  border: none;
  color: rgb(156, 154, 154);
  height: 40px;
  padding: 10px;
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
    width: 100%;
    height: 100vh;
    border-radius: 0;
    padding: 10px;
    box-shadow: none;
  }
  h1 {
    font-size: 1.5em;
  }
}

.button-container {
  display: flex;
  justify-content: center;
}
</style>
