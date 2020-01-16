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
                            <option value="blue">Blue</option>
                            <option value="red">Red</option>
                            <option value="green">Green</option>
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
                        Connect Service
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: null,
            color: "blue",

            title_error: null,
            is_creating: true
        };
    },
    computed: {
        heading() {
            return this.is_creating ? "Create Board" : "Editing Board";
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
            this.is_creating ? this.store() : this.update();
        },
        store() {},
        update() {},
        closeModal() {
            this.$emit("close-modal");
        }
    }
};
</script>
