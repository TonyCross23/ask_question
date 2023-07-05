<template>
    <div class="container mt-5">
        <div class="col-4 offset-4">
            <div class="card shadow-sm">
                <div class="card-header">User Register</div>
                <div class="card-body">
                    <form @submit.prevent="register">
                        <div class="form-group my-2">
                            <label for>Name</label>
                            <input
                                type="text"
                                :class="[
                                    'form-control',
                                    errors.name ? 'border border-danger' : '',
                                ]"
                                placeholder="Enter Your Name"
                                id="name"
                                v-model="name"
                            />
                            <small v-if="errors.name" class="text-danger">{{
                                errors.name
                            }}</small>
                        </div>

                        <div class="form-group my-2">
                            <label for>Email</label>
                            <input
                                type="email"
                                :class="[
                                    'form-control',
                                    errors.email ? 'border border-danger' : '',
                                ]"
                                placeholder="Enter Your Email"
                                id="email"
                                v-model="email"
                            />
                            <small v-if="errors.email" class="text-danger">{{
                                errors.email
                            }}</small>
                        </div>

                        <div class="form-group my-2">
                            <label for>Image</label>
                            <input
                                type="file"
                                :class="[
                                    'form-control',
                                    errors.image ? 'border border-danger' : '',
                                ]"
                                id="image"
                                @change="selectimage"
                            />
                            <small v-if="errors.image" class="text-danger">{{
                                errors.image
                            }}</small>
                        </div>

                        <div class="form-group my-2">
                            <label for>Password</label>
                            <input
                                type="password"
                                :class="[
                                    'form-control',
                                    errors.password
                                        ? 'border border-danger'
                                        : '',
                                ]"
                                placeholder="Enter Your Password"
                                id="password"
                                v-model="password"
                            />
                            <small v-if="errors.password" class="text-danger">{{
                                errors.password
                            }}</small>
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
                            <span v-show="!loading">Register</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: { errors: Object },
    name: "Register",
    data() {
        return {
            name: "",
            email: "",
            image: "",
            password: "",
            loading: false,
        };
    },

    //method
    methods: {
        selectimage(e) {
            this.image = e.target.files[0];
        },

        register() {
            this.loading = true;
            var data = new FormData();
            data.append("name", this.name);
            data.append("email", this.email);
            data.append("image", this.image);
            data.append("password", this.password);
            this.$inertia
                .post("/register", data)
                .then(() => (this.loading = false));
        },
    },
};
</script>
