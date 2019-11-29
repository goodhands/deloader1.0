<template>
<div>
    <div class="container" v-for="dev in post" :key="dev.id">
        <div class="single-post-meta">
            <div class="post-peripherals">
                <router-link v-bind:to="{ name: 'category', params: {id : dev.category.slug} }" class="single-post-category">
                    {{dev.category.title}}
                </router-link>

                <div class="post-controls">
                    <!--TODO: Add text-to-speech <i class="fa fa-play"></i> -->
                    <span class="single-post-date" title="On this page">
                       Content <i class="fas fa-book"></i>
                    </span>
                    <span class="single-post-date" :title="dev.created_at" v-desktoponly>
                       <i class="far fa-calendar-alt"></i> {{dev.created_at | ago}}
                    </span>
                    <span class="single-post-date" v-desktoponly :title="dev.content | readTime">
                       <i class="fas fa-bolt"></i> {{ dev.content | readTime }}
                    </span>
                </div>
            </div>
            <!-- <post-peripherals></post-peripherals> -->
            <h3 class="single-post-title">{{dev.title}}</h3>
            <span class="single-post-date has-text-grey-light" :title="dev.created_at">
                <i class="far fa-calendar-alt"></i> {{dev.created_at | ago}}
            </span>
            <span class="single-post-date has-text-grey-light">
                <i class="fas fa-bolt"></i> {{ dev.content | readTime }}
            </span>
            <author-componenet v-desktoponly></author-componenet>
        </div>
        <header class="single-header">
            <img :src="dev.featured_image"/>
        </header>
        <div class="share-btns-box" v-mobileonly>
             <h3 class="title">Share</h3>
             <social-sharing :url="base_url+'/dev/'+dev.slug"
                      :title="dev.title"
                      :description="dev.content | str_limit"
                      :quote="dev.content | str_limit"
                      :hashtags="dev.category.title"
                      twitter-user="devloader"
                      inline-template>
                    <div class="footer-social">
                        <network network="email" class="social-em">
                            <i class="fa fa-envelope"></i>
                        </network>
                        <network network="facebook" class="social-fb">
                            <i class="fab fa-facebook-f"></i>
                        </network>
                        <network network="linkedin" class="social-lnkd">
                            <i class="fab fa-linkedin-in"></i>
                        </network>
                        <network network="reddit" class="social-reddit">
                            <i class="fab fa-reddit-alien"></i>
                        </network>
                        <network network="telegram" class="social-tgm">
                            <i class="fab fa-telegram-plane"></i>
                        </network>
                        <network network="twitter" class="social-twtr">
                            <i class="fab fa-twitter"></i>
                        </network>
                        <network network="whatsapp" class="social-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </network>
                    </div>
                </social-sharing>
         </div>
        <div class="single-post-arraign">
            <div class="page-content" v-desktoponly>
                <h3>
                    On this page
                </h3>
                <ul>
                    <li v-for="anchor in anchortags" :key="anchor">
                        <a v-bind="href={anchor}" class="anchor">
                            {{ "#"+anchor }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="post-content" v-html="dev.content" @click="createAnchor(dev.content)">
            </div>
            <div class="page-content has-text-centered" v-desktoponly>
                <p>
                    Share
                </p>
                <social-sharing :url="base_url+'/dev/'+dev.slug"
                      :title="dev.title"
                      :description="dev.content"
                      quote="Vue is a progressive framework for building user interfaces."
                      :hashtags="dev.category.title"
                      twitter-user="devloader"
                      inline-template>
                    <div class="share-social">
                        <network network="facebook" class="social-fb">
                            <i class="fab fa-facebook-f"></i>
                        </network>
                        <network network="linkedin" class="social-lnkd">
                            <i class="fab fa-linkedin-in"></i>
                        </network>
                        <network network="twitter" class="social-twtr">
                            <i class="fab fa-twitter"></i>
                        </network>
                        <network network="whatsapp" class="social-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </network>
                    </div>
                </social-sharing>
            </div>
        </div>
         <author-componenet></author-componenet>
         <!-- TODO: Work on recommended post in later release <recommended-component></recommended-component> -->
         <div class="share-btns-box" v-mobileonly>
             <h3 class="title">Share</h3>
             <social-sharing :url="base_url+'/dev/'+dev.slug"
                      :title="dev.title"
                      :description="dev.content | str_limit"
                      :quote="dev.content | str_limit"
                      :hashtags="dev.category.title"
                      twitter-user="devloader"
                      inline-template>
                    <div class="footer-social">
                        <network network="email" class="social-em">
                            <i class="fa fa-envelope"></i>
                        </network>
                        <network network="facebook" class="social-fb">
                            <i class="fab fa-facebook-f"></i>
                        </network>
                        <network network="linkedin" class="social-lnkd">
                            <i class="fab fa-linkedin-in"></i>
                        </network>
                        <network network="reddit" class="social-reddit">
                            <i class="fab fa-reddit-alien"></i>
                        </network>
                        <network network="telegram" class="social-tgm">
                            <i class="fab fa-telegram-plane"></i>
                        </network>
                        <network network="twitter" class="social-twtr">
                            <i class="fab fa-twitter"></i>
                        </network>
                        <network network="whatsapp" class="social-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </network>
                    </div>
                </social-sharing>
         </div>
    </div>
</div>
</template>

<script>
    import moment from 'moment';
    import Posts from '../model/Posts';
    import AuthorComponenet from '../components/AuthorComponent';
    import PostPeripherals from '../components/PostPeripherals';
    // import Helpers from '../core/Helpers';
    //TODO: import RecommendedComponent from '../components/RecommendedComponent';

    export default {
        components:{
            AuthorComponenet,
            PostPeripherals,
            //TODO: RecommendedComponent
        },

        data() {
            return {
                post: [],
                anchortags: [],
                base_url: document.location.origin
            }
        },

        created() {
            Posts.find(this.$route.params.id).then( 
                ({data}) => this.post = data
            )
        },

        methods: {
            createAnchor: function (content){

                var vm = this;

                let div = document.createElement('div');
                
                div.innerHTML = content;

                console.log(content.getElementsByTagName("a"));
                
                let anchors = div.getElementsByTagName("a");

                for (let index = 0; index < anchors.length; index++) {
                    if(anchors[index].hash){
                        // console.log(ids);
                        vm.anchortags.push(anchors[index].hash);
                    }
                }
            }
        },

        filters:    {

            ago(date){
                return window.screen.width <= 500 ? moment(date).format("MM/DD/YY, h:mma") : moment(date).format("MMM Do YYYY, h:mma");
            },

            str_limit(string){
                return string.length <= 50 ? string : string[50];
            }

        }
        

    }
</script>
