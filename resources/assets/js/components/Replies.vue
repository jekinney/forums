<template>
	<div>
		<div v-for="(reply, value) in items" :key="reply.id">
			<reply :data="reply" @deleted="remove(value)"></reply>
		</div>
		
		<paginator :dataSet="dataSet" @changed="fetch"></paginator>

		<new-reply @created="add"></new-reply>

	</div>
</template>

<script>
	import Reply from './Reply.vue'
	import NewReply from '../components/NewReply.vue'
	import collection from '../mixins/Collections'

	export default {

		data () {
			return {
				items: [],
				dataSet: false
			}
		},

		created () {
			this.fetch()
		},

		mixins: [collection],

		components: {
			Reply,
			NewReply
		},

		methods: {
			fetch (page) {
				axios.get(this.url(page)).then(this.refresh)
			},
			url (page) {
				if(!page) {
					let query = location.search.match(/page=(\d+)/)

					page = query? query[1]:1
				}
				return location.pathname + '/replies?page=' + page
			},
			refresh ({data}) {
				this.dataSet = data
				this.items = data.data
			},
		}
	}
</script>