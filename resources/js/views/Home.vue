<template>
<transition :name="transitionName" mode="out-in" @beforeLeave="beforeLeave" @enter="enter">
    <div class="container">
        <div class="grid-area-x2">
            <article class="dev-story" v-for="post in posts.featured" :key="post.id">
                <div class="dev-category">                    
                    <router-link v-bind:to="{ name: 'category', params: {id : post.category.slug} }" class="category-slug">
                        {{ post.category.title }}
                    </router-link>
                </div>
                <div class="dev-billboard">
                    <div class="dev-article-avatar" v-bind:style="{ background: 'linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.9)), url(' + post.featured_image + ')', backgroundSize: 'cover' }">
                        <h2 class="dev-article-title">
                            <router-link v-bind:to="{ name: 'dev', params: {id : post.slug} }">
                                {{ post.title }}
                            </router-link>
                        </h2>
                    </div>
                    <div class="dev-article-meta">
                        <div class="dev-meta-sm">
                            <a href="http://facebook.com" target="_blank">
                                <i class="sm-icon fab fa-facebook-square"></i>
                            </a>
                            &nbsp;&nbsp;
                            <a :href="socialShare(post, 'twitter')" target="_blank">
                                <i class="sm-icon fab fa-twitter-square"></i>
                            </a>
                            &nbsp;&nbsp;
                            <a href="http://facebook.com" target="_blank">
                                <i class="sm-icon fab fa-facebook-square"></i>
                            </a>
                            &nbsp;&nbsp;
                            <a href="https://twitter.com/home?status=Check%20out%20this%20post%20by%20@devloader%20" target="_blank">
                                <i class="sm-icon fab fa-twitter-square"></i>
                            </a>
                        </div>
                        <div class="dev-meta-tags">
                            <!-- <a href="#">Must Read</a> -->
                        </div>
                        <div class="dev-meta-duration">
                            {{ post.content | readTime }}
                        </div>
                        <div class="dev-meta-date">
                            <div class="dev-date-n-time">
                                <span class="dnt">{{ post.created_at | ago }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <!-- END TOP GRID AREA -->

        <!-- START PAGE DIVIDER -->
        <div class="line"></div>
        <div class="block">
            <div class="subscribe">Top of the Stack</div>
        </div>
        <!-- END PAGE DIVIDER -->

        <!-- BEGIN MINIMAL POST SLIDE -->
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
        <!-- END MINIMAL POST SLIDE -->

        <!-- START YELLOW TWIN -->
        <div class="grid-area-twin --section">
            <article class="dev-twin" v-for="quote in posts.quotes" :key="quote.id">
                <div class="twin-avatar" v-bind:style="{ backgroundImage: 'url(' + quote.featured_image + ')' }">
                </div>
                <div class="twin-meta">
                    <router-link v-bind:to="{ name: 'category', params: {id : quote.category.slug} }" class="twin-meta-cat">
                        {{quote.category.title}}
                    </router-link>
                    <h2 class="twin-title">
                        <router-link v-bind:to="{ name: 'dev', params: {id : quote.slug} }">
                            {{quote.title}}
                        </router-link>
                    </h2>
                    <p class="twin-meta-excerpt">
                        {{quote.excerpt}}
                    </p>
                    <br>
                    <strong>Written on </strong><span>{{ quote.created_at | ago }}</span>
                </div>
            </article>
        </div>
        <!-- END YELLOW TWIN -->

        <!-- START MULTIPLE GRID -->
        <div class="grid-area-multiple --section">
            <article class="listed" v-for="aside in posts.notable" :key="aside.id">
                <router-link v-bind:to="{ name: 'category', params: {id : aside.category.slug} }" class="article-m-cat">
                    {{aside.category.title}}
                </router-link>
                <h2>
                    <router-link v-bind:to="{ name: 'dev', params: {id : aside.slug} }" class="article-m-title">
                        {{aside.title}}
                    </router-link>
                </h2>
            </article>
        </div>
        <!-- END MULTIPLE GRID -->
    </div>
</transition>
</template>
<script>
    // :TODO: Install momemnt globally
    import Posts from '../model/Posts'
    import moment from 'moment'

    const DEFAULT_TRANSITION = 'fade';
    
    export default {

        data() {
            return {
                posts: {
                    featured: [],
                    gallery_recent: [],
                    quotes: [],
                    notable:[]
                },

                social: {
                    twitter_url: "https://twitter.com/intent/tweet?text=",
                },

                transitionName: DEFAULT_TRANSITION,
                prevHeight: 0,
            }
        },

        created() {
            Posts.featured( posts => this.posts.featured = posts );

            Posts.gallery( posts => this.posts.gallery_recent = posts );
            
            Posts.quotes( posts => this.posts.quotes = posts );

            Posts.notable( posts => this.posts.notable = posts );

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

        methods: {
            socialShare(post, type){
                
                var url;

                switch (type) {
                    case 'twitter':
                        url = this.social.twitter_url+encodeURIComponent('Check out this post by @devloader\r "'+post.title+'" '+document.location.origin+'/dev/'+post.slug);                        
                        break;
                
                    default:
                        break;
                }

                return url;
            },

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
    
        filters: {
            ago(date){
                return moment(date).format("MMM Do YYYY");
            },
        }

    }
</script>