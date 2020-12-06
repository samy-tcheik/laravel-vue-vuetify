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
      </v-toolbar>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <div class="row">
      <UserEditForm @refresh="getUsers" :user_id='item.id'></UserEditForm>
      <v-icon @click="showAlert(item.id)" small>
        mdi-trash-can
      </v-icon>
      </div>
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
      },

      showAlert(user_id) {
        this.$swal({
          icon:'question',
          text: 'Do you really want to delete this user ?',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          denyButtonText: 'Cancel',
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete('http://localhost/admin/user_destroy/' + user_id)
            .then(
                this.$swal('User deleted!', '', 'success')
                .then((result) => {
                  this.getUsers()
                }),
            )
          }
        })
      }
    },

    created() {
      this.getUsers()
    }
    
  }
</script>