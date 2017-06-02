<script>
	import Replies from '../components/Replies.vue'

	export default {
		props: ['count'],

		data () {
			return {
				repliesCount: this.count
			}
		},

		components: {
			Replies
		},
	}
</script>