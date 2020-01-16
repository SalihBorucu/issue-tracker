<template>
    <div class="c-task c-task--info">
        <p class="c-task__content">
            {{ task.title }}
        </p>
        <div class="c-task__indicators">
            <span class="c-task__indicator">
                <i class="fa fa-comments-o"></i>2
            </span>
            <span class="c-task__indicator">
                <i class="fa fa-check-square-o"></i>1/4
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["task"],
    data() {
        return {
            injTask: this.task
        };
    }
};
</script>
