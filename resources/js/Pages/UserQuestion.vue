<template>
    <Master>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div
                        class="card my-1"
                        v-for="(q, index) in questions.data"
                        :key="index"
                    >
                        <div class="card-body">
                            <Link
                                :href="route('question.detail', q.slug)"
                                class="text-dark"
                                >{{ q.title }}</Link
                            >
                            <i
                                class="fas fa-trash-can text-danger float-end"
                                @click="questionDelete(index, q.id)"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Pagination :links="questions.links" />
    </Master>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Master from "./Layout/Master.vue";
import axios from "axios";
import Pagination from "./Components/Pagination.vue";
export default {
    name: "UerQuestion",

    components: { Link, Master, Pagination },

    data() {
        return {
            questions: [],
        };
    },

    created() {
        this.questions = this.$page.props.questions;
    },

    methods: {
        questionDelete(index, q_id) {
            axios.get(this.route("question.delete", q_id)).then((res) => {
                if (res.data.success) {
                    this.questions.data.splice(index, 1);
                }
            });
        },
    },
};
</script>
