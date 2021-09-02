<template>
<div class="g-0">
  <div class="row justify-content-center mb-5">
    <div class="col-7 mt-5">
      <div class="card me-3">          
        <div class="d-flex justify-content-between p-3">
            <h5 class="card-title ">Insira o link para buscar os veiculos</h5>
            <a href="#/buscarCarros" class="btn btn-success">Voltar</a>
        </div>
        <div class="card-body d-flex">
          <input v-model="link" type="text " class="form-control" placeholder="Link" required />
          <button @click="buscarAnuncios()" class="btn btn-primary ms-2" :disabled="timeRequest" >
            <span v-if="timeRequest" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Buscar
          </button>
        </div>
        <ul>
          <li v-for="(item, index) in anuncios" :key="index">
            {{item.nome_veiculo}} - {{item.result}}
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

</template>
<script>
export default {
  name: "Login",
  data() {
    return {
      link: "",
      anuncios:[],
      erro:"",
      token:"",
      timeRequest:false
    };
  },
  created() {
    if (!sessionStorage.getItem("usuario")) {
      this.$router.push("/");
      return;
    }else{
      this.token = sessionStorage.getItem("usuario");
    }
  },
  methods: {
    buscarAnuncios(){ 
      this.timeRequest = true;
      this.$http
      .post(this.$url+"carros/anuncio", {
        link:this.link
      },{
        "headers":{"Authorization": "Bearer "+this.token}
      })
      .then((response) => {
        if (response.data.length > 0){
          this.anuncios = response.data;
          this.timeRequest = false;
        }
      })
      .catch((e) => {
        console.log(e);
        this.$router.push("/");
      });
    }
  },
};
</script>
<style scoped>

</style>