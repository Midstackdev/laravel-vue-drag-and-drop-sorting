<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editing <em>{{ title }}</em></div>

                    <div class="card-body">
                        <form action="#" @submit.prevent="update">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" v-model="title">
                            </div>

                            <div class="card mb-2" v-for="(part, index) in parts">
                                <div class="card-header">Part {{ index + 1 }}</div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Part title</label>
                                        <input type="text" class="form-control" v-model="part.title">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'data'
        ],

        data () {
            return {
                title: null,
                parts: []
            }
        },

        methods: {
            update () {

            }
        },

        mounted() {
            this.title = this.data.title
            this.parts = this.data.parts
        }
    }
</script>
