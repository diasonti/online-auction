<template>
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col-2 p-3">
                <h2>Navigation</h2>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <router-link to="/lots/1" class="nav-link">Category 1</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/lots/2" class="nav-link">Category 2</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/lost/3" class="nav-link">Category 3</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/lots/4" class="nav-link">Category 4</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/lots/5" class="nav-link">Category 5</router-link>
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <div id="adCarousel" class="carousel slide p-3" data-ride="carousel" style="max-height: 600px;">
                    <ol class="carousel-indicators">
                        <li data-target="#adCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#adCarousel" data-slide-to="1"></li>
                        <li data-target="#adCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" style="max-height: 500px;">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://via.placeholder.com/600x200/777/555?text=First+Ad"
                                 alt="First Ad">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://via.placeholder.com/600x200/666/444?text=Second+Ad"
                                 alt="Second Ad">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://via.placeholder.com/600x200/555/333?text=Third+Ad"
                                 alt="Third Ad">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#adCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#adCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row border border-bottom-0 mt-3 p-3">
            <div class="col">
                <h2 style="text-align: center;">Featured lots</h2>
            </div>
        </div>
        <div class="row border border-top-0 p-3" id="featuredProducts">

            <!-- Six cards -->
            <!--            <div class="col-2" v-for="item in featuredLots">-->
            <div class="col" v-for="item in featuredLots">
                <router-link :to="'/lot/' + item.id" class="card">
                    <!--                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=First+Product"-->
                    <img class="card-img-top" :src="item.imageUrl"
                         :alt="item.title">
                    <div class="card-body">
                        <p class="card-text">{{ item.title }}</p>
                    </div>
                </router-link>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                featuredLots: []
            }
        },
        methods: {
            refreshFeaturedLots() {
                const context = this;
                this.axios.get("/lots.php?action=featured")
                    .then((response) => {
                        context.featuredLots = response.data
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
        created() {
            this.refreshFeaturedLots();
        }
    }
</script>

<style scoped>
    #featuredProducts .card-text {
        text-align: center;
    }

    #featuredProducts .card:hover {
        background-color: darkgrey;
        cursor: pointer;
    }
</style>