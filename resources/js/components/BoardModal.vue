<template>
    <div
        class="c-modal c-modal--xsmall modal fade"
        id="modal7"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modal7"
        data-backdrop="static"
    >
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">
                        {{ heading }}
                    </h3>

                    <span
                        class="c-modal__close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal()"
                    >
                        <i class="fa fa-close"></i>
                    </span>
                </div>

                <div class="c-modal__body">
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="title"
                            >Board Title
                        </label>
                        <input
                            id="title"
                            type="title"
                            class="c-input"
                            autocomplete="title"
                            autofocus
                            v-model="title"
                            :class="{ 'c-input--danger': title_error }"
                            @keypress="title_error = null"
                        />
                        <small
                            v-if="title_error"
                            class="c-field__message u-color-danger"
                            role="alert"
                        >
                            <i class="fa fa-times-circle"></i>
                            <span>{{ title_error }}</span>
                        </small>
                    </div>
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="color"
                            >Board Colour</label
                        >
                        <select
                            id="color"
                            type="color"
                            class="c-input"
                            name="color"
                            v-model="color"
                        >
                            <option value="c-board--info">Blue</option>
                            <option value="c-board--danger">Red</option>
                            <option value="c-board--success">Green</option>
                        </select>
                        <small
                            class="c-field__message u-color-danger"
                            role="alert"
                        >
                            <!-- <i class="fa fa-times-circle"></i> -->
                            <span></span>
                        </small>
                    </div>

                    <a
                        class="c-btn c-btn--success c-btn--fullwidth"
                        @click="submit()"
                    >
                        Submit
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["editingBoard"],

    data() {
        return {
            title: this.editingBoard ? this.editingBoard.title : null,
            color: this.editingBoard
                ? this.editingBoard.color
                : "c-board--info",

            title_error: null
        };
    },
    computed: {
        heading() {
            return this.editingBoard ? "Editing Board" : "Create Board";
        }
    },
    mounted() {
        $("#modal7").modal("show");
    },

    methods: {
        submit() {
            if (!this.title) {
                this.title_error = "This field is required.";
                return;
            }
            this.editingBoard ? this.update() : this.store();
        },
        store() {
            const vm = this;

            let obj = {
                title: this.title,
                color: this.color
            };
            axios
                .post("/ajax/board", obj)
                .then(function(response) {
                    console.log(response);
                    let newBoard = response.data.board;
                    vm.closeModal();
                    vm.$emit("board-created", newBoard);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        update() {
            const vm = this;

            let obj = {
                title: this.title,
                color: this.color
            };

            axios
                .patch("/ajax/board/" + this.editingBoard.id, obj)
                .then(function(response) {
                    console.log(response);
                    let updatedBoard = response.data.board;
                    vm.closeModal();
                    vm.$emit("board-updated", updatedBoard);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        closeModal() {
            this.$emit("close-modal");
            $("#modal7").modal("hide");
        }
    }
};
</script>
