<template>
    <div>
        <div class="menu">
            <button class="btn btn-transparent" @click="showNav = !showNav">
                <span :style="{backgroundColor: showNav?'white':'black'}" class="caret-line top"></span>
                <span :style="{backgroundColor: showNav?'white':'black'}" class="caret-line bottom"></span>
            </button>
        </div>

        <transition name="fade" mode="out-in" @after-enter="showMenuLinks = true">
            <div class="menu-body" v-if="showNav">
                <transition name="fade" mode="out-in">
                    <ul v-show="showMenuLinks" class="list-style menu-items">
                        <li><a href="home">Home</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                </transition>
                <p class="menu-intro menu-intro has-text-left">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis alias sapiente nisi itaque saepe Omnis alias sapiente nisi itaque saepe 
                </p>
                <hr>
                <ul class="list-style menu-items">
                    <li><a href="home">NodeJs</a></li>
                    <li><a href="about">Laravel</a></li>
                    <li><a href="contact">VueJs</a></li>
                    <li><a href="contact">VueJs</a></li>
                    <li><a href="contact">VueJs</a></li>
                    <li><a href="contact">VueJs</a></li>
                </ul>
            </div>
        </transition>

        <router-view></router-view>
        <subscribe-component></subscribe-component>
        <footer-component></footer-component>
    </div>
</template>

<style scoped>
/* * {
  will-change: height;
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
} */
</style>
<script>
    import FooterComponent from '../components/FooterComponent';
    import SubscribeComponent from '../components/SubscribeComponent';

    export default {
        components: {
            FooterComponent,
            SubscribeComponent
        },

        data() {
            return {
                showNav: false,
                showMenuLinks: false
            }
        },

        computed: {
            whiteMenuButtons(){
                window.focus = function(){
                    this.showNav = false;
                }
            }
        },
    }
</script>