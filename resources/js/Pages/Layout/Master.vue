<template>
    <div>
        <Navbar />
        <!-- end navbar -->

        <!-- side bar -->
        <div class="container mt-3">
            <div class="row">
                <Sidebar />
                <!-- end side bar -->
                <div class="col-md-8">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";

export default {
    name: "Master",

    components: {
        Navbar,
        Sidebar,
    },
};
</script>
