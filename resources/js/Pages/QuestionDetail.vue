<template>
    <Master>
        <div class="card mt-3">
            <div class="card-header">
                <span class="badge badge-sm bg-danger">Need Fixed?</span>
                <span class="ms-1">{{ q.title }}</span>
                <div class="float-end">
                    <span class="badge badge-sm bg-warning me-1">Fixed?</span>
                    <span class="badge badge-sm bg-dark">Delete</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>{{ q.description }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <i class="far fa-heart text-danger"></i>
                        <span>{{ q.like_count }}</span>
                        &nbsp; &nbsp;
                        <i class="far fa-comment text-success"></i>
                        <span></span>
                        &nbsp; &nbsp;
                        <i class="far fa-bookmark text-primary"></i>
                    </div>

                    <!-- category -->
                    <div class="col-md-7">
                        <Link
                            href=""
                            v-for="t in q.tag"
                            :key="t"
                            class="badge badge-sm bg-dark ml-1"
                            >{{ t.name }}</Link
                        >
                    </div>
                    <!-- end category -->

                    <!-- comment box -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form @submit.prevent="createComment(q.id)">
                                        <div class="form-group">
                                            <textarea
                                                class="form-control"
                                                placeholder="Enter Comment"
                                                v-model="comment"
                                            ></textarea>
                                            <button
                                                class="btn btn-sm btn-danger float-right mt-2"
                                            >
                                                Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div
                                class="card mt-1"
                                v-for="c in q.comment"
                                :key="c.id"
                            >
                                <div
                                    class="card-header d-flex bg-dark text-white"
                                >
                                    <img
                                        :src="c.user.image"
                                        width="40"
                                        class="rounded-circle shadow-4-strong me-2"
                                        alt=""
                                    />

                                    {{ c.user.name }}
                                    <p class="ms-1">{{ c.date }}</p>
                                </div>
                                <div class="card-body">
                                    <p>{{ c.comment }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from "./Layout/Master.vue";
import axios from "axios";
export default {
    props: { question: Object },
    name: "QuestionDetail",
    components: { Master },

    data() {
        return {
            q: "",
            comment: "",
        };
    },

    created() {
        this.q = this.question;
    },

    methods: {
        createComment(q_id) {
            var data = new FormData();
            data.append("question_id", q_id);
            data.append("comment", this.comment);
            axios.post("/question/comment/create", data).then((res) => {
                const { success, comment } = res.data;
                if (success) {
                    this.q.comment.push(comment);
                }
            });
        },
    },
};
</script>
