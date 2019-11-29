<template>
    <div class="container">
        <div class="post-peripherals">
            <router-link v-bind:to="{ name: 'year', params: {year : this.$route.params.year} }" class="single-post-category">
                {{ this.$route.params.year }}
            </router-link>
            <span class="single-post-date">
                 {{ postcount }} article(s)
            </span>
        </div>
        <div class="full-list-post">
            <div class="minimal-post" v-for="gallery in posts" :key="gallery.id">
                <!-- TODO: Add category here -->
                <div class="minimal-avatar" v-bind:style="{ background: 'linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.9)), url(' + gallery.featured_image + ')', backgroundSize: 'cover' }">
                    <h3 class="minimal-title">
                        <router-link v-bind:to="{ name: 'dev', params: {id : gallery.slug} }">
                            {{ gallery.title }}
                        </router-link>
                    </h3>
                    <router-link v-bind:to="{ name: 'dev', params: {id : gallery.slug} }" class="minimal-btn">
                        Read more
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Posts from '../model/Posts'

    export default {

        data() {
            return {
                posts: []
            }
        },

        created(){
            Posts.postsByYear(this.$route.params.year).then( 
                ({data}) => this.posts = data
            )
        },

        computed:{
            postcount (){
                return this.posts.length;
            }
        }

    }
</script>
