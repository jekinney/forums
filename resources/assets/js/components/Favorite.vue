<template>
	<button type="button" @click="toggle" :class="classes" class="btn">
		<span class="glyphicon glyphicon-heart"></span>
		<span v-text="count"></span>
	</button>
</template>

<script>
	export default {
		props: ['reply'],
		data () {
			return {
				count: this.reply.favoritesCount,
				active: this.reply.isFavorited
			}
		},
		computed: {
			classes () {
				return ['btn', this.active ? 'btn-primary':'btn-default']
			}
		},
		methods: {
			toggle () {
				return this.active ? this.destroy():this.create()
			},
			destroy () {
				axios.delete('/replies/' + this.reply.id +'/favorites')
				this.count--
				this.active = false
				flash('Reply has been unfavorited')
			},
			create () {
				axios.post('/replies/' + this.reply.id +'/favorites')
				this.count++
				this.active = true
				flash('Reply has been favorited')
			}
		}
	}
</script>