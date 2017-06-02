export default {
	data () {
		return {
			items: []
		}
	},
	methods: {
		add (item) {
			this.items.push(item)
		},
		remove (item) {
			this.items.splice(item, 1)
			this.$emit('removed');
		}
	}
}