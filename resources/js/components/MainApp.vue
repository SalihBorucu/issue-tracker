<template>
    <div>
        <div class="row">
            <board
                v-for="(board, index) in boards"
                :key="index"
                :board="board"
                @edit-board="editBoardModal"
            ></board>

            <div class="col-sm-6 col-md-4 col-xl">
                <a class="c-add-board" @click="createBoardModal()">
                    <i class="fa fa-plus"></i>Add a board
                </a>
            </div>
            <board-modal
                :editing-board="editing_board"
                @close-modal="closeModal()"
                @board-created="boardCreated"
                @board-updated="boardUpdated"
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
            modalOn: false,
            editing_board: null
        };
    },

    methods: {
        createBoardModal() {
            this.modalOn = true;
        },

        editBoardModal(val) {
            this.editing_board = val;
            this.modalOn = true;
        },

        boardCreated(board) {
            this.boards.push(board);
            this.modalOn = false;
        },

        boardUpdated(val) {
            this.boards.forEach((element, index) => {
                if (element.id === val.id) {
                    this.boards[index] = val;
                }
            });
        },

        closeModal() {
            this.modalOn = false;
            this.editing_board = null;
        }
    }
};
</script>
