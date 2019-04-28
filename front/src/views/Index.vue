<template>
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col-2 p-3">
                <h2>Navigation</h2>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item 4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item 5</a>
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
                <h2 style="text-align: center;">Recommended deals</h2>
            </div>
        </div>
        <div class="row border border-top-0 p-3" id="featuredProducts">
            <div class="col-2">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=First+Product"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">First product</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=Second+Product"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Second product</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=Third+Product"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Third product</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=Fourth+Product"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Fourth product</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=Fifth+Product"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Fifth product</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/500x500/777/555?text=Sixth+Product"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">Sixth product</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index"
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