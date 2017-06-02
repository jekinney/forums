<template>
    <section class="panel panel-default">
    	<div v-if="auth" class="panel-body">
        	<div class="form-group">
                <textarea v-model="body" class="form-control" placeholder="Have something to add?" rows="5"></textarea>
            </div>

            <div class="form-group text-right">
                <button type="submit" @click="addReply" class="btn btn-primary">Add Reply</button>
            </div>

            </form>
        </div>
        <div v-else class="panel-body text-center">
        	<p>Please <a href="/login">Sign In</a> to participate in this discussion.</p>
        </div>
	</section>
</template>


<script>
	export default {
		data () {
			return {
				body: ''
			}
		},

		computed: {
			auth () {
				return window.auth
			}
		},

		methods: {
			addReply () {
				axios.post(location.pathname + '/replies', { body: this.body }).then( ({data}) => {
					this.body = ''
					flash('New Reply has been saved!')
					this.$emit('created', data)
				})
			}
		}
	}
</script>