<template>
    <div class="c-task c-task--info">
        <p
            class="c-task__content"
            contenteditable="true"
            ref="editable"
            @keypress="titleChanged"
            @keyup.enter="submitTask"
            @focus="clearPh($event)"
        >
            New Task
        </p>
    </div>
</template>
<style></style>
<script>
export default {
    data() {
        return {
            // title: null
        };
    },
    mounted() {
        const el = this.$refs.editable;
        el.focus();
    },

    methods: {
        clearPh(event) {
            let tgt = event.target;

            var range = document.createRange();
            range.selectNodeContents(tgt);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        },

        titleChanged(event) {
            if (event.keyCode === 13) {
                event.preventDefault();

                return;
            }
        },

        submitTask() {
            let newTitle = this.$refs.editable.innerText.trim();
            this.$emit("task-submitted", newTitle);
        }
    }
};
</script>
