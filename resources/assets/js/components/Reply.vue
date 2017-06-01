<script>
	import Favorite from './favorite'

	export default {
		props: ['attributes'],
		data () {
			return {
				editing: false,
				body: this.attributes.body
			}
		},
		components: {
			Favorite
		},
		methods: {
			update () {
				axios.patch('/replies/'+ this.attributes.id, { body: this.body }).then( response => {
					this.editing = false
					flash('Reply has been updated!')
				})
			},
			destroy () {
				axios.delete('/replies/'+ this.attributes.id)
				$(this.el).fadeOut(300, () => {
					flash('Reply has been deleted!')
				})
			}
		}
	}
</script>