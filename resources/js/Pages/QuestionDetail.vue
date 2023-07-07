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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-1" v-for="c in q.comment" :key="c.id">
                        <div class="card-header bg-dark">
                            <div class="d-flex text-white">
                                <img
                                    :src="c.user.image"
                                    width="40"
                                    class="rounded-circle shadow-4-strong"
                                    alt=""
                                />
                                <div class="">
                                    <p class="ms-2 mb-0">{{ c.user.name }}</p>
                                    <small class="ms-2 mt-0">{{
                                        c.date
                                    }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <small>{{ c.comment }}</small>
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
export default {
    props: { question: Object },
    name: "QuestionDetail",
    components: { Master },

    data() {
        return {
            q: "",
        };
    },

    created() {
        this.q = this.question;
    },
};
</script>
