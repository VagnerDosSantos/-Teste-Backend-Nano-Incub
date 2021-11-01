<template>
  <button
    type="button"
    class="btn btn-small waves-effect waves-light red accent-4 tooltip"
    data-position="top"
    data-tooltip="Deletar cadastro"
    @click="showAlert"
  >
    <i class="material-icons">delete</i>
  </button>
</template>

<script>
export default {
  props: {
    id: String,
  },
  methods: {
    showAlert() {
      this.$swal
        .fire({
          title: "Tem certeza?",
          text: "Deseja realmente deletar este funcionário?",
          icon: "warning",
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonText: "Deletar",
        })
        .then((result) => {
          if (result.isConfirmed) {
            return axios
              .delete("funcionarios/deletar/" + this.id)
              .then((response) => {
                if (response.statusText !== "OK") {
                  this.$swal.fire({ text: "Ocorreu um erro!", icon: "error" });
                  throw new Error(response.statusText);
                }

                this.$swal.fire({
                  text: "Funcionário deletado com sucesso!",
                  icon: "success",
                });
                $("#linha" + this.id).remove();
              })
              .catch((error) => {
                this.$swal.fire({ text: "Ocorreu um erro!", icon: "error" });
              });
          }
        });
    },
  },
};
</script>