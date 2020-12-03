<template>
    <v-dialog
    v-model="dialog"
    max-width="600px">
        <template v-slot:activator="{ on }">
            <v-icon
            small
            class="mr-2"
            v-on="on"
            @click="getRoles();getUser();">
                mdi-account-edit
            </v-icon>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">User Edit</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-form>
                        <v-text-field
                        v-model="name"
                        :error-messages="nameErrors"
                        label="Name"
                        required
                        @input="$v.name.$touch()"
                        @blur="$v.name.$touch()">
                        </v-text-field>
                        <v-text-field
                        v-model="email"
                        required
                        :error-messages="emailErrors"
                        label="E-mail"
                        @input="$v.email.$touch()"
                        @blur="$v.email.$touch()">
                        </v-text-field>
                        <v-select
                        v-model="role"
                        :items="roles"
                        :error-messages="selectErrors"
                        label="User Role"
                        @change="$v.role.$touch()"
                        @blur="$v.role.$touch()"></v-select>
                    </v-form>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn
                tile
                color="error"
                @click="dialog = false"
                >
                    Cancel
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn
                tile
                color="primary"
                @click="submit">
                Add
                </v-btn>
                
                
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>

import { required, maxLength, email } from 'vuelidate/lib/validators'

export default {

     validations: {
        name: { required, maxLength: maxLength(12) },
        email: { required, email},
        role: { required }
    },
    data: () => ({
        dialog: false,
        role: '',
        roles: [],
        name: '',
        email: ''
    }),

    props: {
        user_id: null
    },

    computed: {
        nameErrors () {
            const errors = []
            if (!this.$v.name.$dirty) return errors
            !this.$v.name.required && errors.push('Please enter your name')
            !this.$v.name.maxLength && errors.push('Name must be less then 12 characters')
            return errors
        },

        emailErrors () {
            const errors = []
            if (!this.$v.email.$dirty) return errors
            !this.$v.email.required && errors.push('please enter your E-mail')
            !this.$v.email.email && errors.push('Plese enter a valid E-mail')
            return errors
        },

        selectErrors () {
            const errors = []
            if (!this.$v.role.$dirty) return errors
            !this.$v.role.required && errors.push('Please select a role')
            return errors
        }
    },

    methods: {
        submit () {
            let Data = new FormData()
            Data.append('name', this.name)
            Data.append('email', this.email)
            Data.append('role', this.role)
            axios.post('http://localhost/admin/user_update/' + this.user_id , Data)
            .then(Response => {
                if (Response.status === 200) {
                    console.log('success')
                    this.dialog = false
                    this.$emit('refresh')
                }
            })
        },

        getRoles () {
            axios.get('http://localhost/admin/get_roles')
            .then(Response => {
                if (Response.status === 200) {
                    this.roles = Response.data
                } else {
                    consle.log('getting roles has faild')
                }
            })
        },

        getUser() {
            axios.get('http://localhost/admin/get_user/' + this.user_id)
            .then(Response => {
                if (Response.status === 200) {
                    this.name = Response.data.name,
                    this.email = Response.data.email,
                    this.role = Response.data.roles
                }  else {
                    console.log('error request faild')
                }
            })
        }
    }
}
</script>

<style>

</style>