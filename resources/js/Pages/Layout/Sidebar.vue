<template>
    <div class="col-md-4">
        <Link
            href="/question/create"
            class="btn btn-sm btn-primary btn-block mb-1"
            >Ask New Question</Link
        >
        <div class="card" v-show="!isProfileUrl">
            <div class="card-header">All Tag</div>
            <div class="card-body">
                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="tag in $page.props.tag"
                        :key="tag.id"
                    >
                        <Link :href="'/?tag=' + tag.slug" class="text-dark">
                            {{ tag.name }}</Link
                        >
                    </li>
                </ul>
            </div>
        </div>

        <!-- side bar for user profile -->
        <div class="card" v-show="isProfileUrl">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <Link class="text-dark">Edit Profile</Link>
                    </li>
                    <li class="list-group-item">
                        <Link href="/profile/question" class="text-dark"
                            >Your Question</Link
                        >
                    </li>
                    <li class="list-group-item">
                        <Link href="/profile/save-question" class="text-dark"
                            >Your Save Question</Link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
export default {
    components: {
        Link,
    },
    name: "Sidebar",

    computed: {
        isProfileUrl() {
            var url = location.pathname;
            var exp = "/profile/.*";
            var res = url.match(exp);

            if (res != null) {
                return true;
            }
            return false;
        },
    },
};
</script>
