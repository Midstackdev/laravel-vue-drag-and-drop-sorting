<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editing <em>{{ title }}</em></div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" v-if="message">
                            {{ message }}
                        </div>

                        <form action="#" @submit.prevent="submit">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': errors.title }" id="title" v-model="title">

                                <div class="invalid-feedback" v-if="errors.title">
                                    {{ errors.title[0] }}
                                </div>
                            </div>
                            
                            <draggable :list="parts" :options="{'handle': '.card-header'}" @start="drag=true" @end="drag=false" @change="update">  
                                <div class="card mb-2" v-for="(part, index) in parts">
                                    <div class="card-header">Part {{ index + 1 }} ({{ part.sort_order}})</div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Part title</label>
                                            <input type="text" class="form-control" v-model="part.title" 
                                            :class="{ 'is-invalid': errors['parts.' + index + '.title'] }">

                                            <div class="invalid-feedback" v-if="errors['parts.' + index + '.title']">
                                                {{ errors['parts.' + index + '.title'][0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </draggable>

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
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },

        props: [
            'data'
        ],

        data () {
            return {
                title: null,
                parts: [],
                errors: [],
                message: null
            }
        },

        methods: {
            submit () {
                axios.patch(`/series/${this.data.id}`, {
                    title: this.title,
                    parts: this.parts
                })
                .then((response) => {
                    this.message = 'Series saved.'
                })
                .catch((e) => {
                    console.log(e.response.data)
                    this.errors = e.response.data.errors
                    console.log(this.errors)
                })
            },

            update (e) {
                this.parts.map((parts, index) => {
                    parts.sort_order = index + 1
                })
            }
        },

        mounted() {
            this.title = this.data.title
            this.parts = this.data.parts
        }
    }
</script>
