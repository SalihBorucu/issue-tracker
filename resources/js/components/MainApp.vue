<template>
    <div>
        <div class="row">
            <board
                v-for="(board, index) in boards"
                :key="index"
                :board="board"
            ></board>

            <div class="col-sm-6 col-md-4 col-xl">
                <a class="c-add-board" @click="createBoardModal()">
                    <i class="fa fa-plus"></i>Add a board
                </a>
            </div>
            <board-modal
                @close-modal="modalOn = false"
                @board-created="boardCreated"
                v-if="modalOn"
            ></board-modal>
        </div>
    </div>
</template>

<script>
import Board from "./Board.vue";
import BoardModal from "./BoardModal.vue";
export default {
    props: ["injBoards"],
    components: { Board, BoardModal },
    data() {
        return {
            boards: this.injBoards,
            modalOn: false
        };
    },

    methods: {
        createBoardModal() {
            this.modalOn = true;
        },
        boardCreated(board) {
            this.boards.push(board);
            this.modalOn = false;
        }
    }
};
</script>
