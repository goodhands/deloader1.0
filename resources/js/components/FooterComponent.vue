<template>
    <footer>
        <div class="container">
            <nav class="level">
                <div class="level-item">
                    <div>
                        <p class="heading">categories</p>
                        <ul class="list-style">
                            <li><a href="#">vue js</a></li>
                            <li><a href="#">laravel</a></li>
                            <li><a href="#">node js</a></li>
                        </ul>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <p class="heading">archive</p>
                        <ul class="list-style">
                            <li v-for="archive in this.links.archives" :key="archive.id">
                                <router-link v-bind:to="{ name: 'year', params: {year : archive.year} }">
                                    {{ archive.year }}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <p class="heading">categories</p>
                        <ul class="list-style">
                            <li><a href="#">laravel</a></li>
                            <li><a href="#">laravel</a></li>
                            <li><a href="#">laravel</a></li>
                        </ul>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <p class="heading">social</p>
                        <ul class="list-style">
                            <li><a href="#">twitter</a></li>
                            <li><a href="#">medium</a></li>
                            <li><a href="#">github</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <section class="has-text-centered">
            Built with 🍸 by Samuel Olaegbe
            <p>
                &copy; Copyright 2019. Devloader
            </p>
        </section>
    </footer>
</template>

<script>

    import Posts from '../model/Posts'
    import Category from '../model/Category'
    export default {

        data() {
            return {
                links:{
                    archives: [],
                    categories: [],
                }
            }
        },

        mounted() {
            console.log("mounted")
        },

        created(){
            Posts.years(years => this.links.archives = years)
            // Category.bestThree(three => this.links.categories = three)
        },

    }
</script>