<template>
  <div class="d-flex">
    <div class="login-wrap">
      <form class="form-horizontal text-center" role="form">

        <h3>Quest Multimarca</h3>
        <div v-if="registrar">
          <div class="form-group d-flex mt-4 mb-3">
            <label for="inputEmail3" class="col-sm-3 control-label">Email: </label>
            <input v-model="email" type="email" class="form-control" placeholder="Email" required />
          </div>

          <div class="form-group d-flex mb-3">
            <label for="inputEmail3" class="col-sm-3 control-label">Senha: </label>
            <input v-model="senha" type="password" class="form-control" placeholder="Senha" required />
          </div>

          <h6 v-if="erro != ''">{{erro}}</h6>

          <div class="form-group d-flex">
              <button @click="login" type="button" class="btn btn-success btn-sm">Entrar</button>
          </div>
        </div>

        <div v-if="!registrar">
          <div class="form-group d-flex mt-4 mb-3">
            <label class="col-sm-3 control-label">Nome: </label>
            <input v-model="nome" type="text" class="form-control" placeholder="Nome Completo" required />
          </div>

          <div class="form-group d-flex mt-4 mb-3">
            <label class="col-sm-3 control-label">Email: </label>
            <input v-model="email" type="email" class="form-control" placeholder="Email" required />
          </div>

          <div class="form-group d-flex mb-3">
            <label class="col-sm-3 control-label">Senha: </label>
            <input v-model="senha" type="password" class="form-control" placeholder="Senha" required />
          </div>

          <div class="form-group d-flex mb-3">
            <label class="col-sm-3 control-label">Confirmar senha: </label>
            <input v-model="senha2" type="password" class="form-control" placeholder="Senha" required />
          </div>

          <h6 v-if="erro != ''">{{erro}}</h6>

          <div class="form-group d-flex">
              <button @click="register" type="button" class="btn btn-success btn-sm">Cadastrar</button>
          </div>
        </div>
      </form>
      <button @click="registrar = !registrar" class="btn btn-success btn-sm mt-2">
        <label v-if="registrar">Registrar</label> 
        <label v-else>Logar</label>
      </button>
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
      senha2:"",
      nome:"",
      registrar:true,
      erro:""
    };
  },
  methods: {
    login(event){
      event.preventDefault();
      this.$http
      .post(this.$url+"login", {
        email:this.email,
        password:this.senha
      })
      .then((response) => {
        if (response.data.token) {
          sessionStorage.setItem('usuario',response.data.token);
          this.$router.push('/buscarCarros');
        } else {
          console.log(response.data);
          this.erro = "Erro no login";
          setTimeout(() => {
            this.erro = "";
          }, 3000);
        }
      })
      .catch((e) => {
        console.log(e);
      });
    },
    register(event){
      event.preventDefault();
      this.$http
      .post(this.$url+"register", {
        name:this.nome,
        email:this.email,
        password:this.senha,
        password_confirmation:this.senha2
      })
      .then((response) => {
        if (response.data.user) {
          this.registrar = !this.registrar;
          this.erro = "Cadastro com sucesso";
          setTimeout(() => {
            this.erro = "";
          }, 3000);
        } else {
          console.log(response.data);
          this.erro = "Erro no cadastro";
          setTimeout(() => {
            this.erro = "";
          }, 3000);
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