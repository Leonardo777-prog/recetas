<template>
    <div>
        <div
            class="heart"
            @click="likeReceta"
            :class="{ activo: this.like }"
        ></div>
        <p>Esta Recetas tiene {{ cantidadLikes }}</p>
    </div>
</template>

<script>
export default {
    props: ["idReceta", "like", "likes"],
    data: function() {
        return {
            totalLikes: this.likes
        };
    },
    mounted() {
        console.log(this.like);
    },
    methods: {
        likeReceta() {
            axios
                .post("/recetas/" + this.idReceta)
                .then(res => {
                    if (res.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    } else {
                        this.$data.totalLikes--;
                    }
                })
                .catch(error => {
                    if(error.response.status == 401){
                        window.location = '/register';
                    }
                });
        }
    },
    computed: {
        cantidadLikes: function() {
            return this.totalLikes;
        }
    }
};
</script>
