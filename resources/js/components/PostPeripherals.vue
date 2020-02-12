<template>
    <div class="post-peripherals">
        <router-link v-bind:to="{ name: 'category', params: {id : dev.category.slug} }" class="single-post-category">
            {{dev.category.title}}
        </router-link>
        <span class="single-post-date">
            <!-- TODO: Install momentjs to display date properly -->
            {{dev.created_at}}
        </span>
        <span class="single-post-date">
            3 min read
        </span>
        <span class="post-controls">
            <i class="fa fa-play"></i>
        </span>
    </div>
</template>

<script>
    export default {

        mounted() {
            console.log("mounted")
        }

    }
</script>