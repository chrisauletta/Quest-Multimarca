<template>
<div class="g-0">
  <div class="row justify-content-center">
    <div class="col-11 mt-5">
      <div class="card me-3" >
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h5 class="card-title ">Lista de veiculos salvos</h5>
            <a href="#/buscarAnuncios" class="btn btn-success">Buscar Anuncios</a>
          </div>
          <table class="table table-responsive table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Anuncio</th>
                <th scope="col">Ano</th>
                <th scope="col">Combustivel</th>
                <th scope="col">Portas</th>
                <th scope="col">Quilometragem</th>
                <th scope="col">Cambio</th>
                <th scope="col">Cor</th>
                <th scope="col">Usuario</th>
                <th scope="col">Link</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in carros"
                  :key="index">
                <th scope="row">{{item.id}}</th>
                <td>{{item.nome_veiculo}}</td>
                <td>{{item.ano}}</td>
                <td>{{item.combustivel}}</td>
                <td>{{item.portas}}</td>
                <td>{{item.quilometragem}}</td>
                <td>{{item.cambio}}</td>
                <td>{{item.cor}}</td>
                <td>{{item.user.name}}</td>
                <td>{{item.link}}</td>
                <td>
                    <button @click="deletarCarro(item.id, index)" class="btn btn-danger">
                      <i class="bi bi-trash"></i>
                    </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
      email: "",
      senha: "",
      token:"",
      carros:[]
    };
  },
  created() {
    if (!sessionStorage.getItem("usuario")) {
      this.$router.push("/");
      return;
    }else{
      this.token = sessionStorage.getItem("usuario");
    }
    this.buscarCarros();
  },
  methods: {
    buscarCarros(){ 
      this.$http
      .post(this.$url+"carros/buscar", {
      },{
        "headers":{"Authorization": "Bearer "+this.token}
      })
      .then((response) => {
        if (response.data) {
          this.carros = response.data;
        }
      })
      .catch((e) => {
        console.log(e);
      });
    },
    deletarCarro(id, index){
      if(!confirm("Tem certeza que deseja remover?")){
        return;
      }
      this.$http
        .delete(this.$url+"carros/"+id, {
          "headers":{"Authorization": "Bearer "+this.token}
        })
        .then((response) => {
          if (response.data) {
            this.carros.splice(index, 1);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    }
  },
};
</script>
<style scoped>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
</style>