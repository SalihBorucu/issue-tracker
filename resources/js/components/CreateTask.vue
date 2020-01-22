<template>
    <div class="c-task c-task--info">
        <p
            class="c-task__content"
            contenteditable="true"
            ref="editable"
            @keypress="titleChanged"
            @keyup.enter="storeTask"
            @focus="clearPh($event)"
        >
            New Task
        </p>
    </div>
</template>
<style></style>
<script>
export default {
    props: ["boardId"],

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

        storeTask() {
            const vm = this;

            let obj = {
                title: this.$refs.editable.innerText.trim(),
                board_id: this.boardId
            };

            axios
                .post("/ajax/task", obj)
                .then(function(response) {
                    // console.log(response.data.task);
                    let newTask = response.data.task;
                    vm.$emit("task-submitted", newTask);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
};
</script>
