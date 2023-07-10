<template>
    <Master>
        <div class="container">
            <div class="card" v-for="(q, index) in questions" :key="index">
                <div class="card-body">
                    <Link :href="route('question.detail', q.question.title)">{{
                        q.question.slug
                    }}</Link>
                </div>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from "./Layout/Master.vue";

export default {
    name: "SaveQuestion",

    components: {
        Master,
    },

    data() {
        return {
            questions: [],
        };
    },

    created() {
        this.questions = this.$page.props.questions;
    },
};
</script>
