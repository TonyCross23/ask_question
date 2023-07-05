<template>
    <div>
        <Navbar />
        <div v-show="$page.props.flash.success">
            <div class="text-center">
                <div
                    class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span class="font-semibold mr-2 text-left flex-auto">{{
                        $page.props.flash.success
                    }}</span>
                    <svg
                        class="fill-current opacity-75 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                        />
                    </svg>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="col-4 offset-4">
                <div class="card shadow-sm">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <form @submit.prevent="update">
                            <div class="form-group my-2">
                                <label for>Name</label>
                                <input
                                    type="text"
                                    placeholder="Enter Your Name"
                                    class="form-control"
                                    id="name"
                                    v-model="name"
                                />
                            </div>

                            <div class="form-group my-2">
                                <label for>Email</label>
                                <input
                                    type="email"
                                    placeholder="Enter Your Email"
                                    class="form-control"
                                    id="email"
                                    v-model="email"
                                />
                            </div>

                            <div class="form-group my-2">
                                <label for>Image</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    id="image"
                                    @change="selectimage"
                                />
                            </div>

                            <div class="form-group my-2">
                                <label for>Password</label>
                                <input
                                    type="password"
                                    placeholder="Enter Your Password"
                                    class="form-control"
                                    id="password"
                                    v-model="password"
                                />
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
                                    <span class="visually-hidden"
                                        >Loading...</span
                                    >
                                </div>
                                <span v-show="loading">wait...</span>
                                <span v-show="!loading">Register</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Layout/Navbar.vue";
export default {
    name: "EditUser",

    components: {
        Navbar,
    },

    data() {
        return {
            name: "",
            email: "",
            image: "",
            password: "",
            loading: false,
        };
    },

    created() {
        const { name, email } = this.$page.props.auth_user;
        this.name = name;
        this.email = email;
    },

    methods: {
        selectimage(e) {
            this.image = e.target.files[0];
        },

        update() {
            this.loading = true;
            var data = new FormData();
            data.append("name", this.name);
            data.append("email", this.email);
            data.append("image", this.image);
            data.append("password", this.password);
            this.$inertia
                .post("/user/profile/edit", data)
                .then(() => (this.loading = false));
        },
    },
};
</script>
