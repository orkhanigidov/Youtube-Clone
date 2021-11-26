<template>
    <div>
        <img @click="vote('up')" class="thumbs-up" :class="{ 'thumbs-up-active': upvoted }" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAA7UlEQVRIie3UvS4GQRTG8d8iolfp3IJK5QJoNBIqiUKhcQuiU7oGicYVvK1WoxeVl4ieQohVOG8y2az9yO4kCk9ycs6cOfN/ipkMf1R7uMR8DvguPlDiMCe8xHku+Gvko7HgOwn8BHdRr40NP8MyvvCGhaHw7QR+Gr2tWF8PhcO0Ahd12RJTbKagtgOpJh3mSzxAkRg0qWjZr2rGK6qXVAW1GbdqbiigRuuRn3IZHEe+SJt1l9nU/00reMcnVnMYzJ7wVVdQH4NFPMf8Rg6D/Zi9rdscw+AmZg+aDIbGC5b6GNxHdIE/+vkI/9VP35vGgg6LTb6OAAAAAElFTkSuQmCC"/>
        {{ upvotes_count }}
        <img @click="vote('down')" class="thumbs-down" :class="{ 'thumbs-down-active': downvoted }" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAA60lEQVRIid3Ur05DMRTH8Q9/QvAoHM+AwfECExiSYTAkQHgLcEheAsUTICencQvuQhY8CAJhiB2SMnahl7Rmv+SX3vac0+9pml4WRZMW34fb4qkf0esK6OonrP8GyF2fp2HkHtUCHEbuXS3AGsaRv1sDAOeRf1MLsIlXvGMLljsU52hs2v0KTtNAqRPATtQ81AJ8q1udEyiq/9zBrb9fNDQpYKnFTcQvEsAwo4kGJznd7uEtuvqC9GI+yNkgR/sJ5BIb+MCLn3dYDDKK7+1SAOgnkOcYz0oCZiETXJUGzEKOawDgANem/5wF1yccZHp+5sBdFwAAAABJRU5ErkJggg=="/>
        {{ downvotes_count }}
    </div>
</template>

<script>
import numeral from 'numeral';

export default {
    props: {
        default_votes: {
            required: true,
            default: () => []
        },
        entity_owner: {
            required: true,
            default: ''
        },
        entity_id: {
            required: true,
            default: ''
        }
    },
    data() {
        return {
            votes: this.default_votes
        }
    },
    computed: {
        upvotes() {
            return this.votes.filter(v => v.type === 'up');
        },
        downvotes() {
            return this.votes.filter(v => v.type === 'down');
        },
        upvotes_count() {
            return numeral(this.upvotes.length).format('0a');
        },
        downvotes_count() {
            return numeral(this.downvotes.length).format('0a');
        },
        upvoted() {
            if (!__auth()) {
                return false;
            }
            return !!this.upvotes.find(v => v.user_id === __auth().id);
        },
        downvoted() {
            if (!__auth()) {
                return false;
            }
            return !!this.downvotes.find(v => v.user_id === __auth().id);
        }
    },
    methods: {
        vote(type) {
            if (!__auth()) {
                return alert('Please login to vote.');
            }
            if (__auth().id === this.entity_owner) {
                return alert('You cannot vote this item.');
            }
            if (type === 'up' && this.upvoted) {
                return;
            }
            if (type === 'down' && this.downvoted) {
                return;
            }

            axios.post(`/votes/${this.entity_id}/${type}`)
            .then(({data}) => {
                if (this.upvoted || this.downvoted) {
                    this.votes = this.votes.map(v => {
                        if (v.user_id === __auth().id) {
                            return data;
                        }
                        return v;
                    });
                } else {
                    this.votes = [
                        ...this.votes,
                        data
                    ];
                }
            });
        }
    }
}
</script>
