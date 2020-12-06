<template>
  <div>
    <v-dialog v-model="dialog" max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-icon small class="mr-2" v-bind="attrs" v-on="on" @click="getEmployee();getPosts();">
          mdi-account-edit
        </v-icon>
      </template>
      <v-card>
        <v-card-title> Add New Employee </v-card-title>
        <v-card-text>
          <v-text-field
            label="Last Name"
            v-model="lastname"
            :error-messages="LastNameErrors"
            required
            @click="$v.lastname.$touch()"
            @blur="$v.lastname.$touch()"
          >
          </v-text-field>
          <v-text-field
            label="First Name"
            v-model="firstname"
            :error-messages="FirstNameErrors"
            required
            @click="$v.firstname.$touch()"
            @blur="$v.firstname.$touch()"
          >
          </v-text-field>
          <v-text-field
            required
            label="E-mail"
            v-model="email"
            :error-messages="EmailErrors"
            @click="$v.email.$touch()"
            @blur="$v.email.$touch()"
          >
          </v-text-field>
          <v-select
            required
            label="Post"
            :error-messages="PostErrors"
            v-model="post"
            :items="posts"
            @click="$v.post.$touch()"
            @blur="$v.post.$touch()"
          >
          </v-select>
          <v-text-field
            v-model="address"
            label="Address"
            required
            :error-messages="AddressErrors"
            @click="$v.address.$touch()"
            @blur="$v.address.$touch()"
          >
          </v-text-field>
          <v-menu
            ref="menu1"
            v-model="menu1"
            :close-on-content-click="false"
            :return-value.sync="birth"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="birth"
                label="Birthday"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker v-model="birth" @change="saveBirth"> </v-date-picker>
          </v-menu>
          <v-menu
            ref="menu2"
            v-model="menu2"
            :close-on-content-click="false"
            :return-value.sync="recru"
            transition="scale-transition"
            offset-y
            min-width="250px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="recru"
                label="Recruitement date"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
              >
              </v-text-field>
            </template>
            <v-date-picker v-model="recru" @change="saveRecru"></v-date-picker>
          </v-menu>
        </v-card-text>
        <v-card-actions>
          <v-btn color="error" tile @click="dialog = false"> Close</v-btn>
          <v-spacer></v-spacer>
          <v-btn @click="submit" color="primary" tile>Apply</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {
  required,
  minLength,
  maxLength,
  email,
  minValue,
} from "vuelidate/lib/validators";

export default {
  validations: {
    lastname: { required, minLength: minLength(3), maxLength: maxLength(15) },
    firstname: { required, minLength: minLength(3), maxLength: maxLength(15) },
    email: { required, email },
    post: { required },
    birth: { required },
    address: { required },
    recru: { required },
  },

  data: () => ({
    dialog: false,
    lastname: "",
    firstname: "",
    email: "",
    post: "",
    posts: [],
    birth: "",
    address: "",
    recru: "",
    menu1: false,
    menu2: false,
  }),

  props: {
    employee_id: null,
  },

  methods: {

      getPosts() {
      axios.get("http://localhost/admin/get_posts").then((Response) => {
        this.posts = Response.data;
      });
    },

    getEmployee() {
        axios.get('http://localhost/admin/get_empl/' + this.employee_id)
        .then(Response => {
            this.lastname = Response.data.last_name
            this.firstname = Response.data.first_name
            this.email = Response.data.email
            this.post = Response.data.post.name
            this.birth = Response.data.date_birth
            this.recru = Response.data.recru
            this.address = Response.data.address
        })
    },
    saveBirth(birth) {
      this.$refs.menu1.save(birth);
    },

    saveRecru(recru) {
      this.$refs.menu2.save(recru);
    },

    submit () {
      let emplData = new FormData()
      emplData.append('last_name', this.lastname)
      emplData.append('first_name', this.firstname)
      emplData.append('email', this.email)
      emplData.append('post', this.post)
      emplData.append('birth', this.birth)
      emplData.append('address', this.address)
      emplData.append('recru', this.recru)
      axios.post('http://localhost/admin/update_empl/' + this.employee_id, emplData)
      .then(Response => {
        if (Response.status === 200) {
          console.log('success')
          this.dialog = false
          this.$emit('refresh')
        }
      })
    },
    },
    computed: {
    LastNameErrors() {
      const errors = [];
      if (!this.$v.lastname.$dirty) return errors;
      !this.$v.lastname.required && errors.push("Last name is required");
      !this.$v.lastname.minLength &&
        errors.push("Last name must be more then 3 characters");
      !this.$v.lastname.maxLength &&
        errors.push("Last name must be less then 15 characters");
      return errors;
    },

    FirstNameErrors() {
      const errors = [];
      if (!this.$v.firstname.$dirty) return errors;
      !this.$v.firstname.required && errors.push("First name is required");
      !this.$v.firstname.minLength &&
        errors.push("First name must be more the 3 characters");
      !this.$v.firstname.maxLength &&
        errors.push("First name must be less then 15 characters");
      return errors;
    },

    EmailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.required && errors.push("E-mail is required");
      !this.$v.email.email && errors.push("Please insert a valid email");
      return errors;
    },

    PostErrors() {
      const errors = [];
      if (!this.$v.post.$dirty) return errors;
      !this.$v.post.required && errors.push("Please select a post");
      return errors;
    },

    AddressErrors() {
      const errors = [];
      if (!this.$v.address.$dirty) return errors;
      !this.$v.address.required && errors.push("Address is required");
      return errors;
    },
  },
  
};
</script>

<style>
</style>