<template>
    <div>
        <div class="row">
            <board
                v-for="(board, index) in boards"
                :key="index"
                :board="board"
                @edit-board="editBoardModal"
                @board-deleted="deleteBoard"
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

    mounted() {
        const vm = this;

        // Vue.vueDragula.eventBus.$on("drop", function(args) {
        //     console.log("asd");
        // });

        // Vue.vueDragula.eventBus.$on("drag", function(args) {
        //     console.log("123");
        // });

        Vue.vueDragula.eventBus.$on("drop", function(args) {
            let taskId = parseInt(args[1].dataset.taskId);
            let fromBoardId = parseInt(args[3].dataset.boardId);
            let toBoardId = parseInt(args[2].dataset.boardId);
            console.log(args);

            let obj = {
                board_id: toBoardId
            };

            axios
                .patch("/ajax/task/" + taskId + "/update-board", obj)
                .then(function(response) {
                    // console.log(response);

                    let fromBoardIndex = vm.boards.findIndex(
                        board => board.id === fromBoardId
                    );
                    let toBoardIndex = vm.boards.findIndex(
                        board => board.id === toBoardId
                    );

                    vm.boards[fromBoardIndex].tasks.forEach((task, index) => {
                        if (task.id === taskId) {
                            // vm.boards[fromBoardIndex].tasks.splice(index, 1);

                            task.board_id = toBoardId;
                            // vm.boards[toBoardIndex].tasks.push(task);
                        }
                    });
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
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
        },

        deleteBoard(boardId) {
            this.boards.forEach((element, index) => {
                if (element.id === boardId) {
                    this.boards.splice(index, 1);
                }
            });
        }
    }
};
</script>
