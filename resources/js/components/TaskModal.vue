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
                <div class="c-modal__header">
                    <h3
                        @keyup="editTask()"
                        class="c-modal__title"
                        :contenteditable="is_editing"
                        ref="editableh3"
                    >
                        {{ task_title }}
                    </h3>
                    <div>
                        <a @click="enableEditTask"
                            ><i class=" edit fa fa-pencil u-mr-xsmall"></i
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

                <div class="c-modal__footer"></div>
                <!-- add comments, add completed -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["task"],
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
            this.is_editing = !this.is_editing;
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
                title: vm.$refs.editableh3.innerText,
                description: vm.$refs.editable.innerText
            };

            axios
                .patch("/ajax/task/" + vm.task.id, obj)
                .then(function(response) {
                    console.log(response);
                    let updatedTask = response.data.task;
                    vm.closeModal();

                    // BURDA GALDIK VUEX MI GULLANACAYIK GRANDPARENTE YOLLAMAK ICIN?
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
</style>
