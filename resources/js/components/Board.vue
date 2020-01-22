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
                    <a @click="deleteBoard()">
                        <i class="fa fa-trash u-mr-xsmall"></i>
                    </a>
                </div>
            </div>

            <div
                class="c-board__content"
                :data-board-id="board.id"
                bag="first-bag"
                v-dragula="tasks"
            >
                <div
                    v-for="task in tasks"
                    :key="task.id"
                    :data-task-id="task.id"
                >
                    <task
                        :key="task.id"
                        :task="task"
                        @show-task-modal="launchEditTaskModal"
                    ></task>
                </div>
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
                @click="is_creating ? storeTaskOnClick() : createTask()"
            >
                <i
                    class="fa"
                    :class="{
                        'fa-plus': !is_creating,
                        'fa-check ': is_creating
                    }"
                ></i>
            </a>
        </div>
        <task-modal
            :task="editingTask"
            @task-deleted="deleteTask"
            @close-modal="closeModal()"
            @task-updated="replaceUpdatedTask"
            v-if="modalOn"
        ></task-modal>
    </div>
</template>

<script>
import Task from "./Task.vue";
import CreateTask from "./CreateTask.vue";
import TaskModal from "./TaskModal.vue";

export default {
    props: ["board"],

    components: { Task, CreateTask, TaskModal },

    data() {
        return {
            is_creating: false,
            tasks: this.board.tasks,
            modalOn: false,
            editingTask: null
        };
    },

    watch: {
        tasks() {
            const vm = this;

            this.$nextTick(() => {
                vm.$forceUpdate();
                Vue.vueDragula.eventBus.$forceUpdate();
            });

            // Vue.vueDragula.$forceUpdate();
        }
    },

    methods: {
        storeTaskOnClick() {
            this.$refs.createTaskComp.storeTask();
        },

        createTask() {
            if (!this.is_creating) {
                this.is_creating = true;
            }
        },

        submitTask(newTask) {
            // console.log(newTask);
            this.tasks.push(newTask);

            this.is_creating = false;
        },

        editBoard() {
            this.$emit("edit-board", this.board);
        },

        launchEditTaskModal(task) {
            this.editingTask = task;
            this.modalOn = true;
        },

        closeModal() {
            this.modalOn = false;
        },

        deleteTask(taskId) {
            this.tasks.forEach((element, index) => {
                if (element.id === taskId) {
                    this.tasks.splice(index, 1);
                }
            });
        },

        replaceUpdatedTask(task) {
            this.tasks.forEach((element, index) => {
                if (element.id === task.id) {
                    this.tasks[index] = task;
                }
            });
        },

        deleteBoard() {
            const vm = this;

            swal({
                title: "Are you sure?",
                text:
                    "Once deleted, you will not be able to recover this board and its tasks!",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(willDelete => {
                if (willDelete) {
                    axios
                        .delete("/ajax/board/" + vm.board.id)
                        .then(function(response) {
                            vm.$emit("board-deleted", vm.board.id);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                    swal("Your board has been deleted!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "OK",
                                className: "c-btn c-btn--info c-btn--fullwidth"
                            }
                        }
                    });
                }
            });
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
