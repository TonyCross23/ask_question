<template>
    <Master>
        <div class="col-md-8">
            <div class="card my-3">
                <div class="card-header">
                    <span class="badge badge-sm bg-danger">Fixed</span>
                    <div class="float-end">
                        <span class="badge badge-sm bg-warning me-1"
                            >Fixed?</span
                        >
                        <span class="badge badge-sm bg-dark">Delete</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                It is a long established fact that a reader will
                                be distracted by the readable content of a page
                                when looking at its layout. The point of using
                                Lorem Ipsum is that it has a more-or-less normal
                                distribution of letters, as opposed to using
                                'Content here, content here', making it look
                                like readable English.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <i class="far fa-heart text-danger"></i>
                            <span>4</span>
                            &nbsp; &nbsp;
                            <i class="far fa-comment text-success"></i>
                            <span>4</span>
                            &nbsp; &nbsp;
                            <i class="far fa-bookmark text-primary"></i>
                            <span>4</span>
                        </div>

                        <!-- category -->
                        <div class="col-md-7">
                            <a href="" class="badge badge-sm bg-dark ml-1"
                                >web</a
                            >
                            <a href="" class="badge badge-sm bg-dark ml-1"
                                >android</a
                            >
                        </div>
                        <!-- end category -->
                        <div class="col-md-2">
                            <Link
                                href="/question-detail"
                                class="badge badge-sm bg-dark float-end"
                                >view</Link
                            >
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
    name: "QuestionDetail",
    components: { Master },
};
</script>
