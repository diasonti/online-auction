<template>
    <div class="container-fluid mt-5">
        <div class="card-group">
            <div class="card categories">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="/lots" class="nav-link">Everything</a>
                        </li>
                        <li class="nav-item">
                            <a href="/lots/books" class="nav-link">Books</a>
                        </li>
                        <li class="nav-item">
                            <a href="/lots/gifts" class="nav-link">Gifts</a>
                        </li>
                        <li class="nav-item">
                            <a href="/lots/toys" class="nav-link">Toys</a>
                        </li>
                        <li class="nav-item">
                            <a href="/lots/clothing" class="nav-link">Clothing</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 v-if="category" class="card-title filter">Browsing {{ category }}</h5>
                    <h5 v-if="!category" class="card-title filter">No filter applied</h5>
                    <hr />
                    <div class="card-text list">
                        <router-link tag="div" :to="'/lot/' + lot.id" class="card-group mb-2 lot" v-for="lot in lots">
                            <div class="card p-2 text-center">
                                <img :src="lot.imageUrl" :alt="lot.title">
                            </div>
                            <div class="card">
                                <h6 class="card-title p-2">{{ lot.title }}</h6>
                            </div>
                            <div class="card">
                                <h6 class="card-title p-2 text-center">{{ lot.status }}</h6>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LotList",
        props: ["category"],
        data() {
            return {
                lots: [],
                error: null
            }
        },
        created() {
            this.confirmToken();
            this.refresh();
        },
        beforeRouteUpdate() {
            this.confirmToken();
            this.refresh();
        },
        methods: {
            refresh() {
                const context = this;
                this.lots = []
                const query = this.category != null ? "&category=" + this.category : ""
                this.axios.get('/lots.php?action=list' + query)
                    .then((response) => {
                        context.lots = response.data
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
    .categories {
        max-width: 250px;
    }
    .list {

    }
    .lot .card{
        cursor: pointer;
    }
    .lot img {
        height: 100px;
        width: 160px;
    }
</style>