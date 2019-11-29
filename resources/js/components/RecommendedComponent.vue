<template>
    <div>
        <div class="line"></div>
        <div class="block">
            <div class="subscribe">Recommended</div>
        </div>
        <!-- END PAGE DIVIDER -->
        <div class="dev-slider-posts --section">
            <div class="minimal-post" v-for="gallery in posts.gallery_recent" :key="gallery.id">
                <div class="minimal-cat">
                    <router-link v-bind:to="{ name: 'category', params: {id : gallery.category.slug} }">
                        {{ gallery.category.title }}
                    </router-link>
                </div>
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
            <div class="slide-control" v-if="posts.gallery_recent.length > 3">
                <a href="#">
                    <span class="fas fa-angle-right"></span>
                </a>
            </div>
        </div>
        <!-- END SUBSCRIBE BOX-->    
    </div>
</template>

<script>
    export default {
        data(){

            return{
                form: new Form({ 
                    firstname : 'Firstname',
                    lastname: 'Lastname',
                    email: 'Email' 
                }),

                error: [],
            };
        },

        methods: {
            onSubmit() {
                this.form
                .post('/subscribe')
                .then(status => this.$emit('completed', status))
                .catch(errors => this.error = errors)
            },

            clearDefault(){
                this.form.firstname == "" ? this.form.firstname == "Firstname": this.form.firstname;
                // this.form.firstname == "" ? this.form.firstname == "Firstname": this.form.firstname;
            }
        },
    }
</script>

<style>

</style>
