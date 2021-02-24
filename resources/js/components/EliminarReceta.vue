<template>
    <input
        v-on:click="eliminarReceta"
        type="submit"
        class="btn btn-danger d-block w-100 mb-2"
        value="Eliminar"
    />
</template>

<script>
export default {
    props: ["recetaId"],
    methods: {
        eliminarReceta() {
            this.$swal({
                title: "Deseas eliminar esta receta?",
                text: "Si la eliminas no la podras recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No"
            }).then(result => {
                if (result.isConfirmed) {
                    const params = {
                        id: this.recetaId
                    };
                    axios
                        .post(`/recetas/${this.recetaId}`, {
                            params,
                            _method: "delete"
                        })
                        .then(res => {
                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        });
                    this.$swal(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        }
    }
};
</script>
