<template>
  <div>
      <v-data-table
      :headers="headers"
      :items="employees"
      class="elevation-1">
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>
              Employees
            </v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <EmplAddForm @refresh="getEmployees"></EmplAddForm>
          </v-toolbar>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <div class="d-flex">
          <EmplEditForm @refresh="getEmployees" :employee_id='item.id'></EmplEditForm>
          <v-icon @click="showAlert(item.id)" small>
            mdi-trash-can
          </v-icon>
          </div>
        </template>
      </v-data-table>
  </div>
</template>

<script>
import EmplAddForm from './EmplAddForm'
import EmplEditForm from './EmplEditForm'

export default {

  components: { EmplAddForm, EmplEditForm},
  
  data: () => ({
    headers: [
      { text: 'Last Name', value:'last_name'},
      { text: 'First Name', value: 'first_name'},
      { text: 'Post', value: 'post'},
      { text: 'Recruitment', value: 'recru'},
      { text: 'Age', value: 'date_birth'},
      { text: 'Actions', value: 'actions'}
    ],
    employees: [],

  }),

  methods: {
    getEmployees () {
      axios.get('http://localhost/admin/employees_get')
      .then(Response => {
        this.employees = Response.data
      })
    },

    showAlert(employee_id) {
        this.$swal({
          icon:'question',
          text: 'Do you really want to delete this employee ?',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          denyButtonText: 'Cancel',
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete('http://localhost/admin/empl_delete/' + employee_id)
            .then(
                this.$swal('Employee deleted!', '', 'success')
                .then((result) => {
                  this.getEmployees()
                }),
            )
          }
        })
      }
  },

  created() {
    this.getEmployees()
  }
}
</script>

<style>

</style>