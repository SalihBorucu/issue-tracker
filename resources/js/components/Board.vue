<template>
    <div class="col-sm-6 col-md-4 col-xl">
        <div class="c-board" :class="board.color">
            <div class="c-board__header">
                <h4 class="c-board__title">
                    {{ board.title }}
                    <span class="u-text-mute"> {{ tasks.length }}</span>
                </h4>
                <div>
                    <a @click="editBoard()">
                        <i class="fa fa-pencil u-mr-xsmall"></i>
                    </a>
                </div>
            </div>

            <div class="c-board__content">
                <!-- // .c-task -->
                <task
                    v-for="(task, index) in tasks"
                    :key="index"
                    :task="task"
                ></task>
                <create-task
                    ref="createTaskComp"
                    v-if="is_creating"
                    @task-submitted="submitTask"
                    :board-id="board.id"
                ></create-task>
            </div>
            <a
                class="c-board__btn"
                :class="{ 'c-board__btn--success': is_creating }"
                @click="createTask()"
            >
                <i
                    class="fa"
                    :class="{
                        'fa-plus': !is_creating,
                        'fa-check': is_creating
                    }"
                ></i>
            </a>
        </div>
        <!-- // .c-board__content -->
    </div>
    <!-- // .c-board -->
</template>

<script>
import Task from "./Task.vue";
import CreateTask from "./CreateTask.vue";

export default {
    props: ["board"],

    components: { Task, CreateTask },

    data() {
        return {
            is_creating: false,
            tasks: this.board.tasks
        };
    },

    methods: {
        createTask() {
            if (this.is_creating) {
                // SUBMIT
                // trigger method in child from parent
                this.$refs.createTaskComp.submitTask();
            } else {
                // SHOW
                this.is_creating = true;
            }
        },

        submitTask(newTitle) {
            console.log(newTitle);
            this.tasks.push({ title: newTitle });
            this.is_creating = false;
        },

        editBoard() {
            this.$emit("edit-board", this.board);
        }
    }
};
</script>

<style>
.c-board__btn--success {
    background: #39b54a;
    background: linear-gradient(180deg, #39b54a, #34aa44);
    border-color: #249533;
}
</style>
