<template>
   <section :id="'reply-'+data.id" class="panel panel-default">
                            
        <header class="panel-heading">
            <div class="level">

                <h5 class="flex">
                    <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name"></a> replied
                    <span v-text="ago"></span>
                </h5>
                
                <favorite v-if="auth" :reply="data"></favorite>
                
            </div>
        </header>

        <article class="panel-body">
            <div v-if="editing">
                <textarea v-model="body" class="form-control"></textarea>
            </div>
            <div v-else v-html="body"></div>
        </article>
        
        <footer v-if="canUpdate" class="panel-footer">
            <div v-if="editing" class="level">
                <button type="button" @click="editing = false" class="btn btn-xs btn-default mr-1">Cancel</button>
                <button class="btn btn-xs btn-primary" @click="update">Save</button>
            </div>
            <div v-else class="level">
                <button type="button" @click="editing = true" class="btn btn-xs btn-info mr-1">Edit</button>
                <button type="button" @click="destroy" class="btn btn-xs btn-danger">Delete</button>
            </div>
        </footer>

    </section>
</template>

<script>
	import Favorite from './favorite'
	import moment from 'moment'


	export default {
		props: ['data'],
		data () {
			return {
				editing: false,
				body: this.data.body
			}
		},
		components: {
			Favorite
		},
		computed: {
			auth () {
				return window.auth
			},
			canUpdate () {
				return this.authorize(user => this.data.user_id == user.id)
			},
			ago () {
				return moment(this.data.created_at).fromNow()
			}
		},
		methods: {
			update () {
				axios.patch('/replies/'+ this.data.id, { body: this.body }).then( response => {
					this.editing = false
					flash('Reply has been updated!')
				})
			},
			destroy () {
				axios.delete('/replies/'+ this.data.id).then( () => {
					flash('Reply has been removed!')
					this.$emit('deleted')
				})
				
			}
		}
	}
</script>