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
                    <p
                        @keypress="editTask()"
                        :contenteditable="is_editing"
                        ref="editable"
                    >
                        {{ task_description }}
                    </p>
                </div>

                <div class="c-modal__footer" v-if="is_editing">
                    <a
                        class="c-btn c-btn--success c-btn--fullwidth"
                        @click="submitTaskChange"
                        href="#"
                        >Save Changes
                    </a>
                </div>
                <ol class="c-stream">
                    <comment></comment>
                </ol>
                <!-- <div class="c-modal__footer"></div> -->
                <!-- add comments, add completed -->
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

        editTask() {
            // let newTitle = this.$refs.editableh3.innerText;
            // this.task_title = newTitle;
            // let newDescription = this.$refs.editable.innerText;
            // this.task_description = newDescription;
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
                    vm.closeModal();
                    vm.$emit("task-updated", updatedTask);
                })
                .catch(function(error) {
                    console.log(error);
                });
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
