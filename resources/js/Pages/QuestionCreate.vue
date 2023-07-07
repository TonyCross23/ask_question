<template>
    <Master>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="createQuestion()">
                        <div class="form-group my-3">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter Title"
                                v-model="title"
                            />
                        </div>

                        <div class="form-group my-3">
                            <div v-for="t in $page.props.tag" :key="t.id">
                                <input
                                    :value="t.id"
                                    type="checkbox"
                                    v-model="tag"
                                />
                                <label class="me-1">{{ t.name }}</label>
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <textarea
                                v-model="description"
                                class="form-control"
                                placeholder="Enter Description"
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-danger float-right mt-2"
                            :disabled="loading"
                        >
                            <div
                                v-show="loading"
                                class="spinner-border spinner-border-sm"
                                role="status"
                            >
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span v-show="loading">wait...</span>
                            <span v-show="!loading">Submit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from "./Layout/Master.vue";
export default {
    name: "QuestionCreate",

    components: { Master },

    data() {
        return {
            title: "",
            tag: [],
            description: "",
            loading: false,
        };
    },

    methods: {
        createQuestion() {
            this.loading = true;
            var data = new FormData();
            data.append("title", this.title);
            data.append("tag", this.tag);
            data.append("description", this.description);
            axios.post("/question/create", data).then((res) => {
                this.loading = false;
            });
        },
    },
};
</script>
