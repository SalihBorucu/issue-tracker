<template>
    <div
        class="c-modal modal fade"
        id="task-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="task-modal"
        data-backdrop="static"
        style="display: none;"
        aria-hidden="true"
    >
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header ">
                    <div class="col pl-0">
                        <h3
                            @keyup="editTask()"
                            class="c-modal__title"
                            :contenteditable="is_editing"
                            ref="editableh3"
                        >
                            {{ task_title }}
                        </h3>
                    </div>
                    <div class="col-auto px-0">
                        <a @click="deleteTask()">
                            <i class="fa fa-trash u-text-white u-mr-xsmall"></i>
                        </a>

                        <a @click="enableEditTask" v-if="!is_editing">
                            <i class="u-text-white fa fa-pencil u-mr-xsmall"></i
                        ></a>
                        <a @click="submitTaskChange" v-else>
                            <i class="u-text-white fa fa-check u-mr-xsmall"></i
                        ></a>
                        <span
                            class="c-modal__close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="closeModal"
                        >
                            <i class="fa fa-close"></i>
                        </span>
                    </div>
                </div>

                <div class="c-modal__body">
                    <p :contenteditable="is_editing" ref="editable">
                        {{ task_description }}
                    </p>
                </div>

                <div class="c-modal__footer" v-if="is_editing">
                    <a
                        class="c-btn c-btn--success c-btn--fullwidth"
                        @click="submitTaskChange"
                        >Save Changes
                    </a>
                </div>
                <div v-if="!this.is_editing">
                    <ol class="c-stream u-mb-zero">
                        <comment
                            :comment="comment"
                            v-for="(comment, index) in task.comments"
                            :key="index"
                        ></comment>
                    </ol>
                    <div class="c-modal__footer">
                        <div class="c-chat__composer">
                            <div class="c-field has-addon-left">
                                <input
                                    @keydown.enter="submitNewComment"
                                    v-model="new_comment"
                                    class="c-input"
                                    type="text"
                                    placeholder="Write your comment here."
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Comment from "./Comment.vue";

export default {
    props: ["task"],

    components: { Comment },

    data() {
        return {
            new_comment: null,
            is_editing: false,
            task_title: this.task.title,
            task_description: this.task.description
        };
    },
    mounted() {
        $("#task-modal").modal("show");
    },

    methods: {
        closeModal() {
            this.$emit("close-modal");
            $("#task-modal").modal("hide");
        },

        enableEditTask() {
            const vm = this;
            this.is_editing = !this.is_editing;
            this.$nextTick(() => {
                vm.$refs.editableh3.focus();
            });
        },

        submitTaskChange() {
            const vm = this;

            let obj = {
                title: vm.$refs.editableh3.innerText.trim(),
                description: vm.$refs.editable.innerText.trim()
            };

            axios
                .patch("/ajax/task/" + vm.task.id, obj)
                .then(function(response) {
                    let updatedTask = response.data.task;
                    console.log(updatedTask);
                    vm.closeModal();
                    vm.$emit("task-updated", updatedTask);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        deleteTask() {
            const vm = this;

            axios
                .delete("/ajax/task/" + vm.task.id)
                .then(function(response) {
                    vm.closeModal();
                    vm.$emit("task-deleted", vm.task.id);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        submitNewComment() {
            console.log(this.new_comment);
            if (this.new_comment) {
                let obj = {
                    message: this.new_comment,
                    task_id: this.task.id
                };

                const vm = this;

                axios
                    .post("/ajax/comment", obj)
                    .then(function(response) {
                        console.log(response);
                        vm.task.comments.push(response.data.comment);
                        vm.new_comment = null;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }
    }
};
</script>
<style>
a .edit {
    color: #eff3f6;
}

[contenteditable="true"] {
    display: block;
    width: 100%;
    margin: 0;
    padding: 0.59375rem 0.9375rem;
    transition: all 0.3s;
    border: 1px solid #dfe3e9;
    border-radius: 4px;
    background-color: #fff;
    color: #354052;
}

.px-0 {
    padding-left: 0;
    padding-right: 0;
}

.pl-0 {
    padding-left: 0;
}
</style>
