<template>
    <div>
        <div class="c-task c-task--info" @click="launchEditTaskModal">
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
        <task-modal
            v-if="modalOn"
            @close-modal="closeModal()"
            :task="injTask"
        ></task-modal>
    </div>
</template>

<script>
import TaskModal from "./TaskModal.vue";
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
            this.modalOn = true;
        },

        closeModal() {
            this.modalOn = false;
        }
    }
};
</script>
