<template>
    <div class="col-md-4">
        <a href="" class="btn btn-sm btn-primary btn-block mb-1"
            >Ask New Question</a
        >
        <div class="card">
            <div class="card-header">All Tag</div>
            <div class="card-body">
                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="tag in $page.props.tag"
                        :key="tag.id"
                    >
                        <Link class="text-dark"> {{ tag.name }}</Link>
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
};
</script>
