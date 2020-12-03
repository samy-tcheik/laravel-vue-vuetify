<template>
  <v-data-table
    :headers="headers"
    :items="items"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>My CRUD</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <UserEditForm @refresh="getUsers" :user_id='item.id'></UserEditForm>
    </template>
  </v-data-table>
</template>
<script>
import UserEditForm from '../users/UserEditForm.vue'
  export default {

    components: { UserEditForm },

    data: () => ({
        headers: [
            {
                text: 'Name',
                value: 'name'
            },
            {
                text: 'E-mail',
                value: 'email'
            },
            {
                text: 'Role',
                value: 'roles'
            },
            {
              text: 'Actions',
              value: 'actions'
            }
        ],

        items: [],
    }),

    methods: {
      getUsers (){
        axios.get('http://localhost/admin/get_users')
        .then(Response => {
            if (Response.status === 200) {
                this.items = Response.data
            }
        })
      }
    },

    created() {
      this.getUsers()
    }
    
  }
</script>