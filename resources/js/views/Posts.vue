<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">A single post</div>

                    <div class="card-body">
                        Post id {{$route.params.id}}
                        <br>
                        Query {{$route.query}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Single post mounted.')
        }
    }
</script>
