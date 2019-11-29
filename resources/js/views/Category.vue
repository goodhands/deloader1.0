<template>
    <div class="container">
        <div class="post-peripherals">
            <router-link v-bind:to="{ name: 'category', params: {id : posts[0].slug} }" class="single-post-category">
                {{posts[0].title}}
            </router-link>
            <span class="single-post-date">
                {{ postcount }} article(s)
            </span>
        </div>
        <div class="full-list-post" v-for="gallery in posts" :key="gallery.id">
            <div class="minimal-post" v-for="cat_post in gallery.post" :key="cat_post.id">
                <div class="minimal-avatar" v-bind:style="{ background: 'linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.9)), url(' + cat_post.featured_image + ')', backgroundSize: 'cover' }">
                    <h3 class="minimal-title">
                        <router-link v-bind:to="{ name: 'dev', params: {id : cat_post.slug} }">
                            {{ cat_post.title }}
                        </router-link>
                    </h3>
                    <router-link v-bind:to="{ name: 'dev', params: {id : cat_post.slug} }" class="minimal-btn">
                        Read more
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Category from '../model/Category'

    export default {

        data() {
            return {
                posts: []
            }
        },

        created(){
            Category.post(this.$route.params.id).then( 
                ({data}) => this.posts = data
            )

        },

        computed: {
            postcount(){
                return this.posts[0].post.length;
            }
        },

    }
</script>
