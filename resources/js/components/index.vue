<template>
    <div>
        <div class="navbar border-bottom " style="color: #563d7c">


             <router-link class = "btn nav-button" :to="{ name: 'contacts' }">Contacts</router-link>

        </div>

        <div class = "mt-4 mr-4 pr-4 pl-4">
  <router-view />
        </div>


    </div>
</template>
