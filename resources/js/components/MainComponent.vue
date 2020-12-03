<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-list>
        <v-list-item class="px-2">
          <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
          </v-list-item-avatar>
        </v-list-item>

        <v-list-item link>
            <v-list-item-content>
              <v-list-item-title class="title">
                Sandra Adams
              </v-list-item-title>
              <v-list-item-subtitle>sandra_a88@gmail.com</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
      </v-list>
      <v-divider></v-divider>
      <v-list
      nav
      dense>
      <router-link to="/users">
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>
              mdi-account-group
            </v-icon>
          </v-list-item-icon>
          <v-list-item-title>
            Utilisateur
          </v-list-item-title>
        </v-list-item>
      </router-link>
      <router-link to="/employees">
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>
              mdi-account-group-outline
            </v-icon>
          </v-list-item-icon>
          <v-list-item-title>
            Employés
          </v-list-item-title>
        </v-list-item>
      </router-link>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>MyApp</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-icon
      large>
        mdi-account-circle
      </v-icon>
      
    </v-app-bar>

    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data: () => ({ 
      drawer: null,
      drawer1: null 
      }),
  }
</script>