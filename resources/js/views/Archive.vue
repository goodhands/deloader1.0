<template>
    <div class="container">
        <div class="post-peripherals">
            <router-link class="single-post-category">
                Archive
            </router-link>
            <span class="single-post-date">
                 {{ postcount }} total article(s)
            </span>
        </div>
        <div class="full-list-post">
            <div class="minimal-post" v-for="gallery in posts.data" :key="gallery.id">
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
    const DEFAULT_TRANSITION = 'fade';

    export default {

        data() {
            return {
                posts: [],
                transitionName: DEFAULT_TRANSITION,
                prevHeight: 0,
            }
        },

        created(){
            Posts.all( 
                posts => this.posts = posts
            );

            //animation code
            this.$router.beforeEach((to, from, next) => {
              let transitionName = to.meta.transitionName || from.meta.transitionName;
        
              if (transitionName === 'slide') {
                const toDepth = to.path.split('/').length;
                const fromDepth = from.path.split('/').length;
                transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left';
              }
        
              this.transitionName = transitionName || DEFAULT_TRANSITION;
        
              next();
            });
        },

        computed:{
            postcount (){
                // return this.posts.data.length;
            }
        },

        methods: {
            beforeLeave(element) {
                this.prevHeight = getComputedStyle(element).height;
            },

            enter(element) {
                const { height } = getComputedStyle(element);

                element.style.height = this.prevHeight;

                setTimeout(() => {
                    element.style.height = height;
                });
            },

            afterEnter(element) {
                element.style.height = 'auto';
            },
        },

    }
</script>
