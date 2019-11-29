<template>
    <div>
        <div class="line"></div>
        <div class="block">
            <div class="subscribe">Subscribe</div>
        </div>
        <!-- END PAGE DIVIDER -->
        <form @submit.prevent="onSubmit" @keydown="form.errors.clear()">    
            <div class="subscribe-box">
                <div class="control">
                    <input class="input" @keydown="clearDefault()" v-model="form.firstname" type="text" placeholder="First name">
                        <span class="spacing-line"></span>
                    <input class="input" v-model="form.lastname" type="text" placeholder="Last name">
                        <span class="spacing-line"></span>
                    <input class="input" v-model="form.email" type="email" placeholder="Email Address">
                </div>
                <button class="submit-newsletter" :disabled="form.errors.any()">I CAN'T WAIT TO GET THOSE VLOGS! 😋</button>
                <div class="success message">
                    {{ error.errors }}
                </div>
            </div>
        </form>
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
