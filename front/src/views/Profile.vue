<template>
    <div class="container-fluid mt-5">
        <div class="card-group">
            <div class="card">
                <div class="p-4">
                    <img v-if="user" src="../assets/avatar.svg" class="card-img-top" alt="avatar">
                </div>
            </div>
            <div class="card">
                <div class="card-body" v-if="user">
                    <h5 class="card-title">{{ user.fullName }}</h5>
                    <p class="card-text">Email: {{ user.email }}</p>
                </div>
                <div class="card-body" v-if="!user">
                    <h5 class="card-title">User not found</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 v-if="id == null" class="card-title">It's me</h5>
<!--                    <div v-if="id == null" class="card-text">-->
<!--                        <router-link to="/lot">My lots</router-link>-->
<!--                    </div>-->
<!--                    <div v-if="id != null" class="card-text">-->
<!--                        <router-link to="/lot">User's lots</router-link>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        props: ["id"],
        data() {
            return {
                user: null,
                error: null
            };
        },
        created() {
            this.refresh();
        },
        beforeRouteUpdate() {
            this.refresh();
        },
        methods: {
            refresh() {
                const context = this;
                const query = context.id != null ? "?id=" + context.id : ""
                this.axios.get('/profile.php' + query)
                    .then((response) => {
                        context.user = response.data
                    })
                    .catch((error) => {
                        console.error(error)
                        context.error = error
                    })
            }
        }
    }
</script>

<style scoped>

</style>