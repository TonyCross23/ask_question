<template>
    <Master>
        <div v-for="(q, index) in questions.data" :key="q.id" class="card my-3">
            <div class="card-header">
                <!-- fixed -->
                <span
                    v-if="q.is_fixed == 'false'"
                    class="badge badge-sm bg-danger"
                    >Need Fixed?</span
                >
                <span v-else class="badge badge-sm bg-success">Fixed!</span>
                <span class="ms-1">{{ q.title }}</span>
                <div class="float-end">
                    <button
                        :hidden="q.is_fixed == 'true'"
                        v-show="isOwn(q.user_id)"
                        @click="setFixed(idex, q.id)"
                        class="badge badge-sm bg-warning me-1"
                    >
                        Fixed?
                    </button>
                    <a
                        href="#"
                        v-show="isOwn(q.user_id)"
                        @click="questionDelete(index, q.id)"
                        class="badge badge-sm bg-dark"
                        >Delete</a
                    >
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            {{ q.description }}
                        </p>
                    </div>
                </div>

                <div class="">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- like -->
                            <i
                                v-show="q.is_like !== 'true'"
                                @click="like(q.id, index)"
                                class="far fa-heart text-danger"
                            ></i>
                            <i
                                v-show="q.is_like == 'true'"
                                class="fas fa-heart text-danger"
                            ></i>
                            <span>{{ q.like_count }}</span>
                            &nbsp; &nbsp;
                            <!-- comment -->
                            <i class="far fa-comment text-success"></i>
                            <span>{{ q.comment.length }}</span>
                            &nbsp; &nbsp;
                            <!-- save -->
                            <i
                                v-show="!q.is_save"
                                @click="saveQuestion(index, q.id)"
                                class="far fa-bookmark text-primary"
                            ></i>
                            <i
                                v-show="q.is_save"
                                class="fas fa-bookmark text-primary"
                            ></i>
                        </div>

                        <!-- category -->
                        <div class="col-md-7">
                            <Link
                                v-for="t in q.tag"
                                :key="t.id"
                                class="badge badge-sm bg-dark ml-1"
                                >{{ t.name }}</Link
                            >
                        </div>
                        <!-- end category -->
                        <div class="col-md-2">
                            <Link
                                :href="route('question.detail', q.slug)"
                                class="badge badge-sm bg-dark float-end"
                                >view</Link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Pagination :links="questions.links" />
    </Master>
</template>

<script>
import Master from "./Layout/Master.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import Pagination from "./Components/Pagination.vue";
export default {
    name: "Home",

    components: {
        Master,
        Link,
        Pagination,
    },

    data() {
        return {
            questions: "",
        };
    },

    created() {
        this.questions = this.$page.props.questions;
    },

    methods: {
        like(q_id, index) {
            this.questions.data[index].is_like = "true";
            this.questions.data[index].like_count++;

            axios.get(`/question/like/${q_id}`).then((res) => {});
        },

        isOwn(user_id) {
            var auth_user_id = this.$page.props.auth_user.id;

            if (user_id == auth_user_id) {
                return true;
            }
            return false;
        },

        setFixed(index, q_id) {
            var data = new FormData();
            data.append("id", q_id);
            axios.post("/question/set/fix", data).then((res) => {
                if (res.data.success) {
                    this.questions.data[index].is_fixed = "true";
                }
            });
        },

        questionDelete(index, q_id) {
            axios.get(this.route("question.delete", q_id)).then((res) => {
                if (res.data.success) {
                    this.questions.data.splice(index, 1);
                }
            });
        },

        saveQuestion(index, q_id) {
            var data = new FormData();
            data.append("question_id", q_id);
            axios.post("/question/save", data).then((res) => {
                if (res.data.success) {
                    this.questions.data[index].is_save = true;
                }
            });
        },
    },
};
</script>
