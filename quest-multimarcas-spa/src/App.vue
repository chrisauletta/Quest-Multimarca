<template>
  <div id="app" class="container-fluid">
    <button v-if="this.$router.history.current.path != '/'"
     @click="logoff" class="btn btn-light mt-5 ms-5">Sair</button>
      <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
  methods: {
    logoff(){
      sessionStorage.clear();
      this.$router.push("/");
    }
  }
}
</script>

<style>
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
} */
</style>
