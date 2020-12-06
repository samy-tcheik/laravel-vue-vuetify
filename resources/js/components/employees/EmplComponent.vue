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
          <EmplEditForm @refresh="getEmployees" :employee_id='item.id'></EmplEditForm>
          <v-icon @click="showAlert(item.id)" small>
            mdi-trash-can
          </v-icon>
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
      { text: 'Age', value: 'age'},
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
    }
  },

  created() {
    this.getEmployees()
  }
}
</script>

<style>

</style>