<template>
    <div @click="launchEditTaskModal">
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
    </div>
</template>

<script>
import TaskModal from "./TaskModal";
export default {
    props: ["task"],
    components: { TaskModal },

    data() {
        return {
            injTask: this.task,
            modalOn: false
        };
    },

    methods: {
        launchEditTaskModal() {
            this.$emit("show-task-modal", this.task);
        }
    }
};
</script>
